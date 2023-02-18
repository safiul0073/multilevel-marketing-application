@extends('frontend.layouts.app')
@section('title', __('Verification'))
@section('content')
<div class="relative flex justify-center md:px-12 lg:px-0 min-h-[600px]">
    <div class="relative z-10 flex flex-1 flex-col bg-white py-10 px-6 shadow-2xl justify-center sm:flex-none sm:px-16 w-full sm:w-3/4 lg:w-1/2">
        <div class="card">
            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

            <div class="card-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
    <div class="hidden sm:contents lg:relative lg:block lg:flex-1">
        <img alt="" src="https://images.pexels.com/photos/7534801/pexels-photo-7534801.jpeg?auto=compress&cs=tinysrgb&w=1600" width="1664" height="1866" decoding="async" data-nimg="1" class="absolute inset-0 h-full w-full object-cover" loading="lazy" />
    </div>
</div>
@endsection
