<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') - Мария Официален сайт</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Playfair+Display&amp;subset=cyrillic" rel="stylesheet">
    <link rel="icon" href="{{ Config::get('view.frontend.img') }}/content/icon.png">
    <script type="text/javascript">
        window.addEventListener("keydown", function(e) {
        // space and arrow keys
            if([37, 38, 39, 40].indexOf(e.keyCode) > -1) {
                e.preventDefault();
            }
        }, false);
    </script>
    
    <!-- ========== CSS INCLUDES ========== -->
    <link rel="stylesheet" href="{{ Config::get('view.frontend.css') }}/master.css">
</head>
<body>
    <div class="page-loader">
         <div class="vertical-align align-center">
              <img src="{{ Config::get('view.frontend.img') }}/loader/loader.gif" alt="" class="loader-img">
         </div>
    </div>
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.player')

    @include('frontend.layouts.footer')

    
    <!-- ================================================== -->
    <!-- =============== START JQUERY SCRIPTS ================ -->
    <!-- ================================================== -->
    <script src="{{ Config::get('view.frontend.js') }}/jquery.js"></script>
    <script src="{{ Config::get('view.frontend.js') }}/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ Config::get('view.frontend.jplayer') }}/jplayer/jquery.jplayer.js"></script>
    <script src="{{ Config::get('view.frontend.js') }}/jPlayer.js"></script>
    <script src="{{ Config::get('view.frontend.js') }}/plugins.js"></script>
    <script src="{{ Config::get('view.frontend.js') }}/main.js"></script>
    <!--[if lte IE 9 ]>
        <script src="{{ Config::get('view.frontend.js') }}/placeholder.js"></script>
        <script>
            jQuery(function() {
                jQuery('input, textarea').placeholder();
            });
        </script>
    <![endif]-->
    <!-- ================================================== -->
    <!-- =============== END JQUERY SCRIPTS ================ -->
    <!-- ================================================== -->

    @yield('js')
</body>
</html>