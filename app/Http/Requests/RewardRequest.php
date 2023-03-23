<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class RewardRequest extends FormRequest
{

    public function rules()
    {
        return [
            'designation' => 'required|string|max:255',
            'right_count' => 'required|numeric',
            'left_count' => 'required|numeric',
            'travel_destination' => 'required|string|max:255',
            'one_time_bonus' => 'required|string',
            'salary' => 'required|string',
            'images.*' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
        ];
    }
}
