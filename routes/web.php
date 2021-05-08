<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

// Social Auth
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

Route::group(['middleware' => ['auth', 'verified']], function () {

    // Change languaje
    Route::get('lang/{lang}', [App\Http\Controllers\HomeController::class, 'swap'])->name('lang.swap');

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home'); //main dashboard

    // Blog
    Route::resource('/blogs', \App\Http\Controllers\BlogsController::class, ['except' => ['show']]);
    Route::get('ajaxindex/blog', [App\Http\Controllers\BlogsController::class, 'ajaxIndex'])->name('blog.ajaxindex');

    // Page
    Route::resource('/pages', \App\Http\Controllers\PagesController::class, ['except' => ['show']]);
    Route::post('/mainpage/{id}', [App\Http\Controllers\PagesController::class, 'mainPage'])->name('page.mainpage');
    Route::get('ajaxindex/page', [App\Http\Controllers\PagesController::class, 'ajaxIndex'])->name('page.ajaxindex');

    // Menu
    Route::resource('/menu', \App\Http\Controllers\MenuController::class);
    Route::post('/mainmenu/{id}', [App\Http\Controllers\MenuController::class, 'mainMenu'])->name('menu.mainmenu');
    Route::get('ajaxindex/menu', [App\Http\Controllers\MenuController::class, 'ajaxIndex'])->name('menu.ajaxindex');

    route::get('menu-item', [App\Http\Controllers\MenuItemController::class, 'menuItem'])->name('menu-item');
    route::get('search-menu-item', [App\Http\Controllers\MenuItemController::class, 'menuItemSearch'])->name('search-menu-item');
    route::post('menu-item/save', [App\Http\Controllers\MenuItemController::class, 'menuItemSave'])->name('save-menu-item');
    route::post('menu-item/update', [App\Http\Controllers\MenuItemController::class, 'menuItemUpdate'])->name('update-menu-item');
    route::delete('menu-item/delete', [App\Http\Controllers\MenuItemController::class, 'menuItemDelete'])->name('delete-menu-item');

    //change order on ajax
    route::post('change-menu-order', [App\Http\Controllers\MenuItemController::class, 'changeMenuOrder'])->name('change-menu-order');

    // Setting
    Route::resource('setting', \App\Http\Controllers\SettingsController::class);
    Route::get('ajaxindex/setting',[App\Http\Controllers\SettingsController::class, 'ajaxIndex'])->name('setting.ajaxIndex');

    // Media
    Route::resource('media', \App\Http\Controllers\MediaController::class);
    Route::get('ajaxindex/media', [\App\Http\Controllers\MediaController::class, 'ajaxIndex'])->name('ajaxindex.media');
    Route::get('getmediamodal/media', [\App\Http\Controllers\MediaController::class, 'getMediaModal'])->name('getmediamodal.media');

    // Theme
    Route::resource('themes', \App\Http\Controllers\ThemeController::class)->middleware('setTheme');
    Route::post('theme/active', [App\Http\Controllers\ThemeController::class, 'active'])->name('theme.active');

    // Addons
    Route::resource('addons', \App\Http\Controllers\AddonsController::class);
    Route::post('addons/active', [App\Http\Controllers\AddonsController::class, 'active'])->name('addons.active');

    // Categories
    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
    Route::get('ajaxindex/category', [App\Http\Controllers\CategoriesController::class, 'ajaxIndex'])->name('category.ajaxindex');

    // Users
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('ajaxindex/users',[App\Http\Controllers\UsersController::class, 'ajaxIndex'])->name('users.ajaxIndex');

    // Profile
    Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [App\Http\Controllers\UserProfileController::class, 'destroy'])->name('profile.destroy');

    // Change password
    Route::post('change/password', [App\Http\Controllers\UserProfileController::class, 'changePassword'])->name('change.password');

    // Permissions
    Route::resource('permissions', \App\Http\Controllers\PermissionsController::class);
    Route::post('permissions_mass_destroy', [App\Http\Controllers\PermissionsController::class, 'massDestroy'])->name('permissions.mass_destroy');

    // Roles
    Route::resource('roles', \App\Http\Controllers\RolesController::class);
    Route::post('roles_mass_destroy', [App\Http\Controllers\RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
});

Route::group(['middleware' => 'setTheme'], function () {
    Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
    Route::get('/blog', [App\Http\Controllers\FrontendController::class, 'blog'])->name('blog.index');
    Route::get('/blog/search', [App\Http\Controllers\FrontendController::class, 'search'])->name('blog.search');
    Route::get('/blog/{slug}', [App\Http\Controllers\FrontendController::class, 'showblog'])->name('blog.show'); //show the blog page
    Route::get('/page/{slug}', [App\Http\Controllers\FrontendController::class, 'showpage'])->name('page.show'); //show the page
    Route::get('/category/{slug}', [App\Http\Controllers\FrontendController::class, 'category'])->name('site.category');
});
