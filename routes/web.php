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

Auth::routes();

Route::get('/', 'IndexController@index')->name('home');
Route::post('/incr/{step}', 'IndexController@incr');
Route::get('/user_data', 'IndexController@user_data');
Route::get('/settings', 'IndexController@oauth');
