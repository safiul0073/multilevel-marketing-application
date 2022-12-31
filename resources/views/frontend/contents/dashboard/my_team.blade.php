@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<h3 class="text-3xl mb-5">Team Members</h3>
<div class="flex flex-wrap md:flex-nowrap items-center gap-3">
    <input id="username" type="search" class="w-full max-w-[250px] h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" />
    <button type="button" class=" rounded-md h-12 px-3 py-2 bg-indigo-600 whitespace-nowrap text-white text-sm">
        {{ __('Search') }}
    </button>
</div>
<img src="https://www.letscms.com/storage/pages/binary-mlm-plan.png" class="w-full" alt="">
<h3 class="text-3xl mb-5 mt-5">Sponsor List</h3>
<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">SL</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Package ID</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right">
                                <span>Joining Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay Walton</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">O2KMND</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                01/01/2021
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection