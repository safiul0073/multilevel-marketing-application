<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- dependent style --}}
    @vite('resources/css/app.css')
    @include('frontend.static.css')

    {{-- custome style for every single page --}}
    @stack('custom_style')
    @yield('custome_style')
</head>
<body>
    <div class="w-full min-h-screen bg-gray-100">

        {{-- Header  --}}
        @include('frontend.layouts.partials.header')

        @yield('content')

        {{-- footer --}}
        @include('frontend.layouts.partials.footer')

    </div>


    {{-- dependent script --}}
    @include('frontend.static.js')
    {{-- custome script for every single page --}}
    @stack('custom_scipt')
    @yield('custome_scipt')
</body>
</html>
