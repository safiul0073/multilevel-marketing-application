<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index () {

        $method = request()->method;
        $payment_methods = PaymentMethod::where('status', 1)->select('id','name')->get();

        return view('frontend.contents.dashboard.withdraw_form', ['payment_methods' => $payment_methods,
            'method' => $method]);
    }

    public function withdrawBalance (Request $request) {

        $this->validate($request, [
            'payment_method_id' => 'nullable|numeric|exists:payment_methods,id',
            'phone' => 'required|string|confirmed|regex:/^[0-9]+$/',
            'amount' => 'required|numeric'
        ]);

        $user = User::find(auth()->id());

        if ($user->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Not enough balance.']);
        }

        $payment_method = PaymentMethod::find((int) $request->payment_method_id);

        if (!$payment_method) {
            return redirect()->back()->with(['error' => 'Please select a payment method.']);
        }

        if ($payment_method->min > $request->amount || $payment_method->max < $request->amount) {
            return redirect()->back()->with(['error' => "This payment method support minimum amount $payment_method->min and maximum amount $payment_method->max . "]);
        }

        $user->withdraws()->create([
            'payment_method_id' => $payment_method->id,
            'amount' => $request->amount,
            'account_number' => $request->phone
        ]);

        return redirect()->back()->with(['success' => 'Successfully withdraw request sended.']);
    }

    public function withdrawList () {

        $withdraws = Withdraw::where('user_id', auth()->id())->paginate(10);

        return view('frontend.contents.dashboard.withdraw_list', ['withdraws' => $withdraws]);
    }
}
