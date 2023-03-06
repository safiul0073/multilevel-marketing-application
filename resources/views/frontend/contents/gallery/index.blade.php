@extends('frontend.layouts.app')
@section('title', __('Gallery'))
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<section class="overflow-hidden text-gray-700 py-6 sm:py-10 lg:py-20">
    <div class="container px-5 mx-auto">
        <div class="grid grid-cols-3 grid-flow-col gap-4 -m-1 md:-m-2">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gallary1.jpeg') }}">
            </div>

            {{-- <div class="flex flex-wrap w-1/2">
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gallary1.jpeg') }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gellary2.jpeg') }}">
                </div>
                <div class="w-full p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gellary3.jpeg') }}">
                </div>
            </div>
            <div class="flex flex-wrap w-1/2">
                <div class="w-full p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gallary10.jpeg') }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gallary9.jpeg') }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="{{ asset('frontend/images/gellary/gellary8.jpeg') }}">
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
