<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \SLIM\Category\App\Http\Controllers\Api\CategoryController;
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
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('classifications', 'index');
        Route::post('question-classification', 'questionClassification')->middleware('auth:api');
        Route::get('question-classification', 'getQuestionClassification')->middleware('auth:api');
        Route::delete('question-classification', 'destroy')->middleware('auth:api');
        Route::get('question-classification-details/{id}', 'classification_details');
    });
