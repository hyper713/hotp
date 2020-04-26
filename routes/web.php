<?php
use App\Mail\AdminVerifyMail;
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

Route::get('/mail', function () {
    return new AdminVerifyMail();
});

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('verify', 'Auth\VerificationController@index')->name('verify');
Route::post('verify', 'Auth\VerificationController@verify')->name('verify');
Route::get('send', 'Auth\VerificationController@send')->name('send');
