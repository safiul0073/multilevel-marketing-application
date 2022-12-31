@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Invoices</h1>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="username" type="search" class="w-full max-w-[250px] h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" />
            <button type="button" class=" rounded-md h-12 px-3 py-2 bg-indigo-600 whitespace-nowrap text-white text-sm">
                {{ __('Search') }}
            </button>
        </div>
    </div>
</div>
<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">SR.</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Invoice No</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Invoice Date</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Print</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right">
                                <span>Status</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                1
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                IL/22-03-2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                22/03/2024
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">1020.43</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="#" class="text-indigo-600 underline">print</a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                        </tr>

                        <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection