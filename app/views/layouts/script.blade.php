<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Jquery Source -->
    {{ HTML::script('assets/js/libs/jquery-1.11.0.min.js') }}
    <!-- Bootstrap Source -->
    {{ HTML::script('assets/js/libs/bootstrap.min.js') }}
    <!-- Google Map Source -->
    {{ HTML::script('assets/js/libs/gmap3.min.js') }}
    <script src='https://maps.googleapis.com/maps/api/js?sensor=true'></script>
    {{ HTML::script("assets/js/plugins/metisMenu/jquery.metisMenu.js") }}
    <!-- Main Action Javascript -->
    {{ HTML::script('assets/js/modern-business.js') }}
    {{ Setting::SITE_SCRIPT() }}
    @yield('script')