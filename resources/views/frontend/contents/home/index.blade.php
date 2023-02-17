@extends('frontend.layouts.app')
@section('title', __('Home'))
@push('custom_style')
{{-- here some custome style --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<div class="relative overflow-hidden">
    <div class="absolute inset-y-0 h-full w-full pointer-events-none" aria-hidden="true">
        <div class="relative h-full">
            <svg class="absolute right-full translate-y-1/3 translate-x-1/4 transform sm:translate-x-1/2 md:translate-y-1/2 lg:translate-x-full" width="404" height="784" fill="none" viewBox="0 0 404 784">
                <defs>
                    <pattern id="e229dbec-10e9-49ee-8ec3-0286ca089edf" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="784" fill="url(#e229dbec-10e9-49ee-8ec3-0286ca089edf)" />
            </svg>
            <svg class="absolute left-full -translate-y-3/4 -translate-x-1/4 transform sm:-translate-x-1/2 md:-translate-y-1/2 lg:-translate-x-3/4" width="404" height="784" fill="none" viewBox="0 0 404 784">
                <defs>
                    <pattern id="d2a68204-c383-44b1-b99f-42ccff4e5365" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="784" fill="url(#d2a68204-c383-44b1-b99f-42ccff4e5365)" />
            </svg>
        </div>
    </div>
    <div class="py-8 md:py-12 xl:py-20">
        <div class="container">
            <div class="mx-auto px-4 sm:px-6">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">{{ config('mlm.home_content.top_h1_first') }}</span>
                        <span class="block text-indigo-600">{{ config('mlm.home_content.top_h1_second') }}</span>
                    </h1>
                    <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">{{ config('mlm.home_content.top_p_tag') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="relative">
        <div class="absolute inset-0 flex flex-col" aria-hidden="true">
            <div class="flex-1"></div>
            <div class="w-full flex-1 bg-gray-800"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div id="splide1" class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        @forelse ($sliders as $slider)
                        <li class="splide__slide">
                            <img class="relative rounded-lg shadow-lg" src="{{ $slider?->image?->url }}" alt="App screenshot">
                        </li>
                        @empty
                        <li class="splide__slide">
                            <img class="relative rounded-lg shadow-lg" src="https://tailwindui.com/img/component-images/top-nav-with-multi-column-layout-screenshot.jpg" alt="App screenshot">
                        </li>
                        <li class="splide__slide">
                            <img class="relative rounded-lg shadow-lg" src="https://tailwindui.com/img/component-images/top-nav-with-multi-column-layout-screenshot.jpg" alt="App screenshot">
                        </li>
                        <li class="splide__slide">
                            <img class="relative rounded-lg shadow-lg" src="https://tailwindui.com/img/component-images/top-nav-with-multi-column-layout-screenshot.jpg" alt="App screenshot">
                        </li>
                        @endforelse

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-800 py-10 md:py-12 lg:py-20">
    <div class=" container">
        <h1 class="text-4xl font-bold tracking-tight text-gray-200 sm:text-5xl md:text-6xl mb-10 md:mb-12 lg:mb-20 text-center">
            <span class="block">Some of Our</span>
            <span class="block text-indigo-500">Trending {{ auth()->check() ? "Products" : "Package" }}</span>
        </h1>
        <div class="bg-indigo-600/20 rounded-xl">
            <div class="mx-auto p-4 sm:p-8">
                <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

                    @foreach ($products as $product)
                    <div>
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8 relative pt-[120%]">
                            <img src="{{count($product->images) > 0 ? $product->images[0]->url : 'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg'}}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-top group-hover:opacity-75 absolute inset-0">
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex flex-col">
                                <h3 class="text-sm text-white">{{$product->name}}</h3>
                                <p class="mt-1 text-lg font-medium text-white">{{$product->price . " TK"}}</p>
                            </div>
                            <button data-modal="modal-one" onclick="getOneProduct({{$product->id}})" class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>

    </div>
</div>

<div class="bg-white py-10 md:py-12 lg:py-20">
    <h1 class="text-4xl font-bold tracking-tight text-gray-500 sm:text-5xl md:text-6xl mb-10 md:mb-12 lg:mb-20 text-center">
        <span class="block tracking-wide">Some of Our's</span>
        <span class="block text-indigo-700">Reward</span>
    </h1>
    <div class="relative container">
        <div id="splide2" class="splide" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($rewards as $reward)
                        <li class="splide__slide">
                            <div class="relative overflow-hidden rounded-xl bg-indigo-500 py-24 px-8 shadow-2xl lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-16">
                                <div class="absolute inset-0 opacity-50 mix-blend-multiply saturate-0 filter">
                                    <img src="{{ count($reward->images) ? $reward->images[0]->url : "https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80" }}" alt="" class="h-full w-full object-cover">
                                </div>
                                <div class="relative lg:col-span-1">
                                    {{-- <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-white.svg" alt=""> --}}
                                    <blockquote class="mt-6 text-white">
                                        <p class="text-xl font-medium sm:text-2xl">This app has completely transformed how we interact with customers. We've seen record bookings, higher customer satisfaction, and reduced churn.</p>
                                        <footer class="mt-6">
                                            <p class="flex flex-col font-medium">
                                                <span>{{ $reward->designation }}</span>
                                                <span>{{ "Matching Count " . $reward->left_count }}</span>
                                            </p>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </li>
                    @empty
                    <li class="splide__slide">
                        <div class="relative overflow-hidden rounded-xl bg-indigo-500 py-24 px-8 shadow-2xl lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-16">
                            <div class="absolute inset-0 opacity-50 mix-blend-multiply saturate-0 filter">
                                <img src="https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80" alt="" class="h-full w-full object-cover">
                            </div>
                            <div class="relative lg:col-span-1">
                                <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-white.svg" alt="">
                                <blockquote class="mt-6 text-white">
                                    <p class="text-xl font-medium sm:text-2xl">This app has completely transformed how we interact with customers. We've seen record bookings, higher customer satisfaction, and reduced churn.</p>
                                    <footer class="mt-6">
                                        <p class="flex flex-col font-medium">
                                            <span>Marie Chilvers</span>
                                            <span>CEO, Workcation</span>
                                        </p>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="relative overflow-hidden rounded-xl bg-indigo-500 py-24 px-8 shadow-2xl lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-16">
                            <div class="absolute inset-0 opacity-50 mix-blend-multiply saturate-0 filter">
                                <img src="https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80" alt="" class="h-full w-full object-cover">
                            </div>
                            <div class="relative lg:col-span-1">
                                <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-white.svg" alt="">
                                <blockquote class="mt-6 text-white">
                                    <p class="text-xl font-medium sm:text-2xl">This app has completely transformed how we interact with customers. We've seen record bookings, higher customer satisfaction, and reduced churn.</p>
                                    <footer class="mt-6">
                                        <p class="flex flex-col font-medium">
                                            <span>Marie Chilvers</span>
                                            <span>CEO, Workcation</span>
                                        </p>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="relative overflow-hidden rounded-xl bg-indigo-500 py-24 px-8 shadow-2xl lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-16">
                            <div class="absolute inset-0 opacity-50 mix-blend-multiply saturate-0 filter">
                                <img src="https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80" alt="" class="h-full w-full object-cover">
                            </div>
                            <div class="relative lg:col-span-1">
                                <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-white.svg" alt="">
                                <blockquote class="mt-6 text-white">
                                    <p class="text-xl font-medium sm:text-2xl">This app has completely transformed how we interact with customers. We've seen record bookings, higher customer satisfaction, and reduced churn.</p>
                                    <footer class="mt-6">
                                        <p class="flex flex-col font-medium">
                                            <span>Marie Chilvers</span>
                                            <span>CEO, Workcation</span>
                                        </p>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="relative bg-gray-900 py-10 md:py-12 lg:py-20">
    <div class="absolute bottom-0 h-80 w-full xl:inset-0 xl:h-full">
        <div class="h-full w-full xl:grid xl:grid-cols-2">
            <div class="h-full xl:relative xl:col-start-2">
                <img class="h-full w-full object-cover opacity-25 xl:absolute xl:inset-0" src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2830&q=80&sat=-100" alt="People working on laptops">
                <div aria-hidden="true" class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-gray-900 xl:inset-y-0 xl:left-0 xl:h-full xl:w-32 xl:bg-gradient-to-r"></div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative pb-0 sm:pb-6 xl:col-start-1 xl:pb-24">
            <h1 class="text-4xl font-bold tracking-tight text-gray-200 sm:text-5xl md:text-6xl mb-10 md:mb-12 lg:mb-20 text-center">
                <span class="block text-indigo-500">Reward Achievements</span>
            </h1>
            <div class="w-full bg-indigo-300/10 border rounded-lg shadow-md border-indigo-900/20">
                <div class="p-4 rounded-lg md:p-8">
                    <div class="relative container">
                        <div id="splide3" class="splide" aria-label="Splide Basic HTML Example">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @forelse ($reward_users as $user)
                                    <li class="splide__slide">
                                        <div class="text-center text-gray-400">
                                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="{{ $user->image ? $user->image->url : "https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" }}" alt="Bonnie Avatar">
                                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-white">
                                                <p>{{ $user->first_name .' '. $user->last_name??""  }}</p>
                                            </h3>
                                            <p>{{ count($user->rewards) ? $user->rewards[0]->designation : "" }}</p>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="splide__slide">
                                        <div class="text-center text-gray-400">
                                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-white">
                                                <a href="#">Bonnie Green</a>
                                            </h3>
                                            <p>CEO/Co-founder</p>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="text-center text-gray-400">
                                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-white">
                                                <a href="#">Bonnie Green</a>
                                            </h3>
                                            <p>CEO/Co-founder</p>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="text-center text-gray-400">
                                            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
                                            <h3 class="mb-1 text-2xl font-bold tracking-tight text-white">
                                                <a href="#">Bonnie Green</a>
                                            </h3>
                                            <p>CEO/Co-founder</p>
                                        </div>
                                    </li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative bg-white py-10 md:py-12 lg:py-20">
    <div class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8">
        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our UpComing Events</p>
        <div class=" mt-10 md:mt-12 lg:mt-20 ">
            <div class="grid grid-cols-1 gap-4 md:gap-8 lg:gap-12 sm:grid-cols-2 lg:grid-cols-3">
                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/cloud-arrow-up -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">Push to Deploy</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/lock-closed -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">SSL Certificates</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/arrow-path -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12c0-1.232.046-2.453.138-3.662a4.006 4.006 0 013.7-3.7 48.678 48.678 0 017.324 0 4.006 4.006 0 013.7 3.7c.017.22.032.441.046.662M4.5 12l-3-3m3 3l3-3m12 3c0 1.232-.046 2.453-.138 3.662a4.006 4.006 0 01-3.7 3.7 48.657 48.657 0 01-7.324 0 4.006 4.006 0 01-3.7-3.7c-.017-.22-.032-.441-.046-.662M19.5 12l-3 3m3-3l3 3" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">Simple Queues</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/shield-check -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">Advanced Security</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/cog -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">Powerful API</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-100 px-6 pb-8">
                        <div class="-mt-6">
                            <div>
                                <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                                    <!-- Heroicon name: outline/server -->
                                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 17.25v-.228a4.5 4.5 0 00-.12-1.03l-2.268-9.64a3.375 3.375 0 00-3.285-2.602H7.923a3.375 3.375 0 00-3.285 2.602l-2.268 9.64a4.5 4.5 0 00-.12 1.03v.228m19.5 0a3 3 0 01-3 3H5.25a3 3 0 01-3-3m19.5 0a3 3 0 00-3-3H5.25a3 3 0 00-3 3m16.5 0h.008v.008h-.008v-.008zm-3 0h.008v.008h-.008v-.008z" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="mt-8 text-lg font-semibold leading-8 tracking-tight text-gray-900">Database Backups</h3>
                            <p class="mt-5 text-base leading-7 text-gray-600">Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed inset-0 flex z-50 modal overflow-y-auto p-10" id="modal-one">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity modal-exit"></div>
    <div class="flex flex-col m-auto transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:p-6">
        <div class="absolute top-0 right-0 pt-2 pr-2">
            <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 modal-exit">
                <span class="sr-only">Close</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="bg-white">

            <div class="mx-auto py-8 px-4 sm:px-6 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8">
                <div class="lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pr-8">
                    <div class="w-full h-[400px] swiper mySwiper">
                        <div id="swiper-images" class="swiper-wrapper">

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="mt-10">
                        <h2 class="text-sm font-medium text-gray-900">Details</h2>

                        <div class="mt-4 space-y-6">
                            <p id="description" class="text-sm text-gray-600"></p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h1 id="product_name" class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl mb-4"></h1>
                    <h2 class="sr-only">Product information</h2>
                    <p id="category" class="text-lg tracking-tight text-gray-600"></p>
                    <div class="mt-6">
                        <p id="price" class="text-lg tracking-tight text-gray-600"></p>

                    </div>

                    <div class="mt-6">
                        <h3 id="referral_commission" class="text-lg text-gray-600"> </h3>
                    </div>
                    <div class="mt-6">
                        <h1 class="text-lg text-gray-600 mb-1 font-bold">Video</h1>
                        <iframe class="w-full aspect-video" id="vedio_link" frameBorder="0"></iframe>
                    </div>
                    <div class="pt-4">
                        <a class="btn btn-primary" id="checkout_button">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}
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

@endpush

@section('custome_scipt')

@endsection
