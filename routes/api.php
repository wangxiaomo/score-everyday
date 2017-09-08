<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

Route::post('/login', function() {
    $client_id = 4;
    $client_secret = 'K6LV852RB1qmKyX2sKNdENCfKmx7nofBT0gy05lQ';
    $email = request()->input('email');
    $password = request()->input('password');
    $scope = request()->input('scope', '');

    $http = new GuzzleHttp\Client;
    try{
        $response = $http->post('http://dev.minmore.com/oauth/token', [
            'form_params'   =>  [
                'grant_type'    =>  'password',
                'client_id'     =>  $client_id,
                'client_secret' =>  $client_secret,
                'username'      =>  $email,
                'password'      =>  $password,
                'scope'         =>  $scope,
            ]
        ]);
    }catch(\GuzzleHttp\Exception\ClientException $e){
        $response = $e->getResponse();
    }
    return json_decode($response->getBody(), true);
});

Route::middleware('auth:api')->get('/data', function() {
    $id = Auth::id();
    $year = date('Y');
    $key = "score_everyday:user_$id:$year";
    $values = Redis::hgetall($key);
    return response()->json($values);
});
