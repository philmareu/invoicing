<?php

use App\Http\Middleware\RedirectIfInstalled;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Installation Routes
|--------------------------------------------------------------------------
|
| These routes are only for handling the installation of the application.
| This includes creating the own
|
*/

Route::get(
    'install',
    [\App\Http\Controllers\InstallationController::class, 'install']
)
    ->name('install')
    ->middleware(RedirectIfInstalled::class);

Route::post(
    'installations',
    [
        \App\Http\Controllers\Endpoints\InstallationsController::class,
        'store'
    ]
)
    ->name('api.installations.store')
    ->prefix('api');
