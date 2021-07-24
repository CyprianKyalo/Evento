<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('index');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Verifying Email
Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class, 'verifyUser'])->name('verify.user');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Preventing back history
Route::group(['middleware' => 'prevent-back-history'], function () {
	Auth::routes();

	Route::get('/', function () {
    	return view('index');
	});

	Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile');
	Route::get('/activity', [App\Http\Controllers\HomeController::class, 'activity'])->name('activity');
	Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
	Route::get('/vendor', [App\Http\Controllers\HomeController::class, 'vendor'])->name('vendor');
	Route::get('/description', [App\Http\Controllers\HomeController::class, 'description'])->name('description');
	Route::get('/equipment', [App\Http\Controllers\HomeController::class, 'equipment'])->name('equipment');

	Route::resource('/users', 'App\Http\Controllers\UserController');

});