<?php $page = 'buy-property-grid'; 
?>
@extends('site.layout.mainlayout')
@section('content')
    @component('site.components.breadcrumb')
        @slot('title')
        {!! $page_content['buy-property-grid title'] !!} 
        @endslot
        @slot('li_1')
        {!! $page_content['buy-property-grid li_1'] !!} 
        @endslot
        @slot('li_2')
        {!! $page_content['buy-property-grid li_2'] !!}
        @endslot
    @endcomponent

    <!-- Feature Property For Rent -->
    <div class="listing-section">
        <div class="container">

            @component('site.components.buy-sortresult')
            @endcomponent

            <div class=" for-rent p-0">
                <div class="row">
                    @foreach ($properties as $property)
                    <!-- Buy grid -->    
                    <div class="col-lg-4 col-md-6">
                        <div class="product-custom">
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="{{ url('property-detail/'. $property->id) }}" class="property-img">
                                        <img class="img-fluid" alt="Property Image"
                                            src="{{ $property->main_picture ? asset('storage/' . $property->main_picture) : URL::asset($page_content['product-1-img']) }}">
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
                                        <img src="{{ URL::asset($page_content['avatar-01-img']) }}" alt="User">
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
                                        <a href="{{ url('property-detail/'. $property->id) }}" tabindex="-1">{{$property->property_name}}</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>{{$property->property_address}}</p>
                                    <ul class="d-flex details">
                                        <li>
                                            <img src="{{ URL::asset($page_content['bed-icon-img']) }}" alt="bed-icon">
                                            {{$property->number_of_bedrooms_house}} Beds
                                        </li>
                                        <li>
                                            <img src="{{ URL::asset( $page_content['bath-icon-img']) }}" alt="bath-icon">
                                            {{$property->number_of_bath_house}} Baths
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
            </div>

            <!-- Pagination -->
            <div class="grid-pagination">
                <ul class="pagination justify-content-center">
                    @if ($properties->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="javascript:void(0);" tabindex="-1">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $properties->previousPageUrl() }}">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @endif

                    {{-- Page Links --}}
                    @for ($i = 1; $i <= $properties->lastPage(); $i++)
                        <li class="page-item {{ ($properties->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $properties->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Next Button --}}
                        @if ($properties->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $properties->nextPageUrl() }}">
                                <i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0);">
                                <i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        @endif
                </ul>
            </div>
            <!-- /Pagination -->
        </div>
    </div>
    <!-- /Feature Property For Rent -->
@endsection
