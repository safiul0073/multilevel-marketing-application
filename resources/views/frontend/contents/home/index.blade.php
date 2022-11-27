@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}
<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
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
    <div class="pt-6 pb-16 sm:pb-24">
        <div class="container">
            <div class="mx-auto mt-16 px-4 sm:px-6">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Data to enrich your</span>
                        <span class="block text-indigo-600">online business</span>
                    </h1>
                    <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
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
            <img class="relative rounded-lg shadow-lg" src="https://tailwindui.com/img/component-images/top-nav-with-multi-column-layout-screenshot.jpg" alt="App screenshot">
        </div>
    </div>
</div>

<div class="bg-gray-800">
    <div class="container pt-20 pb-28">
        <h1 class="text-4xl font-bold tracking-tight text-gray-200 sm:text-5xl md:text-6xl mb-20 text-center">
            <span class="block">Some of Our</span>
            <span class="block text-indigo-500">Trending Products</span>
        </h1>
        <div class="bg-indigo-600/20 rounded-xl">
            <div class="mx-auto p-8 sm:p-16 lg:p-24">
                <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg" alt="Person using a pen to cross a task off a productivity paper card." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg" alt="Person using a pen to cross a task off a productivity paper card." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>
                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>

                    <a href="#" class="group">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="my-4 flex flex-col">
                                <h3 class="text-sm text-white">Earthen Bottle</h3>
                                <p class="mt-1 text-lg font-medium text-white">$48</p>
                            </div>
                            <button class="inline-flex items-center rounded-md border border-transparent bg-rose-500 pl-2 pr-3 py-1.5 text-base font-medium text-white hover:bg-rose-600">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>Buy
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="bg-white py-16 lg:py-24">
    <h1 class="text-4xl font-bold tracking-tight text-gray-500 sm:text-5xl md:text-6xl mb-20 text-center">
        <span class="block tracking-wide">Some of Our's</span>
        <span class="block text-indigo-700">Success Story</span>
    </h1>
    <div class="relative container">
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
    </div>
</div>

<div class="relative bg-gray-900">
    <div class="absolute bottom-0 h-80 w-full xl:inset-0 xl:h-full">
        <div class="h-full w-full xl:grid xl:grid-cols-2">
            <div class="h-full xl:relative xl:col-start-2">
                <img class="h-full w-full object-cover opacity-25 xl:absolute xl:inset-0" src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2830&q=80&sat=-100" alt="People working on laptops">
                <div aria-hidden="true" class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-gray-900 xl:inset-y-0 xl:left-0 xl:h-full xl:w-32 xl:bg-gradient-to-r"></div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative pt-12 pb-64 sm:pt-24 sm:pb-64 xl:col-start-1 xl:pb-24">
            <h1 class="text-4xl font-bold tracking-tight text-gray-200 sm:text-5xl md:text-6xl mb-20 text-center">
                <span class="block text-indigo-500">Achievements</span>
            </h1>
            <div class="w-full bg-indigo-300/10 border rounded-lg shadow-md border-indigo-900/20">
                <div class="p-4 rounded-lg md:p-8">
                    <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto sm:grid-cols-3 text-white sm:p-8">
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Developers</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Public repositories</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Open source projects</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">1B+</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Contributors</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">90+</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Top Forbes companies</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">4M+</dt>
                            <dd class="font-light text-gray-300 dark:text-gray-400">Organizations</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative bg-white py-16 sm:py-24 lg:py-32">
    <div class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8">
        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our UpComing Events</p>
        <div class="mt-20">
            <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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
                    <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
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

@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')
<script src="{{ asset('frontend/script/home.js') }}"></script>
@endsection