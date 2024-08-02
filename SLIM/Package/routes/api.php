<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SLIM\Package\App\Http\Controllers\Api\PackageController;
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

Route::prefix('v1')->middleware('auth:api')->name('api.')
    ->controller(PackageController::class)
    ->group(function () {
        Route::get('packages', 'index');
    });
