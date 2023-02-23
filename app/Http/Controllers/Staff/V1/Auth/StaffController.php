<?php

namespace App\Http\Controllers\Staff\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    use Formatter;

    public function login(Request $request)
    {
        $att = $this->validate($request, [
            'username' => 'string',
            'password' => 'string|min:8',
        ]);

        $user = User::where('username', $att['username'])->whereNull('sponsor_id')->first();

        if (! $user) {
            return $this->withNotFound('User not fount!');
        }

        if (!Hash::check($request->password, $user->password)){
            return $this->withErrors('Invalied password. Try again');
        }

        $token = $user->createToken('staff')->plainTextToken;

        return $this->withSuccess([
            'token' => $token,
            'message' => 'Login Successfull.',
        ]);
    }

    public function me()
    {
        $user = User::with('image')->where('id',Auth::guard('staff')->user()->id)->first();

        return $this->withSuccess($user);
    }

    public function logout()
    {
        Auth::guard('staff')->user()->tokens()->delete();

        return $this->withSuccess('Loged out.');
    }
}
