@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
    <div class="flex">
        <div>
            @include('frontend.contents.dashboard.sidebar')
        </div>
        <div>
            @yield('dashboard-page')
        </div>
    </div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
