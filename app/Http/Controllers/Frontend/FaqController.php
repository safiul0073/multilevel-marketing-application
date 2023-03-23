<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index () {

        $faqs = Answer::where('status', 1)->with('question:id,question')->limit(5)->orderBy('id', "DESC")->get();
        return view('frontend.contents.faq.index',["faqs" => $faqs]);
    }
}
