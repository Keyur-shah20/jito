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
Route::group(['prefix' => 'admin'], function () {
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/login','Auth\LoginController@getLogin');
	Route::get('/register','Auth\RegisterController@getRegister');

	Route::post('/register','Auth\RegisterController@postRegister');
	Route::post('/login','Auth\LoginController@postLogin');
});


Route::group(['middleware' => 'userAuth' ,'prefix' => 'admin'], function () {
    Route::get('/home', 'HomeController@home');
    Route::get('/user', 'UserController@index');
    Route::get('/user/add', 'UserController@add');
    Route::post('/user/save', 'UserController@save');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::get('/user/delete/{id}', 'UserController@delete');
    Route::post('/update', 'UserController@update');
    Route::get('/logout', 'Auth\LoginController@logoutUser');
    
	Route::get('/categories', 'CategoriesController@listCategory');
	Route::get('/categories/add', 'CategoriesController@add');
	Route::get('/categories/edit/{id}', 'CategoriesController@edit');
	Route::post('/categories/save', 'CategoriesController@save');
	Route::post('/categories/update', 'CategoriesController@update');
	Route::get('/categories/remove/{id}', 'CategoriesController@remove');
	Route::get('/categories/view/{id}', 'CategoriesController@view');

	Route::get('/products', 'ProductsController@listProduct');
	Route::get('/products/add', 'ProductsController@add');
	Route::get('/products/edit/{id}', 'ProductsController@edit');
	Route::post('/products/save', 'ProductsController@save');
	Route::post('/products/update', 'ProductsController@update');
	Route::get('/products/delete/{id}', 'ProductsController@remove');
	Route::get('/products/view/{id}', 'ProductsController@view');
	Route::get('/products/br', 'ProductsController@listProduct');
	Route::get('/products/us', 'ProductsController@listProduct');
});