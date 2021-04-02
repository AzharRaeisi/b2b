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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'api'], function(){
    Route::post('register', 'Api\UserController@register');
    Route::post('login', 'Api\UserController@login');
    Route::get('get-content', 'Api\CommonController@getContent');
    Route::get('get-home-data', 'Api\CommonController@getHomeData');
    Route::get('view-all-flash-deals', 'Api\CommonController@viewAllFlashDeal');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('logout', 'Api\UserController@logout');
    });


});
