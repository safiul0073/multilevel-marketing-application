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
            <form method="get" action="{{ route('check.sponsor.user', $slug) }}">
                @csrf
                <input type="hidden" name="slug" value="{{$slug}}" >
                <div class="formGroup">
                    <label for="sponsor_id">Enter Sponser code/username</label>
                    <input type="text" name="username" class="form-control @error('username') has-error @enderror">
                    @error('username')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    <label for="sponsor_id">Set Position</label>
                    <input type="text" name="position" class="form-control @error('position') has-error @enderror">
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
