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
            <form method="get" action="{{ route('check.sponsor.user') }}">
                @csrf
                <input type="hidden" name="slug" value="{{$slug}}" >
                <div class="formGroup">
                    <label for="sponsor_id">Enter Sponser code/username</label>
                    <input type="text" name="username" value="{{ $sponsor_id ? $sponsor_id : old('username') }}" {{ $sponsor_id ? "readonly" : '' }} class="form-control @error('username') has-error @enderror">
                    @error('username')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">

                    <label for="sponsor_id">Set Position</label>
                    <select name="position" value="{{ $position ? $position : old('position') }}" class="form-control @error('position') has-error @enderror" id="">
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
                    <button type="submit" class="btn btn-primary" >continue</button>
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
