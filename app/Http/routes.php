<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/films');
});

// API Version 1
Route::get('/api/v1/{category}', 'Nodes\NodeAPI@index');
Route::get('/api/v1/{category}/search', 'Nodes\NodeAPI@search');
Route::get('/api/v1/{category}/{slug}', 'Nodes\NodeAPI@find');
Route::get('/api/v1/{category}/{slug}/reviews', 'Nodes\NodeAPI@reviews');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Application category routes
Route::get('/{category}', 'Nodes\NodeController@index');
Route::get('/{category}/create/confirm/{id}', 'Nodes\NodeController@createConfirm');
Route::post('/{category}/create/confirm/{id}', 'Nodes\NodeController@store');
Route::get('/{category}/create/{query}', 'Nodes\NodeController@create');
Route::get('/{category}/{slug}', 'Nodes\NodeController@show');
Route::post('/{category}/{slug}', 'Reviews\ReviewController@create');
