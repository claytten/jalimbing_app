<?php

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

Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login.view');
    Route::post('admin/login', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
});

/**
 * Employees routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.' ], function () {

    Route::namespace('Admin')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::namespace('Categories')->group(function () {
            Route::resource('/categories/category', 'CategoryController');
        });

        Route::namespace('Accounts')->group(function () {
            Route::resource('/account/admin', 'AdminController', ['except' => ['show'] ] );
            Route::resource('/account/role', 'RoleController');
            
            Route::get('/account/{id}', 'AdminController@editAccount')->name('edit.account');
            Route::put('/account/{id}/edit', 'AdminController@updateAccount')->name('update.account');
        });

        Route::namespace('Maps')->group(function () {
            Route::resource('/maps/view', 'MapController',['only' => ['index']]);
            Route::resource('/maps/api', 'MapApiController',['only' => ['index','store']]);
        });
    });
});

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
});
