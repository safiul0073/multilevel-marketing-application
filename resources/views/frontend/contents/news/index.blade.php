@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')<section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20">
    <div class="container mx-auto">
        <div class="-mx-4 flex flex-wrap justify-center">
            <div class="w-full px-4">
                <div class="mx-auto mb-[60px] max-w-[510px] text-center lg:mb-20">
                    <span class="text-indigo-600 mb-2 block text-lg font-semibold">
                        Our Blogs
                    </span>
                    <h2 class="text-dark mb-4 text-3xl font-bold sm:text-4xl md:text-[40px]">
                        Our Recent News
                    </h2>
                    {{-- <p class="text-body-color text-base">
                        There are many variations of passages of Lorem Ipsum available but
                        the majority have suffered alteration in some form.
                    </p> --}}
                </div>
            </div>
        </div>
        <div class="-mx-4 flex flex-wrap">
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="mx-auto mb-10 max-w-[370px]">
                    <div class="mb-8 overflow-hidden rounded">
                        <img src="{{ asset('frontend/images/rank.jpeg') }}" alt="image" class="w-full h-64" />
                    </div>
                    <div>
                        <span class="bg-indigo-600 mb-5 inline-block rounded py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                            Fab 23, 2023
                        </span>
                        <h3>
                            <a href="javascript:void(0)" class="text-dark hover:text-indigo-600 mb-4 inline-block text-xl font-semibold sm:text-2xl lg:text-xl xl:text-2xl">
                                First Rank
                            </a>
                        </h3>
                        <p class="text-body-color text-base">
                            Additional reward will be given to the person who achieves first rank in the company.
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="mx-auto mb-10 max-w-[370px]">
                    <div class="mb-8 overflow-hidden rounded">
                        <img src="{{ asset('frontend/images/good.jpeg') }}" alt="image" class="w-full h-64" />
                    </div>
                    <div>
                        <span class="bg-indigo-600 mb-5 inline-block rounded py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                            Fab 23, 2023
                        </span>
                        <h3>
                            <a href="javascript:void(0)" class="text-dark hover:text-indigo-600 mb-4 inline-block text-xl font-semibold sm:text-2xl lg:text-xl xl:text-2xl">
                                Good Income
                            </a>
                        </h3>
                        <p class="text-body-color text-base">
                            Many unemployed in Bangladesh. To play a strong role in eliminating unemployment in Bangladesh. We want to provide 10,000 people with good income by 2023.
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="mx-auto mb-10 max-w-[370px]">
                    <div class="mb-8 overflow-hidden rounded">
                        <img src="{{ asset('frontend/images/leader.jpeg') }}" alt="image" class="w-full h-64" />
                    </div>
                    <div>
                        <span class="bg-indigo-600 mb-5 inline-block rounded py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                            Fab 23, 2023
                        </span>
                        <h3>
                            <a href="javascript:void(0)" class="text-dark hover:text-indigo-600 mb-4 inline-block text-xl font-semibold sm:text-2xl lg:text-xl xl:text-2xl">
                                Leaders Forum
                            </a>
                        </h3>
                        <p class="text-body-color text-base">
                            A Leaders Forum will be formed with those who can do good business at the start of the company. Members of the Leaders Forum will be paid additional income.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
