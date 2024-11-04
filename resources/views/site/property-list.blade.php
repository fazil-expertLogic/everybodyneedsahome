<?php $page = 'property-list'; ?>
@extends('site.layout.mainlayout')
@section('content')
@component('site.components.breadcrumb')
@slot('title')
Buy Property List With Sidebar
@endslot
@slot('li_1')
Home
@endslot
@slot('li_2')
Buy Property List With Sidebar
@endslot
@endcomponent

<!-- Feature Property For Rent -->
<div class="property-sidebar">
    <section class="feature-property-sec for-rent content">
        <div class="container">
            @component('site.components.buy-sortresult')
            @endcomponent
            <div class="row">

                @component('site.components.search')
                @endcomponent

                <div class="col-xl-9">

                    <div class="row justify-content-center buy-list">

                        <!-- Buy List -->
                        @foreach ($properties as $property)
                        <div class="col-lg-12">
                            <div class="product-custom">
                                <div class="profile-widget rent-list-view">
                                    <div class="doc-img">
                                        <a href="{{ url('buy-details') }}" class="property-img">
                                            <img class="img-fluid" alt="Product image"
                                                src="{{ $property->main_picture ? asset('storage/' . $property->main_picture) : URL::asset('assets/img/product/product-1.jpg') }}">
                                        </a>
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
                                        <a href="javascript:void(0)">
                                            <div class="favourite">
                                                <span><i class="fa-regular fa-heart"></i></span>
                                            </div>
                                        </a>
                                        <div class="user-avatar">
                                            <img src="{{ URL::asset('/assets/img/profiles/avatar-02.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <div class="list-head">
                                            <div class="rating">
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <span class="me-1">5.0</span> (20 Reviews)
                                                <div class="product-name-price">
                                                    <h3 class="title">
                                                        <a href="{{ url('buy-details') }}" tabindex="-1">{{$property->property_name}}</a>
                                                    </h3>
                                                    <div class="product-amount">
                                                        <h5><span>${{ number_format($property->bed_fee + $property->bedroom_fee + $property->unit_fee,2) }} </span></h5>
                                                    </div>
                                                </div>
                                                <p><i class="feather-map-pin"></i> {{$property->property_address}}</p>
                                            </div>

                                        </div>
                                        <ul class="d-flex details">
                                            <li>
                                                <img src="{{ URL::asset('/assets/img/icons/bed-icon.svg') }}"
                                                    alt="bed-icon">
                                                    {{$property->number_of_beds}} Beds
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset('/assets/img/icons/bath-icon.svg') }}"
                                                    alt="bath-icon">
                                                    {{$property->number_of_bedrooms}} Bath
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset('/assets/img/icons/building-icon.svg') }}"
                                                    alt="building-icon">
                                                15000 Sqft
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

                        @endforeach
                        <!-- Pagination -->
                        <div class="grid-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item prev">
                                    <a class="page-link" href="javascript:void(0);"><i
                                            class="fa-solid fa-arrow-left"></i> Prev</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">4</a>
                                </li>
                                <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);">Next <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /Pagination -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /Feature Property For Rent -->
@endsection