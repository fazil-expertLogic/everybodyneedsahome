<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name="Description" content="Sparic - Laravel Starerkit">
        <meta name="Author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template, vite laravel template, vite admin template, vite laravel admin, vite laravel admin dashboard, vite laravel bootstrap admin template">

        <!-- TITLE -->
		<title> Sparic - Laravel Starerkit</title>

        <!-- FAVICON -->
        <link rel="icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon" >
		<link rel="shortcut icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">

        <!-- BOOTSTRAP CSS -->
	    <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- APP SCSS -->
        @vite(['resources/sass/app.scss'])


        <!-- ICONS CSS -->
        <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">

        <!-- ANIMATE CSS -->
        <link href="{{asset('build/assets/iconfonts/animated.css')}}" rel="stylesheet">

        <!-- APP CSS -->
        @vite(['resources/css/app.css'])

        @yield('styles')

	</head>

	<body class="app sidebar-mini ltr">

        <!-- PAGE -->
		<div class="page">
            <div class="page-main">

                <!-- MAIN-HEADER -->
                @include('layouts.components.main-header')

                <!-- END MAIN-HEADER -->

                <!-- MAIN-SIDEBAR -->
                @include('layouts.components.main-sidebar')

                <!-- END MAIN-SIDEBAR -->

                <!-- MAIN-CONTENT -->
                <div class="main-content app-content">
                    <div class="side-app">
                        <!-- CONTAINER -->
                        <div class="main-container container-fluid">
                                @yield('content')
                        </div>
                    </div>
                </div>
                <!-- END MAIN-CONTENT -->
            </div>
            
            <!-- RIGHT-SIDEBAR -->
            @include('layouts.components.right-sidebar')

            <!-- END RIGHT-SIDEBAR -->

            <!-- MAIN-FOOTER -->
            @include('layouts.components.main-footer')

            <!-- END MAIN-FOOTER -->

		</div>
        <!-- END PAGE-->

        <!-- SCRIPTS -->
        
        <!-- JQUERY MIN JS -->
        <script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- BOOTSTRAP5 BUNDLE JS -->
        <script src="{{asset('build/assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- PERFECT-SCROLLBAR JS  -->
        <script src="{{asset('build/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('build/assets/plugins/p-scroll/pscroll.js')}}"></script>

        <!-- SIDEMENU JS -->
        <script src="{{asset('build/assets/plugins/sidemenu/sidemenu.js')}}"></script>

        <!-- RIGHT SIDEBAR JS -->
        <script src="{{asset('build/assets/plugins/sidebar/sidebar.js')}}"></script>

        <!-- APP JS -->
		@vite('resources/js/app.js')
        

        <!-- END SCRIPTS -->

	</body>
</html>
