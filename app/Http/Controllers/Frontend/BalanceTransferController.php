<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ChargeEvent;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceTransferController extends Controller
{
    public function index () {

        return view('frontend.contents.dashboard.user_balance_transfer', ['charge' => config('mlm.balance_transfer')]);
    }

    public function transferBalance (Request $request) {

        $this->validate($request, [
            'username' => 'required|string|exists:users,username',
            'amount' => 'required|numeric'
        ]);

        $charge = config('mlm.balance_transfer');

        $amount = $request->amount;

        if ($amount < $charge) {
            return redirect()->back()->with(['error' => "Transfer charge is $charge and your transfer amount is $amount ."]);
        }

        $user = User::find(auth()->id());

        if ($amount > $user->balance) {
            return redirect()->back()->with(['error' => "Not enough balance for transfer."]);
        }

        $member = User::where('username', $request->username)->first();

        if ($member->id == $user->id) {
            return redirect()->back()->with(['error' => "Ops! account same."]);
        }

        $final_amount = $amount - $charge;

        try {
            DB::beginTransaction();
            $transaction = $user->transactions()->create( [
                'member_id' => $member->id,
                'type' => Transaction::TRANSFER,
                'amount' => $final_amount,
                'charge' => $charge
            ]);

            // charge creating by event
            ChargeEvent::dispatch($transaction, Transaction::TRANSFER);

            // decreasing user balance
            $user->balance = $user->balance - $amount;
            $user->save();

            $member->transactions()->create( [
                'member_id' => $user->id,
                'type' => Transaction::RECEIVED,
                'amount' => $final_amount,
                'charge' => $charge
            ]);
            
            // increasing member balance
            $member->balance = $member->balance + $final_amount;
            $member->save();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }

        return redirect()->back()->with(['success' => 'Successfully balance transferred.']);

    }
}
