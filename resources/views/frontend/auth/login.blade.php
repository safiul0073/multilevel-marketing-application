@extends('frontend.layouts.app')

@section('content')
<div class="relative flex justify-center md:px-12 lg:px-0 min-h-[600px]">
    <div class="relative z-10 flex flex-1 flex-col bg-white py-10 px-6 shadow-2xl justify-center sm:flex-none sm:px-16 w-full sm:w-3/4 lg:w-1/2">
        <div class="card">
            @include('frontend.layouts.partials.flash-alert')
            <h2 class="text-3xl font-medium leading-6 text-gray-900">{{ __('Login') }}</h2>
            <div class="card-body mt-10">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control ring-1 ring-indigo-600 @error('username') has-error @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control ring-1 ring-indigo-600 @error('password') has-error @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check text-xl">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-lg ml-1" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class=" rounded-md px-4 py-2 bg-indigo-600 text-white text-lg">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
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