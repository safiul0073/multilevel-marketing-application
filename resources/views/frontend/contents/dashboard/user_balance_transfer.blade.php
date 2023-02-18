@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Balance Transfer</h3>
</div>
<div class="w-full mx-auto py-2 px-1">
    <p class=" font-bold text-gray-600 text-center">You can transfer amount to other peaple from you wallet ({{ $charge }}TK charge for every transfer)</p>
    @include('frontend.layouts.partials.flash-alert')

    <form class="mb-2 mt-8 p-6 lg:p-10 bg-white border-1 border-gray-200 rounded-lg" method="POST" action="{{ route('transfer.balance') }}">
        @csrf
        <div class="formGroup">
            <label class="label-style">Username</label>
            <input type="text" value="{{ old('username') }}" name="username" required autocomplete class="form-control @error('username') has-error @enderror">
            @error('username')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="formGroup">
            <label class="label-style">Amount</label>
            <input type="text" value="{{ old('amount') }}" name="amount" required autocomplete class="form-control @error('amount') has-error @enderror">
            @error('amount')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="rounded-full mt-3 h-[50px] w-full max-w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Submit</button>
    </form>
</div>
@endsection