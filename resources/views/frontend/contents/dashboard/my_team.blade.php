@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<h3 class="text-3xl mb-5">Team Members</h3>
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
        'position'  => '',
        'referrar_position' => 'auto',
        'referrar_username' => $trees[0]->username,
        ])
    </div>
</main>

@endsection
