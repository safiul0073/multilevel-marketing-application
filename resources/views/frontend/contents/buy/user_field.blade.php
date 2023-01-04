@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
    <div class="lg:flex xl:flex justify-center items-center ">
        <div class="lg:w-1/2 xl:w-1/2 mx-auto">
            {{-- error message show or success message show component --}}
            @include('frontend.layouts.partials.flash-alert')
            {{-- error show or success message shop composnent --}}
            <form method="get" action="{{ route('check.user', $slug) }}">
                @csrf
                <input type="hidden" name="slug" value="{{ $slug }}" >
                <input type="hidden" name="sponsor_id" value="{{ $sponsor_id }}" >
                <input type="hidden" name="position" value="{{ $position }}" >
                <div class="formGroup">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') has-error @enderror">
                    @error('first_name')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}"  class="form-control @error('last_name') has-error @enderror">
                    @error('last_name')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="username">Enter username</label>
                    <input type="text" name="username" value="{{ old('username') }}"  class="form-control @error('username') has-error @enderror">
                    @error('username')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}"  class="form-control @error('email') has-error @enderror">
                    @error('email')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"  class="form-control @error('phone') has-error @enderror">
                    @error('phone')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="password">Password</label>
                    <input type="text" name="password" value="{{ old('password') }}" class="form-control @error('password') has-error @enderror">
                    @error('password')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="text" name="password_confirmation" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" >Continue</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
