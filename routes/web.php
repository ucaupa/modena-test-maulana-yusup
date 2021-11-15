<?php

use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/geolocation', [GeolocationController::class, 'index'])->name('geolocation');
    Route::resource('user', UserController::class)->middleware('roles:admin');
    Route::middleware(['auth'])->name('user.')->group(function () {
        Route::get('/reset-password/{user}', [UserController::class, 'resetPassword'])->name('reset.index');
        Route::post('/reset-password/{user}', [UserController::class, 'reset'])->name('reset');
    });
});
