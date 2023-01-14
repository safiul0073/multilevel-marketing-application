@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Referral List</h1>
    </div>
    {{-- <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="username" type="search" class="w-full max-w-[250px] h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" />
            <button type="button" class=" rounded-md h-12 px-3 py-2 bg-indigo-600 whitespace-nowrap text-white text-sm">
                {{ __('Search') }}
            </button>
        </div>
    </div> --}}
</div>
<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Full Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Username</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Joined At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($referrals as $referral)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                {{ $referral->bonus_for->first_name . ' ' . $referral->bonus_for->last_name }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $referral->bonus_for->email }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $referral->bonus_for->phone }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $referral->bonus_for->username }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $referral->bonus_for->created_at->format('D-M-Y') }}
                            </td>

                        </tr>
                        @empty

                        @endforelse


                        <!-- More people... -->
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        {{ $referrals->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
