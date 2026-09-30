<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class ExportStudents extends Command
{
    protected $signature = 'sikes:export-students {--dry-run} {--chunk=300}';

    protected $description = 'Ekspor kelas, akun siswa, role, dan siswa sebagai file SQL idempotent';

    private const MAX_FILE_BYTES = 1_500_000;

    public function handle(): int
    {
        $chunkSize = filter_var($this->option('chunk'), FILTER_VALIDATE_INT);
        if (! $chunkSize || $chunkSize < 1) {
            $this->error('Opsi --chunk harus berupa bilangan bulat lebih besar dari 0.');

            return self::FAILURE;
        }

        try {
            $export = $this->collectExportRows();
            $studentStatements = array_map(fn (array $row) => $this->studentStatement($row), $export['students']);
            $studentParts = $this->partitionStatements($studentStatements, $chunkSize);
            $fileCount = 3 + count($studentParts);

            $fileStatements = [
                '01_classrooms.sql' => $export['classroom_statements'],
                '02_users.sql' => $export['user_statements'],
                '03_roles.sql' => $export['role_statements'],
            ];
            foreach ($studentParts as $index => $part) {
                $fileStatements[sprintf('04_students_part%d.sql', $index + 1)] = $part;
            }
            foreach ($fileStatements as $filename => $statements) {
                if (strlen($this->sqlContents($statements)) > self::MAX_FILE_BYTES) {
                    throw new RuntimeException($filename . ' melewati batas ukuran file SQL 1,5 MB.');
                }
            }

            if ($this->option('dry-run')) {
                $this->printSummary($export, $fileCount + 1, null);

                return self::SUCCESS;
            }

            $directory = $this->createExportDirectory();
            $this->writeSqlFile($directory . DIRECTORY_SEPARATOR . '01_classrooms.sql', $export['classroom_statements']);
            $this->writeSqlFile($directory . DIRECTORY_SEPARATOR . '02_users.sql', $export['user_statements']);
            $this->writeSqlFile($directory . DIRECTORY_SEPARATOR . '03_roles.sql', $export['role_statements']);

            foreach ($studentParts as $index => $part) {
                $filename = sprintf('04_students_part%d.sql', $index + 1);
                $this->writeSqlFile($directory . DIRECTORY_SEPARATOR . $filename, $part);
            }

            $this->writeReadme($directory, count($studentParts));
            $this->printSummary($export, $fileCount + 1, $directory);

            return self::SUCCESS;
        } catch (\Throwable $exception) {
            $this->error('Ekspor gagal: ' . $exception->getMessage());

            return self::FAILURE;
        }
    }

    protected function collectExportRows(): array
    {
        $quote = fn (mixed $value): string => $this->quote($value);
        $students = [];
        $users = [];
        $classrooms = [];
        $warnings = [
            'nis_kosong' => 0,
            'kelas_kosong' => 0,
            'tanggal_lahir_kosong' => 0,
            'akun_tidak_tersedia' => 0,
            'akun_role_admin_petugas' => 0,
            'major_tidak_tersedia' => 0,
        ];

        Student::query()
            ->with(['user.roles', 'class.major'])
            ->orderBy('id')
            ->chunk(200, function ($studentChunk) use (&$students, &$users, &$classrooms, &$warnings) {
                foreach ($studentChunk as $student) {
                    $nis = trim((string) $student->nis);
                    if ($nis === '') {
                        $warnings['nis_kosong']++;
                        continue;
                    }

                    if (! $student->birth_date) {
                        $warnings['tanggal_lahir_kosong']++;
                    }

                    $user = $student->user;
                    if (! $user || trim((string) $user->email) === '') {
                        $warnings['akun_tidak_tersedia']++;
                        continue;
                    }

                    $roleNames = $user->roles->pluck('name')->all();
                    if (array_intersect(['admin', 'super-admin', 'petugas'], $roleNames)) {
                        $warnings['akun_role_admin_petugas']++;
                        continue;
                    }

                    $email = trim((string) $user->email);
                    $users[$email] = [
                        'email' => $email,
                        'name' => (string) $user->name,
                        'password' => (string) $user->password,
                        'status' => in_array($user->status, ['active', 'inactive'], true) ? $user->status : 'active',
                    ];

                    $classroom = $student->class;
                    if ($classroom && $classroom->deleted_at !== null) {
                        $classroom = null;
                    }
                    $className = $classroom ? trim((string) $classroom->name) : '';
                    $majorName = $classroom?->major?->name;
                    if ($className === '') {
                        $warnings['kelas_kosong']++;
                        $className = null;
                    } elseif (! $majorName) {
                        $warnings['major_tidak_tersedia']++;
                        $warnings['kelas_kosong']++;
                        $className = null;
                    } else {
                        $key = mb_strtoupper(preg_replace('/\s+/u', ' ', $className));
                        $classrooms[$key] = [
                            'name' => $className,
                            'major_name' => (string) $majorName,
                            'grade' => (int) ($classroom->grade ?? 0),
                            'code' => $this->classCode($className),
                        ];
                    }

                    $students[] = [
                        'nis' => $nis,
                        'user_email' => $email,
                        'classroom_name' => $className,
                        'full_name' => (string) $student->full_name,
                        'birth_place' => $student->birth_place,
                        'birth_date' => $student->birth_date?->format('Y-m-d'),
                        'address' => $student->address,
                        'parent_name' => $student->parent_name,
                        'parent_phone' => $student->parent_phone,
                        'blood_type' => $student->blood_type,
                        'allergy_history' => $student->allergy_history,
                    ];
                }
            });

        $userStatements = $this->userStatements(array_values($users));
        $roleStatements = $this->roleStatements(array_values($users));
        $classroomStatements = [];

        foreach (array_values($classrooms) as $classroom) {
            $classroomStatements[] = $this->classroomStatement($classroom);
        }

        return [
            'students' => $students,
            'users' => array_values($users),
            'classrooms' => array_values($classrooms),
            'classroom_statements' => $classroomStatements,
            'user_statements' => $userStatements,
            'role_statements' => $roleStatements,
            'warnings' => $warnings,
        ];
    }

    protected function classroomStatement(array $classroom): string
    {
        $majorName = $this->quote($classroom['major_name']);
        $name = $this->quote($classroom['name']);
        $code = $this->quote($classroom['code']);
        $grade = (int) $classroom['grade'];
        $createdAt = $this->quote(now()->toDateTimeString());

        return "INSERT INTO classrooms (major_id, name, code, grade, created_at, updated_at)\n"
            . "SELECT (SELECT id FROM majors WHERE name = {$majorName} AND deleted_at IS NULL LIMIT 1), {$name}, {$code}, {$grade}, {$createdAt}, {$createdAt}\n"
            . "WHERE EXISTS (SELECT 1 FROM majors WHERE name = {$majorName} AND deleted_at IS NULL)\n"
            . "AND NOT EXISTS (SELECT 1 FROM classrooms WHERE name = {$name} AND deleted_at IS NULL)\n"
            . "AND NOT EXISTS (SELECT 1 FROM classrooms WHERE code = {$code} AND deleted_at IS NULL)";
    }

    protected function userStatements(array $users): array
    {
        if ($users === []) {
            return [];
        }

        $values = [];
        $now = $this->quote(now()->toDateTimeString());
        foreach ($users as $user) {
            $values[] = '(' . implode(', ', [
                $this->quote($user['name']),
                $this->quote($user['email']),
                $this->quote($user['password']),
                $this->quote($user['status']),
                $now,
                $now,
            ]) . ')';
        }

        $insert = 'INSERT INTO users (name, email, password, status, created_at, updated_at) VALUES' . "\n"
            . implode(",\n", $values);
        $guard = $this->studentAccountGuard('users.id');

        return [$insert . "\nON DUPLICATE KEY UPDATE\n"
            . "name = IF(users.deleted_at IS NULL AND {$guard}, VALUES(name), users.name),\n"
            . "updated_at = IF(users.deleted_at IS NULL AND {$guard}, VALUES(updated_at), users.updated_at)"];
    }

    protected function roleStatements(array $users): array
    {
        $ignore = 'INSERT IGNORE';
        $createdAt = $this->quote(now()->toDateTimeString());
        $statements = [
            "{$ignore} INTO roles (name, guard_name, created_at, updated_at) VALUES ('siswa', 'web', {$createdAt}, {$createdAt})",
        ];

        foreach ($users as $user) {
            $email = $this->quote($user['email']);
            $modelType = $this->quote('App\\Models\\User');
            $userGuard = $this->unprotectedAccountGuard('target_user.id');
            $statements[] = "{$ignore} INTO model_has_roles (role_id, model_type, model_id)\n"
                . "SELECT (SELECT id FROM roles WHERE name = 'siswa' AND guard_name = 'web' LIMIT 1), {$modelType},\n"
                . "(SELECT id FROM users AS target_user WHERE email = {$email} AND deleted_at IS NULL LIMIT 1)\n"
                . "WHERE EXISTS (SELECT 1 FROM users AS target_user WHERE email = {$email} AND deleted_at IS NULL AND {$userGuard})";
        }

        return $statements;
    }

    protected function studentStatement(array $student): string
    {
        $nis = $this->quote($student['nis']);
        $email = $this->quote($student['user_email']);
        $className = $student['classroom_name'] === null ? null : $this->quote($student['classroom_name']);
        $userGuard = $this->studentAccountGuard('export_user.id');
        $userId = "(SELECT export_user.id FROM users AS export_user WHERE export_user.email = {$email} AND export_user.deleted_at IS NULL AND {$userGuard} LIMIT 1)";
        $classroomId = $className === null
            ? 'NULL'
            : "(SELECT id FROM classrooms WHERE name = {$className} AND deleted_at IS NULL LIMIT 1)";
        $createdAt = $this->quote(now()->toDateTimeString());

        $columns = [
            'user_id', 'classroom_id', 'nis', 'full_name', 'birth_place', 'birth_date',
            'address', 'parent_name', 'parent_phone', 'blood_type', 'allergy_history', 'created_at', 'updated_at',
        ];
        $select = [
            $userId,
            $classroomId,
            $nis,
            $this->quote($student['full_name']),
            $this->quote($student['birth_place']),
            $this->quote($student['birth_date']),
            $this->quote($student['address']),
            $this->quote($student['parent_name']),
            $this->quote($student['parent_phone']),
            $this->quote($student['blood_type']),
            $this->quote($student['allergy_history']),
            $createdAt,
            $createdAt,
        ];

        $statement = 'INSERT INTO students (' . implode(', ', $columns) . ")\nSELECT\n    "
            . implode(",\n    ", $select)
            . "\nWHERE EXISTS (SELECT 1 FROM users AS export_user WHERE export_user.email = {$email} AND export_user.deleted_at IS NULL AND {$userGuard})";

        if ($className !== null) {
            $statement .= "\nAND EXISTS (SELECT 1 FROM classrooms WHERE name = {$className} AND deleted_at IS NULL)";
        }

        $updates = [
            'user_id', 'classroom_id', 'full_name', 'birth_place', 'birth_date', 'address',
            'parent_name', 'parent_phone', 'blood_type', 'allergy_history', 'updated_at',
        ];

        $updates = array_map(fn ($column) => "{$column} = IF(students.deleted_at IS NULL, VALUES({$column}), students.{$column})", $updates);
        $statement .= "\nON DUPLICATE KEY UPDATE\n    " . implode(",\n    ", $updates);

        return $statement;
    }

    protected function studentAccountGuard(string $userIdExpression): string
    {
        $modelType = $this->quote('App\\Models\\User');

        return "EXISTS (SELECT 1 FROM model_has_roles AS student_roles JOIN roles AS student_role ON student_role.id = student_roles.role_id WHERE student_roles.model_id = {$userIdExpression} AND student_roles.model_type = {$modelType} AND student_role.name = 'siswa' AND student_role.guard_name = 'web')"
            . ' AND ' . $this->unprotectedAccountGuard($userIdExpression);
    }

    protected function unprotectedAccountGuard(string $userIdExpression): string
    {
        $modelType = $this->quote('App\\Models\\User');

        return "NOT EXISTS (SELECT 1 FROM model_has_roles AS protected_roles JOIN roles AS protected_role ON protected_role.id = protected_roles.role_id WHERE protected_roles.model_id = {$userIdExpression} AND protected_roles.model_type = {$modelType} AND protected_role.name IN ('admin', 'super-admin', 'petugas') AND protected_role.guard_name = 'web')";
    }

    protected function partitionStatements(array $statements, int $chunkSize): array
    {
        $parts = [];
        $current = [];
        $currentBytes = strlen($this->sqlHeader()) + strlen($this->sqlFooter());

        foreach ($statements as $statement) {
            $statementBytes = strlen($statement) + 2;
            if ($statementBytes + strlen($this->sqlHeader()) + strlen($this->sqlFooter()) > self::MAX_FILE_BYTES) {
                throw new RuntimeException('Satu baris siswa melebihi batas ukuran file SQL 1,5 MB.');
            }

            if ($current !== [] && (count($current) >= $chunkSize || $currentBytes + $statementBytes > self::MAX_FILE_BYTES)) {
                $parts[] = $current;
                $current = [];
                $currentBytes = strlen($this->sqlHeader()) + strlen($this->sqlFooter());
            }

            $current[] = $statement;
            $currentBytes += $statementBytes;
        }

        if ($current !== [] || $parts === []) {
            $parts[] = $current;
        }

        return $parts;
    }

    protected function writeSqlFile(string $path, array $statements): void
    {
        $contents = $this->sqlContents($statements);
        if (strlen($contents) > self::MAX_FILE_BYTES) {
            throw new RuntimeException('File SQL melewati batas ukuran 1,5 MB: ' . basename($path));
        }

        File::put($path, $contents);
    }

    protected function sqlContents(array $statements): string
    {
        $body = $statements ? implode(";\n", $statements) . ";\n" : '';

        return $this->sqlHeader() . $body . $this->sqlFooter();
    }

    protected function writeReadme(string $directory, int $studentParts): void
    {
        $parts = [];
        for ($index = 1; $index <= $studentParts; $index++) {
            $parts[] = sprintf('04_students_part%d.sql', $index);
        }

        $instructions = [
            'IMPORT EKSPOR DATA SISWA SIKES',
            '',
            'Prasyarat: jalankan seluruh migration SIKES yang tertunda, termasuk classrooms.code VARCHAR(50) dan students.birth_date/classroom_id nullable. Pastikan major dengan nama yang dipakai kelas sudah tersedia.',
            'Jangan impor bersamaan dengan proses sinkronisasi lain.',
            '',
            'Urutan impor melalui phpMyAdmin:',
            '1. 01_classrooms.sql',
            '2. 02_users.sql',
            '3. 03_roles.sql',
            ...array_map(fn ($part, $index) => ($index + 4) . '. ' . $part, $parts, array_keys($parts)),
            '',
            'Setiap file berisi SET NAMES utf8mb4 serta transaction sendiri.',
            'Ekspor dirancang idempotent. Jangan mengubah atau menghapus password akun yang sudah ada.',
            'File 02_users.sql berisi hash password untuk akun baru; batasi akses folder ekspor dan hapus file setelah proses impor selesai.',
            'Akun admin, super-admin, dan petugas dilindungi dari perubahan nama/password dan tidak diberi role siswa oleh dump ini.',
            'Siswa tanpa NIS tidak diekspor. Tanggal lahir kosong tetap NULL. Kelas yang tidak dapat dipetakan ditulis NULL.',
            '',
        ];

        File::put($directory . DIRECTORY_SEPARATOR . 'README-IMPORT.txt', implode(PHP_EOL, $instructions));
    }

    protected function printSummary(array $export, int $fileCount, ?string $directory): void
    {
        $roleCount = count($export['users']);
        $this->line('Kelas: ' . count($export['classrooms']));
        $this->line('User siswa: ' . count($export['users']));
        $this->line('Role siswa yang ditautkan: ' . $roleCount . ' (definisi role: 1)');
        $this->line('Siswa diekspor: ' . count($export['students']));
        $this->line('Jumlah file: ' . $fileCount);
        $this->line('Lokasi: ' . ($directory ?? '(dry-run, file tidak ditulis)'));

        foreach ($export['warnings'] as $name => $count) {
            if ($count > 0) {
                $this->warn('Peringatan ' . str_replace('_', ' ', $name) . ': ' . $count);
            }
        }
    }

    protected function createExportDirectory(): string
    {
        $base = storage_path('app/exports');
        File::ensureDirectoryExists($base);
        $timestamp = now()->format('Ymd-His');
        $directory = $base . DIRECTORY_SEPARATOR . 'sikes-students-' . $timestamp;
        $suffix = 1;
        while (File::exists($directory)) {
            $directory = $base . DIRECTORY_SEPARATOR . 'sikes-students-' . $timestamp . '-' . $suffix++;
        }
        File::ensureDirectoryExists($directory);

        return $directory;
    }

    protected function classCode(string $name): string
    {
        $slug = Str::upper(Str::slug($name, '_'));
        $hash = strtoupper(substr(hash('sha256', mb_strtoupper(trim($name))), 0, 16));

        return substr($slug, 0, 30) . '_' . $hash;
    }

    protected function quote(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        return DB::connection()->getPdo()->quote((string) $value);
    }

    protected function sqlHeader(): string
    {
        return "SET NAMES utf8mb4;\nSTART TRANSACTION;\n";
    }

    protected function sqlFooter(): string
    {
        return "COMMIT;\n";
    }
}