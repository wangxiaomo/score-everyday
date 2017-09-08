<?php

use Illuminate\Support\Facades\Redis;
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
Route::get('/settings', 'IndexController@oauth');

Route::middleware('auth')->get('/user_data', function() {
    $id = Auth::id();
    $year = date('Y');
    $key = "score_everyday:user_$id:$year";
    $values = Redis::hgetall($key);
    return response()->json($values);
});
