<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $main_user = [
                'avatar' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'gender' => 'required|string|in:Male,Female,Other',
                'nid_number' => 'required|numeric|min:13',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'email' => 'required|email|string|max:255',
                'phone' => 'required|max:11|min:11',
                'address' => 'required|string|max:500',
                'birthday' => 'required|date',
                'nominee_image' => ['nullable', File::types(['jpg', 'png', 'jpeg', 'svg'])->min(5)->max(10 * 1000)],
                'nominee_name' => 'required|string|max:255',
                'relation' => 'required|string|max:255',
                'nominee_profession' => 'required|string|max:255',
                'nominee_birthday' => 'required|date',
                'nominee_gender' => 'required|string|in:Male,Female,Other',
                'nominee_nid' => 'required|numeric|min:13',
                'nominee_father' => 'required|string|max:255',
                'nominee_mother' => 'required|string|max:255',
                'nominee_phone' => 'required|max:11|min:11',
                'nominee_address' => 'required|string|max:500',
            ];

            if (request()->routeIs('staff.user.update')) {
                $more = [
                    'id' => 'required|exists:users,id',
                    'status' => 'required|in:1,0',
                    'email_verified' => 'required|in:1,0',
                    'sms_verified' => 'required|in:1,0',
                    'isUpdated' => 'required|in:1,0'
                ];
                array_merge($main_user, $more);
            }
        return $main_user;
    }
}
