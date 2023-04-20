@extends('frontend.contents.dashboard.index')

@section('dashboard-page')
@php
    $currency_symbol = config('mlm.currency.icon');
@endphp
<div class="flex items-center mb-5">
    <button type="button" class="rounded-md px-2.5 py-1.5 mr-2.5 text-gray-700 xl:hidden border border-gray-500" id="dashboard-hamburger-toggler">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <h3 class="text-3xl">Dashboard</h3>
</div>
<div class="grid gird-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-7">
    <div class="flex w-full items-center rounded-md bg-green-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <svg class="h-16 w-16 flex-none text-gray-100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0"  viewBox=" 0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
            <g>
                <path xmlns="http://www.w3.org/2000/svg" d="m482 245.242v-60.363c0-29.656-23.597-53.891-53-54.949v-37.051c0-19.299-15.701-35-35-35h-96.358l-12.443-34.587c-3.173-8.82-9.595-15.868-18.083-19.845-8.488-3.978-18.014-4.402-26.821-1.196l-174.855 63.641c-8.798 3.202-15.817 9.641-19.765 18.131s-4.349 18.007-1.128 26.799l7.025 19.175c-28.735 1.777-51.572 25.707-51.572 54.882v272c0 30.327 24.673 55 55 55h372c30.327 0 55-24.673 55-55v-62.363c16.938-2.434 30-17.036 30-34.637v-80c0-17.601-13.062-32.203-30-34.637zm0 114.637c0 2.757-2.243 5-5 5h-80c-24.813 0-45-20.187-45-45s20.187-45 45-45h80c2.757 0 5 2.243 5 5zm-409.284-259.377c-.621-1.695-.166-3.126.161-3.829.327-.702 1.128-1.973 2.824-2.59l174.854-63.641c1.698-.617 3.129-.158 3.832.171s1.972 1.135 2.583 2.835l8.79 24.432h-6.76c-19.299 0-35 15.701-35 35v37h-140.521zm326.284-7.623v37h-145v-37c0-2.757 2.243-5 5-5h135c2.757 0 5 2.243 5 5zm28 389h-372c-13.785 0-25-11.215-25-25v-272c0-13.785 11.215-25 25-25h372c13.785 0 25 11.215 25 25v60h-55c-41.355 0-75 33.645-75 75s33.645 75 75 75h55v62c0 13.785-11.215 25-25 25z" fill="currentColor" data-original="currentColor"></path>
                <circle xmlns="http://www.w3.org/2000/svg" cx="397" cy="319.879" r="15" fill="currentColor" data-original="currentColor"></circle>
            </g>
        </svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">My Wallet</h4>
            <h3 class="text-3xl">{{ $user->balance }}{{ $user->balance ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex  w-full items-center rounded-md bg-red-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        <span class="text-white">
            <svg class="h-16 w-16 flex-none" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve">
                <g>
                    <title xmlns="http://www.w3.org/2000/svg">payout</title>
                    <g xmlns="http://www.w3.org/2000/svg" id="payout">
                        <path d="M55,4H9A5,5,0,0,0,4,9v8a5,5,0,0,0,5,5v8a5,5,0,0,0,5,5h2v9a7.94,7.94,0,0,0,3.7,6.74C17.55,52.26,18,54.35,18,58a4,4,0,0,0,4,4H41a4,4,0,0,0,4-4c0-3.51.45-5.74-1.7-7.26A8,8,0,0,0,47,44V35h3a5,5,0,0,0,5-5V22a5,5,0,0,0,5-5V9A5,5,0,0,0,55,4ZM11,30V14h5.23A3,3,0,0,1,14,15a1,1,0,0,0-1,1V26a1,1,0,0,0,1,1,3,3,0,0,1,3,3,1,1,0,0,0,1,1H37v2H14A3,3,0,0,1,11,30ZM36,19.5c0,3-1.79,5.5-4,5.5s-4-2.47-4-5.5S29.79,14,32,14,36,16.47,36,19.5ZM32,27c5.45,0,8.07-8.37,4.07-13h9.35A5,5,0,0,0,49,16.9v8.2a5.46,5.46,0,0,0-1.24.44c-1.46.73-.23.79-1.22-1.45A5,5,0,0,0,37,26v3H18.9A5,5,0,0,0,15,25.1V16.9A5,5,0,0,0,18.58,14h9.35C24,18.6,26.53,27,32,27Zm9,25a2,2,0,0,1,2,2v4a2,2,0,0,1-2,2H22a2,2,0,0,1-2-2V54a2,2,0,0,1,2-2Zm4-8a6,6,0,0,1-6,6H24a6,6,0,0,1-6-6V35H31.69A10.94,10.94,0,0,0,27,44a1,1,0,0,0,2,0,9,9,0,0,1,9-9,1,1,0,0,0,1-1c0-8.18-.31-8.91.87-10.12A2.88,2.88,0,0,1,44,23.82C45.31,25.1,45,24.57,45,44Zm8-14a3,3,0,0,1-3,3H47V30a3,3,0,0,1,3-3,1,1,0,0,0,1-1V16a1,1,0,0,0-1-1,3.09,3.09,0,0,1-2.22-1c-.09-.1,0,0,5.22,0Zm5-13a3,3,0,0,1-3,3V14a1,1,0,0,0,0-2H9a1,1,0,0,0,0,2v6a3,3,0,0,1-3-3V9A3,3,0,0,1,9,6H55a3,3,0,0,1,3,3Z" fill="currentColor" class=""></path>
                    </g>
                </g>
            </svg>
        </span>

        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Withdraw</h4>
            <h3 class="text-3xl">{{ $user->withdraw_amount }}{{ $user->withdraw_amount ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-orange-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <span class="text-white">
            <svg class="h-16 w-16 flex-none" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g><path d="M155.999 370.002c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10z" fill="#000000" data-original="#000000" class=""></path><path d="m450.143 190.001 58.929-58.929a10 10 0 0 0-4.122-16.626l-143.5-44.29C348.514 28.575 310.066.002 265.999.002c-40.964 0-77.6 24.965-92.763 62.625L7.022 114.455a10 10 0 0 0-4.094 16.618l60.479 60.479-38.144 63.575a10.001 10.001 0 0 0 5.413 14.632l55.323 18.44v153.802a10 10 0 0 0 6.489 9.363c33.827 12.684 159.512 59.822 160.187 60.061a9.962 9.962 0 0 0 6.398.089c.029-.01.059-.016.088-.026l180-60a10.001 10.001 0 0 0 6.838-9.487v-157.92l58.998-18.54a10 10 0 0 0 4.074-16.611l-58.928-58.929zm-84.144-89.999c0-2.541-.107-5.076-.298-7.603l117.494 36.265-49.897 49.896-81.528-27.173c9.232-15.431 14.229-33.237 14.229-51.385zM190.326 73.974c11.101-32.282 41.512-53.972 75.673-53.972 36.801 0 68.719 24.892 77.618 60.532a80.446 80.446 0 0 1 2.382 19.468c0 18.574-6.164 35.983-17.828 50.352-15.277 18.842-37.938 29.648-62.172 29.648-26.196 0-50.767-12.858-65.733-34.404-9.333-13.406-14.267-29.174-14.267-45.596 0-8.931 1.455-17.688 4.327-26.028zM28.764 128.625l138.3-43.124a100.825 100.825 0 0 0-1.065 14.5c0 16.101 3.814 31.696 11.084 45.767L78.7 178.56l-49.936-49.935zm20.063 126.102 31.62-52.702 160.563 53.521-31.619 52.702-160.564-53.521zm197.172 232.845-140-52.5V294.866c110.15 36.522 104.771 35.407 107.838 35.407 3.438 0 6.73-1.779 8.577-4.856l23.585-39.311v201.466zm10-248.111-148.376-49.458 80.794-26.93c18.91 23.247 47.377 36.929 77.582 36.929 27.942 0 54.203-11.499 73.092-31.759l65.284 21.759-148.376 49.459zm170 195.333-160 53.333v-209.62l35.451 44.31a10.002 10.002 0 0 0 10.807 3.293l113.742-35.743v144.427zM312.791 304.979l-40.024-50.026 160.531-53.51 49.964 49.964-170.471 53.572z" fill="currentColor" ></path><path d="m219.511 392.198-22.24-8.34c-5.171-1.938-10.935.681-12.875 5.852-1.939 5.172.681 10.936 5.852 12.875l22.24 8.34c5.182 1.942 10.939-.69 12.875-5.852 1.939-5.171-.681-10.936-5.852-12.875zM219.51 434.918l-60-22.5c-5.171-1.939-10.935.681-12.875 5.852-1.94 5.171.681 10.936 5.852 12.875l60 22.5a9.975 9.975 0 0 0 3.51.64c4.049 0 7.859-2.477 9.365-6.492 1.94-5.172-.68-10.936-5.852-12.875zM323.071 62.93c-3.905-3.906-10.237-3.905-14.143 0l-52.929 52.93-12.929-12.929c-3.905-3.905-10.237-3.905-14.143 0-3.906 3.905-3.905 10.237 0 14.143l20.001 19.999c3.905 3.905 10.237 3.905 14.143 0l60-60c3.905-3.905 3.905-10.237 0-14.143z" fill="currentColor" ></path></g>
            </svg>
        </span>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Package Purchase</h4>
            <h3 class="text-3xl">{{ $user->purchase_amount }}{{ $user->purchase_amount ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-amber-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-gray-100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" class="w-50px h-50px" "="" viewBox=" 0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve">
            <g>
                <path xmlns="http://www.w3.org/2000/svg" d="m3.5 7a5.5 5.5 0 1 0 5.5-5.5 5.507 5.507 0 0 0 -5.5 5.5zm5.5-4.5a4.5 4.5 0 1 1 -4.5 4.5 4.505 4.505 0 0 1 4.5-4.5zm-7.5 19.5v-2a4.505 4.505 0 0 1 4.5-4.5h6a4.505 4.505 0 0 1 4.5 4.5v2a.5.5 0 0 1 -1 0v-2a3.5 3.5 0 0 0 -3.5-3.5h-6a3.5 3.5 0 0 0 -3.5 3.5v2a.5.5 0 0 1 -1 0zm20.854-10.354a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1 -.708-.708l2.147-2.146h-4.793a.5.5 0 0 1 0-1h4.793l-2.147-2.146a.5.5 0 0 1 .708-.708z" fill="currentColor" data-original="currentColor"></path>
            </g>
        </svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Right User</h4>
            <h3 class="text-3xl">{{ $user->right_group }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-lime-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-gray-100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" class="w-50px h-50px" "="" viewBox=" 0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve">
            <g>
                <path xmlns="http://www.w3.org/2000/svg" d="m3.5 7a5.5 5.5 0 1 0 5.5-5.5 5.506 5.506 0 0 0 -5.5 5.5zm10 0a4.5 4.5 0 1 1 -4.5-4.5 4.505 4.505 0 0 1 4.5 4.5zm-11 13v2a.5.5 0 0 1 -1 0v-2a4.505 4.505 0 0 1 4.5-4.5h6a4.505 4.505 0 0 1 4.5 4.5v2a.5.5 0 0 1 -1 0v-2a3.5 3.5 0 0 0 -3.5-3.5h-6a3.5 3.5 0 0 0 -3.5 3.5zm20-8a.5.5 0 0 1 -.5.5h-4.793l2.147 2.146a.5.5 0 0 1 -.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708.708l-2.147 2.146h4.793a.5.5 0 0 1 .5.5z" fill="currentColor" data-original="currentColor"></path>
            </g>
        </svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Left User</h4>
            <h3 class="text-3xl">{{ $user->left_group }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-teal-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 60 60" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M53.291 45.13c2.016-1.11 3.383-3.215 3.383-5.63 0-3.564-2.974-6.464-6.629-6.464-3.656 0-6.63 2.899-6.63 6.464 0 2.414 1.367 4.52 3.383 5.63-3.898 1.35-6.71 5.049-6.71 9.402V59a1 1 0 0 0 1 1H59a1 1 0 0 0 1-1v-4.469c0-4.352-2.811-8.051-6.709-9.401zm-7.877-5.63c0-2.461 2.077-4.464 4.63-4.464s4.629 2.003 4.629 4.464-2.077 4.464-4.629 4.464-4.63-2.003-4.63-4.464zM58 58H42.087v-3.469c0-4.387 3.569-7.956 7.957-7.956S58 50.145 58 54.531zM53.294 12.092c2.014-1.11 3.379-3.215 3.379-5.628C56.673 2.9 53.699 0 50.044 0c-3.656 0-6.63 2.9-6.63 6.464 0 2.413 1.365 4.518 3.38 5.628-3.897 1.352-6.706 5.05-6.706 9.4v4.469a1 1 0 0 0 1 1H59a1 1 0 0 0 1-1v-4.469c0-4.35-2.809-8.049-6.706-9.4zm-7.88-5.628c0-2.461 2.077-4.464 4.63-4.464s4.629 2.002 4.629 4.464-2.077 4.464-4.629 4.464-4.63-2.003-4.63-4.464zM58 24.961H42.087v-3.469c0-4.387 3.569-7.956 7.957-7.956S58 17.105 58 21.492zM32.241 29.558l5.624-4.847a1 1 0 1 0-1.306-1.514l-6.244 5.381h-7.036a1 1 0 0 0 0 2h7.05l6.249 5.123c.484.362 1.13.151 1.407-.14.381-.399.288-1.057-.14-1.407zM17.545 27.16a7.556 7.556 0 0 0 1.862-4.963c0-4.213-3.462-7.641-7.718-7.641S3.97 17.984 3.97 22.197c0 1.895.704 3.627 1.862 4.963C2.292 29.072 0 32.772 0 36.792v5.882a1 1 0 0 0 1 1h21.376a1 1 0 0 0 1-1v-5.882c0-4.02-2.292-7.72-5.831-9.632zm-5.857-10.604c3.153 0 5.718 2.53 5.718 5.641s-2.565 5.641-5.718 5.641-5.719-2.53-5.719-5.641 2.566-5.641 5.719-5.641zm-1.079 13.197c.354.049.712.084 1.079.084s.725-.034 1.079-.084v4.677l-1.079 1.381-1.079-1.381zm10.767 11.921h-3.144v-4.901c0-1.287-2-1.289-2 0v4.901H7.144v-4.901c0-1.287-2-1.289-2 0v4.901H2v-4.882c0-3.539 2.193-6.758 5.488-8.194.355.229.729.431 1.122.601v5.922l2.291 2.931a1 1 0 0 0 1.575 0l2.291-2.932v-5.921c.392-.17.767-.372 1.122-.601 3.294 1.436 5.488 4.656 5.488 8.194v4.882z" fill="currentColor"></path></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Referral Commission</h4>
            <h3 class="text-3xl">{{ $user->referral_bonus }}{{ $user->referral_bonus ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-violet-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M251.879 212.793c0-27.602-24.102-42.64-48-42.64-23.48 0-46.555 14.421-46.555 39.55 0 12.98 6.184 16.688 14.422 16.688 10.504 0 16.89-5.77 16.89-11.743 0-11.332 7.212-15.449 15.45-15.449 11.535 0 15.656 8.035 15.656 14.625 0 26.16-64.887 44.7-64.887 77.043v19.98c0 5.973 8.239 9.887 14.008 9.887h73.332c5.149 0 9.684-6.796 9.684-14.21 0-7.419-4.535-13.805-9.684-13.805h-53.968v-1.852c0-18.746 63.652-33.37 63.652-78.074zm0 0" fill="currentColor"></path><path d="M327.066 320.734c8.036 0 16.067-3.296 16.067-9.886v-21.836h8.86c4.94 0 9.886-7.414 9.886-14.832 0-7.414-3.293-14.832-9.887-14.832h-8.86V244.93c0-6.797-8.03-9.684-16.066-9.684-8.03 0-16.066 2.887-16.066 9.684v14.418h-17.715l36.461-73.125c.617-1.446 1.027-2.68 1.027-3.914 0-7.418-10.503-12.157-16.062-12.157-5.152 0-10.305 2.266-13.395 8.243l-47.582 93.312c-4.05 7.426-.609 17.305 9.063 17.305H311v21.836c0 6.59 8.035 9.886 16.066 9.886zm0 0" fill="currentColor"></path><path d="M492 236c-11.047 0-20 8.953-20 20 0 119.379-96.605 216-216 216-119.379 0-216-96.605-216-216 0-119.379 96.605-216 216-216 43.79 0 84.785 12.96 119.46 36h-21.976c-11.046 0-20 8.953-20 20s8.954 20 20 20h76c11.043 0 20-9.094 20-20V20c0-11.047-8.957-20-20-20-11.046 0-20 8.953-20 20v31.07C367.184 19.328 314.016 0 256 0 114.516 0 0 114.496 0 256c0 141.484 114.496 256 256 256 141.484 0 256-114.496 256-256 0-11.047-8.953-20-20-20zm0 0" fill="currentColor"></path></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Daily Commission</h4>
            <h3 class="text-3xl">{{ $user->total_bonus }}{{ $user->total_bonus ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-purple-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M58 31h-1.206a4.5 4.5 0 1 0-5.588 0h-1.97L45.5 29.134l-.271-.181A.986.986 0 0 0 46 28V14a1 1 0 0 0-1-1H19a1 1 0 0 0-1 1v14a.986.986 0 0 0 .768.953l-.271.181L14.764 31h-1.97a4.5 4.5 0 1 0-5.588 0H6a4 4 0 0 0-4 4v11a1 1 0 0 0 1 1h2v13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V36.728l5.461-2.84a1.051 1.051 0 0 0 .12-.075L27.32 29h9.36l6.739 4.813a1.051 1.051 0 0 0 .12.075L49 36.728V60a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V47h2a1 1 0 0 0 1-1V35a4 4 0 0 0-4-4zm-4-6a2.5 2.5 0 1 1-2.5 2.5A2.5 2.5 0 0 1 54 25zm-44 0a2.5 2.5 0 1 1-2.5 2.5A2.5 2.5 0 0 1 10 25zm9.476 7.146-5.937 3.086a1 1 0 0 0-.539.888V59h-2V45H9v14H7V36H5v9H4V35a2 2 0 0 1 2-2h9a1 1 0 0 0 .447-.1l4-2a1.168 1.168 0 0 0 .108-.063L22.3 29h1.58zM31 23v4H20V15h11v4a1 1 0 0 0 1 1h2a.975.975 0 0 1 .712.307A.952.952 0 0 1 35 21a1 1 0 0 1-1 1h-2a1 1 0 0 0-1 1zm2 4v-3h1a3 3 0 0 0 3-3 3.017 3.017 0 0 0-3-3h-1v-3h11v12zm27 18h-1v-9h-2v23h-2V45h-2v14h-2V36.12a1 1 0 0 0-.539-.888l-5.937-3.086L40.12 29h1.58l2.748 1.832a1.168 1.168 0 0 0 .108.063l4 2A1 1 0 0 0 49 33h9a2 2 0 0 1 2 2zM31 3h2v4h-2zM36.238 8.346l2.828-2.828 1.414 1.414-2.828 2.828zM23.512 6.933l1.414-1.414 2.828 2.828-1.414 1.414z" fill="currentColor"></path></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Matching Commission</h4>
            <h3 class="text-3xl">{{ $user->matching_bonus }}{{ $user->matching_bonus ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-fuchsia-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16 flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 61 60" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="currentColor" fill-rule="nonzero" d="M35.87 31.211c2.689-1.726 5.72-3.291 8.932-4.948a706.78 706.78 0 0 0 1.914-.993 9.012 9.012 0 1 0-3.55-5.567C39.528 22.32 36.356 24 35 24a.213.213 0 0 1-.198-.1c-.609-.74-.597-3.482 0-6.754a9 9 0 1 0-7.603 0c.596 3.272.608 6.015 0 6.755A.213.213 0 0 1 27 24c-1.356 0-4.528-1.68-8.167-4.297a9.036 9.036 0 1 0-3.55 5.567l1.915.993c3.211 1.657 6.243 3.222 8.932 4.948.476.28.904.635 1.267 1.052.409.477.462 1.163.131 1.697-.284.401-.73.656-1.22.697-2.112.256-4.575-.601-6.737-1.503a8.995 8.995 0 1 0 1.191 6.867C26.77 40.234 26.994 42.904 27 43v7.995A2.853 2.853 0 0 1 24 54c-2.84.047-5.29 2-5.97 4.757a1 1 0 0 0 1.186 1.22c3.319-.738 9.301-1.43 11.229-.145h.002c.006.005.013.006.02.01.093.058.196.1.303.125a.937.937 0 0 0 .096.014c.044.01.088.016.133.019.05-.002.099-.008.147-.018.02-.003.039-.003.058-.007a.992.992 0 0 0 .32-.13c.01-.006.021-.007.03-.013 1.926-1.284 7.91-.592 11.229.144.07.015.14.023.212.023l.004.001h.007a.98.98 0 0 0 .236-.03c.015-.003.024-.014.038-.018a.986.986 0 0 0 .257-.122c.023-.015.051-.023.073-.04a.995.995 0 0 0 .24-.267c.016-.027.022-.058.036-.086a.976.976 0 0 0 .09-.22c.002-.01-.001-.02 0-.032a3.067 3.067 0 0 0-.005-.397c-.002-.01 0-.02-.002-.03A6.255 6.255 0 0 0 38 54a2.852 2.852 0 0 1-3-3v-7.977c.006-.118.23-2.789 6.237-3.002a9.007 9.007 0 1 0 1.191-6.867c-2.162.901-4.629 1.759-6.741 1.503a1.662 1.662 0 0 1-1.216-.699 1.442 1.442 0 0 1 .135-1.699c.362-.415.789-.769 1.264-1.048Zm11.466-8.006a4.972 4.972 0 0 1 2.643-2.773 3.88 3.88 0 0 0 4.042 0 4.972 4.972 0 0 1 2.643 2.773 6.957 6.957 0 0 1-9.328 0ZM52 19a2 2 0 1 1 0-4 2 2 0 0 1 0 4Zm0-8a6.987 6.987 0 0 1 6.054 10.497 6.943 6.943 0 0 0-2.576-2.56A3.95 3.95 0 0 0 56 17a4 4 0 1 0-8 0 3.95 3.95 0 0 0 .522 1.936 6.943 6.943 0 0 0-2.576 2.561A6.987 6.987 0 0 1 52 11Zm-25.664 3.205a4.972 4.972 0 0 1 2.643-2.773 3.88 3.88 0 0 0 4.042 0 4.972 4.972 0 0 1 2.643 2.773 6.957 6.957 0 0 1-9.328 0ZM31 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Zm0-8a6.987 6.987 0 0 1 6.054 10.497 6.943 6.943 0 0 0-2.576-2.56A3.95 3.95 0 0 0 35 8a4 4 0 1 0-8 0 3.95 3.95 0 0 0 .522 1.937 6.943 6.943 0 0 0-2.576 2.56A6.987 6.987 0 0 1 31 2Zm-21 9a6.987 6.987 0 0 1 6.054 10.497 6.943 6.943 0 0 0-2.576-2.56A3.95 3.95 0 0 0 14 17a4 4 0 1 0-8 0 3.95 3.95 0 0 0 .522 1.936 6.943 6.943 0 0 0-2.576 2.561A6.987 6.987 0 0 1 10 11Zm-2 6a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm-2.664 6.205a4.972 4.972 0 0 1 2.643-2.773 3.88 3.88 0 0 0 4.042 0 4.972 4.972 0 0 1 2.643 2.773 6.957 6.957 0 0 1-9.328 0ZM12 31a6.987 6.987 0 0 1 6.054 10.497 6.943 6.943 0 0 0-2.576-2.56A3.95 3.95 0 0 0 16 37a4 4 0 1 0-8 0 3.95 3.95 0 0 0 .522 1.937 6.943 6.943 0 0 0-2.576 2.56A6.987 6.987 0 0 1 12 31Zm-2 6a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm-2.664 6.205a4.972 4.972 0 0 1 2.643-2.773 3.88 3.88 0 0 0 4.042 0 4.972 4.972 0 0 1 2.643 2.773 6.957 6.957 0 0 1-9.328 0Zm38 0a4.972 4.972 0 0 1 2.643-2.773 3.88 3.88 0 0 0 4.042 0 4.972 4.972 0 0 1 2.643 2.773 6.957 6.957 0 0 1-9.328 0ZM50 39a2 2 0 1 1 0-4 2 2 0 0 1 0 4Zm0-8a6.987 6.987 0 0 1 6.054 10.497 6.943 6.943 0 0 0-2.576-2.56A3.95 3.95 0 0 0 54 37a4 4 0 1 0-8 0 3.95 3.95 0 0 0 .522 1.937 6.943 6.943 0 0 0-2.576 2.56A6.987 6.987 0 0 1 50 31Zm-17.212 4.04a3.622 3.622 0 0 0 2.661 1.603c.341.04.684.06 1.028.06a14.85 14.85 0 0 0 4.824-.971A8.959 8.959 0 0 0 41 38l.002.034C33.118 38.387 33 42.804 33 43v8a4.82 4.82 0 0 0 5 5 3.866 3.866 0 0 1 3.233 1.644c-2.763-.464-7.602-1.01-10.226.22-2.624-1.235-7.48-.683-10.243-.22A3.871 3.871 0 0 1 24 56a4.82 4.82 0 0 0 5-5v-8c0-.196-.118-4.613-8.002-4.966L21 38a8.959 8.959 0 0 0-.3-2.267c1.541.59 3.171.917 4.822.97.342.001.684-.019 1.024-.06a3.624 3.624 0 0 0 2.665-1.601 3.413 3.413 0 0 0-.246-4.021 6.934 6.934 0 0 0-1.755-1.492c-2.768-1.777-5.84-3.364-9.095-5.044l-1.269-.657a9.015 9.015 0 0 0 1.345-2.12C20.85 23.582 24.723 26 27 26a2.193 2.193 0 0 0 1.744-.83c1.198-1.458.996-4.768.605-7.329a8.675 8.675 0 0 0 3.302 0c-.39 2.561-.593 5.871.605 7.329A2.193 2.193 0 0 0 35 26c2.277 0 6.15-2.419 8.809-4.292.347.766.8 1.48 1.345 2.12l-1.27.657c-3.253 1.68-6.326 3.267-9.094 5.044a6.926 6.926 0 0 0-1.752 1.489 3.413 3.413 0 0 0-.25 4.022Z"></path></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Generation Commission</h4>
            <h3 class="text-3xl">{{ $user->gen_bonus }}{{ $user->gen_bonus ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-pink-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16  flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M23 33h18v2H23zM39 37h2v2h-2zM27 37h10v2H27zM23 37h2v2h-2zM23 31h18V13H23zm6-9c0-1.654 1.346-3 3-3s3 1.346 3 3-1.346 3-3 3-3-1.346-3-3zm-1.216 7c1.025-1.25 2.549-2 4.216-2s3.191.75 4.216 2zM25 15h14v14h-.394a7.426 7.426 0 0 0-3.344-3.242C36.318 24.84 37 23.505 37 22c0-2.757-2.243-5-5-5s-5 2.243-5 5c0 1.505.682 2.84 1.737 3.758A7.424 7.424 0 0 0 25.394 29H25z" fill="currentColor" data-original="#000000" class=""></path><circle cx="44" cy="45" r="1" fill="currentColor"></circle><circle cx="48" cy="51" r="1" fill="currentColor" data-original="#000000" class=""></circle><circle cx="51" cy="47" r="1" fill="currentColor"></circle><path d="M61 49h-2.094c.055-.328.094-.66.094-1 0-2.578-1.66-4.85-4.045-5.672-.182-1.35-.917-2.516-1.955-3.302V22c0-11.579-9.42-21-21-21s-21 9.421-21 21v27H3c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h8v1.095l2.566-.233 1.871 5.612 6.508-3.719.208 1.245H23a7.485 7.485 0 0 0 2.913-.593 41.43 41.43 0 0 0 25.809.998l3.083-.881-.486-.547a6.027 6.027 0 0 0 2.324-2.978H61c1.103 0 2-.897 2-2v-4A2.002 2.002 0 0 0 61 49zM13 22c0-10.477 8.523-19 19-19s19 8.523 19 19v16.107A4.996 4.996 0 0 0 50 38c-.342 0-.675.043-1 .109V22c0-9.374-7.626-17-17-17s-17 7.626-17 17v27h-2zm27.875 17.693-1.162.349c-6.232 1.869-11.997 5.204-16.752 9.643L21.618 47H21a5.97 5.97 0 0 0-4 1.54V22c0-8.271 6.729-15 15-15s15 6.729 15 15v17.005a4.977 4.977 0 0 0-1.195 1.287c-1.636-.538-3.385-.292-4.816.539zM17.087 52.167a4.013 4.013 0 0 1 3.317-3.123l.788 1.577a2.986 2.986 0 0 0-1.158 2.037zM23 54a1.001 1.001 0 0 1 0-2 1.001 1.001 0 0 1 0 2zM3 55v-4h12.35a5.969 5.969 0 0 0-.26 1H14c-1.654 0-3 1.346-3 3zm10 0c0-.552.449-1 1-1h1.919l4.679.78c.107.144.224.279.355.401L13 55.905zm3.563 5.526-.95-2.851 5.897-.536.085.512zm6.778-4.56a2.98 2.98 0 0 0 1.935-1.034l2.4 1.44a5.429 5.429 0 0 1-3.839 2.564zM40.335 61a39.29 39.29 0 0 1-12.298-1.968 7.482 7.482 0 0 0 1.646-2.163l.625-1.25-4.312-2.587c.001-.011.004-.021.004-.032 0-.952-.454-1.792-1.147-2.341a40.597 40.597 0 0 1 14.275-8.333l.693 6.927a40.114 40.114 0 0 0-6.261-2.144l-.318-.079-.483 1.941.317.078A37.84 37.84 0 0 1 51.16 59.485 39.417 39.417 0 0 1 40.335 61zm14.478-9.458-.952.489.552.916c.39.647.587 1.338.587 2.053a4.02 4.02 0 0 1-2.056 3.497c-3.198-3.396-6.907-6.195-11.016-8.273l-.708-7.081c1.18-1.146 2.987-1.512 4.597-.682l.991.51.4-1.041A2.976 2.976 0 0 1 50 40a3.004 3.004 0 0 1 3 2.952l-.033.962.826.166A4.01 4.01 0 0 1 57 48c0 1.492-.838 2.85-2.187 3.542zM61 55h-4c0-.748-.148-1.494-.432-2.2a5.994 5.994 0 0 0 1.609-1.8H61z" fill="currentColor"></path></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Death Fund</h4>
            <h3 class="text-3xl">{{ $user->death_amount }}{{ $user->death_amount ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-rose-600 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16  flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 60 60" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g fill="#000" fill-rule="nonzero"><path d="M58 28H45v-8.056l7-3.937v3.177a3 3 0 1 0 2 0v-4.3l4.97-2.8a2.019 2.019 0 0 0-.408-3.693L31.144.167a4 4 0 0 0-2.293 0L1.439 8.393a2.019 2.019 0 0 0-.41 3.693L15 19.944V28H2a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h56a2 2 0 0 0 2-2V30a2 2 0 0 0-2-2zm-5-5a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM2 37.941A9.012 9.012 0 0 0 9.941 30h40.118A9.012 9.012 0 0 0 58 37.941v12.118A9.013 9.013 0 0 0 50.059 58H9.941A9.012 9.012 0 0 0 2 50.059zm56-2.021A7 7 0 0 1 52.08 30H58zm-4-23.333V9.142l3.989 1.2zM2.014 10.309l27.412-8.224c.373-.112.77-.112 1.143 0L52 8.539v5.173l-7 3.937v-.494a2.957 2.957 0 0 0-1.648-2.678C41.476 13.552 37.247 12 30 12s-11.476 1.552-13.351 2.476A2.959 2.959 0 0 0 15 17.155v.491zM17 17.155a.983.983 0 0 1 .533-.884C19.253 15.422 23.158 14 30 14s10.747 1.422 12.468 2.271c.33.17.536.512.532.884V28H21v-8a1 1 0 0 0-2 0v8h-2zM7.92 30A7 7 0 0 1 2 35.92V30zM2 52.08A7 7 0 0 1 7.92 58H2zM52.08 58A7 7 0 0 1 58 52.08V58z" fill="currentColor" data-original="#000000" class=""></path><path d="M30 53a9 9 0 1 0-9-9 9.01 9.01 0 0 0 9 9zm0-16a7 7 0 1 1-7 7 7.008 7.008 0 0 1 7-7zM11 48a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zM49 48a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-6a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" fill="currentColor"></path></g></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Education Fund</h4>
            <h3 class="text-3xl">{{ $user->education_amount }}{{ $user->education_amount ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
    <div class="flex w-full items-center rounded-md bg-violet-400 p-4 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
        {{-- <svg class="h-16 w-16  flex-none" viewBox="0 0 40 40" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8322 6.12083C11.1486 5.56355 11.74 5.21924 12.3808 5.21924H27.1431C27.7322 5.21924 28.2831 5.51055 28.6148 5.99738L37.4718 18.9974C37.8542 19.5587 37.884 20.2887 37.5487 20.8793L30.1679 33.8793C29.8515 34.4366 29.2601 34.7809 28.6192 34.7809L12.3808 34.7809C11.74 34.7809 11.1486 34.4366 10.8322 33.8793L3.45137 20.8793C3.14178 20.334 3.14178 19.6661 3.45137 19.1208L10.8322 6.12083ZM12.3808 10.607L17.7138 20.0001L12.3808 29.3931L7.04787 20.0001L12.3808 10.607ZM15.4397 31.2192L27.5825 31.2192L32.9411 21.7809H20.7984L15.4397 31.2192ZM20.7984 18.2192H32.6319L26.2015 8.78092H15.4397L20.7984 18.2192Z" fill="#fff"></path>
        </svg> --}}
        <svg class="h-16 w-16 flex-none text-white" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="currentColor" data-original="#000000"></path></clipPath><clipPath id="b" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="currentColor" data-original="#000000"></path></clipPath><clipPath id="c" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="currentColor" data-original="#000000"></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0h306.667v-35.61h-438" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(195.333 45.61)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path></g><path d="M0 0v0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="matrix(1.33333 0 0 -1.33333 278.336 294.244)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" fill="currentColor"></path><g clip-path="url(#b)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0v216.346h-253.248" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(502 74.97)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" fill="currentColor"></path></g><path d="M0 0h60.791" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="matrix(1.33333 0 0 -1.33333 143.948 294.244)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" class=""></path><path d="M0 0v60.856" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="matrix(1.33333 0 0 -1.33333 85.333 438.475)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" fill="currentColor"></path><g clip-path="url(#c)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0v-38.46h-308" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(502 84.07)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0h240.874c0 17.347 14.063 31.409 31.41 31.409v111.669c-17.347 0-31.41 14.063-31.41 31.41H-63.024c0-17.347-14.063-31.41-31.41-31.41v-42.964" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(194 81.22)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0h14.244" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(381.712 168.463)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0c0-23.899 19.371-43.273 43.266-43.273C67.16-43.273 86.531-23.899 86.531 0c0 23.899-19.371 43.273-43.265 43.273C19.371 43.273 0 23.899 0 0Z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(239.359 168.463)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="m0 0-80.785-80.785 28.683-28.682 168.76 168.76 42.497-42.497 88.587 88.587 21.425-21.425 17.344 86.184-86.184-17.345 18.732-18.731-59.904-59.904-42.497 42.497-60.09-60.09" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(91.137 331.858)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0h128c15.464 0 28-12.536 28-28v0c0-15.464-12.536-28-28-28H0c-15.464 0-28 12.536-28 28v0C-28-12.536-15.464 0 0 0z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(38 66)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0h128c15.464 0 28-12.536 28-28v0c0-15.464-12.536-28-28-28H0c-15.464 0-28 12.536-28 28v0C-28-12.536-15.464 0 0 0z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(38 122)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0h128c15.464 0 28-12.536 28-28v0c0-15.464-12.536-28-28-28H0c-15.464 0-28 12.536-28 28v0C-28-12.536-15.464 0 0 0z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(38 178)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path><path d="M0 0v0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(119.556 360.007)" fill="none" stroke="currentColor" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="currentColor" class=""></path></g></g></svg>
        <div class="flex flex-col ml-5 text-white">
            <h4 class="text-lg">Total Salary</h4>
            <h3 class="text-3xl">{{ $user->salary }}{{ $user->salary ? $currency_symbol : ''  }}</h3>
        </div>
    </div>
</div>
<h3 class="text-3xl mb-5 mt-7">Account Information</h3>
<div class="mt-10 w-full rounded-md bg-white px-6 py-4 leading-6 text-slate-900 shadow-xl shadow-black/5 ring-1 ring-slate-700/10">
    <div class="flex flex-col items-center py-5">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $user->image ? $user->image->url : 'https://img.freepik.com/premium-vector/woman-portrait-generic-female-avatar-gender-placeholder-isolated-white-background_543062-417.jpg?w=2000' }}" alt="Bonnie image" />
        <p>{{ count($user->rewards) ? $user->rewards[0]->designation : ''  }}</p>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
            <span class="w-1/2 flex-none font-bold">User name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->username }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Full Name</span>
            <input readonly id="username" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->first_name . ' ' . $user->last_name }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
            <span class="w-1/2 flex-none font-bold">Joining Date</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->created_at->format('d-m-Y') }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Nominee Name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->nominee ? $user->nominee->nominee_name : '' }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
            <span class="w-1/2 flex-none font-bold">Sponsor Id</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->sponsor ? $user->sponsor->username : '' }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">Sponsor Name</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->sponsor ? $user->sponsor->first_name . ' ' . $user->sponsor->last_name : '' }}" readonly autofocus />
        </div>
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3 lg:pr-5">
            <span class="w-1/2 flex-none font-bold">Mobile No</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->phone }}" readonly autofocus />
        </div>
        <div class="basis-1/2 grow-1 flex items-center border-t border-slate-400/20 py-3">
            <span class="w-1/2 flex-none font-bold">E-mail</span>
            <input id="username" readonly type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ $user->email }}" readonly autofocus />
        </div>
    </div>
    <div class="border-t border-slate-400/20 pt-3">
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="autoInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=auto" readonly autofocus />
            <button onclick="copyClickInput('auto')" id="autoClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                {{ __('Copy Link') }}
            </button>
        </div>
        {{-- @if (!$user->left_ref_id) --}}
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="leftInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=left" autofocus />
            <button onclick="copyClickInput('left')" id="leftClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                {{ __('Copy Link') }}
            </button>
        </div>
        {{-- @endif --}}
        {{-- @if (!$user->right_ref_id) --}}
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
            <input id="rightInput" type="text" class="w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700" name="username" value="{{ config('app.url') }}/set-sponsor/?sponsor_id={{ $user->username }}&position=right" autofocus />
            <button onclick="copyClickInput('right')" id="rightClickButton" class=" rounded-md h-12 px-3 py-2 bg-red-600 whitespace-nowrap text-white text-sm">
                {{ __('Copy Link') }}
            </button>
        </div>
        {{-- @endif --}}
    </div>
</div>
@endsection
@push('custom_scipt')
{{-- some sort js you can write here --}}
<script>
    function copyClickInput(position) {
        var copyText = null
        var ClickButton = null
        if (position == 'auto') {
            copyText = document.getElementById("autoInput");
            ClickButton = document.getElementById("autoClickButton")
        } else if (position == 'left') {
            copyText = document.getElementById("leftInput");
            ClickButton = document.getElementById("leftClickButton")
        } else {
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
    }
</script>
@endpush
