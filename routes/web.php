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
Route::post('/products/save', 'Product\AddProductController@save')->name('product.save');
Route::get('/products/media-center', 'Product\AddProductController@index')->name('product.media.center');
Route::get('/products/manage-image', 'Product\ManageImageController@index')->name('product.manage.image');

Route::get('/products/brands', 'Product\BrandController@index')->name('product.brand');
Route::post('/products/brands/new', 'Product\BrandController@_new')->name('product.brand.new');
Route::post('/products/brands/save', 'Product\BrandController@save')->name('product.brand.save');
Route::post('/products/brands/view', 'Product\BrandController@view')->name('product.brand.view');
Route::post('/products/brands/update', 'Product\BrandController@update')->name('product.brand.update');
Route::post('/products/brands/archived', 'Product\BrandController@archived')->name('product.brand.archived');

Route::post('/products/status', 'Product\ManageProductController@status')->name('product.status');
Route::get('/products/edit/{id}', 'Product\ManageProductController@edit')->name('product.edit');
Route::post('/products/update', 'Product\ManageProductController@update')->name('product.update');
Route::post('/products/archived', 'Product\ManageProductController@archived')->name('product.update');