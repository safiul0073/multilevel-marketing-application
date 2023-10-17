<?php

namespace App\Http\Controllers\API\V1\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class CodeCheckController extends Controller
{
    use Formatter;
    /**
     * Check if the code is exist and vaild one (Setp 2)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|exists:reset_code_passwords',
        ]);
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return $this->withErrors('Your code is expired. Please try again');
        }

        return $this->withSuccess([
            'code' => $passwordReset->code
        ]);
    }
}
