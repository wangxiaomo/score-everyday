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

Route::get('/data', function() {
    return response()->json([
        '2017/09/04' => 3,
        '2017/09/05' => 10,
        '2017/09/06' => 1,
        '2017/09/07' => 0,
    ]);
});
