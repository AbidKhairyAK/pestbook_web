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

Route::redirect('/', '/libraries');
Route::get('/libraries/image/{img}', 'LibraryController@image');
Route::get('/libraries/list/{type}', 'LibraryController@list');
Route::get('/libraries/detail/{id}', 'LibraryController@detail');
Route::resource('/libraries', 'LibraryController');
