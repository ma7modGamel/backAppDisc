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
Route::post('password/email', 'App\Http\Controllers\api\v1\AuthenticationController@forgot');

Route::get('/user/{id}','App\Http\Controllers\api\v1\AuthenticationController@user');
Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\api\v1'],function(){
    
    Route::post('/register','AuthenticationController@register');
    Route::post('/login','AuthenticationController@login');
    Route::group(['middleware'=>'auth:api'],function(){
        Route::get('/me','AuthenticationController@me');
        
        Route::get('/me/images','UserController@myImages');
        Route::post('/me/images','UserController@addImage'); 
        Route::post('/addimage','UserController@addImage');
        Route::post('/logout/all/devices','AuthenticationController@revokeAll');
        Route::post('/logout/{token}','AuthenticationController@revoke');
        Route::post('/logout','AuthenticationController@logout');

        Route::post('/user/preferences/values','PreferenceValueController@store');
        Route::post('/user/{user}/update','UserController@update');
        Route::post('/topics/{topic}/join-topic', 'CallController@joinTopic');
        Route::post('/calls/{call}/accept', 'CallController@accept');

        Route::group(['prefix'=>'/package'],function(){
            Route::post('/{package}/subscribe','PackageController@subscribe');
            Route::post('/{package}/un-subscribe','PackageController@unSubscribe');
        });
    });

    Route::get('/countries','CountryController@index');
    Route::get('/genders','GenderController@index');
    Route::get('/packages','PackageController@index');
    Route::get('/packages/{package}','PackageController@show');
    Route::get('/topics','TopicController@index');
    Route::post('/user-search','UserController@search_user');
    Route::get('/preferences','PreferenceController@index');

    Route::get('/contact-us','StaticContentController@contactUs');
    Route::get('/terms-conditions','StaticContentController@termsAndConditions');

    Route::any('test-request',function(){ 
        return response()->json([
            'method'=>request()->method(),
            'headers'=>request()->header(),
            'data'=>request()->all()
        ]);
    });
     // agora 
     Route::post('/agora/token/channel', 'AgoraVoiceController@token');
     // end agora

    //new
     Route::get('/user/{id}','AuthenticationController@user');
     Route::get('/addlike/{id}','UserController@addlike');
     Route::get('/sub/{id}','AuthenticationController@sub');
     Route::get('/subscriptions','PackageController@subscriptions');
     Route::get('/usercalls/{id}', 'CallController@usercalls');
     Route::post('/subscribe','PackageController@subscribe');
     Route::get('/deleteimg/{id}','UserController@deleteimg');
     Route::post('/endcall','AgoraVoiceController@endcall');


});
