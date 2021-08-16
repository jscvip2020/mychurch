<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 12:26
 */ ?>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{ asset('js/main.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@yield('scripts')
