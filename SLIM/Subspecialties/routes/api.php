<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SLIM\Subspecialties\App\Http\Controllers\Api\SubsSpecialistController;


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

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('subspecialties', fn (Request $request) => $request->user())->name('subspecialties');
});


Route::prefix('v1')->name('api.')

    ->controller(SubsSpecialistController::class)->group(function () {
        Route::get('sub-specialists', 'subSpecialists');
    });
