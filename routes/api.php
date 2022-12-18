<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('get_offers', 'ApiController@offers');
Route::get('get_categories', 'ApiController@categories');
Route::get('get_top_products', 'ApiController@topproducts');
Route::post('get_products_by_ids', 'ApiController@productsByIds');
Route::get('get_products/{cat_id}', 'ApiController@products');
Route::get('get_product/{id}', 'ApiController@product');
Route::get('/check_phone', 'ApiController@checkPhone');
Route::get('/login', 'ApiController@login');
Route::post('/register', 'ApiController@register');
Route::get('/confirm', 'ApiController@confirm');
Route::post('/make_order', 'ApiController@makeOrder');
Route::get('/get_orders', 'ApiController@orders');
Route::get('/get_order/{id}', 'ApiController@order');