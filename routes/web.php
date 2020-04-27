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
    return view('welcome');
});

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('login', 'WebAuth\LoginController@showLoginForm')->name('login');
Route::post('login', 'WebAuth\LoginController@login');
Route::get('logout', 'WebAuth\LoginController@logout')->name('logout');

Route::get('verify', 'WebAuth\VerificationController@index')->name('verify');
Route::post('verify', 'WebAuth\VerificationController@verify')->name('verify');
Route::get('sendverify', 'WebAuth\VerificationController@send')->name('sendverify');

Route::get('reset', 'WebAuth\ResetPasswordController@index')->name('reset');
Route::post('sendpassword', 'WebAuth\ResetPasswordController@send')->name('sendpassword');
