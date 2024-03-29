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
Route::post('/products/archived', 'Product\ManageProductController@archived')->name('product.archived');
Route::post('/products/stock/new', 'Product\ManageProductController@new_stocks')->name('product.new_stocks');
Route::post('/products/stock/save', 'Product\ManageProductController@save_stock')->name('product.save_stock');
Route::get('/products/stock/logs/{id}', 'Product\ManageProductController@stock_logs')->name('product.stock.logs');
Route::post('/products/sale', 'Product\ManageProductController@put_sale')->name('product.put_sale');
Route::post('/products/sale/update', 'Product\ManageProductController@update_sale')->name('product.update_sale');

Route::get('/orders', 'Orders\OrdersController@index')->name('orders.orders');
Route::get('/orders/view/{id}', 'Orders\OrdersController@view')->name('orders.view');
Route::post('/orders/status', 'Orders\OrdersController@update_status')->name('orders.status');
Route::post('/orders/pouch', 'Orders\OrdersController@update_pouch')->name('orders.pouch');
Route::get('/orders/print/{id}', 'Orders\OrdersController@print')->name('orders.print');



Route::get('/reports/sales', 'Report\SalesController@index')->name('reports.sales');
Route::get('/reports/sales/export', 'Report\SalesController@export')->name('reports.sales.export');

Route::get('/test', 'TestController@index');
Route::get('/test/assign', 'TestController@assign_brand');
Route::get('/test/assign/stock', 'TestController@assign_stocks');
Route::get('/test/assign/image', 'TestController@assign_image');
Route::get('/test/assign/order', 'TestController@assign_order');
Route::get('/test/com', 'TestController@com');
Route::get('/test/inventory', 'TestController@inventory');
Route::get('/test/fixorder', 'TestController@fixorder');
Route::post('/test/fixorder/check', 'TestController@check_error_orders')->name('check.fix.order');
Route::post('/test/fixorder/check/order', 'TestController@check_order_number')->name('check.order.number');
Route::post('/test/fixorder/fix', 'TestController@fix_this_order')->name('check.order.fix');
Route::get('/test/email', 'TestController@email');

Route::post('/register/city', 'TestController@load_city')->name('reg.city');
Route::post('/register/brgy', 'TestController@load_brgy')->name('reg.brgy');


Route::get('/logs', 'Logs\LogsController@index')->name('system.logs');

// Route::get('/coming-soon', 'TestController@coming_soon')->name('reg.brgy');


Route::get('/account/pending','DeniedController@pending')->name('account.pending');
Route::get('/account/declined','DeniedController@declined')->name('account.declined');

Route::get('/courier/ninja-van', 'Courier\NinjaVanController@index')->name('courier.ninja');
Route::POST('/courier/ninja-van/save', 'Courier\NinjaVanController@save')->name('courier.ninja.save');