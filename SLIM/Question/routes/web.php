<?php

use Illuminate\Support\Facades\Route;
use SLIM\Question\App\Http\Controllers\QuestionController;
use SLIM\Question\App\Http\Controllers\QuestionNoteController;
use SLIM\Question\App\Http\Controllers\QuestionSuggestController;
use SLIM\Subspecialties\App\Http\Controllers\SubspecialtiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => 'auth'], function ()
{
    Route::resource('question', QuestionController::class)->names('question');
    Route::get('export/question', [QuestionController::class,'export'])->name('questions.export');
    Route::resource('question_note', QuestionNoteController::class)->names('question_note');
    Route::resource('question_suggest', QuestionSuggestController::class)->names('question_suggest');
    Route::get('get/sub-specialization', [SubspecialtiesController::class, 'getSubSpecialization']);
    Route::get('import', [QuestionController::class, 'importForm'])->name('questions.import-form');
    Route::get('questions/download-template', [QuestionController::class, 'downloadTemplate'])->name('questions.download-template');
    Route::post('import', [QuestionController::class, 'import'])->name('questions.import');
});
