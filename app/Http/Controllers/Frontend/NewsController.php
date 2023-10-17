<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index () {

        $news = Blog::with('image')->where('status', 1)->get();
        return view('frontend.contents.news.index', ['news' => $news]);
    }

    public function show ($slug) {

        $news = Blog::with('image')->where('slug', $slug)->first();

        return view('frontend.contents.news.single_news', compact('news'));
    }
}
