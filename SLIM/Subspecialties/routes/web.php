<?php

use Illuminate\Support\Facades\Route;
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

Route::group(['middleware'=>'auth'], function () {
    Route::resource('subspecialties', SubspecialtiesController::class)->names('subspecialties');
});
