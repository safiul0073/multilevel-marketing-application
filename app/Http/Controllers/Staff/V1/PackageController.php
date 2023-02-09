<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class PackageController extends Controller
{
    use Formatter, MediaOperator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $products = Product::with(['category:id,title'])->where('is_package',1)->orderBy('id', 'DESC')->paginate($perPage);

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
            'sku'       => 'required|string|unique:products,sku',
            'description' => 'required|string|max:500',
            'refferral_commission' => 'nullable|numeric',
            'price' => 'required|numeric',
            'video_url' => 'nullable|string',
            'referral_type' => 'required|string|in:percent,direct',
            'images.*' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
            'thamnail_image' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
            'status' => 'nullable|between:0,1',
        ]);


        $image_urls = [];
        $thamnail_image = null;

        try {
            DB::beginTransaction();
            // multiple image uplaod and validation checking
            if (isset($att['images'])) {
                foreach ($request->images as $image) {
                    if ($this->validationCheck($image)) {
                        $image_urls[] = $this->uploadFile($image);
                    } else {
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
            $att['is_package'] = 1;

            $product = Product::create($att);

            if (!$product) {
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
            DB::rollBack();
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
    public function show(Product $package)
    {
        if ($package->is_package) {
            return $this->withSuccess($package->load('images'));
        }
        return $this->withNotFound('not found');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $att = $this->validate($request, [
            'id'    => 'required|numeric|exists:products,id',
            'name' => 'required|string|max:100',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string|max:500',
            'refferral_commission' => 'nullable|numeric',
            'price' => 'required|numeric',
            'video_url' => 'nullable|string',
            'images.*' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
            'thamnail_image' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
            'status' => 'nullable|between:0,1',
        ]);
        $product = Product::firstWhere(['id'=> $att['id'], 'is_package'=> 1]);
        unset($att['id']);
        $image_urls = [];
        $thamnail_image = null;
        if ($request->images) {
            foreach ($request->images as $image) {
                $image_urls[] = $this->uploadFile($image);
            }
            unset($att['images']);
            $gallary_images = $product->images()->where('type', 'gellary')->get();
            if (count($gallary_images) > 0) {
                $this->multiFileDelete($gallary_images);
                $product->images()->where('type', 'gellary')->delete();
            }
        }

        if (isset($att['thamnail_image'])) {
            $thamnail_image = $this->uploadFile($request->file('thamnail_image'));
            unset($att['thamnail_image']);
            $thamnail_file = $product->images()->where('type', 'thamnail')->first();
            if ($thamnail_file) {
                $this->deleteFile($thamnail_file);
                $product->images()->where('type', 'thamnail')->delete();
            }
        }

        // slug setting
        $att['slug'] = $att['name'];

        try {
            DB::beginTransaction();
            $p = $product->update($att);

            if (!$p) {
                throw new Exception('Package not created');
            }
            if (count($image_urls)) {
                $product->images()->cerateMany(array_map(function ($url) {
                    return [
                        'url' => $url,
                        'type' => 'gellary',
                    ];
                },$image_urls));
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

        return $this->withSuccess('Package Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $package)
    {
        $this->multiFileDelete($package->images);
        $package->delete();

        return $this->withSuccess('Package successfully deleted.');
    }
}
