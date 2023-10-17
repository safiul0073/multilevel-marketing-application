@extends('frontend.contents.dashboard.index')
@push('custom_style')
{{-- here some custome style --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">My Reward</h3>
</div>
<div class="">
    <div class="grid lg:grid-cols-4 gap-4">
        @forelse ($rewards as $reward)
        @if (count($reward->reward_users))
        <button data-modal="modal-view-user" onclick="showImageSlider({{ $reward->images }})" class="relative w-full h-44 bg-indigo-800 text-white rounded-md hover:bg-indigo-600">
            @if (count($reward->images))
                <img src="{{$reward->images[0]->url}}" alt="reward-image" class="h-full w-full object-cover rounded-md">
            @endif
            <div class="w-full h-full flex justify-center items-center text-xl absolute top-0 bottom-0 left-0 right-0 rounded-md bg-indigo-600/20">
                <h1 class="text-xl">{{ $reward->designation }}</h1>
            </div>
        </button>
        @else
        <div class="w-full h-44 relative bg-slate-600 text-white rounded-md flex flex-col justify-center items-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <h1 class="text-xl mt-1">{{ $reward->designation }}</h1>
        </div>
        @endif
        @empty
        <h1 class="text-center">Nothing!</h1>
        @endforelse
    </div>
</div>
@include("frontend.common.modal")
@endsection

@push('custom_scipt')
<script src="{{ asset('frontend/script/splide.min.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset("frontend/script/swiper.js") }}"></script>
<script src="{{ asset('frontend/script/modalImageSlider.js') }}"></script>
@endpush
