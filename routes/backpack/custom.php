<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

//Preventing back history
Route::group(['middleware' => 'prevent-back-history'], function () {

	Route::group([
	    'prefix'     => config('backpack.base.route_prefix', 'admin'),
	    'middleware' => array_merge(
	        (array) config('backpack.base.web_middleware', 'web'),
	        (array) config('backpack.base.middleware_key', 'admin')
	    ),
	    'namespace'  => 'App\Http\Controllers\Admin',
	], function () { // custom admin routes
	    Route::crud('user', 'UserCrudController');
	    Route::crud('product', 'ProductCrudController');
	    Route::crud('userproduct', 'UserproductCrudController');
	    Route::crud('hiredproduct', 'HiredproductCrudController');
	    Route::crud('role', 'RoleCrudController');
	    Route::crud('permission', 'PermissionCrudController');
	    Route::get('charts/weekly-users', 'Charts\WeeklyUsersChartController@response')->name('charts.weekly-users.index');
	    Route::get('user/{id}/disable', 'UserCrudController@disable');
	}); 

});// this should be the absolute last line of this file