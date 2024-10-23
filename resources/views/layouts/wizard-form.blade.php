<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
	
	<title>RegForm - Advanced Multi Step Registration HTML Ajax Form</title>
	<!-- set your website meta description and keywords -->
	<meta name="description" content="Add your website description here">
	<meta name="keywords" content="Add your website keywords here">
	<!-- set your website favicon icon -->
	<link href="favicon.ico" rel="icon">

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
</head>

<body>

	@yield('content')

    
	<!-- jQuery Library -->
	<script src="{{asset('wizard-form/js/jquery-3.5.1.min.js')}}"></script>
	<!-- bootstrap-datepicker Js -->
    <script src="{{asset('wizard-form/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- Form validator Js -->
	<script src="{{asset('wizard-form/js/validator.min.js')}}"></script>
	<!-- sweetalert Js -->
    <script src="{{asset('wizard-form/js/sweetalert.min.js')}}"></script>
	<!-- Template main Js -->
    <script src="{{asset('wizard-form/js/reg-form.js')}}"></script>
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