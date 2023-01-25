<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    use Formatter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $paymentMethods = PaymentMethod::orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($paymentMethods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|max:255',
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
            'type' => 'required|in:auto,manual',
            'percent_charge' => 'nullable|numeric',
            'fixed_charge' => 'nullable|numeric',
            'status' => 'integer',
        ]);

        PaymentMethod::create($attributes);

        return $this->withSuccess('Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $this->validate($request, [
            'id'    => 'required|numeric|exists:payment_methods,id',
            'name' => 'required|string|max:255',
            'min' => 'nullable|numeric',
            'max' => 'nullable|numeric',
            'type' => 'required|in:auto,manual',
            'percent_charge' => 'nullable|numeric',
            'fixed_charge' => 'nullable|numeric',
            'status' => 'integer',
        ]);

        PaymentMethod::find((int) $request->id)->update($attributes);
        return $this->withSuccess('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return $this->withSuccess('Successfully deleted.');
    }
}
