<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signin', 'UserController@apiSignin');
Route::get('channels', 'ChannelController@loadChannels');
//Route::get('syncmenus', 'MenuController@syncData');
Route::get('syncproducts/{level1}', 'ProductController@syncProducts');
Route::post('customers', 'CustomerController@customers@apiCustomers');
Route::post('createcustomer', 'CustomerController@createCustomer');
Route::post('updatecustomer', 'CustomerController@updateCustomer');

//Route::get('syncmenuproducts', 'ProductController@syncMenuProducts');