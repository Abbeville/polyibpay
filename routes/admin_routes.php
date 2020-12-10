<?php

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


// Admin Auth Routes
Route::group(['name' => 'admin', 'middleware' => []], function(){
    // Login
    Route::get('/', 'Admin\Auth\LoginController@showLoginForm')->name('admin.showLogin1');
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.showLogin');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    // forgot password
    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Reset Password
    Route::get('/password/reset/{token}','Admin\Auth\ResetPasswordController@showResetForm')->name('admin.passwords.token');
    Route::post('password/reset/set', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
    
    // Admin Auth Routes
    Route::group(['middleware' => 'adminAuth:admin'], function(){

        Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');



        // Users Management routes
        Route::get('/users', 'Admin\UserController@index')->name('admin.user.index');
        Route::get('/users/list', 'Admin\UserController@index')->name('admin.user.listing');
        Route::get('/user/{user}/profile', 'Admin\UserController@show')->name('admin.user.show');
        Route::get('/user/create', 'Admin\UserController@create')->name('admin.user.create');
        Route::get('/user/{user}/delete', 'Admin\UserController@destroy')->name('admin.user.delete');
        Route::post('/user/{user}/update', 'Admin\UserController@update')->name('admin.user.update');
        Route::get('/users/{user}/{status}', 'Admin\UserController@change_status')->where('status', 'active|inactive|suspended')->name('admin.users.change_status');

        // Wallet Transaction Management
        Route::get('/wallet_transactions', 'Admin\UserController@index')->name('admin.wallet.index');



    });
});