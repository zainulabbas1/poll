<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PollController;


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
Route::get('/poll/{id}', [PollController::class, 'vote'])->name('poll');

Route::get('/', function () {
    return view('/auth/login');
});

Route::group(['middleware' => ['auth']], function() {
    /**
    * Verification Routes
    */
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
});
// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');

Auth::routes(['verify' => true]);
Route::post('poll', [PollController::class, 'save']);

Route::get('url/{id}', [PollController::class,'geturl'])->name('url');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
    Route::get('vote', function () {
        return view('vote');
    });
    Route::post('/submit', [PollController::class, 'submit'])->name('submit');
    Route::get('edit/{id}', [PollController::class,'edit'])->name('edit');
    Route::post('edit/update', [PollController::class,'update']);
    Route::get('delete/{id}', [PollController::class,'delete'])->name('delete');
    Route::get('report/{id}', [PollController::class,'report'])->name('report');
    Route::view('report', 'reports');
   // more route definitions

});