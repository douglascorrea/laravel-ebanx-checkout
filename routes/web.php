<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', "ProductsController@index");

Route::get('/cart', "CartController@index");
Route::get('/cart/add/{id}', "CartController@add");
Route::get('/cart/destroy', "CartController@destroy");
Route::get('/cart/remove/{rowId}', "CartController@remove");
Route::post('/cart/update', "CartController@update");
Route::get('/checkout', "CheckoutController@index");
Route::post('/checkout/payment', "CheckoutController@payment");