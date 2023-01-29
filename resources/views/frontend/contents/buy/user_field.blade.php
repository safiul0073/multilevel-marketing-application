@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')

<div class="relative overflow-hidden bg-white h-full">
    <div class="hidden lg:absolute lg:inset-0 lg:block" aria-hidden="true">
        <svg class="absolute top-0 left-1/2 translate-x-64 -translate-y-8 transform" width="640" height="784" fill="none" viewBox="0 0 640 784">
            <defs>
                <pattern id="9ebea6f4-a1f5-4d96-8c4e-4c2abf658047" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
            <rect x="118" width="404" height="784" fill="url(#9ebea6f4-a1f5-4d96-8c4e-4c2abf658047)" />
        </svg>
    </div>
    <div class="relative py-8 sm:py-12 lg:py-16">
        <main class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="lg:flex xl:flex justify-center items-center ">
                <div class="lg:w-1/2 xl:w-1/2 mx-auto">
                    {{-- error message show or success message show component --}}
                    @include('frontend.layouts.partials.flash-alert')
                    {{-- error show or success message shop composnent --}}
                    <form method="get" action="{{ route('check.user', $slug) }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $slug }}">
                        <input type="hidden" name="sponsor_username" value="{{ $sponsor_username }}">
                        <input type="hidden" name="main_sponsor_username" value="{{ $main_sponsor_username }}">
                        <input type="hidden" name="position" value="{{ $position }}">
                        <div class="formGroup">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control !ring-1 !ring-indigo-600 @error('first_name') has-error @enderror">
                            @error('first_name')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control !ring-1 !ring-indigo-600 @error('last_name') has-error @enderror">
                            @error('last_name')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="username">Enter username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control !ring-1 !ring-indigo-600 @error('username') has-error @enderror">
                            @error('username')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control !ring-1 !ring-indigo-600 @error('email') has-error @enderror">
                            @error('email')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control !ring-1 !ring-indigo-600 @error('phone') has-error @enderror">
                            @error('phone')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="password">Password</label>
                            <input type="text" name="password" value="{{ old('password') }}" class="form-control !ring-1 !ring-indigo-600 @error('password') has-error @enderror">
                            @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="text" name="password_confirmation" class="form-control !ring-1 !ring-indigo-600">
                        </div>
                        <div class="flex justify-center items-center">
                            <button type="submit" class="mt-3 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
