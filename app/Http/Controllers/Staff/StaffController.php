<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    use Formatter;

    public function login(Request $request)
    {
        $att = $this->validate($request, [
            'username' => 'string',
            'password' => 'string|min:8',
        ]);

        $user = User::where('username', $att['username'])->whereNull('reference_id')->first();

        if (! $user) {
            return $this->withNotFound('User not fount!');
        }

        $token = $user->createToken('staff')->plainTextToken;

        return $this->withSuccess([
            'token' => $token,
            'message' => 'Login Successfull.',
        ]);
    }

    public function me()
    {
        $user = Auth::guard('staff')->user();

        return $this->withSuccess($user);
    }
}
