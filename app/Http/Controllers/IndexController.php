<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('index');
    }

    public function incr($step) {
        $id = Auth::id();
        $year = date('Y');
        $key = "score_everyday:user_$id:$year";
        $v = Redis::hget($key, date('Y/m/d'));
        $v = $v+intval($step);
        if($v>10) $v=10;if($v<-10) $v=-10;
        Redis::hset($key, date('Y/m/d'), $v);
        return response()->json($v);
    }

    public function oauth() {
        return view('oauth');
    }
}
