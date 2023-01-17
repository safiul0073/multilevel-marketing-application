@extends('frontend.layouts.app')

@section('content')
<div class="relative flex justify-center md:px-12 lg:px-0 min-h-[600px]">
    <div class="relative z-10 flex flex-1 flex-col bg-white py-10 px-6 shadow-2xl justify-center sm:flex-none sm:px-16 w-full sm:w-3/4 lg:w-1/2">
        <div class="card">
            <div class="card-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control ring-1 ring-indigo-600 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden sm:contents lg:relative lg:block lg:flex-1">
        <img alt="" src="https://images.pexels.com/photos/7534801/pexels-photo-7534801.jpeg?auto=compress&cs=tinysrgb&w=1600" width="1664" height="1866" decoding="async" data-nimg="1" class="absolute inset-0 h-full w-full object-cover" loading="lazy" />
    </div>
</div>
@endsection