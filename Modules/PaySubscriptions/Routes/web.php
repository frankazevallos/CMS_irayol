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
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'paysubscriptions', 'middleware' => ['auth']], function () {
    Route::get('/', 'PaySubscriptionsController@index')->name('paysubscriptions.index');
    Route::resource('packages', 'PackagesController');
    Route::resource('subscriptions', 'SubscriptionsController');
    Route::post('subscriptions/getuser', 'SubscriptionsController@getUser')->name('subscriptions.getuser');
    Route::post('subscriptions/getpackage', 'SubscriptionsController@getPackage')->name('subscriptions.getpackage');
});