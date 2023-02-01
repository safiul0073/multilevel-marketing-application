@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')


<div class="bg-white py-10 md:py-12 lg:py-20">
    <div class=" container">
        <h1 class="text-4xl font-bold tracking-tight text-gray-600 sm:text-5xl md:text-6xl text-center mb-10 md:mb-12 lg:mb-20">
            <span class="block">Our All Product List</span>
        </h1>
        <div class="bg-gray-800 rounded-xl p-4 sm:p-8">
            <div class="bg-gray-200 rounded-xl p-5 flex flex-wrap gap-5 items-center justify-between mb-4 sm:mb-8">
                <form action="{{url("products")}}">
                    @csrf
                    <div class="relative w-60 flex flex-row">
                        <select name="category_id" class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-1 h-14 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" name="" id="">
                            @foreach ($categories as $category )
                            @if ($category_id === $category->id)
                            <option selected value="{{ $category->id }}">{{$category->title}}</option>
                            @else
                            <option value="{{ $category->id }}">{{$category->title}}</option>
                            @endif

                            @endforeach
                        </select>
                        <button class="px-3 rounded-md bg-white hover:bg-gray-100 text-gray-700" type="submit">Go</button>
                        {{-- <button type="button" class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-1 h-14 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                            <span class="flex items-center">
                                <span class="ml-3 block truncate">Tom Cook</span>
                            </span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button> --}}
                        {{-- <ul class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm border border-gray-300" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                            <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="option">
                                <div class="flex items-center">
                                    <span class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400" aria-hidden="true"></span>
                                    <span class="font-normal ml-3 block truncate">
                                        Wade Cooper
                                        <span class="sr-only"> is online</span>
                                    </span>
                                </div>
                                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>
                            <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="option">
                                <div class="flex items-center">
                                    <span class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400" aria-hidden="true"></span>
                                    <span class="font-normal ml-3 block truncate">
                                        Wade Cooper
                                        <span class="sr-only"> is online</span>
                                    </span>
                                </div>
                                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>
                        </ul> --}}
                    </div>
                </form>
                <form action="{{url('products')}}">
                    @csrf
                    <div class="relative w-80 flex flex-row ">
                        <div class="relative shadow-sm bg-white rounded-lg border border-gray-300">
                            <input name="search" value="{{$search}}" class="block w-full appearance-none bg-transparent py-1 h-14 pl-4 pr-12 text-base text-slate-900 placeholder:text-slate-600 focus:outline-none sm:text-sm sm:leading-6" placeholder="Find anything..." aria-label="Search components" id="headlessui-combobox-input-35" role="combobox" type="text" aria-expanded="true" tabindex="0" style="caret-color: rgb(107, 114, 128);" aria-controls="headlessui-combobox-options-36" />
                            <svg class="pointer-events-none absolute top-4 right-4 h-6 w-6 fill-slate-400" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.47 21.53a.75.75 0 1 0 1.06-1.06l-1.06 1.06Zm-9.97-4.28a6.75 6.75 0 0 1-6.75-6.75h-1.5a8.25 8.25 0 0 0 8.25 8.25v-1.5ZM3.75 10.5a6.75 6.75 0 0 1 6.75-6.75v-1.5a8.25 8.25 0 0 0-8.25 8.25h1.5Zm6.75-6.75a6.75 6.75 0 0 1 6.75 6.75h1.5a8.25 8.25 0 0 0-8.25-8.25v1.5Zm11.03 16.72-5.196-5.197-1.061 1.06 5.197 5.197 1.06-1.06Zm-4.28-9.97c0 1.864-.755 3.55-1.977 4.773l1.06 1.06A8.226 8.226 0 0 0 18.75 10.5h-1.5Zm-1.977 4.773A6.727 6.727 0 0 1 10.5 17.25v1.5a8.226 8.226 0 0 0 5.834-2.416l-1.061-1.061Z"></path>
                            </svg>
                        </div>
                        <button class="px-3 rounded-md bg-white hover:bg-gray-100 text-gray-700" type="submit">Search</button>
                        {{-- <ul class="max-h-[18.375rem] mt-1 divide-y divide-slate-200 overflow-auto rounded-lg text-sm leading-6 absolute top-full inset-x-0 z-10 bg-white border border-gray-300" role="listbox" id="headlessui-combobox-options-36 shadow-lg">
                            <li class="flex items-center justify-between p-4" id="headlessui-combobox-option-129" role="option" tabindex="-1">
                                <span class="whitespace-nowrap font-semibold text-slate-900">Section Headings</span>
                                <span class="ml-4 text-right text-xs text-slate-600">Application UI / Headings</span>
                            </li>
                            <li class="flex items-center justify-between p-4" id="headlessui-combobox-option-129" role="option" tabindex="-1">
                                <span class="whitespace-nowrap font-semibold text-slate-900">Section Headings</span>
                                <span class="ml-4 text-right text-xs text-slate-600">Application UI / Headings</span>
                            </li>
                        </ul> --}}
                    </div>
                </form>
            </div>
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
                    <div id="image-shop-slid" class="show"></div>
                    <div class="small-img">
                        <img src="{{ asset("frontend/images/icon/online_icon_right@2x.png") }}" class="icon-left" alt="" id="prev-img">
                        <div class="small-container">
                            <div id="small-img-roll">
                                {{-- <img src="https://placeimg.com/1000/1000/animals" class="show-small-img" alt="">
                            <img src="https://placeimg.com/1000/1000/arch" class="show-small-img" alt="">
                            <img src="https://placeimg.com/1000/1000/nature" class="show-small-img" alt="">
                            <img src="https://placeimg.com/1000/1000/people" class="show-small-img" alt="">
                            <img src="https://placeimg.com/1000/1000/tech" class="show-small-img" alt="">
                            <img src="https://picsum.photos/1000/1000/?random" class="show-small-img" alt=""> --}}
                            </div>
                        </div>
                        <img src="{{ asset("frontend/images/icon/online_icon_right@2x.png") }}" class="icon-right" alt="" id="next-img">
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
                        <h1 class="text-lg text-gray-600 font-bold">Video</h1>
                        <iframe class="w-full aspect-video" id="vedio_link" frameBorder="0"></iframe>
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

@endsection