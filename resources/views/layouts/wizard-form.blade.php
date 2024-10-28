<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name="Description" content="Sparic - Laravel Starerkit">
        <meta name="Author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template, vite laravel template, vite admin template, vite laravel admin, vite laravel admin dashboard, vite laravel bootstrap admin template">

		<title> Sparic - Laravel Starerkit</title>

        <link rel="icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon" >
		<link rel="shortcut icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">
	    <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        @vite(['resources/sass/app.scss'])
        <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">
        <link href="{{asset('build/assets/iconfonts/animated.css')}}" rel="stylesheet">
        @vite(['resources/css/app.css'])
        <!-- Bootstrap Stylesheets -->
        <link rel="stylesheet" href="{{ asset('wizard-form/css/bootstrap.min.css') }}">

        <!-- Font Awesome Stylesheets -->
        <link rel="stylesheet" href="{{asset('wizard-form/css/fontawesome/all.min.css')}}">	
        <!-- bootstrap-datepicker Stylesheets -->
        <link rel="stylesheet" href="{{asset('wizard-form/css/bootstrap-datepicker3.min.css')}}">
        <!-- sweetalert Stylesheets -->
        <link rel="stylesheet" href="{{asset('wizard-form/css/sweetalert.css')}}" type="text/css">
        <!-- Template Main Stylesheets -->
        <link rel="stylesheet" href="{{asset('wizard-form/css/reg-form.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('wizard-form/css/reg-form-modern.css')}}" type="text/css">
        @yield('styles')

	</head>

	<body class="app sidebar-mini ltr">

        <!-- PAGE -->
		<div class="page">
            <div class="page-main">

                @include('layouts.components.main-header')
                @include('layouts.components.main-sidebar')
                <div class="main-content app-content">
                    <div class="side-app">
                        <div class="main-container container-fluid">
                                @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            
            @include('layouts.components.right-sidebar')
            @include('layouts.components.main-footer')
		</div>
        
        <script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('build/assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('build/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('build/assets/plugins/p-scroll/pscroll.js')}}"></script>
        <script src="{{asset('build/assets/plugins/sidemenu/sidemenu.js')}}"></script>
        <script src="{{asset('build/assets/plugins/sidebar/sidebar.js')}}"></script>
		@vite('resources/js/app.js')



        <script src="{{asset('wizard-form/js/jquery-3.5.1.min.js')}}"></script>
	<!-- bootstrap-datepicker Js -->
    <script src="{{asset('wizard-form/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- Form validator Js -->
	<script src="{{asset('wizard-form/js/validator.min.js')}}"></script>
	<!-- sweetalert Js -->
    <script src="{{asset('wizard-form/js/sweetalert.min.js')}}"></script>
	<!-- Template main Js -->
    @yield('js')
    
	<!-- Google Api -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
	<script>
		function init() {
			var input = document.getElementById('address');
			var autocomplete = new google.maps.places.Autocomplete(input);
		} 
		google.maps.event.addDomListener(window, 'load', init);
	</script>
	
	</body>
</html>
