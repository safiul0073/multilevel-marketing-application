<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpamPolicyController extends Controller
{
    public function index () {

        return view('frontend.contents.spam_policy.index');
    }
}
