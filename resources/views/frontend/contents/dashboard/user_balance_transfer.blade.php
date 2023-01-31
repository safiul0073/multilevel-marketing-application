@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
    <div class="sm:w-full w-1/2 mx-auto py-2 px-1">
        <p class=" font-bold text-gray-600 text-center">You can transfer amount to other peaple from you wallet ({{ $charge }}TK charge for every transfer)</p>
        @include('frontend.layouts.partials.flash-alert')

        <form class="my-2" method="POST" action="{{ route('transfer.balance') }}">
            @csrf
            <div class="formGroup">
                <label class="label-style">Username</label>
                <input
                    type="text"
                    value="{{ old('username') }}"
                    name="username"
                    required
                    autocomplete
                    class="form-control @error('username') has-error @enderror"
                >
                @error('username')
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

            <button type="submit" class="rounded-full h-[50px] w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Submit</button>
        </form>
    </div>
@endsection
