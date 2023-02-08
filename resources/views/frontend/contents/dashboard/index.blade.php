@extends('frontend.layouts.app')
@push('custom_style')
{{-- here some custome style --}}
@endpush
@section('custome_style')
{{-- here some style --}}

@endsection
@section('content')
<div class="flex p-5 md:p-10 lg:p-20 gap-10 flex-col xl:flex-row relative">
    @include('frontend.contents.dashboard.sidebar')
    <div class="w-full">
        @yield('dashboard-page')
    </div>
</div>
@endsection

@push('custom_scipt')
{{-- some sort js you can write here --}}

@endpush

@section('custome_scipt')

<script>
    var hamburger_menu = document.getElementById("dashboard-sidebar");
    var hamburger_button = document.getElementById("dashboard-hamburger-toggler");


    hamburger_button.addEventListener("click", function() {
        hamburger_menu.classList.toggle("active")
    });
</script>

@endsection