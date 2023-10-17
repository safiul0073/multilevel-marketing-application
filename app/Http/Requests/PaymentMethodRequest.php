<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
            'type' => 'required|in:auto,manual',
            'percent_charge' => 'nullable|numeric',
            'fixed_charge' => 'nullable|numeric',
            'status' => 'integer',
        ];
    }
}
