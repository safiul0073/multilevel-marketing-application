@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Purchase List</h3>
</div>
<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 px-4 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                            {{-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Username</th> --}}
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Purchase At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($purchases as $purchase)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                {{ $purchase->product_name }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $purchase->category }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $purchase->amount }}
                            </td>
                            {{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $purchase->bonus_for->username }}
                            </td> --}}
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $purchase->created_at->format('d-m-Y') }}
                            </td>

                        </tr>
                        @empty

                        @endforelse


                        <!-- More people... -->
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        {{ $purchases->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
