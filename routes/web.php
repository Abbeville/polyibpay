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

use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\SettingsController;


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

/*
 *
 *
 *
 *
 * REMEMBER TO CREATE A
  ____                              _    ____                              _
 | __ )   _ __    ___    __ _    __| |  / ___|  _ __   _   _   _ __ ___   | |__
 |  _ \  | '__|  / _ \  / _` |  / _` | | |     | '__| | | | | | '_ ` _ \  | '_ \
 | |_) | | |    |  __/ | (_| | | (_| | | |___  | |    | |_| | | | | | | | | |_) |
 |____/  |_|     \___|  \__,_|  \__,_|  \____| |_|     \__,_| |_| |_| |_| |_.__/

 FOR THE ROUTE YOU CREATE @   /routes/breadcrumb.php

https://github.com/davejamesmiller/laravel-breadcrumbs
 *
 *
 *
 * */


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    Route::get('/', 'Users\DashboardController@index')->name('users.dashboard');
    Route::get('/vcard', 'Users\VCardController@index')->name('users.vcard');
    Route::get('/transactions', 'Users\TransactionsController@index')->name('users.transactions');



//    Route::get('/settings/edit', 'Users\ProfileController@editProfile')->name('users.profile.edit');
    Route::get('/settings/password', 'Users\ProfileController@changePassword')->name('users.profile.password');
    Route::get('/profile/', [ProfileController::class, 'index'])->name('users.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('users.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('users.profile.update');

    Route::get('/settings', 'Users\SettingsController@index')->name('users.settings.index');

    Route::get('/settings/pin', 'Users\SettingsController@pin')->name('users.settings.pin');
    Route::post('/settings/pin/update', 'Users\SettingsController@updatePin')->name('users.settings.pin.update');

    //Password
    Route::get('/settings/password', 'Users\SettingsController@changePassword')->name('users.settings.password');
    Route::post('/settings/password/update', 'Users\SettingsController@updatePassword')->name('user.password.update');

    //Profile (user_data)

});

