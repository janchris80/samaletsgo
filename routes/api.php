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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
////
//Route::post('login', 'API\UserController@login');
//Route::post('register', 'API\UserController@register');
//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post('details', 'API\UserController@details');
//});

Route::post('login', 'API\AccountApiController@login');
Route::post('register', 'API\AccountApiController@register');

Route::post('resort', 'API\ResortApiController@index');
Route::post('resort/trending', 'API\ResortApiController@trending');
Route::post('resort/like', 'API\ResortApiController@like');
Route::post('resort/add-like', 'API\ResortApiController@addLike');
Route::post('resort/remove-like', 'API\ResortApiController@removeLike');
Route::post('resort/package', 'API\ResortApiController@package');
Route::post('resort/custom', 'API\ResortApiController@custom');
Route::post('resort/review', 'API\ResortApiController@review');
Route::resource('event', 'API\EventApiController');
Route::resource('hotline', 'API\HotlineApiController');
Route::resource('tourist', 'API\TouristApiController');
