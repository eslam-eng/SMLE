<?php

use Illuminate\Support\Facades\Route;
use SLIM\Trainee\App\Http\Controllers\Api\AuthController;
use SLIM\Trainee\App\Http\Controllers\Api\SubscribeController;

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
    ->controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('reset-password', 'reset_password');
        Route::post('send/otp', 'sendOtp');
        Route::post('validate/otp', 'ValidateOtp');
    });


Route::middleware(['middleware' => 'auth:api'])->prefix('v1')->name('api.')
    ->controller(AuthController::class)->group(function () {
        Route::get('profile', 'profile');
        Route::post('change-password', 'change_password');
    })
    ->controller(SubscribeController::class)->group(function () {
        Route::post('subscribe', 'subscribe');
    });




