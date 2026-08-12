<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // ✅ Tambahkan import ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan Alias Middleware Spatie (tetap dipertahankan)
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        // ✅ BARU: Redirect guest ke halaman login sesuai role berdasarkan URL
        $middleware->redirectGuestsTo(function (Request $request) {
            // Kalau URL diawali 'admin/', lempar ke login-admin
            if ($request->is('admin*')) {
                return '/login-admin';
            }

            // Kalau URL diawali 'petugas/', lempar ke login-petugas
            if ($request->is('petugas*')) {
                return '/login-petugas';
            }

            // Kalau URL diawali 'siswa/', lempar ke login-siswa
            if ($request->is('siswa*')) {
                return '/login-siswa';
            }

            // Default: kalau guest coba akses halaman terproteksi lainnya, 
            // lempar ke landing page
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();