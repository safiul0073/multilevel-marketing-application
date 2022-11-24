<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeCotroller extends Controller
{
    public function index()
    {
        return view('frontend.contents.home.index');
    }
}
