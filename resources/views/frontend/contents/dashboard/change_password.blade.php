@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="row mb-3">
    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>
    <div class="col-md-6">
        <input id="username" type="password" class="form-control @error('username') has-error @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
        @error('username')
        <span class="error-message" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>
    <div class="col-md-6">
        <input id="username" type="password" class="form-control @error('username') has-error @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
        @error('username')
        <span class="error-message" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
    <div class="col-md-6">
        <input id="username" type="password" class="form-control @error('username') has-error @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
        @error('username')
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
@endsection