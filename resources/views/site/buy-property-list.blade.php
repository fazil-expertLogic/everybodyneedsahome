<?php $page = 'buy-property-list'; 
?>
@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
        {!! $page_content['buy-property-list title'] !!} 
        @endslot
        @slot('li_1')
        {!! $page_content['buy-property-list li_1'] !!} 
        @endslot
        @slot('li_2')
        {!! $page_content['buy-property-list li_2'] !!}
        @endslot
    @endcomponent

    <!-- Feature Property For Rent -->
    <section class="feature-property-sec for-rent bg-white listing-section">
        <div class="container">
            @component('components.buy-sortresult')
            @endcomponent

            <div class="row justify-content-center buy-list">

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-01-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <div class="new-featured">
                                    <span>New</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite selected">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-02-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        5.0 (20 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Place perfect for
                                                    nature</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$41,400 </span></h5>
                                            </div>
                                        </div>
                                        <p><i class="feather-map-pin"></i> 318-330 S Oakley Blvd, Chicago, IL 60612, USA</p>
                                    </div>

                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        2 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        3 Baths
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        10000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">17 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date">Condos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-02-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-01-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <span class="me-1">5.0</span> (12 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Modern Apartment</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$1,400 </span></h5>
                                            </div>
                                        </div>
                                        <p><i class="feather-map-pin"></i> 318-330 S Oakley Blvd, Chicago, IL 60612, USA</p>
                                    </div>
                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        3 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        2 Baths
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        14000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">17 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date">Condos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-03-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite selected">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-03-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <span class="me-1">4.0</span> (3 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Two storey modern
                                                    flat</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$21,400 </span></h5>
                                            </div>
                                        </div>
                                        <p><i class="feather-map-pin"></i> 470 Park Ave S, New York, NY 10016</p>
                                    </div>
                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        2 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        3 Baths
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        12000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">13 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date">Flat</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-04-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-04-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="me-1">3.0</span> (3 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Beautiful Condo
                                                    Room</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$12,400 </span></h5>
                                            </div>
                                        </div>

                                        <p><i class="feather-map-pin"></i> 470 Park Ave S, New York, NY 10016</p>
                                    </div>
                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        2 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        2 Baths
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        18000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">17 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date"> Home</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-01-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-05-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <span class="me-1">5.0</span> (30 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Minimalist and bright
                                                    flat</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$48,400 </span></h5>
                                            </div>
                                        </div>
                                        <p><i class="feather-map-pin"></i>518-520 8th Ave, New York, NY 10018, USA</p>
                                    </div>

                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        4 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        1 Bath
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        25000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">27 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date"> Home</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

                <!-- Buy List -->
                <div class="col-lg-12">
                    <div class="product-custom">
                        <div class="profile-widget rent-list-view">
                            <div class="doc-img">
                                <a href="{{ url('buy-details') }}" class="property-img">
                                    <img class="img-fluid" alt="Property Image"
                                        src="{{ URL::asset($page_content['rent-list-06-img']) }}">
                                </a>
                                <div class="featured">
                                    <span>Featured</span>
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="favourite">
                                        <span><i class="fa-regular fa-heart"></i></span>
                                    </div>
                                </a>
                                <div class="user-avatar">
                                    <img src="{{ URL::asset($page_content['avatar-06-img']) }}" alt="User">
                                </div>
                            </div>
                            <div class="pro-content">
                                <div class="list-head">
                                    <div class="rating">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="me-1">3.0</span> (30 Reviews)
                                        <div class="product-name-price">
                                            <h3 class="title">
                                                <a href="{{ url('buy-details') }}" tabindex="-1">Summer house</a>
                                            </h3>
                                            <div class="product-amount">
                                                <h5><span>$48,400 </span></h5>
                                            </div>
                                        </div>
                                        <p><i class="feather-map-pin"></i>122-140 N Morgan St, Chicago, IL 60607, USA</p>
                                    </div>
                                </div>
                                <ul class="d-flex details">
                                    <li>
                                        <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                        4 Beds
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['bath-icon-img']) }}" alt="bath-icon">
                                        2 Baths
                                    </li>
                                    <li>
                                        <img src="{{ URL::asset($page_content['building-icon-img']) }}"
                                            alt="building-icon">
                                        15000 Sqft
                                    </li>
                                </ul>
                                <ul class="property-category d-flex justify-content-between">
                                    <li>
                                        <span class="list">Listed on : </span>
                                        <span class="date">27 Jan 2023</span>
                                    </li>
                                    <li>
                                        <span class="category list">Category : </span>
                                        <span class="category-value date"> Apartments</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Buy List -->

            </div>
        </div>
    </section>
    <!-- /Feature Property For Rent -->
@endsection
