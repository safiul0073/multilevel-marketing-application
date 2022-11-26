<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    use Formatter, MediaOperator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category:id,title','images'] )->latest()->get();

        return $this->withSuccess($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att = $this->validate($request, [
            'name' => 'required|string|max:100',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string|max:500',
            'refferral_commission' => 'nullable|numeric',
            'price' => 'required|numeric',
            'video_url' => 'nullable|string',
            'images.*' => ['required',File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)],
            'thamnail_image' => ['required',File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)],
            'status' => 'nullable|between:0,1',
        ]);


        $image_urls = [];
        $thamnail_image = null;

        try {
            // multiple image uplaod and validation checking
            if (isset($att['images'])) {
                foreach ($request->images as $image) {
                    if ($this->validationCheck($image)) {
                        $image_urls[] = $this->uploadFile($image);
                    }else {
                        throw new Exception('Please upload png and jpg image.');
                    }
                }
                unset($att['images']);
            }

            if (isset($att['thamnail_image'])) {
                $thamnail_image = $this->uploadFile($request->file('thamnail_image'));
                unset($att['thamnail_image']);
            }

            // slug setting
            $att['slug'] = $att['name'];

            DB::beginTransaction();
            $product = Product::create($att);

            if (! $product) {
                throw new Exception('Product not created');
            }

            foreach ($image_urls as $url) {
                $product->images()->create([
                    'url' => $url,
                    'type' => 'gellary',
                ]);
            }

            if ($thamnail_image) {
                $product->images()->create([
                    'url' => $thamnail_image,
                    'type' => 'thamnail',
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Product Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $this->withSuccess($product->load('images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $att = $this->validate($request, [
            'name' => 'required|string|max:100',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string|max:500',
            'refferral_commission' => 'nullable|numeric',
            'price' => 'required|numeric',
            'video_url' => 'nullable|string',
            'images.*' => ['required',File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)],
            'thamnail_image' => ['required',File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)],
            'status' => 'nullable|between:0,1',
        ]);

        $image_urls = [];
        $thamnail_image = null;
        if ($att['iamges'] && count($att['images']) > 0) {
            foreach ($att['iamges'] as $image) {
                $image_urls[] = $this->uploadFile($image);
            }
            unset($att['iamges']);
            $this->multiFileDelete($product->images()->where('type', 'gellary')->get());
            $product->images()->where('type', 'gellary')->delete();
        }

        if (isset($att['thamnail_image'])) {
            $thamnail_image = $this->uploadFile($request->file('thamnail_image'));
            unset($att['thamnail_image']);
            $this->deleteFile($product->images()->where('type', 'thamnail')->firt());
            $product->images()->where('type', 'thamnail')->delete();
        }

        // slug setting
        $att['slug'] = $att['name'];

        try {
            DB::beginTransaction();
            $product = Product::create($att);

            if (! $product) {
                throw new Exception('Product not created');
            }

            foreach ($image_urls as $url) {
                $product->images()->create([
                    'url' => $url,
                    'type' => 'gellary',
                ]);
            }

            if ($thamnail_image) {
                $product->images()->create([
                    'url' => $thamnail_image,
                    'type' => 'thamnail',
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Product Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->multiFileDelete($product->images);
        $product->delete();

        return $this->withSuccess('Product successfully deleted.');
    }
}
