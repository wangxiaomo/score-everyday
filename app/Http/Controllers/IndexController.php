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

    public function oauth() {
        return view('oauth');
    }
}
