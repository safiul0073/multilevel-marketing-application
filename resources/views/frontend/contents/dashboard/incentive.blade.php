@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="w-full mx-auto py-2 px-1">
    <p class=" font-bold text-gray-600 text-center">Your incentive bonus</p>
    @include('frontend.layouts.partials.flash-alert')
    <div class="text-center my-4">
        <p class=" text-[200px] text-gray-600 text-center"> {{ $incentive }}</p>
    </div>
    <form class="my-2 flex justify-center items-center" method="POST" action="{{ route('incentive.add.bonus') }}">
        @csrf
        <input type="hidden" name="amount" value="{{ $incentive }}">
        <button type="submit" class="rounded-full h-[50px] w-[300px] bg-indigo-800 text-white hover:bg-indigo-600 ">Add to Your Wallat</button>
    </form>
</div>
@endsection