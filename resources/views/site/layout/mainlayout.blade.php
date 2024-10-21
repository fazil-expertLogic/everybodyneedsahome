<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title>DreamsEstate</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/assets/img/favicon.png') }}" type="image/x-icon">

    @include('site.layout.partials.head')
</head>

@if (!Route::is(['coming-soon', 'error-404', 'error-500', 'maintenance']))

    <body>
@endif
@if (Route::is(['coming-soon', 'error-404', 'error-500', 'maintenance']))

    <body class="error-page login-body p-0">
@endif
@component('site.components.loader')
@endcomponent
<!-- Main Wrapper -->
@if (!Route::is(['reset-password', 'forgot-password', 'login', 'register', 'about-us']))
    <div class="main-wrapper">
@endif
@if (Route::is(['about-us']))
    <div class="main-wrapper aboutus-page">
@endif
@if (Route::is(['reset-password', 'forgot-password', 'login', 'register']))
    <div class="main-wrapper login-body">
        <div class="container">
@endif
@if (Route::is(['coming-soon', 'error-404', 'error-500', 'maintenance']))
    <div class="container">
@endif
@include('site.layout.partials.header')
@yield('content')
@if (
    !Route::is([
        'reset-password',
        'forgot-password',
        'login',
        'register',
        'coming-soon',
        'error-404',
        'error-500',
        'maintenance',
    ]))
    @include('site.layout.partials.footer')
@endif
@component('site.components.modal-popup')
@endcomponent
</div>
<!-- /Main Wrapper -->
@if (
    !Route::is([
        'reset-password',
        'forgot-password',
        'login',
        'register',
        'coming-soon',
        'error-404',
        'error-500',
        'maintenance',
    ]))
    @component('site.components.scrolltotop')
    @endcomponent
@endif
@include('site.layout.partials.footer-scripts')
</body>

</html>
