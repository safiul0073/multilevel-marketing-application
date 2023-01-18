@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
    <div class="sm:w-full w-1/2 mx-auto py-2 px-1">
        <p class=" font-bold text-gray-600 text-center">Your incentive bonus</p>
        <div class="text-center my-4">
            <p class=" text-[200px] text-gray-600 text-center"> {{ $incentive }}</p>
        </div>

        <div class="my-2 flex justify-center items-center">
            <button class="rounded-full h-[50px] w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Add to Your Wallat</button>
        </div>
    </div>
@endsection
