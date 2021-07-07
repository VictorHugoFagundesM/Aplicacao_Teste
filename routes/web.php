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

//HOMEPAGE

Route::get('/', function () {
    return view('welcome');
});


// PRODUCTS PAGES

// Route::resource('products', "ProductController");

// read products' list
Route::get("products", "ProductController@index");

// create new product and store it at database
Route::get('products/create', "ProductController@create")->name("products.create");
Route::post("products", "ProductController@insert")->name("products.store");
Route::get('products/{id}/edit', "ProductController@edit")->name("products.edit");
Route::put('products', "ProductController@update")->name("products.update");

Route::get('products/{id}/info', "ProductController@show");
Route::delete('products/{id}/delete', "ProductController@delete")->name("products.delete");

// CATEGORIES PAGES

Route::get("categories", "CategoryController@index");

Route::get('categories/create', "CategoryController@create");
Route::post('categories', "CategoryController@insert");

Route::get('categories/{id}/edit', "CategoryController@edit")->name("categories.edit");
Route::put('categories', "CategoryController@update")->name("categories.update");

Route::delete('categories/{id}/delete', "CategoryController@delete")->name("categories.delete");