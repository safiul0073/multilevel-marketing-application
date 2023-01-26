<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{

    use Formatter;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required',
            'status' => 'required'
        ]);

        if (is_array($request->ids)) {
            Withdraw::whereIn($request->ids)->update(['status' => $$request->status]);
        }else{
            Withdraw::find((int) $request->ids)->update(['status' => $$request->status]);
        }
        $message = '';
        if ($request->status == 2) {
            $message = 'Withdraw canceled.';
        }else if ($request->status == 0) {
            $message = 'Withdraw pending.';
        }else {
            $message = 'Withdraw confirmed.';
        }
        return $this->withSuccess($message);
    }
}
