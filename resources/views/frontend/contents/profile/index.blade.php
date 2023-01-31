@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<div class="p-5 md:p-10 lg:p-20">
    @include('frontend.layouts.partials.flash-alert')
    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="text-3xl mb-5">Personal Information</h3>

        <div class="mt-10 w-full rounded-md bg-white px-6 py-4 leading-6 text-slate-900 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
            <div class="flex flex-col items-center py-5">

                @if (!$user->isUpdated)
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                    <!-- Photo File Input -->

                    <input type="file" name="avatar" class="opacity-0" x-ref="avatar" x-on:change="
                                            photoName = $refs.avatar.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.avatar.files[0]);
                        ">

                    <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                        Profile Photo <span class="text-red-600"> </span>
                    </label>

                    <div class="text-center">
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80" class="w-24 h-24 m-auto rounded-full shadow">
                        </div>
                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-24 h-24 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                            </span>
                        </div>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.avatar.click()">
                            Select New Photo
                        </button>
                    </div>
                    @error('avatar')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @else
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $user->image->url }}" alt="Bonnie image" />
                @endif
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">First Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'first_name',
                    'value' => $user->first_name,
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Last Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'last_name',
                    'value' => $user->last_name,
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Professinal</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'profession',
                    'value' =>$user->info ? $user->info->profession : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Gender</span>
                    <div class="w-full">
                        <select class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="gender" {{ $user->isUpdated ? "readonly" : '' }} id="gender">
                            <option value="">Select Gender</option>
                            <option {{ ($user->info ? $user->info->gender : '') == 'Male' ? "selected" : '' }} value="Male">Male</option>
                            <option {{ ($user->info ? $user->info->gender : '') == 'Female' ? "selected" : '' }} value="Female">Female</option>
                            <option {{ ($user->info ? $user->info->gender : '') == 'Other' ? "selected" : '' }} value="Other">Other</option>
                        </select>
                        @error('gender')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">NID Number</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nid_number',
                    'value' => $user->info ? $user->info->nid_number : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Father's Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'father_name',
                    'value' => $user->info ? $user->info->father_name : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Mother's Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'mother_name',
                    'value' => $user->info ? $user->info->mother_name : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Email</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'email',
                    'value' => $user->email,
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Phone Number</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'phone',
                    'value' => $user->phone,
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Address-Country, Division, District, Upazilla, Zip/Postal</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'address',
                    'value' => $user->info ? $user->info->nid_number : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Joined date:</span>
                    <h1>{{ auth()->user()->created_at->format('D m, Y | h:m a') }}</h1>
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Birthday</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'birthday',
                    'value' => $user->info ? $user->info->birthday : '',
                    'type' => 'date',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
        </div>
        <h3 class="text-3xl mb-5 mt-7">Nominee's Information</h3>
        <div class="mt-10 w-full rounded-md bg-white px-6 py-4 leading-6 text-slate-900 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
            <div class="flex flex-col items-center py-5">

                @if (!$user->isUpdated)
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                    <!-- Photo File Input -->
                    <input name="nominee_image" type="file" class="hidden" x-ref="nominee_image" x-on:change="
                                            photoName = $refs.nominee_image.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.nominee_image.files[0]);
                        ">

                    <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                        Profile Photo <span class="text-red-600"> </span>
                    </label>

                    <div class="text-center">
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80" class="w-24 h-24 m-auto rounded-full shadow">
                        </div>
                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-24 h-24 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                            </span>
                        </div>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.nominee_image.click()">
                            Select New Photo
                        </button>
                    </div>
                    @error('nominee_image')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @else
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $user->nominee->image->url }}" alt="Bonnie image" />
                @endif

            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Full Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_name',
                    'value' => $user->nominee? $user->nominee->nominee_name : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Relationship to Nominee</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'relation',
                    'value' => $user->nominee? $user->nominee->relation : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Profassional</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_profession',
                    'value' => $user->nominee? $user->nominee->nominee_profession : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Birthday</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_birthday',
                    'type' => 'date',
                    'value' => $user->nominee? $user->nominee->nominee_birthday : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Gender</span>

                    <div class="w-full">
                        <select class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="nominee_gender" {{ $user->isUpdated ? "disabled" : '' }} id="nominee_gender">
                            <option value="">Select Gender</option>
                            <option {{ ($user->nominee? $user->nominee->nominee_gender : '') == 'Male' ? "selected" : '' }} value="Male">Male</option>
                            <option {{ ($user->nominee? $user->nominee->nominee_gender : '') == 'Female' ? "selected" : '' }} value="Female">Female</option>
                            <option {{ ($user->nominee? $user->nominee->nominee_gender : '') == 'Other' ? "selected" : '' }} value="Other">Other</option>
                        </select>
                        @error('nominee_gender')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">NID Number</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_nid',
                    'value' => $user->nominee? $user->nominee->nominee_nid : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Father's Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_father',
                    'value' => $user->nominee? $user->nominee->nominee_father : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Mother's Name</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_mother',
                    'value' => $user->nominee? $user->nominee->nominee_mother : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
            <div class="flex flex-col lg:flex-row">
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
                    <span class="w-1/2 flex-none font-bold">Phone Number</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_phone',
                    'value' => $user->nominee? $user->nominee->nominee_phone : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
                <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
                    <span class="w-1/2 flex-none font-bold">Address- Country, Division, District, Upazilla, Zip/Postal</span>
                    @include('frontend.contents.profile.inputFiels',
                    [
                    'name' => 'nominee_address',
                    'value' => $user->nominee? $user->nominee->nominee_address : '',
                    'isUpdated' => (isset($user->isUpdated) && $user->isUpdated),
                    ])
                </div>
            </div>
        </div>
        @if (!$user->isUpdated)
        <button type="submit" class="btn btn-primary w-full">Save</button>
        @endif
        @if ($user->isUpdated == 2)
        <button class="btn btn-secondary w-full" disabled>Pending</button>
        @endif
    </form>
</div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.3.x/dist/index.js"></script>
@endpush

@section('custome_scipt')

@endsection