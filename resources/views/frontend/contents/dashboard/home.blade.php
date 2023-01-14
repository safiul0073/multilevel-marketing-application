@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
<h3 class="text-3xl mb-5">Dashboard</h3>
<div class="grid gird-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-7">
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">My Wallet</h4>
            <h3 class="text-3xl">{{ $user->balance }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Total Withdraw</h4>
            <h3 class="text-3xl">{{ $user->withdraw_amount }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Package Purchase</h4>
            <h3 class="text-3xl">{{ $user->purchase_amount }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Right User</h4>
            <h3 class="text-3xl">{{ $user->right_group }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Left User</h4>
            <h3 class="text-3xl">{{ $user->left_group }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Total Referral Commission</h4>
            <h3 class="text-3xl">{{ $user->referral_bonus }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
        Total Daily Commission    <h4 class="text-lg">Total Daily Commission</h4>
            <h3 class="text-3xl">{{ $user->total_bonus }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Total Matching Commission</h4>
            <h3 class="text-3xl">{{ $user->matching_bonus }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-white p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#38BDF8"></path>
        </svg>
        <div class="flex flex-col ml-5">
            <h4 class="text-lg">Diposit Amount</h4>
            <h3 class="text-3xl">{{ $user->deposit_amount }}</h3>
        </div>
    </div>
</div>
<h3 class="text-3xl mb-5 mt-7">Account Information</h3>
<div class="mt-10 w-full rounded-md bg-white px-6 py-4 leading-6 text-slate-900 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
    <div class="flex flex-col items-center py-5">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $user->image ? $user->image->url : 'https://img.freepik.com/premium-vector/woman-portrait-generic-female-avatar-gender-placeholder-isolated-white-background_543062-417.jpg?w=2000' }}" alt="Bonnie image" />
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 pr-5">
            <span class="w-1/2 flex-none font-bold">User name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->username }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Full Name</span>
            <input readonly id="username" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->first_name . ' ' . $user->last_name }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 pr-5">
            <span class="w-1/2 flex-none font-bold">Joining Date</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->created_at->format('dd-mm-Y') }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Nominee Name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->nominee ? $user->nominee->full_name : '' }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 pr-5">
            <span class="w-1/2 flex-none font-bold">Sponsor Id</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->sponsor ? $user->sponsor->username : '' }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Sponsor Name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->sponsor ? $user->sponsor->first_name . ' ' . $user->sponsor->last_name : '' }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 pr-5">
            <span class="w-1/2 flex-none font-bold">Mobile No</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->phone }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">E-mail</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ $user->email }}" readonly autofocus />
        </div>
    </div>
    <div class="border-t border-slate-400/20 pt-3">
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="autoInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
            value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=auto" readonly autofocus />
            <button onclick="copyClickInput('auto')" id="autoClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                {{ __('Copy Link') }}
            </button>
        </div>
        @if (!$user->left_ref_id)
            <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
                <input id="leftInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700"
                       value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=left" autofocus />
                <button onclick="copyClickInput('left')" id="leftClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                    {{ __('Copy Link') }}
                </button>
            </div>
        @endif
        @if (!$user->right_ref_id)
            <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
                <input id="rightInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username"
                value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=right" autofocus />
                <button onclick="copyClickInput('right')" id="rightClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                    {{ __('Copy Link') }}
                </button>
            </div>
        @endif
    </div>
</div>
@endsection
@push('custom_scipt')
{{-- some sort js you can write here --}}
 <script>
    function copyClickInput (position) {
        var copyText = null
        var ClickButton = null
        if (position == 'auto') {
            copyText = document.getElementById("autoInput");
            ClickButton = document.getElementById("autoClickButton")
        }else if (position == 'left'){
            copyText = document.getElementById("leftInput");
            ClickButton = document.getElementById("leftClickButton")
        }else {
            copyText = document.getElementById("rightInput");
            ClickButton = document.getElementById("rightClickButton")
        }
        copyText.select();
        document.execCommand("copy");
        // Copy the text inside the text field
        // navigator.clipboard.writeText(copyText.value);
        ClickButton.classList.add('bg-blue-600')
        setTimeout(() => {
            ClickButton.classList.remove('bg-blue-600')
        }, 2000);
        // navigator.clipboard.writeText(copyText.value).then(
        //         () => {
        //             ClickButton.classList.add('bg-blue-600')
        //             setTimeout(() => {
        //                 ClickButton.classList.remove('bg-blue-600')
        //             }, 2000);
        //         },
        //         () => {
        //             console.log("failed!")
        //         }
        // );


    }
 </script>
@endpush
