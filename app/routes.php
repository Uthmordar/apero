<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['before' => 'auth.basic'], function(){
    Route::resource('apero', 'AperoController');
});

Route::get('/create_apero', ['before'=>'auth', 'uses'=>'AperoController@create']);

Route::get('/', function(){ return View::make('hello');});

Route::get('/login', function(){ return View::make('aperos.authentification', array('title' => 'authentification'));});
Route::get('/logOut', ['before'=>'auth', 'uses'=>'AuthController@logOut']);
Route::post('/authentification', ['before' => 'csrf', 'uses' => 'AuthController@checkUser']);
