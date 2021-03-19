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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/courses', CoursesController::class);
    Route::resource('/sections', SectionsController::class, ['except' => ['index', 'create', 'show', 'update']] );
    Route::resource('/classes', ClassesController::class, ['except' => ['index']] );
    Route::post('/classes/order', 'ClassesController@order')->name('classes.order');
});

Route::group(['middleware' => ['setTheme']], function () {
    Route::get('/course/series', 'CoursesController@all')->name('course.all');
    Route::get('/course/{slug}', 'CoursesController@course')->name('course.view');
    Route::get('/course/{slug}/learn/lecture/{id}', 'CoursesController@play')->name('course.play')->middleware('auth');
    Route::post('/class/viewed', 'ClassesController@viewed')->name('class.viewed')->middleware('auth');
});
