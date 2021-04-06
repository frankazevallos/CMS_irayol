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
use Modules\PaySubscriptions\Http\Controllers\PackagesController;
use Modules\PaySubscriptions\Http\Controllers\SubscriptionsController;

Route::group(['prefix' => 'paysubscriptions', 'middleware' => ['auth']], function () {
    Route::get('/', 'PaySubscriptionsController@index')->name('paysubscriptions.index');

    // Packages
    Route::resource('packages', 'PackagesController');
    Route::get('ajaxindex/packages', [PackagesController::class, 'ajaxIndex'])->name('packages.ajaxindex');

    // Subscriptions
    Route::resource('subscriptions', 'SubscriptionsController');
    Route::post('subscriptions/getuser', 'SubscriptionsController@getUser')->name('subscriptions.getuser');
    Route::post('subscriptions/getpackage', 'SubscriptionsController@getPackage')->name('subscriptions.getpackage');
    Route::get('ajaxindex/subscriptions', [SubscriptionsController::class, 'ajaxIndex'])->name('subscriptions.ajaxindex');
    Route::post('getsubscriptionanalytics/subscriptions', [SubscriptionsController::class, 'getSubscriptionAnalytics'])->name('subscriptions.getsubscriptionanalytics');

    // Pay Settings
    Route::get('paypal-payment-form', 'PaySettingController@index')->name('paypal-payment-form');
    Route::get('paypal-payment-form-submit', 'PaySettingController@payment')->name('paypal-payment-form-submit');
});