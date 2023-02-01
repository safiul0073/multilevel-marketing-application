@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
    <div class="w-full mx-auto py-2 px-1">
        <p class=" font-bold text-gray-600 text-center">Select a method and enter some info for withdraw your amount.</p>
        @include('frontend.layouts.partials.flash-alert')
        <div class="flex flex-wrap flex-row gap-2 my-4">
            @foreach ($payment_methods as $payment)
                <a  href="{{ url('withdraw/request/?method='.$payment->id) }}" class="px-4 py-4 text-center font-semibold rounded-md mx-1 {{ isset($method) && $method == $payment->id ?  "bg-indigo-700 text-white" : "bg-gray-300 hover:bg-indigo-500 text-gray-500 hover:text-white" }} ">{{ $payment->name }}</a>
            @endforeach
        </div>
        <form class="mb-2 mt-8 p-6 lg:p-10 bg-white border-1 border-gray-200 rounded-lg" method="POST" action="{{ route('withdraw.balance') }}">
            @csrf
            <input type="hidden" value="{{ isset($method) ? $method : '' }}" name="payment_method_id">
            <div class="formGroup">
                <label class="label-style">Phone</label>
                <input
                    type="text"
                    value="{{ old('phone') }}"
                    name="phone"
                    required
                    autocomplete
                    class="form-control @error('phone') has-error @enderror"
                >
                @error('phone')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="formGroup">
                <label class="label-style">Again Phone</label>
                <input
                    type="text"
                    value="{{ old('phone_confirmation') }}"
                    name="phone_confirmation"
                    required
                    autocomplete
                    class="form-control @error('phone_confirmation') has-error @enderror"
                >
                @error('phone_confirmation')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="formGroup">
                <label class="label-style">Amount</label>
                <input
                    type="text"
                    value="{{ old('amount') }}"
                    name="amount"
                    required
                    autocomplete
                    class="form-control @error('amount') has-error @enderror"
                >
                @error('amount')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="rounded-full mt-5 h-[50px] w-full max-w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Submit</button>
        </form>
    </div>
@endsection
