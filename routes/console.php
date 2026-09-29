<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sipintu:reset-default-passwords {--go}', function () {
    $pivotTable = config('permission.table_names.model_has_roles', 'model_has_roles');
    $roleTable = config('permission.table_names.roles', 'roles');
    $roleColumn = config('permission.column_names.role_pivot_key') ?: 'role_id';
    $modelColumn = config('permission.column_names.model_morph_key', 'model_id');
    $modelType = (new User())->getMorphClass();
    $findTargets = function () use ($pivotTable, $roleTable, $roleColumn, $modelColumn, $modelType) {
        $targetIds = [];
        $roleCounts = [];

        User::query()->chunkById(100, function ($users) use (&$targetIds, &$roleCounts, $pivotTable, $roleTable, $roleColumn, $modelColumn, $modelType) {
            $userIds = $users->pluck('id')->all();
            $rolesByUser = DB::table($pivotTable . ' as user_roles')
                ->join($roleTable . ' as roles', 'roles.id', '=', 'user_roles.' . $roleColumn)
                ->where('user_roles.model_type', $modelType)
                ->whereIn('user_roles.' . $modelColumn, $userIds)
                ->get(['user_roles.' . $modelColumn . ' as user_id', 'roles.name'])
                ->groupBy('user_id');

            foreach ($users as $user) {
                if (! Hash::check('siswa123', $user->password)) {
                    continue;
                }

                $roles = $rolesByUser->get($user->id, collect())->pluck('name')->all();
                if (array_intersect(['admin', 'super-admin'], $roles)) {
                    continue;
                }

                $targetIds[] = (int) $user->id;
                $bucket = $roles ? implode(', ', $roles) : 'tanpa role';
                $roleCounts[$bucket] = ($roleCounts[$bucket] ?? 0) + 1;
            }
        });

        return [$targetIds, $roleCounts];
    };

    [$targetIds, $roleCounts] = $findTargets();
    $targetCount = count($targetIds);

    $orphanCount = DB::table('users')
        ->where('email', 'like', '%@sikes.sch.id')
        ->whereNotIn('id', DB::table('students')->select('user_id'))
        ->count();

    $this->line($this->option('go') ? 'Mode: EKSEKUSI' : 'Mode: SIMULASI');
    $this->line('Jumlah target sebelum: ' . $targetCount);
    $this->line('Pembagian role: ' . ($roleCounts ? json_encode($roleCounts, JSON_UNESCAPED_UNICODE) : 'tidak ada target'));

    if (! $this->option('go')) {
        $this->line('Jumlah target sesudah simulasi: ' . $targetCount);
        $this->line('Tidak ada data yang diubah.');
    } else {
        if ($targetIds) {
            $passwordHash = Hash::make('password');
            foreach (array_chunk($targetIds, 200) as $idChunk) {
                DB::table('users')->whereIn('id', $idChunk)->update([
                    'password' => $passwordHash,
                    'updated_at' => now(),
                ]);
            }
        }

        [$remainingIds] = $findTargets();
        $this->line('Jumlah target sesudah: ' . count($remainingIds));
    }

    $this->line('Akun yatim email @sikes.sch.id tanpa baris siswa: ' . $orphanCount . '. Opsi: biarkan, nonaktifkan, atau hapus setelah konfirmasi; tidak ada yang dihapus.');
})->purpose('Simulasikan atau reset password default akun siswa SiPintu');
