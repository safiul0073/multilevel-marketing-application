<?php

namespace App\Http\Controllers\Staff\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use Formatter;
     /**
     * Change the password
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:8',
        ]);
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return $this->withErrors('Your code is expired. Please try again');
        }

        $user = User::firstWhere('email', $passwordReset->email);

        try {
            DB::beginTransaction();

            $user->password = Hash::make($request->password);

            $user->save();

            $passwordReset->delete();

            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully changed your password. Thank you!');
    }
}
