<?php

use Illuminate\Support\Facades\Route;
use SLIM\Abbreviation\App\Http\Controllers\AbbreviationController;

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

Route::group(['middleware'=>'auth'], function () {
    Route::resource('abbreviation', AbbreviationController::class)->names('abbreviation');
    Route::get('export/abbreviation', [AbbreviationController::class, 'export'])->name('export.abbreviation');
    Route::get('import', [AbbreviationController::class, 'importForm'])->name('abbreviation.import-form');
    Route::get('download-template', [AbbreviationController::class, 'downloadTemplate'])->name('abbreviation.download-template');
    Route::post('import', [AbbreviationController::class, 'import'])->name('abbreviation.import');
});
