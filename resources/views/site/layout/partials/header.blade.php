

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

<!-- Header -->
<header class="header">
    @if (Route::is(['index']))
    <!-- <div class="header-top">
        <div class="template-ad">
            <img src="{{ URL::asset('/assets/img/icons/badge-icon.svg') }}" alt="icon">
            <h5>No 1, Realestate Website to Buy / Sell Your Place <span>First Listing Free!!!</span></h5>
        </div>
    </div> -->
    @endif
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="{{ url('/') }}" class="navbar-brand logo">
                <img src="{{ URL::asset('/assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ url('index') }}" class="menu-logo">
                    <img src="{{ URL::asset('/assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                </a>

                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li class="{{ Request::is('index', '/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li><a href="{{ url('about-us') }}"
                        class="{{ Request::is('about-us') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ url('buy-property-grid') }}"
                        class="{{ Request::is('buy-property-grid') ? 'active' : '' }}">Property</a></li>
                <li><a href="{{ url('pricing') }}"
                        class="{{ Request::is('pricing') ? 'active' : '' }}">Pricing</a></li>
                <li><a href="{{ url('buy-details') }}"
                        class="{{ Request::is('buy-details') ? 'active' : '' }}">Buy Details</a>
                </li>
               
                <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a
                        href="{{ url('contact-us') }}">Contact Us</a></li>
                <li class="searchbar">
                    <a href="javascript:void(0);">
                        <img src="{{ URL::asset('/assets/img/icons/search-icon.svg') }}" alt="img">
                    </a>
                </li>
                <li class="login-link"><a href="{{ url('login') }}">Sign Up</a></li>
                <li class="login-link"><a href="{{ url('register') }}">Sign In</a></li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="new-property-btn">
                <a href="{{ url('add-new-property') }}"
                    class="{{ Request::is('add-new-property') ? 'active' : '' }}">
                    <i class="bx bxs-plus-circle"></i> Add New Property
                </a>
            </li>
            {{-- <li class="{{ Request::is('register') ? 'active' : '' }}">
                <a href="{{ url('register') }}" class="btn btn-primary"><i class="feather-user-plus"></i>Sign
                    Up</a>
            </li> --}}

            <li class="nav-item dropdown {{ Request::is('register/client', 'register/provider') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="feather-user-plus"></i> Sign Up
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('clients.client_registration') }}">Client</a>
                    <a class="dropdown-item" href="{{ route('providers.provider_registration') }}">Provider</a>
                </div>
            </li>
            </li>
          
            <li class="{{ Request::is('login') ? 'active' : '' }}">
                <a href="{{ url('login') }}" class="btn sign-btn"><i class="feather-unlock"></i>Sign In</a>
            </li>
        </ul>
    </nav>
</header>
<!-- /Header -->
<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0; /* Optional: remove space between the button and dropdown */
    }

    /* Optional: Remove caret (dropdown arrow) if not needed */
    .dropdown-toggle::after {
        display: none;
    }
</style>
@endif

@if (Route::is([
'reset-password',
'forgot-password',
'login',
'register',
'coming-soon',
'error-404',
'error-500',
'maintenance',
]))
<!-- Header -->
<header class="log-header">
    <a href="{{ url('index') }}"><img class="img-fluid logo-dark"
            src="{{ URL::asset('/assets/img/login-logo.svg') }}" alt="Logo"></a>
</header>
<!-- /Header -->
@endif