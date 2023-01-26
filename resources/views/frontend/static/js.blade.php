{{-- dependent js put in below --}}
<script src="{{ asset('frontend/script/home.js') }}"></script>
<script src="{{ asset('frontend/script/splide.min.js') }}"></script>

{{-- end dependent js --}}
<script>

    function setHiddenOnClicked (){
        var showedAlert =  document.getElementById('alert_button')
        showedAlert.classList.add('hidden')
    }

</script>
