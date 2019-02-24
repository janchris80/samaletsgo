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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('resort', 'ResortController', ['only' => ['show', 'index', 'destroy', 'update']]);
    Route::resource('event', 'EventController');
    Route::resource('tourist', 'TouristController');
    Route::resource('archive', 'ArchiveController');
    Route::resource('hotline', 'HotlineController', ['except' => ['show']]);
    Route::resource('profile', 'ProfileController');
    Route::resource('account', 'AccountController');
});

Route::group(['as' => 'owner.', 'prefix' => 'owner', 'namespace' => 'Owner', 'middleware' => ['auth', 'owner']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('resort', 'ResortController');
    Route::resource('image', 'ImageController');
    Route::post('image/remove/{image}','ImageController@fileDestroy')->name('image.remove');
    Route::post('image/upload/{image}','ImageController@upload')->name('image.upload');
    Route::resource('profile', 'ProfileController');
});
