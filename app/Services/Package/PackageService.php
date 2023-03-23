<?php

namespace App\Services\Package;

use App\Models\Media;
use App\Models\Product;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Illuminate\Support\Facades\DB;

class PackageService {

    use Formatter, MediaOperator;

    public function store ($attribute, $model_name = "Product") {
        $image_urls = [];
        $thamnail_image = null;

        try {
            DB::beginTransaction();
            // multiple image upload
            if (isset($attribute['images'])) {
                foreach (request()->images as $image) {
                        $image_urls[] = $this->uploadFile($image);
                }
                unset($attribute['images']);
            }

            if (isset($attribute['thamnail_image'])) {
                $thamnail_image = $this->uploadFile(request()->file('thamnail_image'));
                unset($attribute['thamnail_image']);
            }

            // slug setting
            $attribute['slug'] = $attribute['name'];
            $attribute['is_package'] = 1;

            $product = Product::create($attribute);

            if (!$product) {
                throw new \Exception("$model_name not created");
            }

            foreach ($image_urls as $url) {
                $product->images()->create([
                    'url' => $url,
                    'type' => Media::PRODUCT_GALLERY,
                ]);
            }

            if ($thamnail_image) {
                $product->images()->create([
                    'url' => $thamnail_image,
                    'type' => Media::PRODUCT_THAMNAIL,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated("$model_name Successfully created.");
    }

    public function update ($attribute, $package, $model_name = "Product") {
        $image_urls = [];
        $thamnail_image = null;
        try {
            DB::beginTransaction();

            if (request()->images) {
                foreach (request()->images as $image) {
                    $image_urls[] = $this->uploadFile($image);
                }
                unset($attribute['images']);
                $gallary_images = $package->images()->where('type', Media::PRODUCT_GALLERY)->get();
                if (count($gallary_images) > 0) {
                    $this->multiFileDelete($gallary_images);
                    $package->images()->where('type', Media::PRODUCT_GALLERY)->delete();
                }
            }

            if (isset($attribute['thamnail_image'])) {
                $thamnail_image = $this->uploadFile(request()->file('thamnail_image'));
                unset($attribute['thamnail_image']);
                $thamnail_file = $package->images()->where('type', Media::PRODUCT_THAMNAIL)->first();
                if ($thamnail_file) {
                    $this->deleteFile($thamnail_file);
                    $package->images()->where('type', Media::PRODUCT_THAMNAIL)->delete();
                }
            }

            // slug setting
            $attribute['slug'] = $attribute['name'];

            $p = $package->update($attribute);

            if (!$p) {
                throw new \Exception("$model_name not created.");
            }
            if (count($image_urls)) {
                $package->images()->cerateMany(array_map(function ($url) {
                    return [
                        'url' => $url,
                        'type' => Media::PRODUCT_GALLERY,
                    ];
                },$image_urls));
            }

            if ($thamnail_image) {
                $package->images()->create([
                    'url' => $thamnail_image,
                    'type' => Media::PRODUCT_THAMNAIL,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess("$model_name Successfully updated.");
    }

    public function delete($package, $model_name = "Product") {
        try {
            DB::beginTransaction();
            $this->multiFileDelete($package->images);
            $package->images()->delete();
            $package->delete();
            DB::commit();
        } catch (\Exception $ex) {
            $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess("$model_name successfully deleted.");
    }
}
