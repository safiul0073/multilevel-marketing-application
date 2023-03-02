@extends('frontend.layouts.app')
@section('title', __('News'))
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20">
    <div class="container mx-auto">
        <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
            <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                <article class="mx-auto w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format">
                        <figure class="flex justify-center items-center">
                            <img src="{{ $news->image->url }}" class="rounded-md" height="400" width="600" alt="">
                        </figure>
                        <h1 class="mb-2 mt-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $news->title }}</h1>
                        <p>{{ $news->created_at->format('M d, Y') }}</p>
                    </header>

                    <div>
                        {!! $news->content !!}
                    </div>
                </article>
            </div>
          </main>
    </div>
</section>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
