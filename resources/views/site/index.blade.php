<?php $page = 'index'; ?>
@extends('site.layout.mainlayout')
@section('content')
    <!-- Home Banner -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="banner-content" data-aos="fade-down">
                        <h1>We help you find <span>  Second Chance Housing</span></h1>
                        <p>We are different than any other website offering housing for rent or even a place to stay. We have more than 3000+ listings for you to choose.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-search" data-aos="fade-down">
                        <div class="banner-tab">
                            <ul class="nav nav-tabs" id="bannerTab" role="tablist">
                               
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="rent-property" data-bs-toggle="tab" href="#rent_property"
                                        role="tab" aria-controls="rent_property" aria-selected="false">
                                        <img src="{{ URL::asset('/assets/img/icons/rent-icon.svg') }}" alt="icon"> Rent
                                        a Property
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="bannerTabContent">
                           
                            <div class="tab-pane fade show active" id="rent_property" role="tabpanel" aria-labelledby="rent-property">
                                <div class="banner-tab-property">
                                    <form action="#">
                                        <div class="banner-property-info">
                                            <div class="banner-property-grid">
                                                <input type="text" class="form-control" placeholder="Enter Keyword">
                                            </div>
                                            <div class="banner-property-grid">
                                                <select class="select">
                                                    <option value="0">Property Type</option>
                                                   
                                                    <option value="2">Rent Property</option>
                                                </select>
                                            </div>
                                            <div class="banner-property-grid">
                                                <input type="email" class="form-control" placeholder="Enter Address">
                                            </div>
                                            <div class="banner-property-grid">
                                                <input type="text" class="form-control" placeholder="Min Price">
                                            </div>
                                            <div class="banner-property-grid">
                                                <input type="text" class="form-control" placeholder="Max Price">
                                            </div>
                                            <div class="banner-property-grid">
                                                <a href="{{ url('rent-property-grid') }}" class="btn-primary"><span><i
                                                            class='feather-search'></i></span></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <!-- How It Work -->
    <section class="howit-work">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Second Chance Housing for Everyone...</h2>
                <div class="sec-line">
                    <span class="sec-line1"></span>
                    <span class="sec-line2"></span>
                </div>
 <p>We are different than any other website offering housing for rent or even a place to stay. We are specifically focused on offering Second Chance housing for individuals who may have trouble finding traditional housing solutions. If this is you, we invite you to sign up for free and apply with our network Providers.
</p>
<br />

<div class="price-btn">
 <a href="https://staging.everybodyneedsahome.com/client-registration" class="btn-primary">Applicant Sign Up </a>
</div>
            </div>
        </div>
    </section>
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="faq-img">
                        <img src="{{ URL::asset('/assets/img/faq-img.jpg') }}" alt="icon">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-heading" data-aos="fade-down" data-aos-duration="2000">
                        <h2>Are you a Landlord, Management Company, or Property Owner</h2>
                        <div class="sec-line">
                            <span class="sec-line1"></span>
                            <span class="sec-line2"></span>
                        </div>
                        <p>Who is interested in marketing your house, building, room or even a single bed to someone seeking a Second Chance? We invite you to join our growing network of those willing to offer a Second Chance to those so often forgetten or written off by most of our society. You can create a fully customizable account that matches your budget and where you can set your standards of what you are willing to accept in an Applicant.

</p>
<br />

<div class="price-btn">
 <a href="https://staging.everybodyneedsahome.com/provider-registration" class="btn-primary">Sign up to become a Second Chance Provider  </a>
</div>
                    </div>
                   
                  
    
                </div>
            </div>
        </div>
    </section>

    <!-- Property Type -->
    <section class="property-type-sec">
        <div class="section-shape-imgs">
            <img src="{{ URL::asset('/assets/img/shapes/property-sec-bg-1.png') }}" class="rectangle-left"
                alt="icon">
            <img src="{{ URL::asset('/assets/img/shapes/property-sec-bg-2.png') }}" class="rectangle-right"
                alt="icon">
            <img src="{{ URL::asset('/assets/img/icons/red-circle.svg') }}" class="bg-09" alt="Image">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="section-heading" data-aos="fade-down" data-aos-duration="1000">
                        <h2>Explore by Property Type</h2>
                        <div class="sec-line">
                            <span class="sec-line1"></span>
                            <span class="sec-line2"></span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis et sem sed </p>
                    </div>
                    <div class="owl-navigation">
                        <div class="owl-nav mynav1 nav-control"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="property-type-slider owl-carousel">
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-1.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Houses</h4>
                                <p>30 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-2.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Offices</h4>
                                <p>25 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-3.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Villas</h4>
                                <p>40 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-4.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Apartment</h4>
                                <p>35 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-3.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Villas</h4>
                                <p>40 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-1.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Houses</h4>
                                <p>30 Properties</p>
                            </div>
                        </div>
                        <div class="property-card" data-aos="fade-down" data-aos-duration="1000">
                            <div class="property-img">
                                <img src="{{ URL::asset('/assets/img/icons/property-icon-4.svg') }}" alt="icon">
                            </div>
                            <div class="property-name">
                                <h4>Apartment</h4>
                                <p>35 Properties</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Property Type -->

    <!-- Feature Properties For Sale-->
    <section class="feature-property-sec">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Featured Properties for Rent</h2>
                <div class="sec-line">
                    <span class="sec-line1"></span>
                    <span class="sec-line2"></span>
                </div>
                <p>Hand-Picked selection of quality places</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($properties as $property)
                        <!-- Buy grid -->    
                        <div class="col-lg-4 col-md-6">
                            <div class="product-custom">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="{{ url('property-detail/'. $property->id) }}" class="property-img">
                                            <img class="img-fluid" alt="Property Image"
                                                src="{{ $property->main_picture ? asset('storage/' . $property->main_picture) : URL::asset('assets/img/product/product-1.jpg') }}">
                                        </a>
                                        <div class="product-amount">
                                            <span>${{ number_format($property->bed_fee + $property->bedroom_fee + $property->unit_fee,2) }}</span>
                                        </div>
                                        <div class="feature-rating">
                                            <div>
                                                @if($property->is_feature)
                                                <div class="featured">
                                                    <span>Featured</span>
                                                </div>
                                                @endif
                                                @if($property->is_feature)
                                                <div class="new-featured">
                                                    <span>New</span>
                                                </div>
                                                @endif
                                            </div>
                                            {{-- <a href="javascript:void(0)">
                                                <div class="favourite">
                                                    <span><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </a> --}}
                                        </div>
                                        <div class="user-avatar">
                                            <img src="{{ URL::asset('assets/img/profiles/avatar-01.jpg') }}" alt="User">
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        {{-- <div class="rating">
                                            <span class="rating-count">
                                                <i class="fa-solid fa-star checked"></i>
                                                <i class="fa-solid fa-star checked"></i>
                                                <i class="fa-solid fa-star checked"></i>
                                                <i class="fa-solid fa-star checked"></i>
                                                <i class="fa-solid fa-star checked"></i>
                                            </span>
                                            <p class="rating-review"><span>5.0</span>(20 Reviews)</p>
                                        </div> --}}
                                        <h3 class="title">
                                            <a href="{{ url('buy-details') }}" tabindex="-1">{{$property->property_name}}</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>{{$property->property_address}}</p>
                                        <ul class="d-flex details">
                                            <li>
                                                <img src="{{ URL::asset('assets/img/icons/bed-icon.svg') }}" alt="bed-icon">
                                                {{$property->number_of_beds}} Beds
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset('assets/img/icons/bath-icon.svg') }}" alt="bath-icon">
                                                {{$property->number_of_bedrooms}} Baths
                                            </li>
                                            {{-- <li>
                                                <img src="{{ URL::asset('assets/img/icons/building-icon.svg') }}"
                                                    alt="building-icon">
                                                35000 Sqft
                                            </li> --}}
                                        </ul>
    
                                        <ul class="property-category d-flex justify-content-between">
                                            <li>
                                                <span class="list">Listed on : </span>
                                                <span class="date"> {{ \Carbon\Carbon::parse($property->created_at)->format('d M Y') }} </span>
                                            </li>
                                            <li>
                                                <span class="category list">Category : </span>
                                                <span class="category-value date">{{ $property->category ? $property->category->category_name : ''}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Buy grid -->
                        @endforeach
                    </div>
                    <div class="view-property-btn d-flex justify-content-center" data-aos="fade-down"
                        data-aos-duration="1000">
                        <a href="{{ url('#') }}" class="btn-primary">View All Properties</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-imgs">
            <img src="{{ URL::asset('/assets/img/bg/price-bg.png') }}" class="bg-01" alt="icon">
            <img src="{{ URL::asset('/assets/img/icons/blue-circle.svg') }}" class="bg-02" alt="icon">
            <img src="{{ URL::asset('/assets/img/icons/red-circle.svg') }}" class="bg-03" alt="icon">
        </div>
    </section>
    <!-- /Feature Properties For Sale -->

    <!-- Cities List -->
    {{-- <section class="cities-list-sec">
        <div class="container">
            <div class="section-heading">
                <h2>Cities With Listing</h2>
                <div class="sec-line">
                    <span class="sec-line1"></span>
                    <span class="sec-line2"></span>
                </div>
                <p>Destinations we love the most</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="city-card-slider owl-carousel">
                        <div class="city-first-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-1.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>New York</h5>
                                    <p>300 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-2.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>Singapore</h5>
                                    <p>400 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="city-card-two" data-aos="fade-down" data-aos-duration="2000">
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-3.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>Thailand</h5>
                                    <p>200 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-4.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>Argentina</h5>
                                    <p>740 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="city-card-three" data-aos="fade-down" data-aos-duration="2000">
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-5.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>United Kingdom</h5>
                                    <p>1450 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-1.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>United Arab Emirates</h5>
                                    <p>100 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="city-first-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-1.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>USA</h5>
                                    <p>320 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                            <div class="city-list">
                                <div class="city-img">
                                    <img src="{{ URL::asset('/assets/img/city/city-2.jpg') }}" alt="City">
                                </div>
                                <div class="city-name">
                                    <h5>Singapore</h5>
                                    <p>500 Properties</p>
                                </div>
                                <div class="arrow-overlay">
                                    <a href="{{ url('rent-property-grid') }}"><i class='fa-solid fa-arrow-right'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /Cities List -->

    <!-- Feature Property For Rent -->
  
    <!-- /Feature Property For Rent -->

    <!-- Couter -->
    <section class="counter-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                    <div class="counter-box flex-fill" data-aos="fade-down" data-aos-duration="2000">
                        <div class="counter-icon">
                            <img src="{{ URL::asset('/assets/img/icons/counter-icon-1.svg') }}" alt="icon">
                        </div>
                        <div class="counter-value">
                            <h3 class="dash-count"><span class="counter-up">50</span>K</h3>
                            <h5>Listings Added </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                    <div class="counter-box flex-fill" data-aos="fade-down" data-aos-duration="2000">
                        <div class="counter-icon">
                            <img src="{{ URL::asset('/assets/img/icons/counter-icon-2.svg') }}" alt="icon">
                        </div>
                        <div class="counter-value">
                            <h3 class="dash-count"><span class="counter-up">3000</span>+</h3>
                            <h5>Providers Listed </h5>
                        </div>
                    </div>
                </div>
              
                <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                    <div class="counter-box flex-fill" data-aos="fade-down" data-aos-duration="2000">
                        <div class="counter-icon">
                            <img src="{{ URL::asset('/assets/img/icons/counter-icon-4.svg') }}" alt="icon">
                        </div>
                        <div class="counter-value">
                            <h3 class="dash-count"><span class="counter-up">5000</span>+</h3>
                            <h5>Users</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Couter -->

 

    <!-- Pricing -->
    <section class="price-section" style="display: none">
        <div class="container">
            <div class="pricing-tab">
                <div class="section-heading">
                    <h2>Pricing & Membership Level</h2>
                    <div class="sec-line">
                        <span class="sec-line1"></span>
                        <span class="sec-line2"></span>
                    </div>
                    <p>Checkout our package, choose your package wisely</p>
                </div>
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#monthly-price" type="button" role="tab"
                            aria-controls="monthly-price" aria-selected="true">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#yearly-price" type="button" role="tab"
                            aria-controls="yearly-price" aria-selected="false">Yearly</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContent">

                <!-- Monthly Price -->
                <div class="tab-pane fade active show" id="monthly-price" role="tabpanel"
                    aria-labelledby="pills-profile-tab">
                    <div class="row justify-content-center">

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card aos" data-aos="flip-right" data-aos-easing="ease-out-cubic">
                                <div class="price-title">
                                    <h3>Basic</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>10 Listing Per Login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>10+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry On Listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 Hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>

                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Price Item -->

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card" data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                data-aos-duration="1000">
                                <div class="price-sticker">
                                    <img src="{{ URL::asset('/assets/img/icons/pricing-icon.svg') }}"
                                        alt="price-sticker">
                                </div>
                                <div class="price-title">
                                    <h3>Bronze</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features professional">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>20 Listing Per Login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>100+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry On Listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 Hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>API Access</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Transaction Tracking
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Price Item -->

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card" data-aos="flip-right" data-aos-easing="ease-out-cubic"
                                data-aos-duration="2000">
                                <div class="price-title">
                                    <h3>Silver</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features enterprise">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>30 Listing Per Login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>100+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry On Listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 Hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>API Access</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Transaction Tracking
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Price Item -->

                    </div>
                </div>
                <!-- /Monthly Price -->

                <!-- Yearly Price -->
                <div class="tab-pane fade" id="yearly-price" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row justify-content-center">

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card">
                                <div class="price-title">
                                    <h3>Standard</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>50 Listing per login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>150+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry on listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>API Access</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Transaction tracking
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card">
                                <div class="price-title">
                                    <h3>Professional</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features professional">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>80 Listing per login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>200+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry on listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>API Access</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Transaction tracking
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>

                        <!-- Price Item -->
                        <div class="col-lg-4 col-md-6">
                            <div class="price-card">
                                <div class="price-title">
                                    <h3>Enterprise</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                        ullamcorper mattis, pulvinar dapibus leo.</p>
                                </div>
                                <div class="price-features enterprise">
                                    <h5>Key Features</h5>
                                    <ul>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>70 Listing per login
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>300+ Users</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Enquiry on listing</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>24 hrs Support</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Custom Review</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Impact Reporting</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Onboarding & Account
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>API Access</li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Transaction tracking
                                        </li>
                                        <li><span><i class="fa-regular fa-square-check"></i></span>Branding</li>
                                    </ul>
                                </div>
                                <div class="price-btn">
                                    <a href="{{ url('login') }}" class="btn-primary">Get Quote</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Price Item -->

                    </div>
                </div>
                <!-- /Yearly Price -->

            </div>
        </div>
        <div class="bg-imgs">
            <img src="{{ URL::asset('/assets/img/bg/price-bg.png') }}" class="bg-05" alt="icon">
        </div>
    </section>
    <!-- /Pricing -->

    <!-- Faq -->
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="faq-img">
                        <img src="{{ URL::asset('/assets/img/faq-img.jpg') }}" alt="icon">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="section-heading" data-aos="fade-down" data-aos-duration="2000">
                        <h2>Frequently Asked Questions</h2>
                        <div class="sec-line">
                            <span class="sec-line1"></span>
                            <span class="sec-line2"></span>
                        </div>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                            magni dolores eos qui ratione voluptatem sequi nesciunt</p>
                    </div>
                    <div class="faq-card" data-aos="fade-down" data-aos-duration="2000">
                        <h4 class="faq-title">
                            <a class="collapsed" data-bs-toggle="collapse" href="#faqone" aria-expanded="false">1.
                                What are the costs to buy a house?</a>
                        </h4>
                        <div id="faqone" class="card-collapse collapse">
                            <div class="faq-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-card" data-aos="fade-down" data-aos-duration="2000">
                        <h4 class="faq-title">
                            <a class="collapsed" data-bs-toggle="collapse" href="#faqtwo" aria-expanded="false">2.
                                What are the steps to sell a house?</a>
                        </h4>
                        <div id="faqtwo" class="card-collapse collapse">
                            <div class="faq-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-card" data-aos="fade-down" data-aos-duration="2000">
                        <h4 class="faq-title">
                            <a class="" data-bs-toggle="collapse" href="#faqthree" aria-expanded="false">3. Do
                                you have loan consultants?</a>
                        </h4>
                        <div id="faqthree" class="card-collapse collapse show">
                            <div class="faq-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-card" data-aos="fade-down" data-aos-duration="2000">
                        <h4 class="faq-title">
                            <a class="collapsed" data-bs-toggle="collapse" href="#faqfour" aria-expanded="false">4.
                                When will the project be completed?</a>
                        </h4>
                        <div id="faqfour" class="card-collapse collapse">
                            <div class="faq-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-card" data-aos="fade-down" data-aos-duration="2000">
                        <h4 class="faq-title">
                            <a class="collapsed" data-bs-toggle="collapse" href="#faqfive"
                                aria-expanded="false">5.What are the steps to rent a house?</a>
                        </h4>
                        <div id="faqfive" class="card-collapse collapse">
                            <div class="faq-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Faq -->

    <!-- Agent Register -->
  
    <!-- /Agent Register -->

    <!-- Latest Blog -->
    <section class="latest-blog-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="section-heading text-center">
                        <h2>Latest Blog</h2>
                        <div class="sec-line">
                            <span class="sec-line1"></span>
                            <span class="sec-line2"></span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmodtempor incididunt</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-slider owl-carousel">

                        <!-- Blog -->
                        <div class="blog-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="blog-img">
                                <a href="{{ url('blog-details') }}"><img
                                        src="{{ URL::asset('/assets/img/blog/blog-1.jpg') }}" alt="Blog Image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-property">
                                    <span>Property</span>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{ url('blog-details') }}">How to achieve financial independence</a>
                                    </h3>
                                    <p>There are many variations of passages of lorem ipsum available.</p>
                                </div>
                                <ul class="property-category d-flex justify-content-between align-items-center">
                                    <li class="user-info">
                                        <a href="javascript:void(0);"><img
                                                src="{{ URL::asset('/assets/img/profiles/avatar-01.jpg') }}"
                                                class="img-fluid avatar" alt="User"></a>
                                        <div class="user-name">
                                            <h6><a href="javascript:void(0);">Doe John</a></h6>
                                            <p>Posted on : 15 Jan 2023</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog-details') }}"><span><i
                                                    class='fa-solid fa-arrow-right'></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Blog -->

                        <!-- Blog -->
                        <div class="blog-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="blog-img">
                                <a href="{{ url('blog-details') }}"><img
                                        src="{{ URL::asset('/assets/img/blog/blog-2.jpg') }}" alt="Blog Image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-property">
                                    <span>Advantages</span>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{ url('blog-details') }}">The most popular cities for homebuyers</a>
                                    </h3>
                                    <p>There are many variations of passages of lorem ipsum available.</p>
                                </div>
                                <ul class="property-category d-flex justify-content-between align-items-center">
                                    <li class="user-info">
                                        <a href="javascript:void(0);"><img
                                                src="{{ URL::asset('/assets/img/profiles/avatar-03.jpg') }}"
                                                class="img-fluid avatar" alt="User"></a>
                                        <div class="user-name">
                                            <h6><a href="javascript:void(0);">John</a></h6>
                                            <p>Posted on : 15 Jan 2023</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog-details') }}"><span><i
                                                    class='fa-solid fa-arrow-right'></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Blog -->

                        <!-- Blog -->
                        <div class="blog-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="blog-img">
                                <a href="{{ url('blog-details') }}"><img
                                        src="{{ URL::asset('/assets/img/blog/blog-3.jpg') }}" alt="Blog Image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-property">
                                    <span>Finanace</span>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{ url('blog-details') }}">Learn how real estate really shapes our
                                            future</a>
                                    </h3>
                                    <p>There are many variations of passages of lorem ipsum available.</p>
                                </div>
                                <ul class="property-category d-flex justify-content-between align-items-center">
                                    <li class="user-info">
                                        <a href="javascript:void(0);"><img
                                                src="{{ URL::asset('/assets/img/profiles/avatar-05.jpg') }}"
                                                class="img-fluid avatar" alt="User"></a>
                                        <div class="user-name">
                                            <h6><a href="javascript:void(0);">Eric Krok</a></h6>
                                            <p>Posted on : 15 Jan 2023</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog-details') }}"><span><i
                                                    class='fa-solid fa-arrow-right'></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Blog -->

                        <!-- Blog -->
                        <div class="blog-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="blog-img">
                                <a href="{{ url('blog-details') }}"><img
                                        src="{{ URL::asset('/assets/img/blog/blog-2.jpg') }}" alt="Blog Image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-property">
                                    <span>Property</span>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{ url('blog-details') }}">The most popular cities for homebuyers</a>
                                    </h3>
                                    <p>There are many variations of passages of lorem ipsum available.</p>
                                </div>
                                <ul class="property-category d-flex justify-content-between align-items-center">
                                    <li class="user-info">
                                        <a href="javascript:void(0);"><img
                                                src="{{ URL::asset('/assets/img/profiles/avatar-07.jpg') }}"
                                                class="img-fluid avatar" alt="User"></a>
                                        <div class="user-name">
                                            <h6><a href="javascript:void(0);">Francis</a></h6>
                                            <p>Posted on : 12 May 2023</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog-details') }}"><span><i
                                                    class='fa-solid fa-arrow-right'></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Blog -->

                        <!-- Blog -->
                        <div class="blog-card" data-aos="fade-down" data-aos-duration="2000">
                            <div class="blog-img">
                                <a href="{{ url('blog-details') }}"><img
                                        src="{{ URL::asset('/assets/img/blog/blog-1.jpg') }}" alt="Blog Image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-property">
                                    <span>Property</span>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{ url('blog-details') }}">How to achieve financial independence</a>
                                    </h3>
                                    <p>There are many variations of passages of lorem ipsum available.</p>
                                </div>
                                <ul class="property-category d-flex justify-content-between align-items-center">
                                    <li class="user-info">
                                        <a href="javascript:void(0);"><img
                                                src="{{ URL::asset('/assets/img/profiles/avatar-03.jpg') }}"
                                                class="img-fluid avatar" alt="User"></a>
                                        <div class="user-name">
                                            <h6><a href="javascript:void(0);">Rafael</a></h6>
                                            <p>Posted on : 13 Jan 2023</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog-details') }}"><span><i
                                                    class='fa-solid fa-arrow-right'></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Blog -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Latest Blog -->

    <!-- News Letter -->
    <section class="news-letter-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="news-heading" data-aos="fade-down" data-aos-duration="2000">
                        <h2>Sign Up for Our Newsletter</h2>
                        <p>Lorem ipsum dolor sit amet, consecte tur cing elit. Suspe ndisse suscipit sagittis</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="email-form" data-aos="fade-down" data-aos-duration="2000">
                        <form action="#">
                            <input type="email" class="form-control" placeholder="Enter Email Address">
                            <button class="btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Letter -->
@endsection
