<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\API\Formatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    use Formatter;

    public function login(Request $request)
    {
        $att = $this->validate($request, [
            'username' => 'string',
            'password' => 'string|min:8',
        ]);

        $user = User::where('username', $att['username'])->first();

        if (! $user) {
            return $this->withNotFound('User not fount!');
        }
    }
}
