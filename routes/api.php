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

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function () {
  // 状态报告
  Route::post('sms/callback', 'SmsController@callback')->name('sms.callback');

  // 回复
  Route::post('sms/reply', 'SmsController@reply')->name('sms.reply');

  // iot callback
  Route::post('iot/callback/{type}', 'IotBotController@callback')->name('iot.callback');
});
