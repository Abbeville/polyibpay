<?php

use Illuminate\Support\Facades\Hash;

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
use App\Http\Controllers\Users\TransactionsController;



Route::get('test', 'TestController@test')->name('test');

Route::get('/password', function(){
    return Hash::make('adminpass');
});

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


    Route::get('/transactions/crypto/index', [TransactionsController::class, 'crypto'])->name('users.transactions.crypto');
    Route::get('/transactions/crypto-request', [TransactionsController::class, 'cryptoRequest'])->name('users.transactions.crypto-request');
    Route::post('/transactions/crypto-request-update', [TransactionsController::class, 'crypto_request_save'])->name('users.transactions.crypto-request.save');
    Route::get('/transactions/crypto-transfer/{request}', [TransactionsController::class, 'cryptoTransfer'])->name('users.transactions.crypto-transfer');
    Route::post('/transactions/crypto-transfer/save', [TransactionsController::class, 'saveTransfer'])->name('users.transactions.crypto-transfer.save');
    Route::get('/transactions/crypto-transactions', [TransactionsController::class, 'cryptoTransactions'])->name('users.transactions.crypto-transactions');
    Route::get('/transactions/{category?}', [TransactionsController::class, 'index'])->name('users.transactions')->where('category', 'all|bill|wallet|vcard|airtime|data_bundle|crypto');



    Route::get('/settings/password', 'Users\ProfileController@changePassword')->name('users.profile.password');
    Route::get('/settings/bank', 'Users\ProfileController@updateBank')->name('users.settings.bank');


    Route::get('/settings', 'Users\SettingsController@index')->name('users.settings.index');

    Route::get('/settings/pin', 'Users\SettingsController@pin')->name('users.settings.pin');
    Route::post('/settings/pin/update', 'Users\SettingsController@updatePin')->name('users.settings.pin.update');

    //Password
    Route::get('/settings/password', 'Users\SettingsController@changePassword')->name('users.settings.password');
    Route::post('/settings/password/update', 'Users\SettingsController@updatePassword')->name('user.password.update');




   	Route::post('/fund-wallet', 'Lib\RaveController@initialize')->name('fund-wallet');
  	Route::get('/rave/callback', 'Lib\RaveController@callback')->name('callback');
  	Route::post('/rave/receive', 'Lib\RaveController@webhook')->name('webhook');

    Route::get('/purchase/{category}/{biller_code}', 'Users\BillController@index')->name('users.purchase.category')->where('category', 'airtime|data_bundle|tv_subscription|electricity');

    Route::post('/purchase/bill', 'Users\BillController@createBill')->name('users.create.bill');

    // Route::get('/recharge/wallet', 'Users\BillController@rechargeWallet')->name('users.recharge.wallet');

});

