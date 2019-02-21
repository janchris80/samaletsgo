<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});

Route::get('resort', 'API\ResortApiController@index');
Route::post('resort/like', 'API\ResortApiController@like');
Route::post('resort/like/update', 'API\ResortApiController@likeUpdate');
Route::post('resort/package', 'API\ResortApiController@package');
Route::post('resort/custom', 'API\ResortApiController@custom');
Route::get('resort/trending', 'API\ResortApiController@trending');
Route::resource('event', 'API\EventApiController');
Route::resource('hotline', 'API\HotlineApiController');
Route::resource('tourist', 'API\TouristApiController');
