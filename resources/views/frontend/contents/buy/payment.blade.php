@extends('frontend.layouts.app')
@section('title', __('Ragistration'))
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')

<div class="relative overflow-hidden bg-white h-full">
    <div class="hidden lg:absolute lg:inset-0 lg:block" aria-hidden="true">
        <svg class="absolute top-0 left-1/2 translate-x-64 -translate-y-8 transform" width="640" height="784" fill="none" viewBox="0 0 640 784">
            <defs>
                <pattern id="9ebea6f4-a1f5-4d96-8c4e-4c2abf658047" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
            <rect x="118" width="404" height="784" fill="url(#9ebea6f4-a1f5-4d96-8c4e-4c2abf658047)" />
        </svg>
    </div>
    <div class="relative py-8 sm:py-12 lg:py-16">
        <main class="mx-auto max-w-7xl px-4 sm:px-6">
            <nav aria-label="Progress" class="mb-10 block">
                <ol
                    role="list"
                    class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0"
                >
                    @foreach ($steps as $stepIdx => $step )
                        <li
                        class="relative md:flex md:flex-1"
                    >
                        @if ($step["status"] === "complete")
                        <div class="group flex w-full items-center">
                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                      </svg>

                                </span>
                                <span class="ml-4 text-sm font-medium text-gray-900">
                                    {{$step["name"]}}
                                </span>
                            </span>
                        </div>
                        @else
                            @if ($step["status"] === "current")
                            <div
                                class="flex items-center px-6 py-4 text-sm font-medium"
                                aria-current="step"
                            >
                                <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-indigo-600">
                                    <span class="text-indigo-600">
                                       {{  $step["id"] }}
                                    </span>
                                </span>
                                <span class="ml-4 text-sm font-medium text-indigo-600">
                                   {{  $step["name"] }}
                                </span>
                            </div>
                            @else
                            <div class="group flex items-center">
                                <span class="flex items-center px-6 py-4 text-sm font-medium">
                                    <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300">
                                        <span class="text-gray-500">
                                           {{  $step["id"] }}
                                        </span>
                                    </span>
                                    <span class="ml-4 text-sm font-medium text-gray-500">
                                        {{ $step["name"] }}
                                    </span>
                                </span>
                            </div>
                            @endif
                        @endif

                        @if ($stepIdx !== count($steps) - 1)
                        <div
                            class="absolute top-0 right-0 hidden h-full w-5 md:block"
                            aria-hidden="true"
                        >
                            <svg
                                class="h-full w-full text-gray-300"
                                viewBox="0 0 22 80"
                                fill="none"
                                preserveAspectRatio="none"
                            >
                                <path
                                    d="M0 -2L20 40L0 82"
                                    vectorEffect="non-scaling-stroke"
                                    stroke="currentcolor"
                                    strokeLinejoin="round"
                                />
                            </svg>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ol>
            </nav>
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        {{-- error message show or success message show component --}}
                        @include('frontend.layouts.partials.flash-alert')
                        {{-- error show or success message shop composnent --}}
                        @if ($product)
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr class="">
                                    <th scope="col" class="border border-gray-300 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">SR.</th>
                                    <th scope="col" class="border border-gray-300 px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                    <th scope="col" class="border border-gray-300 px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                                    <th scope="col" class="border border-gray-300 py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="">
                                    <td class="border border-gray-300 whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                                    <td class="border border-gray-300 whitespace-nowrap p-4 text-sm text-gray-500">{{$product->name}}</td>
                                    <td class="border border-gray-300 whitespace-nowrap p-4 text-sm text-gray-500">{{$product->category->title}}</td>
                                    <td class="border border-gray-300 whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">{{$product->price}}</td>
                                </tr>
                            </tbody>
                            <tfoot class="">
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6"></td>
                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500"></td>
                                    <td class="border border-gray-300 bg-white whitespace-nowrap p-4 text-sm text-gray-900 font-bold">Total</td>
                                    <td class="border border-gray-300 bg-white whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-900 font-bold sm:pr-6">{{$product->price}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <h4 class="text-3xl text-gray-900 mb-5">Payment Method</h4>
                <div role="list" class="grid grid-cols-1 gap-x-4 gap-y-4 text-sm sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-6">
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-300 px-5 py-3 bg-gray-100">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">E-pin</h3>
                    </button>
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-200 px-5 py-3 bg-white">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Wallet</h3>
                    </button>
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-200 px-5 py-3 bg-white">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Wallet</h3>
                    </button>
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-200 px-5 py-3 bg-white">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Wallet</h3>
                    </button>
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-200 px-5 py-3 bg-white">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Wallet</h3>
                    </button>
                    <button class="rounded-2xl border flex items-center gap-5 flex-wrap border-gray-200 px-5 py-3 bg-white">
                        <svg viewBox="0 0 32 32" aria-hidden="true" class="h-8 w-8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0a4 4 0 00-4 4v24a4 4 0 004 4h14a4 4 0 004-4V4a4 4 0 00-4-4H9zm0 2a2 2 0 00-2 2v24a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2h-1.382a1 1 0 00-.894.553l-.448.894a1 1 0 01-.894.553h-6.764a1 1 0 01-.894-.553l-.448-.894A1 1 0 0010.382 2H9z" fill="#737373"></path>
                            <path d="M12 25l8-8m0 0h-6m6 0v6" stroke="#171717" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="16" cy="16" r="16" fill="#A3A3A3" fill-opacity="0.2"></circle>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Wallet</h3>
                    </button>
                </div>
                <form action="{{ route('save.user') }}" method="POST">
                    @method("post")
                    @csrf
                    <input type="hidden" name="slug" value="{{ $slug }}">
                    <input type="hidden" name="main_sponsor_username" value="{{ $main_sponsor_username }}">
                    <input type="hidden" name="sponsor_username" value="{{ $sponsor_username }}">
                    <input type="hidden" name="refer_position" value="{{ $position }}">
                    <input type="hidden" name="first_name" value="{{ $first_name }}">
                    <input type="hidden" name="last_name" value="{{ $last_name }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="phone" value="{{ $phone }}">
                    <input type="hidden" name="username" value="{{ $username }}">
                    <input type="hidden" name="password" value="{{ $password }}">
                    <div class="form-group">
                        <label for="epin_id">E-Pin Code</label>
                        <input type="text" name="epin_code" class="form-control !ring-1 !ring-indigo-600">
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="mt-3 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Continue</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

@endsection
