<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index () {

        $galleries = Slider::with('image')->where('is_slider', 2)->get();
        return view('frontend.contents.gallery.index', compact('galleries'));
    }
}
