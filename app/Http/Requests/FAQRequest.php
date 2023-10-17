<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
{

    public function rules()
    {
        return [
            'question' => 'required|string',
            'ans'      => 'required|string',
            'status'   => 'nullable|between:0,1'
        ];
    }
}
