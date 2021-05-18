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
use Modules\PaySubscriptions\Http\Controllers\PaymentController;
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
    Route::resource('pay-settings', PaySettingController::class);
});

Route::group(['middleware' => ['auth']], function(){
    // Subscription packages
    Route::get('/all-packages', [SubscriptionsController::class, 'allPackages', ])->name('all.packages');
    Route::get('/subscription/{package}', [SubscriptionsController::class, 'paySubscription',])->name('subscription.index');
    
    // Payment
    Route::post('/payments/pay/{id}', [PaymentController::class, 'pay'])->name('pay.subscription');
    Route::get('/payments/approval', [PaymentController::class, 'approval'])->name('approval.subscription');
    Route::get('/payments/cancelled', [PaymentController::class, 'cancelled'])->name('cancelled.subscription');
});
