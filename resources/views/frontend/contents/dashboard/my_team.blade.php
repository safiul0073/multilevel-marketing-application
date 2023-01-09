@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<h3 class="text-3xl mb-5">Team Members</h3>
<div class="flex flex-wrap md:flex-nowrap items-center gap-3">
    <input id="username" type="search" class="w-full max-w-[250px] h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" />
    <button type="button" class=" rounded-md h-12 px-3 py-2 bg-indigo-600 whitespace-nowrap text-white text-sm">
        {{ __('Search') }}
    </button>
</div>

<div class="overflow-x-scroll overflow-y-auto grow">
    @php
        $rootUser = null;
        // for ($i; $i < count($trees); $i++) {
        //     $rootUser = $i[0];
        // }
        dd($trees[0]);
    @endphp
</div>

@endsection
