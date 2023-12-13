
		<!-- TITLE -->
        <title>@yield('title', '')</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/fav-icon.png')}}" />

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

        @yield('styles')

        <!--- FONT-ICONS CSS -->
        <link href="{{asset('assets/plugins/icons/icons.css')}}" rel="stylesheet" />
