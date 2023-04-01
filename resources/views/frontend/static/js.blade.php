{{-- dependent js put in below --}}
<script src="{{ asset('frontend/script/splide.min.js') }}"></script>
<script src="{{ asset("frontend/script/slider.js") }}"></script>
<script src="{{ asset("frontend/script/modalOpen.js") }}"></script>
<script>

    function setHiddenOnClicked (){
        var showedAlert =  document.getElementById('alert_button')
        showedAlert.classList.add('hidden')
    }

</script>
