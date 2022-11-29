<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use App\Mail\SendCodeResetPassword;
use App\Traits\Formatter;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    use Formatter;
     /**
     * Send random code to email of user to reset password (Setp 1)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);
        try {
            ResetCodePassword::where('email', $request->email)->delete();

            $codeData = ResetCodePassword::create([
                'email' => $request->email,
                'code'  => rand(700000, 999999),
                'created_at' => now()
            ]);

            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Please check your email and enter code.');
    }
}
