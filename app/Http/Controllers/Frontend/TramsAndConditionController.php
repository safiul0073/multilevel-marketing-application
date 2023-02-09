<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TramsAndConditionController extends Controller
{
    public function index () {

        return view('frontend.contents.trams_and_condition.index');
    }
}
