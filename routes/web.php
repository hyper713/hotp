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

Route::get('dashboard', 'web\DashboardController@index')->name('dashboard');

Route::get('login', 'WebAuth\LoginController@showLoginForm')->name('login');
Route::post('login', 'WebAuth\LoginController@login');
Route::get('logout', 'WebAuth\LoginController@logout')->name('logout');

Route::get('verify', 'WebAuth\VerificationController@index')->name('verify');
Route::post('verify', 'WebAuth\VerificationController@verify')->name('verify');
Route::get('sendverify', 'WebAuth\VerificationController@send')->name('sendverify');

Route::get('reset', 'WebAuth\ResetPasswordController@index')->name('reset');
Route::post('sendpassword', 'WebAuth\ResetPasswordController@send')->name('sendpassword');

Route::get('/admins', 'web\AdminsController@index')->name('admins.index');
Route::delete('/admins/{admin}', 'web\AdminsController@destroy')->name('admins.destroy');
Route::get('/admins/create', 'web\AdminsController@create')->name('admins.create');
Route::post('/admins', 'web\AdminsController@store')->name('admins.store');
Route::get('/admins/{admin}/edit', 'web\AdminsController@edit')->name('admins.edit');
Route::put('/admins/{admin}', 'web\AdminsController@update')->name('admins.update');
Route::get('/admins/{admin}/activate', 'web\AdminsController@activate')->name('admins.activate');

Route::get('/users', 'web\UsersController@index')->name('users.index');

Route::resource('categories','web\CategoriesController');

Route::resource('providers','web\ProvidersController');

Route::resource('groups','web\GroupsController');
