<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SLIM\Message\App\Http\Controllers\Api\MessageController;
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
Route::prefix('v1')->name('api.')
    ->middleware('auth:api')
    ->controller(MessageController::class)
    ->group(function () {
        Route::post('messages', 'store');
    });
