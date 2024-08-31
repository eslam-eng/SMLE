<?php

use Illuminate\Support\Facades\Route;

use SLIM\Trainee\App\Http\Controllers\TraineeController;
use SLIM\Trainee\App\Http\Controllers\TraineeSubscribeController;

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
    Route::resource('trainee', TraineeController::class)->names('trainee');
    Route::get('subscribe-trainee', [TraineeSubscribeController::class, 'index'])->name('subscribe-trainee.index');
    Route::get('subscribe-trainee/create', [TraineeSubscribeController::class, 'create'])->name('subscribe-trainee.create');
    Route::post('subscribe-trainee', [TraineeSubscribeController::class, 'store'])->name('subscribe-trainee.store');
    Route::delete('subscribe-trainee/{id}', [TraineeSubscribeController::class, 'delete'])->name('subscribe-trainee.destroy');
    Route::get('subscribe-trainee/edit/{id}', [TraineeSubscribeController::class, 'edit'])->name('subscribe-trainee.edit');
    Route::post('subscribe-trainee/update/{id}', [TraineeSubscribeController::class, 'update'])->name('subscribe-trainee.update');
    Route::get('package-specialists', [TraineeSubscribeController::class, 'packageSpecialists']);
    Route::get('subscribe-cost', [TraineeSubscribeController::class, 'subscribeCost']);
    Route::get('get/subscribe-end-date', [TraineeSubscribeController::class, 'getEndDate']);
    Route::get('export/trainee', [TraineeController::class, 'export'])->name('trainee.export');
    Route::get('trainee-subscribe-approve/{id}', [TraineeSubscribeController::class, 'approve'])->name('trainee.subscribe.approve');
    Route::get('trainee-subscribe-change-status/{id}', [TraineeSubscribeController::class, 'changeStatus'])->name('trainee.subscribe.changeStatus');
});
Route::get('myfatoorah/callback', [TraineeSubscribeController::class,'myfatoorahCallback'])->name('myfatoorah.callback');
Route::get('test',function (){
   return 'thank you';
});
