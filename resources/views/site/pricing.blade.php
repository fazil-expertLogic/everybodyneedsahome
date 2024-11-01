<?php $page = 'pricing'; ?>
@extends('site.layout.mainlayout')
@section('content')
@component('site.components.breadcrumb')
@slot('title')
Pricing Plan
@endslot
@slot('li_1')
Home
@endslot
@slot('li_2')
Pricing Plan
@endslot
@endcomponent

<!-- Pricing -->
<section class="price-section section">
    <div class="container">
        <div class="pricing-tab align-items-center justify-content-center">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Monthly</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false" tabindex="-1">Yearly</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row justify-content-center">
                    @foreach($membershipsMonthly as $monthly)
                    <div class="col-lg-4 col-md-6">
                        <div class="price-card aos" data-aos="flip-right" data-aos-easing="ease-out-cubic">
                            <div class="price-title">
                                <h3>{{$monthly->name}}</h3>
                                <p>{{$monthly->description}}</p>
                            </div>
                            <div class="price-features bg-white">
                                <h5>Key Features</h5>
                                <ul>
                                    @foreach(explode(',', $monthly->features) as $feature)
                                    <li><span><i class="fa-regular fa-square-check"></i></span>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="price-btn">
                                <a href="javascript:void(0);" class="btn-primary">Get Quote</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row justify-content-center">
                    @foreach($membershipsYearly as $monthly)
                    <div class="col-lg-4 col-md-6">
                        <div class="price-card aos" data-aos="flip-right" data-aos-easing="ease-out-cubic">
                            <div class="price-title">
                                <h3>{{$monthly->name}}</h3>
                                <p>{{$monthly->description}}</p>
                            </div>
                            <div class="price-features bg-white">
                                <h5>Key Features</h5>
                                <ul>
                                    @foreach(explode(',', $monthly->features) as $feature)
                                    <li><span><i class="fa-regular fa-square-check"></i></span>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="price-btn">
                                <a href="javascript:void(0);" class="btn-primary">Get Quote</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Pricing -->
@endsection