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


Route::post('user-login', 'Api\UserController@login')->name('login');
Route::post('profile-update', 'Api\UserController@ProfileUpdate')->name('profile-update');
Route::post('forgot-password', 'Api\UserController@ForgotPassword')->name('forgot-password');


