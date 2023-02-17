@extends('frontend.layouts.app')
@section('title', __('About Us'))
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<div class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4">
    <div class="flex flex-col lg:flex-row justify-between gap-8">
        <div class="w-full lg:w-5/12 flex flex-col justify-center">
            <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 dark:text-white pb-4">About Us</h1>
            <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">We have a modern and  amazing  marketing plan.
                We have  no  P V system and you don`t have a make any personal sales to earn income every month.
                Your  ID will never be blocked so you can  royalty income  from your sales  team .
                Your family  will be safe in this system. Because there is death fund for your  family and education fund for your child.
                Each of our products  repurchase & Quality Products.
                You can earn a total  nine types of income .
                You can only earn matching income of 6,51,000/= Taka per monthly.
                Rank reward will get total 2,70,00,000/= taka BD
                You can achieve all the dreams that people have in life here. Such as salary, mobile, country travel , hajj, motorcycle, car, flat.

                Make your dreams come true at AqebBD. So Start working and become successful.</p>
        </div>
        <div class="w-full lg:w-8/12">
            <img class="w-full h-full" src="{{ asset('frontend/images/about-us/about.jpeg') }}" alt="A group of People" />
        </div>
    </div>

    <div class="flex lg:flex-row flex-col justify-between gap-8 pt-12">
        <div class="w-full lg:w-5/12 flex flex-col justify-center">
            <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 dark:text-white pb-4">Our Story</h1>
            <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">A long journey begins with a single step. In the beginning the story is short. We started working with a proper idea. The road to success is never easy. We believe that hart work and proper planning will take us to the peak of success.</p>
        </div>
        <div class="w-full lg:w-8/12 lg:pt-8">
            <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 lg:gap-4 shadow-lg rounded-md">
                <div class="p-4 pb-6 flex justify-center flex-col items-center">
                    <img class="md:block hidden  w-40 h-24" src="{{ asset('frontend/images/about-us/storie1.jpeg') }}" alt="Alexa featured Image" />
                    <img class="md:hidden block" src="{{ asset('frontend/images/about-us/storie1.jpeg') }}" alt="Alexa featured Image" />
                    <p class="font-medium text-xl leading-5 text-gray-800 dark:text-white mt-4 text-center">A. P. J. Abdul Kalam</p>
                </div>
                <div class="p-4 pb-6 flex justify-center flex-col items-center">
                    <img class="md:block hidden  w-40 h-24" src="{{ asset('frontend/images/about-us/storie2.jpeg') }}" alt="Olivia featured Image" />
                    <img class="md:hidden block" src="{{ asset('frontend/images/about-us/storie2.jpeg') }}" alt="Olivia featured Image" />
                    <p class="font-medium text-xl leading-5 text-gray-800 dark:text-white mt-4 text-center">Mahatma Gandhi</p>
                </div>
                <div class="p-4 pb-6 flex justify-center flex-col items-center">
                    <img class="md:block hidden  w-40 h-24" src="{{ asset('frontend/images/about-us/storie3.jpeg') }}" alt="Liam featued Image" />
                    <img class="md:hidden block" src="{{ asset('frontend/images/about-us/storie3.jpeg') }}" alt="Liam featued Image" />
                    <p class="font-medium text-xl leading-5 text-gray-800 dark:text-white mt-4 text-center">Barack Obama</p>
                </div>
                <div class="p-4 pb-6 flex justify-center flex-col items-center">
                    <img class="md:block hidden w-40 h-24" src="{{ asset('frontend/images/about-us/storie4.jpeg') }}" alt="Elijah featured image" />
                    <img class="md:hidden block" src="{{ asset('frontend/images/about-us/storie4.jpeg') }}" alt="Elijah featured image" />
                    <p class="font-medium text-xl leading-5 text-gray-800 dark:text-white mt-4 text-center">Bill Gates</p>
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
