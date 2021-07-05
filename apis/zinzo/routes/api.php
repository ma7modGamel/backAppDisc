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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\AuthController@register')->name('register');
Route::post('/login', 'Api\AuthController@login')->name('login');
Route::post('/forgetpassword', 'Api\AuthController@forgetpassword')->name('forgetpassword');


////////////////////////////app info
Route::get('/info', 'Api\AppController@info')->name('info');
Route::post('/contactus', 'Api\AppController@contactus')->name('contactus');

//////////////////////////////////////////////home
Route::get('/home', 'Api\AppController@home')->name('home');
Route::get('/lasts', 'Api\AppController@lasts')->name('lasts');
Route::get('/lastschp', 'Api\AppController@lastschp')->name('lastschp');
Route::get('/lastsexp', 'Api\AppController@lastsexp')->name('lastsexp');
Route::get('/lastsrate', 'Api\AppController@lastsrate')->name('lastsrate');

Route::get('/offers', 'Api\AppController@offers')->name('offers');
Route::get('/offerslast', 'Api\AppController@offerslast')->name('offerslast');
Route::get('/offerschp', 'Api\AppController@offerschp')->name('offerschp');
Route::get('/offersexp', 'Api\AppController@offersexp')->name('offersexp');
Route::get('/offersrate', 'Api\AppController@offersrate')->name('offersrate');


//////////////////////////////categories
Route::get('/cats', 'Api\ProductController@cats')->name('cats');
Route::get('/cat/{id}', 'Api\ProductController@cat')->name('cat');
Route::get('/cat/{id}/last', 'Api\ProductController@catlast')->name('catlast');
Route::get('/cat/{id}/exp', 'Api\ProductController@catexp')->name('catexp');
Route::get('/cat/{id}/chp', 'Api\ProductController@catchp')->name('catchp');
Route::get('/cat/{id}/rate', 'Api\ProductController@catrate')->name('catrate');

Route::get('/product/{id}', 'Api\ProductController@product')->name('product');
Route::post('/search', 'Api\ProductController@search')->name('search');




Route::middleware(['auth:api'])->group(function () {
    Route::get('/userprofile', 'Api\AuthController@userprofile')->name('userprofile');
    Route::post('/updateuser', 'Api\AuthController@updateuser')->name('updateuser');
    Route::post('/updatepassword', 'Api\AuthController@updatepassword')->name('updatepassword');
    Route::post('/logout', 'Api\AuthController@logout')->name('logout');

    ///////////////////// user addresses
    Route::get('/useraddresses', 'Api\UserController@useraddresses')->name('useraddresses');
    Route::get('/createaddress', 'Api\UserController@createaddress')->name('createaddress');
    Route::post('/addaddress', 'Api\UserController@addaddress')->name('addaddress');
    Route::get('/getaddress/{id}', 'Api\UserController@getaddress')->name('getaddress');
    Route::post('/updateaddress/{id}', 'Api\UserController@updateaddress')->name('updateaddress');
    Route::get('/removeaddress/{id}', 'Api\UserController@removeaddress')->name('removeaddress');
 
    ////////////////////// user favs
    Route::post('/addfav', 'Api\UserController@addfav')->name('addfav');
    Route::get('/favs', 'Api\UserController@favs')->name('favs');
    Route::get('/removefav/{id}', 'Api\UserController@removefav')->name('removefav');

    //////////////////////add rating
    Route::post('/addrate', 'Api\UserController@addrate')->name('addrate');


});

/////////////////////////cart&order
Route::apiResource('carts', 'CartController')->except(['update', 'index']);
Route::apiResource('orders', 'OrderController')->except(['update', 'destroy','store'])->middleware('auth:api');
Route::post('/carts/{cart}', 'CartController@addProducts');
Route::post('/carts/{cart}/checkout', 'CartController@checkout');
Route::post('/carts/{cart}/ondoor', 'CartController@ondoor');
Route::get('/corders', 'OrderController@corders')->middleware('auth:api');
Route::get('/porders', 'OrderController@porders')->middleware('auth:api');
