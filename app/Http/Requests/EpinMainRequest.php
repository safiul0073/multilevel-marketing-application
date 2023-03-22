<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpinMainRequest extends FormRequest
{

    public function rules()
    {
        $rules = [
            'cost'          => 'required|numeric',
            'type'          => 'required|string',
            'quantity'      => 'required|numeric|max:100',
            'product_id'    => 'required|numeric|exists:products,id',
            'customer_name' => 'required|string|max:56',
            'customer_phone'=> 'required|string|min:11|max:12',
        ];

        if (request()->method() == "POST") {
            array_push([$rules, 'code.*'=> 'required|string|unique:epins,code']);
        }

        return $rules;
    }
}
