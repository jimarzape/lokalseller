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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/products/manage', 'Product\ManageProductController@index')->name('product.manage');
Route::get('/products/add', 'Product\AddProductController@index')->name('product.add');
Route::get('/products/media-center', 'Product\AddProductController@index')->name('product.media.center');
Route::get('/products/manage-image', 'Product\ManageImageController@index')->name('product.manage.image');