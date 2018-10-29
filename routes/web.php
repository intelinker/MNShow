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

Route::post('signin', 'UserController@signin');
Route::get('login', 'UserController@login')->name('login');
Route::get('logout', 'UserController@logout');
Route::get('inituser', 'UserController@initUser');

Route::group(['middleware'=>'auth', 'web'], function() {
    Route::get('/', 'MenuController@index');
    Route::resource('menus', 'MenuController');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');
    Route::resource('customers', 'CustomerController');
    Route::resource('channels', 'ChannelController');
    Route::get('usersearch/{name}', 'UserController@search');
    Route::get('productsearch/{title}/{level1}/{level2}', 'ProductController@search');
    Route::get('menuvisible/{menuid}/{visible}', 'MenuController@setVisible');
    Route::get('customersexport', 'CustomerController@customersExport')->name('customersexport');
    Route::get('channelcreate0', 'ChannelController@channelCreate0');
    Route::get('channelcreate1/{channel1}', 'ChannelController@channelCreate1');
    Route::get('channelcreate/{level}/{channel1}/{channel2}', 'ChannelController@channelCreate');
    Route::post('customersearch', 'CustomerController@search');
});

