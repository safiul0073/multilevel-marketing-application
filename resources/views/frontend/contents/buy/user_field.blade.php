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
            <div class="lg:flex xl:flex justify-center items-center ">
                <div class="lg:w-1/2 xl:w-1/2 mx-auto">
                    {{-- error message show or success message show component --}}
                    @include('frontend.layouts.partials.flash-alert')
                    {{-- error show or success message shop composnent --}}
                    <form method="get" action="{{ route('check.user', $slug) }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $slug }}">
                        <input type="hidden" name="sponsor_username" value="{{ $sponsor_username }}">
                        <input type="hidden" name="main_sponsor_username" value="{{ $main_sponsor_username }}">
                        <input type="hidden" name="position" value="{{ $position }}">
                        <div class="formGroup">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control !ring-1 !ring-indigo-600 @error('first_name') has-error @enderror">
                            @error('first_name')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control !ring-1 !ring-indigo-600 @error('last_name') has-error @enderror">
                            @error('last_name')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="username">Enter username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control !ring-1 !ring-indigo-600 @error('username') has-error @enderror">
                            @error('username')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control !ring-1 !ring-indigo-600 @error('email') has-error @enderror">
                            @error('email')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control !ring-1 !ring-indigo-600 @error('phone') has-error @enderror">
                            @error('phone')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="password">Password</label>
                            <input type="text" name="password" value="{{ old('password') }}" class="form-control !ring-1 !ring-indigo-600 @error('password') has-error @enderror">
                            @error('password')
                            <span class="error-message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="text" name="password_confirmation" class="form-control !ring-1 !ring-indigo-600">
                        </div>
                        <div class="flex justify-center items-center">
                            <button type="submit" class="mt-3 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Continue</button>
                        </div>
                    </form>
                </div>
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
