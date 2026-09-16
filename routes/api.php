<?php

use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for SiPintu SSO Webhooks & Integrations
|--------------------------------------------------------------------------
*/

Route::post('/sipintu/sync-user', [OAuthController::class, 'syncUser'])->name('api.sipintu.sync-user');
Route::post('/sipintu/sync-password', [OAuthController::class, 'syncUser'])->name('api.sipintu.sync-password');
