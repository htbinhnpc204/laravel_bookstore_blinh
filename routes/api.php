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

Route::post('/paypal/create_order', [
    'as' => 'paypal.create_order',
    'uses' => 'PayPalController@paypalCreateOrder'
]);

Route::post('/paypal/order/capture', [
    'as' => 'paypal.capture',
    'uses' => 'PayPalController@CaptureOrder'
]);
