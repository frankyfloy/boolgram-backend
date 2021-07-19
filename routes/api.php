<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login','AuthController@login');
        Route::post('signup','AuthController@signup');
    });

    Route::group([
        'middleware' => 'auth:api'
    ],function(){
        Route::get('Stub_Auth_Token','AuthController@index');
        Route::post('logout','AuthController@logout');
    });

});
