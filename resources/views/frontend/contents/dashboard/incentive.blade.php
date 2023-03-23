@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Incentive</h3>
</div>
<div class="w-full mx-auto py-2 px-1">
    <p class=" font-bold text-gray-600 text-center">Your incentive bonus</p>
    @include('frontend.layouts.partials.flash-alert')
    <div class="text-center my-4">
        <p class="text-[80px] md:text-[200px] text-gray-600 text-center"> {{ $incentive }}</p>
    </div>
    <form class="my-2 flex justify-center items-center" method="POST" action="{{ route('incentive.add.bonus') }}">
        @csrf
        <input type="hidden" name="amount" value="{{ $incentive }}">
        <button type="submit" class="rounded-full h-[50px] w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Add to Your Wallat</button>
    </form>
</div>
@endsection
