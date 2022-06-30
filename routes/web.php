<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth:admin'], function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('admins', 'AdminController');
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoryController')->except('show');
        Route::resource('products', 'ProductController');
        Route::resource('payment-methods', 'PaymentMethodController')->except('show');
        Route::resource('settings', 'SettingController');

        Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
            Route::get('/', 'TransactionController@index')->name('index');
            Route::get('{transaction}', 'TransactionController@show')->name('show');
            Route::post('{transaction}/waiting', 'TransactionController@waiting')->name('waiting');
            Route::post('{transaction}/shipping', 'TransactionController@shipping')->name('shipping');
            Route::post('{transaction}/done', 'TransactionController@done')->name('done');
            Route::post('{transaction}/failed', 'TransactionController@failed')->name('failed');
        });

        Route::group(['prefix' => 'data', 'as' => 'data.'], function() {
            Route::post('transactions', 'DataController@transactions')->name('transactions');
            Route::post('admins', 'DataController@admins')->name('admins');
            Route::post('users', 'DataController@users')->name('users');
            Route::post('categories', 'DataController@categories')->name('categories');
            Route::post('products', 'DataController@products')->name('products');
            Route::post('payment-methods', 'DataController@paymentMethods')->name('payment-methods');
            Route::post('settings', 'DataController@settings')->name('settings');
        });
    });
});

// User
Auth::routes(['verify' => true]);

Route::group(['namespace' => 'User', 'as' => 'user.'], function(){
    Route::group(['middleware' => ['auth', 'verified']], function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('products', 'ProductController')->only('show');
        Route::resource('cart', 'CartController')->except('show', 'edit');
        Route::resource('checkout', 'CheckoutController')->only('index', 'store');
        Route::post('shipping/cost', 'ShippingController@cost')->name('shipping.cost');
        Route::resource('transactions', 'TransactionController')->only('index', 'show');
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
            Route::get('/', 'ProfileController@index')->name('index');
            Route::patch('update', 'ProfileController@update')->name('update');
            Route::get('password', 'ProfileController@showPasswordForm')->name('password');
            Route::patch('password', 'ProfileController@password');
        });
        Route::group(['prefix' => 'data', 'as' => 'data.'], function() {
            Route::post('transactions', 'DataController@transactions')->name('transactions');
        });
    });
});

// Global
Route::post('locations/cities', 'LocationController@cities')->name('locations.cities');
