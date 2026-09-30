<?php

namespace Tests\Feature;

use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ExportStudentsTest extends TestCase
{
    private array $createdExportDirectories = [];

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
    }

    protected function tearDown(): void
    {
        foreach ($this->createdExportDirectories as $directory) {
            File::deleteDirectory($directory);
        }

        DB::purge('export_test');
        parent::tearDown();
    }

    public function test_export_imported_twice_is_idempotent_and_protects_accounts_and_strings(): void
    {
        $major = Major::create(['name' => 'PPLG', 'code' => 'PPLG']);
        $classroom = ClassRoom::create([
            'major_id' => $major->id,
            'name' => 'XII MPLB 1',
            'code' => 'XII_MPLB_1',
            'grade' => 12,
        ]);

        $existingSourceUser = $this->createSourceUser('existing@sikes.sch.id', "D'Angelo", 'source-existing-password');
        $newSourceUser = $this->createSourceUser('new@sikes.sch.id', 'Siswa Baru', 'source-new-password');
        $collisionSourceUser = $this->createSourceUser('collision@sikes.sch.id', 'Nama Siswa Bentrok', 'source-collision-password');
        $collisionStaffSourceUser = $this->createSourceUser('staff-collision@sikes.sch.id', 'Nama Petugas Bentrok', 'source-staff-password');
        $noClassUser = $this->createSourceUser('noclass@sikes.sch.id', 'Siswa Tanpa Kelas', 'source-no-class-password');
        $blankNisUser = $this->createSourceUser('blank-nis@sikes.sch.id', 'NIS Kosong', 'source-blank-password');
        $this->createSourceUser('orphan@sikes.sch.id', 'Akun Tanpa Siswa', 'orphan-password');

        $this->createStudent($existingSourceUser, $classroom, '00001', "D'Angelo");
        $this->createStudent($newSourceUser, $classroom, '00002', 'Siswa Baru');
        $this->createStudent($collisionSourceUser, $classroom, '00003', 'Nama Siswa Bentrok');
        $this->createStudent($noClassUser, null, '00004', 'Siswa Tanpa Kelas');
        $this->createStudent($collisionStaffSourceUser, $classroom, '00005', 'Nama Petugas Bentrok');
        $this->createStudent($blankNisUser, $classroom, '', 'NIS Kosong');

        $this->createTargetDatabase($major->name);
        $this->seedTargetUser('existing@sikes.sch.id', 'Nama Sebelum Impor', 'TARGET-KEEP-EXISTING', 'siswa');
        $this->seedTargetUser('collision@sikes.sch.id', 'Admin Tetap', 'TARGET-KEEP-ADMIN', 'admin');
        $this->seedTargetUser('staff-collision@sikes.sch.id', 'Petugas Tetap', 'TARGET-KEEP-STAFF', 'petugas');

        $beforeDirectories = $this->exportDirectories();
        $exitCode = Artisan::call('sikes:export-students', ['--chunk' => 2]);
        if ($exitCode !== 0) {
            $this->fail('Exporter returned ' . $exitCode . ': ' . Artisan::output());
        }
        $this->assertStringNotContainsString($existingSourceUser->password, Artisan::output());
        $exportDirectory = array_values(array_diff($this->exportDirectories(), $beforeDirectories))[0] ?? null;
        $this->assertNotNull($exportDirectory);
        $this->createdExportDirectories[] = $exportDirectory;

        $files = collect(File::files($exportDirectory))
            ->reject(fn ($file) => $file->getFilename() === 'README-IMPORT.txt')
            ->sortBy(fn ($file) => $file->getFilename())
            ->values();
        $filenames = $files->map(fn ($file) => $file->getFilename())->all();
        $this->assertSame([
            '01_classrooms.sql',
            '02_users.sql',
            '03_roles.sql',
            '04_students_part1.sql',
            '04_students_part2.sql',
            '04_students_part3.sql',
        ], $filenames);
        $this->assertFileExists($exportDirectory . DIRECTORY_SEPARATOR . 'README-IMPORT.txt');

        foreach ($files as $file) {
            $contents = File::get($file->getPathname());
            $this->assertLessThanOrEqual(1_500_000, strlen($contents));
            $this->assertStringStartsWith("SET NAMES utf8mb4;\nSTART TRANSACTION;", $contents);
            $this->assertStringEndsWith("COMMIT;\n", $contents);
        }

        $this->assertStringContainsString("'D''Angelo'", File::get($exportDirectory . DIRECTORY_SEPARATOR . '02_users.sql'));
        $this->assertStringContainsString('ON DUPLICATE KEY UPDATE', File::get($exportDirectory . DIRECTORY_SEPARATOR . '02_users.sql'));
        $this->assertStringContainsString('INSERT IGNORE INTO model_has_roles', File::get($exportDirectory . DIRECTORY_SEPARATOR . '03_roles.sql'));
        $this->assertStringContainsString('ON DUPLICATE KEY UPDATE', File::get($exportDirectory . DIRECTORY_SEPARATOR . '04_students_part1.sql'));
        $this->importExportFiles($exportDirectory);
        $firstCounts = $this->targetCounts();
        $this->importExportFiles($exportDirectory);
        $secondCounts = $this->targetCounts();

        if ($firstCounts !== $secondCounts) {
            $this->fail('Counts after first import: ' . json_encode($firstCounts) . '; after second: ' . json_encode($secondCounts));
        }
        $this->assertSame([
            'classrooms' => 1,
            'users' => 5,
            'student_roles' => 3,
            'students' => 3,
        ], $firstCounts, 'Actual import counts: ' . json_encode($firstCounts) . '; role SQL: ' . File::get($exportDirectory . DIRECTORY_SEPARATOR . '03_roles.sql'));
        $this->assertLessThanOrEqual(50, strlen((string) DB::connection('export_test')->table('classrooms')->value('code')));

        $getUser = fn (string $email) => DB::connection('export_test')->table('users')->where('email', $email);
        $this->assertSame('TARGET-KEEP-EXISTING', $getUser('existing@sikes.sch.id')->value('password'));
        $this->assertSame('D\'Angelo', $getUser('existing@sikes.sch.id')->value('name'));
        $this->assertSame('Admin Tetap', $getUser('collision@sikes.sch.id')->value('name'));
        $this->assertSame('TARGET-KEEP-ADMIN', $getUser('collision@sikes.sch.id')->value('password'));
        $this->assertSame('Petugas Tetap', $getUser('staff-collision@sikes.sch.id')->value('name'));
        $this->assertSame('TARGET-KEEP-STAFF', $getUser('staff-collision@sikes.sch.id')->value('password'));
        $this->assertSame(0, DB::connection('export_test')->table('model_has_roles')->where('model_id', $getUser('staff-collision@sikes.sch.id')->value('id'))->where('role_id', DB::connection('export_test')->table('roles')->where('name', 'siswa')->value('id'))->count());
        $this->assertSame(0, DB::connection('export_test')->table('model_has_roles')->where('model_id', $getUser('collision@sikes.sch.id')->value('id'))->where('role_id', DB::connection('export_test')->table('roles')->where('name', 'siswa')->value('id'))->count());
        $this->assertSame(0, DB::connection('export_test')->table('students')->where('nis', '00003')->count());
        $this->assertNull(DB::connection('export_test')->table('students')->where('nis', '00004')->value('classroom_id'));
        $this->assertNull(DB::connection('export_test')->table('students')->where('nis', '00002')->value('birth_date'));
    }

    public function test_dry_run_reports_counts_without_creating_export_files(): void
    {
        $major = Major::create(['name' => 'PPLG', 'code' => 'PPLG']);
        $classroom = ClassRoom::create([
            'major_id' => $major->id,
            'name' => 'X PPLG 1',
            'code' => 'X_PPLG_1',
            'grade' => 10,
        ]);
        $user = $this->createSourceUser('dry@sikes.sch.id', 'Dry Run', 'dry-run-password');
        $this->createStudent($user, $classroom, '00999', 'Dry Run');
        $beforeDirectories = $this->exportDirectories();

        $this->artisan('sikes:export-students', ['--dry-run' => true])
            ->expectsOutputToContain('Kelas: 1')
            ->expectsOutputToContain('User siswa: 1')
            ->expectsOutputToContain('Siswa diekspor: 1')
            ->expectsOutputToContain('(dry-run, file tidak ditulis)')
            ->assertExitCode(0);

        $this->assertSame($beforeDirectories, $this->exportDirectories());
    }

    protected function createSourceUser(string $email, string $name, string $password): User
    {
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'status' => 'active',
        ]);
        $user->assignRole('siswa');

        return $user;
    }

    protected function createStudent(User $user, ?ClassRoom $classroom, string $nis, string $name): Student
    {
        return Student::create([
            'user_id' => $user->id,
            'classroom_id' => $classroom?->id,
            'nis' => $nis,
            'full_name' => $name,
            'birth_date' => null,
            'address' => 'Alamat uji',
        ]);
    }

    protected function createTargetDatabase(string $majorName): void
    {
        config(['database.connections.export_test' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]]);
        DB::purge('export_test');
        $schema = Schema::connection('export_test');

        $schema->create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 20)->unique();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        $schema->create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained('majors');
            $table->string('name');
            $table->string('code', 50)->unique();
            $table->integer('grade');
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
            $table->unique(['name', 'guard_name']);
        });
        $schema->create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->primary(['role_id', 'model_id', 'model_type']);
        });
        $schema->create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
            $table->string('nis', 20)->unique();
            $table->string('full_name', 100);
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone', 20)->nullable();
            $table->string('blood_type', 5)->nullable();
            $table->text('allergy_history')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::connection('export_test')->table('majors')->insert([
            'name' => $majorName,
            'code' => 'PPLG',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function seedTargetUser(string $email, string $name, string $password, string $roleName): void
    {
        $connection = DB::connection('export_test');
        $userId = $connection->table('users')->insertGetId([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $roleId = $connection->table('roles')->insertGetId([
            'name' => $roleName,
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $connection->table('model_has_roles')->insert([
            'role_id' => $roleId,
            'model_type' => User::class,
            'model_id' => $userId,
        ]);
    }

    protected function importExportFiles(string $directory): void
    {
        $connection = DB::connection('export_test');
        $files = collect(File::files($directory))
            ->sortBy(fn ($file) => $file->getFilename())
            ->values();

        foreach ($files as $file) {
            if ($file->getFilename() === 'README-IMPORT.txt') {
                continue;
            }

            foreach ($this->splitSqlStatements(File::get($file->getPathname())) as $statement) {
                $normalized = strtoupper(trim($statement));
                if (str_starts_with($normalized, 'SET NAMES')) {
                    continue;
                }
                if ($normalized === 'START TRANSACTION') {
                    $connection->beginTransaction();
                    continue;
                }
                if ($normalized === 'COMMIT') {
                    $connection->commit();
                    continue;
                }

                $statement = $this->toSqliteUpsert($statement);

                $connection->unprepared($statement);
            }
        }
    }

    protected function toSqliteUpsert(string $statement): string
    {
        $statement = str_replace('INSERT IGNORE INTO', 'INSERT OR IGNORE INTO', $statement);

            if (str_starts_with($statement, 'INSERT INTO users')) {
                $updateStart = strpos($statement, "\nON DUPLICATE KEY UPDATE\n");
                $updateClause = $updateStart === false ? '' : substr($statement, $updateStart);
                if (preg_match('/name = IF\(users\.deleted_at IS NULL AND (.+), VALUES\(name\), users\.name\),/s', $updateClause, $matches)) {
                    $guard = $matches[1];
                    return substr($statement, 0, $updateStart)
                        . "\nON CONFLICT(email) DO UPDATE SET name = excluded.name, updated_at = excluded.updated_at\n"
                        . 'WHERE users.deleted_at IS NULL AND ' . $guard;
                }
            }

            if (str_starts_with($statement, 'INSERT INTO students')) {
                $updateStart = strpos($statement, "\nON DUPLICATE KEY UPDATE\n");
                if ($updateStart !== false) {
                    $columns = [
                        'user_id', 'classroom_id', 'full_name', 'birth_place', 'birth_date', 'address',
                        'parent_name', 'parent_phone', 'blood_type', 'allergy_history', 'updated_at',
                    ];
                    $updates = implode(', ', array_map(fn ($column) => "{$column} = excluded.{$column}", $columns));

                    return substr($statement, 0, $updateStart)
                        . "\nON CONFLICT(nis) DO UPDATE SET {$updates} WHERE students.deleted_at IS NULL";
                }
            }

        return $statement;
    }

    protected function splitSqlStatements(string $sql): array
    {
        $statements = [];
        $buffer = '';
        $inString = false;
        $length = strlen($sql);

        for ($index = 0; $index < $length; $index++) {
            $character = $sql[$index];
            $buffer .= $character;

            if ($character === "'" && $inString && ($sql[$index + 1] ?? null) === "'") {
                $buffer .= $sql[++$index];
                continue;
            }
            if ($character === "'" && ($index === 0 || $sql[$index - 1] !== '\\')) {
                $inString = ! $inString;
                continue;
            }
            if ($character === ';' && ! $inString) {
                $statement = trim(substr($buffer, 0, -1));
                if ($statement !== '') {
                    $statements[] = $statement;
                }
                $buffer = '';
            }
        }

        if (trim($buffer) !== '') {
            $statements[] = trim($buffer);
        }

        return $statements;
    }

    protected function targetCounts(): array
    {
        $connection = DB::connection('export_test');

        return [
            'classrooms' => $connection->table('classrooms')->count(),
            'users' => $connection->table('users')->count(),
            'student_roles' => $connection->table('model_has_roles')->where('role_id', $connection->table('roles')->where('name', 'siswa')->value('id'))->count(),
            'students' => $connection->table('students')->count(),
        ];
    }

    protected function exportDirectories(): array
    {
        $base = storage_path('app/exports');

        return File::exists($base) ? File::directories($base) : [];
    }

}