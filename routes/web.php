<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// Home Route
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['account'], function (){
    //Guest Route
    Route::group(['middleware' => 'guest'], function (){
        Route::get('/account/register', [\App\Http\Controllers\AccountController::class, 'registration'])->name('account.registration');
        Route::post('/account/process-register', [\App\Http\Controllers\AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/account/login', [\App\Http\Controllers\AccountController::class, 'login'])->name('account.login');
        Route::post('/account/authenticate', [\App\Http\Controllers\AccountController::class, 'authenticate'])->name('account.authenticate');
    });
    // Authenticated Routes
    Route::group(['middleware'=>'auth'], function (){
        Route::get('/account/profile', [\App\Http\Controllers\AccountController::class, 'profile'])->name('account.profile');
        Route::get('/account/logout', [\App\Http\Controllers\AccountController::class, 'logout'])->name('account.logout');
    });

});
