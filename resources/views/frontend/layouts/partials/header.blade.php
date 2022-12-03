<header class="bg-indigo-800 lg:h-24 flex flex-col justify-center sticky top-0 z-50">
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
                <a href="#" class="flex flex-shrink-0 items-center text-white">
                    <!-- <img src="" alt="" class="h-16"> -->
                    <p2 class="text-3xl mobile:text-3xl font-semibold uppercase tracking-tight">MLM Shop</p2>
                </a>
                <div class="hidden lg:ml-auto lg:flex items-center">
                    <div class="flex space-x-4 wide-tablet:space-x-2">
                        <a href="{{url('/')}}" class="{{ request()->routeIs('index.home.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium" >Home</a>

                        <a href="{{url('/products')}}" class="{{ request()->routeIs('product.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Product</a>

                        <a href="{{url('/news')}}" class="{{ request()->routeIs('news.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">News</a>

                        <a href="{{url('/gallery')}}" class="{{ request()->routeIs('gallery.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Gallery</a>

                        <a href="{{url('/about-us')}}" class="{{ request()->routeIs('about.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">About Us</a>

                        <a href="{{url('/contact')}}" class="{{ request()->routeIs('contact.page') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-indigo-600 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center lg:static lg:inset-auto lg:ml-5">
                <a href="#" class="inline-flex items-center rounded-md border border-transparent bg-rose-500 px-4 py-1 text-base font-medium text-white hover:bg-rose-600">Log in</a>
            </div>
        </div>
    </div>
    <div class="lg:hidden bg-indigo-800 absolute top-full w-full transition-transform ease-in-out duration-100 origin-top" id="mlm-mobile-menu">
        <div class="space-y-1 px-8 pt-5 pb-5">
            <a href="#" class="bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Home</a>

            <a href="#" class="text-gray-300 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Product</a>

            <a href="#" class="text-gray-300 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">News</a>

            <a href="#" class="text-gray-300 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Gallery</a>

            <a href="#" class="text-gray-300 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About Us</a>

            <a href="#" class="text-gray-300 hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
        </div>
    </div>
</header>
