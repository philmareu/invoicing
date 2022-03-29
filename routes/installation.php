<?php

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
)->name('install');
