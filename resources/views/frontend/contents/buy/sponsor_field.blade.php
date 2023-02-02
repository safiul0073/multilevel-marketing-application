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
                    <form method="get" action="{{ route('check.sponsor.user') }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{$slug}}">

                        <input type="hidden" name="sponsor_username" value="{{ $sponsor_id }}" >


                        <div class="formGroup">
                            <label for="sponsor_id">Enter Sponser code/username</label>
                            <input type="text" name="main_sponsor_username" value="{{ $sponsor_id ? $sponsor_id : old('main_sponsor_username') }}" {{ $sponsor_id && !isset($map) ? "readonly" : '' }} class="form-control !ring-1 !ring-indigo-600 @error('main_sponsor_username') has-error @enderror">
                            @error('main_sponsor_username')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            @if (isset($map) && $map)
                              <input type="hidden" value="{{ $position }}" name="position">
                            @endif
                            <label for="position">Set Position</label>
                            <select {{ isset($map) ? "disabled" : '' }} name="position" value="{{ $position ? $position : old('position') }}" class="form-control !ring-1 !ring-indigo-600  @error('position') has-error @enderror" id="">
                                <option value="">Select position</option>
                                <option {{ $position && $position == 'left' ? "selected" : '' }} value="left">Left</option>
                                <option {{ $position && $position == 'right' ? "selected" : '' }} value="right">Right</option>
                                <option {{ $position && $position == 'auto' ? "selected" : '' }} value="auto">Auto</option>
                            </select>

                            @error('position')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
