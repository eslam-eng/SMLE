<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \SLIM\Specialization\App\Http\Controllers\Api\SpecializationController;
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
//
Route::prefix('v1')->name('api.')
    ->controller(\SLIM\Specialization\App\Http\Controllers\Api\SpecializationController::class)
    ->group(function () {
        Route::get('specialists', 'specialists');
    });






