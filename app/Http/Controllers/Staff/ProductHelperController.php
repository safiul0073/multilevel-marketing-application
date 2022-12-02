<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class ProductHelperController extends Controller
{
    use Formatter;

    public function getCategoryList () {

        $categories = Category::select('id as value', 'title as label')->get();

        return $this->withSuccess($categories);
    }
}
