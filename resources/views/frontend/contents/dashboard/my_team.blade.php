@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Team Members</h3>
</div>
<form method="GET" action="{{ route("my.team.view") }}">
    @csrf
    <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
        <input id="username" name="username" type="search" class="w-full max-w-[250px] h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" />
        <button type="submit" class=" rounded-md h-12 px-3 py-2 bg-indigo-600 whitespace-nowrap text-white text-sm">
            {{ __('Search') }}
        </button>
    </div>
</form>
<main class="overflow-x-auto overflow-y-auto grow p-5 pt-0 flex flex-col">
    <div class="mx-auto">
        @include('frontend.contents.dashboard.tree_node', [
        'node' => $trees[0],
        'this_parent' => true,
        'position' => '',
        'referrar_position' => 'auto',
        'referrar_username' => $trees[0]->username,
        ])
    </div>
</main>

@endsection