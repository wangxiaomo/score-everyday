<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('index');
    }

    public function incr($step) {
        $user = Auth::user();
        $v = $user->incr($step);
        return response()->json($v);
    }

    public function user_data() {
        $user = Auth::user();
        $values = $user->get_score();
        return response()->json($values);
    }

    public function oauth() {
        return view('oauth');
    }
}
