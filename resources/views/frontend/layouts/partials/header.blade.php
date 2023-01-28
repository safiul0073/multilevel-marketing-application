<header class="bg-indigo-800 lg:h-24 flex flex-col justify-center sticky top-0 z-40">
    <div class="container">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
                <button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id='mlm-toggler-button'>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center ml-16 mobile:ml-12 lg:ml-0">
                <a href="{{url('/')}}" class="flex flex-shrink-0 items-center text-white">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="main_logo" class="h-10 w-24">
                    {{-- <p2 class="text-3xl mobile:text-3xl font-semibold uppercase tracking-tight">MLM Shop</p2> --}}
                </a>
                <div class="hidden lg:ml-auto lg:flex items-center">
                    <div class="flex space-x-4 wide-tablet:space-x-2">
                        <a href="{{url('/')}}" class="{{ request()->routeIs('hello.world.home.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        @if (auth()->check())
                        <a href="{{url('/products')}}" class="{{ request()->routeIs('product.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Product</a>
                        @else
                        <a href="{{url('/packages')}}" class="{{ request()->routeIs('package.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Package</a>
                        @endif
                        <a href="{{url('/news')}}" class="{{ request()->routeIs('news.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">News</a>

                        <a href="{{url('/gallery')}}" class="{{ request()->routeIs('gallery.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Gallery</a>

                        <a href="{{url('/about-us')}}" class="{{ request()->routeIs('about.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">About Us</a>

                        <a href="{{url('/contact')}}" class="{{ request()->routeIs('contact.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>
                </div>
            </div>

            @if (auth()->user())
            <div class="relative inline-block text-left group lg:ml-5">
                <div>
                    <button type="button" class="inline-flex items-center w-full justify-center rounded-md border border-indigo-600 bg-indigo-600 pl-1 pr-2 py-1 text-sm font-medium text-white shadow-sm focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <div class="flex items-center gap-2">
                            <img src="{{ auth()->user()->image ? auth()->user()->image->url : "https://img.freepik.com/premium-vector/woman-portrait-generic-female-avatar-gender-placeholder-isolated-white-background_543062-417.jpg?w=2000" }}" class="w-7 h-7 rounded-full" alt="">
                            <span>{{ auth()->user()->username }}</span>
                        </div>
                        <svg class="-mr-1 ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="absolute right-0 z-10 w-56 origin-top-right divide-y divide-gray-300 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none invisible opacity-0 group-hover:visible group-hover:opacity-100" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm" role="none">Signed in as</p>
                        <p class="truncate text-sm font-medium text-gray-900" role="none">{{ auth()->user()->username }}</p>
                    </div>
                    <div class="py-1" role="none">
                        <a href="{{ route('user.dashboard') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Dasboard</a>
                        <a href="{{ route('user.profile') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Profile</a>
                        <a href="{{ route('withdraw.request') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Withdraw Request</a>
                    </div>
                    <div class="py-1" role="none">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="text-gray-700 block w-full px-4 py-2 text-left text-sm">
                            <p>
                                Log Out
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>

            @else
            <div class="absolute inset-y-0 right-0 flex items-center lg:static lg:inset-auto lg:ml-5">
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-md border border-transparent bg-rose-500 px-4 py-1 text-base font-medium text-white hover:bg-rose-600">Log in</a>
            </div>
            @endif

        </div>
    </div>
    <div class="lg:hidden bg-indigo-800 absolute top-full w-full transition-transform ease-in-out duration-100 origin-top" id="mlm-mobile-menu">
        <div class="space-y-1 px-8 pt-5 pb-5">

            <a href="{{url('/')}}" class="{{ request()->routeIs('hello.world.home.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Home</a>

            <a href="{{url('/products')}}" class="{{ request()->routeIs('product.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white '}} block px-3 py-2 rounded-md text-base font-medium">Product</a>

            <a href="{{url('/news')}}" class="{{ request()->routeIs('news.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white '}} block px-3 py-2 rounded-md text-base font-medium">News</a>

            <a href="{{url('/gallery')}}" class="{{ request()->routeIs('gallery.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white '}} block px-3 py-2 rounded-md text-base font-medium">Gallery</a>

            <a href="{{url('/about-us')}}" class="{{ request()->routeIs('about.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white '}} block px-3 py-2 rounded-md text-base font-medium">About Us</a>

            <a href="{{url('/contact')}}" class="{{ request()->routeIs('contact.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white '}} block px-3 py-2 rounded-md text-base font-medium">Contact</a>
        </div>
    </div>
</header>
