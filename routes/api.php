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

Route::middleware('auth:user-api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'ApiAuth\RegisterController@store');
Route::post('login', 'ApiAuth\LoginController@login');

Route::post('verify', 'ApiAuth\VerificationController@verify');
Route::get('sendverify', 'ApiAuth\VerificationController@send');

Route::post('sendpassword', 'ApiAuth\ResetPasswordController@send');



Route::get('dashboard', 'api\DashboardController@index');