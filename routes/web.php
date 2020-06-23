<?php


use Illuminate\Support\Facades\Auth;
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





Auth::routes();

Route::get('/', 'PageController@index')->name('home');
Route::get('/index', 'PageController@index')->name('home');
Route::get('/home', 'PageController@index')->name('home');
Route::get('/test', 'PageController@test')->name('test');
Route::get('/test2', 'TelegramBotController@updatedActivity')->name('test2');


Route::get('/seller/list', 'SellerController@showSellerList')->name('seller_list');
Route::post('/seller/active','SellerController@activeSeller')->name('customer_active');

Route::get('/customer/list', 'CustomerController@showCustomerList')->name('customer_list');
Route::post('/customer/active','CustomerController@activeCustomer')->name('customer_active');
Route::get('/customer/typehead/{filter}','CustomerController@customerTypehead')->name('customer_typehead');

Route::get('/chat/list', 'ChatController@showChatList')->name('chat_list');
Route::post('/chat/loadmessage','ChatController@loadMessages')->name('load_messages');

Route::get('/product/list', 'ProductController@listProduct')->name('product_list');
Route::get('/product/new', 'ProductController@addProduct')->name('product_new');
Route::post('/product/new/store' ,'ProductController@storeProduct' )->name('product_store');
Route::post('/product/active','ProductController@activeProduct')->name('product_active');
Route::post('/product/delete','ProductController@deleteProduct')->name('product_delete');
Route::get('/product/typehead/{filter}','ProductController@productTypehead')->name('product_typehead');

Route::get('/transaction/list', 'TransactionController@listTransaction')->name('transaction_list');
Route::get('/transaction/new', 'TransactionController@addTransaction')->name('transaction_new');
Route::post('/transaction/new/store' ,'TransactionController@storeTransaction' )->name('transaction_store');

Route::get('/channel/simpleMessage', 'ChannelController@sendSimpleMessage')->name('simpleMessage');
Route::post('/channel/send/simplemessage/','ChannelController@sendMessageByAjax')->name('channel.simple.message');
