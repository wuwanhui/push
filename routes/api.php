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


/**
 * 通知
 */
Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::any('/home', 'HomeController@home');


});
/**
 * 通知
 */
Route::group(['prefix' => 'notice', 'middleware' => 'api', 'namespace' => 'API'], function () {
    Route::any('/wxpay', 'NoticeController@wxpay');
});


Route::get('/user', function (Request $request) {

    return "test";
});
