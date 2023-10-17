@extends('frontend.layouts.app')
@section('title', __('Gallery'))
@push('custom_style')
{{-- here some custome style --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<section class="overflow-hidden text-gray-700 py-6 sm:py-10 lg:py-20">
    <div class="container px-5 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 grid-flow-row gap-4 -m-1 md:-m-2">
            @forelse ($galleries as $gallery)
                <div class="w-full p-1 md:p-2">
                    <button data-modal="modal-view-user" onclick="showImageSlider({{ $gallery->images }})">
                        <img alt="gallery" class="block object-cover object-center w-full h-[300px] rounded-lg" src="{{ $gallery->images[0]->url }}">
                    </button>
                    <h1 class="text-center text-gray-800 bg-gray-300 rounded-md ">{{ $gallery->title }}</h1>
                </div>
            @empty

            @endforelse


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
@include("frontend.common.modal")
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}
<script src="{{ asset('frontend/script/splide.min.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset("frontend/script/swiper.js") }}"></script>
<script src="{{ asset('frontend/script/modalImageSlider.js') }}"></script>
@endpush

@section('custome_scipt')

@endsection
