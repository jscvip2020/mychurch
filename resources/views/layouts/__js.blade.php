<?php
/**
 * Created by JS'Cordeiro Programas.
 * User: Sergio
 * Date: 30/03/2021
 * Time: 12:26
 */ ?>

<!-- Modernizr JS -->
<script src="{{ asset('js/modernizr-3.5.0.min.js') }}"></script>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{ asset('js/main.js')}}"></script>


{{-- JS FrontEnd --}}
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>

<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/mainfront.js') }}"></script>

@yield('scripts')
