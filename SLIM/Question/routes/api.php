<?php

use Illuminate\Support\Facades\Route;
use SLIM\Question\App\Http\Controllers\Api\QuestionController;

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
    ->controller(QuestionController::class)
    ->group(function ()
{
        Route::post('question-note', 'questionNote')->middleware('auth:api');
        Route::get('question-note', 'getQuestionNote')->middleware('auth:api');
        Route::delete('question-note', 'deleteQuestionNote')->middleware('auth:api');
        Route::get('question-note/{id}/details', 'QuestionNoteDetails')->middleware('auth:api');
        Route::post('question-suggest', 'questionSuggest')->middleware('auth:api');
        Route::get('question-suggest', 'getQuestionSuggest')->middleware('auth:api');
        Route::get('question-suggest-details', 'QuestionSuggestDetails')->middleware('auth:api');
        Route::delete('question-suggest', 'deleteQuestionSuggest')->middleware('auth:api');
        Route::get('question-suggest-details', 'QuestionSuggestDetails')->middleware('auth:api');

    });
