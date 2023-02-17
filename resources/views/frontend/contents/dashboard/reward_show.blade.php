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
            <img src="{{count($reward->images) ? $reward->images[0]->url : "" }}" alt="reward-image" class="h-full w-full object-cover rounded-md">
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
<div class="fixed inset-0 flex z-50 modal overflow-y-auto p-10" id="modal-view-user">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity modal-exit"></div>
    <div class="flex flex-col m-auto transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:p-6">
        <h1 id="ful_name_id"></h1>
        <div class="absolute top-0 right-0 pt-2 pr-2">
            <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 modal-exit">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="bg-white">

            <div class="mx-auto py-2 px-2 sm:px-6 ">
                <div class="lg:w-[400px] h-[200px] swiper mySwiper">
                    <div id="swiper-images" class="swiper-wrapper">

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_scipt')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.mySwiper', {
        spaceBetween: 30,
        centeredSlides: true,
        loop: false,
        // autoplay: {
        //   delay: 2500,
        //   disableOnInteraction: false,
        // },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<script>
    function showImageSlider(images) {
        var sliderInputDiv = document.getElementById("swiper-images");
        if (images.length > 0) {
            var images_str = "";
            images?.map((image) => {
                images_str += `<div class="swiper-slide">
            <img
            class="object-cover w-full h-full"
            src="${image?.url}"
            alt="image"
            />
        </div>`;
            });
            sliderInputDiv.innerHTML = images_str;
        } else {
            sliderInputDiv.innerHTML = "<h1 class='text-center'>Sorrry! there is no images right now.</h1>"
        }
    }
</script>
@endpush
