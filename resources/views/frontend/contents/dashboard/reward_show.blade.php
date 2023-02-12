@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="">
    <div class="grid lg:grid-cols-4 gap-4">
        <div class="w-full h-44 relative bg-slate-600 text-white rounded-md">

            <div class="w-full h-full bg-white bg-opacity-10 backdrop-blur-xl rounded drop-shadow-lg flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h1 class="absolute top-[60px] right-[80px] -z-1">Hello</h1>
        </div>
        <div class="w-full h-44 bg-slate-600 text-white rounded-md hover:bg-slate-400">
            <div class=" w-full h-full flex justify-center items-center">
                <h1>hello</h1>
            </div>
        </div>
    </div>
</div>
@endsection
