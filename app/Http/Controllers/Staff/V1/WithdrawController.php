<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            Withdraw::whereIn($request->ids)->update(['status' => $request->status]);
            $withdraws = Withdraw::whereIn($request->ids)->get();
            $withdraws->map(function ($with) use($request) {
                $user = User::find($with->user_id);
                $user->balance = $request->status == 1 ?  $user->balance - $with->amount : $user->balance;
                $user->save();
            });
        }else{
            $withdraw = Withdraw::find((int)$request->ids);
            $user = User::find($withdraw->user_id);
            $user->balance = $request->status == 1 ?  $user->balance - $withdraw->amount : $user->balance;
            $user->save();
            $withdraw->update(['status' => $request->status]);
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
