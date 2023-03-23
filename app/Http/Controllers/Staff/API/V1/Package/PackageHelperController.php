<?php

namespace App\Http\Controllers\Staff\API\V1\Package;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class PackageHelperController extends Controller
{
    use Formatter;

    public function getCategoryList () {

        $categories = Category::select('id as value', 'title as label')->where('status', 1)->get();

        return $this->withSuccess($categories);
    }

    public function getProductImages (Request $request, Product $product) {

        $images = $product->images;

        return $this->withSuccess($images);

    }

    public function getAllPackage () {

        $packages = Product::where('is_package',1)->latest()->get();

        return $this->withSuccess($packages);
    }


}
