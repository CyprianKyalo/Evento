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

//Preventing back history
Route::group(['middleware' => 'prevent-back-history'], function () {
	Auth::routes();

	Route::get('/', function () {

    	return view('index');
	});

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/edit_profile', [App\Http\Controllers\HomeController::class, 'edit_profile'])->name('edit_profile');
	Route::put('/update_profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
	Route::get('/view_profile', [App\Http\Controllers\HomeController::class, 'view_profile'])->name('view_profile');
	Route::get('/activity', [App\Http\Controllers\HomeController::class, 'activity'])->name('activity');
	Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
	Route::get('/vendor', [App\Http\Controllers\HomeController::class, 'vendor'])->name('vendor');
	Route::get('/my_products', [App\Http\Controllers\HomeController::class, 'my_products'])->name('my_products');
	Route::get('/hire', [App\Http\Controllers\HomeController::class, 'hire'])->name('hire');
	Route::post('/hire_product', [App\Http\Controllers\HomeController::class, 'hire_product'])->name('hire_product');
	Route::get('search_equip', [App\Http\Controllers\ProductController::class, 'search_equip'])->name('search_equip');
	Route::get('search_serv', [App\Http\Controllers\ProductController::class, 'search_serv'])->name('search_serv');
	Route::get('/vendor_details', [App\Http\Controllers\HomeController::class, 'vendor_details'])->name('vendor_details');
	Route::post('/update_vendor', [App\Http\Controllers\HomeController::class, 'update_vendor'])->name('update_vendor');
	Route::get('/vendor_profile/{id}', [App\Http\Controllers\HomeController::class, 'vendor_profile'])->name('vendor_profile');

	Route::get('/daraja', [App\Http\Controllers\Payments\Mpesa\MpesaController::class, 'index'])->name('daraja');
	Route::post('get-token', [App\Http\Controllers\Payments\Mpesa\MpesaController::class, 'getAccessToken']);
	Route::post('register-urls', [App\Http\Controllers\Payments\Mpesa\MpesaController::class, 'registerURLS']);
	//Route::get('/description', [App\Http\Controllers\HomeController::class, 'description'])->name('description');
	//Route::get('/equipment', [App\Http\Controllers\HomeController::class, 'equipment'])->name('equipment');

	Route::resource('users', 'App\Http\Controllers\UserController');
	Route::resource('products', 'App\Http\Controllers\ProductController');

	//Admin
	Route::prefix('admin')->group(function () {
		// Route::get('/user', function () {
		// 	return view('edit')->name('admin.user.edit');
		// });
		Route::resource('user_admin', 'App\Http\Controllers\UserController');
		Route::resource('product_admin', 'App\Http\Controllers\ProductController');
	});

});