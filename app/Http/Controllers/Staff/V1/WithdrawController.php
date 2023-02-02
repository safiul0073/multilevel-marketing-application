<?php

namespace App\Http\Controllers\Staff\V1;

use App\Events\ChargeEvent;
use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\User;
use App\Models\Withdraw;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

                if (is_array($request->ids)) {
                    Withdraw::whereIn($request->ids)->update(['status' => $request->status]);
                    $withdraws = Withdraw::whereIn($request->ids)->get();
                    $withdraws->map(function ($with) use($request) {
                        $user = User::find($with->user_id);
                        $this->saveData($user, $with, $request->type);
                    });
                }else{
                    $withdraw = Withdraw::find((int)$request->ids);
                    $user = User::find($withdraw->user_id);
                    $this->saveData($user, $withdraw, $request->type);
                }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
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


    private function saveData ($user, $withdraw, $status) {

        if ($status == 1) {
            $user->balance = $user->balance - $withdraw->amount;
            ChargeEvent::dispatch($withdraw, Charge::WITHDRAW);
        }
        $withdraw->update(['status' => $status]);
        $user->save();
    }
}
