<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'UsersController@header');
Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', function()
{
    Session::forget('user');
    return redirect('/login');
});
Route::view('/register', 'register');
Route::post('/login', 'UsersController@login');
Route::post('/register', 'UsersController@register');
Route::resource('/offers', 'OffersController');
Route::resource('/products', 'ProductsController');
Route::get('/appusers', 'UsersController@appUser');
Route::get('/orders', 'OrdersController@orders');
Route::get('/orders/export', 'OrdersController@export');
Route::get('order_show/{id}', 'OrdersController@orderShow');
Route::post('order_status/{id}', 'OrdersController@orderStatus');
Route::get('categories/show/{id}', 'CategoriesController@show');
Route::get('/categories', 'CategoriesController@index');
Route::get('categories/create', 'CategoriesController@create');
Route::get('categories/edit/{id}', 'CategoriesController@edit');
Route::delete('categories/destroy/{id}', 'CategoriesController@destroy');
Route::post('categories/store', 'CategoriesController@store');
Route::put('categories/update/{id}', 'CategoriesController@update');
Route::get('content/{id}.{type}', 'UsersController@stream');

