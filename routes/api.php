<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resources([
    'customers' => \App\Http\Controllers\Endpoints\CustomersController::class,
    'invoices' => \App\Http\Controllers\Endpoints\InvoicesController::class,
    'work' => \App\Http\Controllers\Endpoints\WorkController::class
]);
