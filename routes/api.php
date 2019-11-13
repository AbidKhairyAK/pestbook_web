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


Route::get('/consultations/image/{img}', 'ConsultationController@image');

Route::group(['middleware' => 'api'], function() {
	Route::post('/consultations/save', 'ConsultationController@save');
	Route::post('/consultations/list', 'ConsultationController@list');
	Route::post('/consultations/detail/{id}', 'ConsultationController@detail');

	Route::group(['prefix' => 'auth'], function () {
	    Route::post('register', 'AuthController@register');
	    Route::post('login', 'AuthController@login');
	    Route::post('logout', 'AuthController@logout');
	    Route::post('refresh', 'AuthController@refresh');
	    Route::post('me', 'AuthController@me');
	});
});

