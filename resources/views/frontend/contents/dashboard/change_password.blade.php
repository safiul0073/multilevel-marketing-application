@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Change Password</h3>
</div>
<form method="POST" action="{{ route('user.update.password') }}">
    @csrf
    @include('frontend.layouts.partials.flash-alert')
    <div class="row mb-3">
        <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>
        <div class="col-md-6">
            <input id="old_password" type="password" class="form-control @error('old_password') has-error @enderror" name="old_password" value="{{ old('old_password') }}" required autofocus>
            @error('old_password')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') has-error @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
            @error('password')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') has-error @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
            @error('password_confirmation')
            <span class="error-message" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row mt-5">
        <button type="submit" class=" rounded-md px-4 py-2 bg-indigo-600 text-white text-lg">
            {{ __('Change Password') }}
        </button>
    </div>
</form>
@endsection