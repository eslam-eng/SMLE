<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SLIM\Quiz\App\Http\Controllers\Api\QuizController;
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
    ->controller(QuizController::class)->group(function () {
        Route::post('save-quiz', 'SaveQuiz');
        Route::get('getAll-quiz', 'getAllQuiz');
        Route::get('show-quiz/{id}', 'show');
        Route::get('statistics', 'Statistics');
        Route::post('save-question-answer', 'SaveQuestionAnswer');
       // Route::get('quiz-analysis', 'QuizAnalysis');
        Route::post('set-taken-time','SetTakenTime');
        Route::get('complete/quiz','CompleteQuiz');
    });
