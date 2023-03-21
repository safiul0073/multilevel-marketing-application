<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PackageRequest extends FormRequest
{

    public function rules()
    {
        return [
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
        ];
    }
}
