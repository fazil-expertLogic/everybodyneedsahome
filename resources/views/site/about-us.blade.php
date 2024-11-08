<?php $page = 'about-us'; 
use App\Helpers\Helper;
?>
@extends('site.layout.mainlayout')
@section('content')
    @component('site.components.breadcrumb')
        @slot('title')
            {!! Helper::pageContent('about-us','about-us title') !!}
        @endslot
        @slot('li_1')
            {!! Helper::pageContent('about-us','about-us li_1') !!}
        @endslot
        @slot('li_2')
            {!! Helper::pageContent('about-us','about-us li_2') !!}
        @endslot
    @endcomponent
    <!-- About Us -->
    <section class="aboutus-section">
        <div class="container">
            <!-- About Content -->
            <div class="about-content">
                <h6>{!! Helper::pageContent('about-us','aboutus-section about-content-h6') !!}</h6>
                <h1>{!! Helper::pageContent('about-us','aboutus-section about-content-h1') !!}</h1>
                <p>{!! Helper::pageContent('about-us','aboutus-section about-content-p') !!}</p>

                <p class="mb-0">{!! Helper::pageContent('about-us','aboutus-section about-content-p-mb-0') !!}</p>
            </div>
            <!-- /About Content -->
        </div>
    </section>
    <!-- /About Us -->

    <!-- About Counter -->
    <section class="about-counter-sec">
        <div class="container">
            <!-- About Images listing -->
            <div class="about-listing-img">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="about-listing">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','about-us-01')) }}" alt="aboutus-01">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="about-listing">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','about-us-02')) }}" alt="aboutus-02">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 col-sm-12">
                        <div class="about-listing">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','about-us-03')) }}" alt="aboutus-03">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /About Images listing -->

            <!-- About Count -->
            <div class="counter-sec">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="counter-box flex-fill">
                            <div class="counter-icon">
                                <img src="{{ URL::asset(Helper::pageContent('about-us','counter-icon-1')) }}" alt="icon">
                            </div>
                            <div class="counter-value">
                                <h3 class="dash-count"><span class="counter-up">50</span>K</h3>
                                <h5>{!! Helper::pageContent('about-us','counter-sec icon-1') !!}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="counter-box flex-fill">
                            <div class="counter-icon">
                                <img src="{{ URL::asset(Helper::pageContent('about-us','counter-icon-2')) }}" alt="icon">
                            </div>
                            <div class="counter-value">
                                <h3 class="dash-count"><span class="counter-up">3000</span>+</h3>
                                <h5>{!! Helper::pageContent('about-us','counter-sec icon-2') !!}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="counter-box active flex-fill">
                            <div class="counter-icon">
                                <img src="{{ URL::asset(Helper::pageContent('about-us','counter-icon-3')) }}" alt="icon">
                            </div>
                            <div class="counter-value">
                                <h3 class="dash-count"><span class="counter-up">2000</span>+</h3>
                                <h5>{!! Helper::pageContent('about-us','counter-sec icon-3') !!}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                        <div class="counter-box flex-fill">
                            <div class="counter-icon">
                                <img src="{{ URL::asset(Helper::pageContent('about-us','counter-sec-img_4')) }}" alt="icon">
                            </div>
                            <div class="counter-value">
                                <h3 class="dash-count"><span class="counter-up">5000</span>+</h3>
                                <h5>{!! Helper::pageContent('about-us','counter-sec icon-4') !!}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /About Count -->
        </div>
    </section>
    <!-- /About Counter -->

    <!-- Book Place -->
    <div class="section book-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="book-listing">
                        <h2>{!! Helper::pageContent('about-us','book-section book-listing-h2') !!}</h2>
                        <img src="{{ URL::asset(Helper::pageContent('about-us','about-us-04')) }}" alt="aboutus-03">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="book-content">
                        <p>{!! Helper::pageContent('about-us','book-section book-content-p1') !!}<span>{!! Helper::pageContent('about-us','book-section book-content-span1') !!}</span></p>

                        <p>{!! Helper::pageContent('about-us','book-section book-content-p2') !!} <span>{!! Helper::pageContent('about-us','book-section book-content-span2') !!}</span> </p>

                        <p class="mb-0">{!! Helper::pageContent('about-us','book-section book-content-p3') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Book Place -->

    <!-- Partners -->
    <section class="section partners-sec">
        <div class="container">
            <div class="section-heading text-center">
                <h2>{!! Helper::pageContent('about-us','partners-sec section-heading-h2') !!}</h2>
                <div class="sec-line">
                    <span class="sec-line1"></span>
                    <span class="sec-line2"></span>
                </div>
                <p>{!! Helper::pageContent('about-us','partners-sec section-heading-p') !!}</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="partners-slider owl-carousel">
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-1')) }}" alt="Partners">
                        </div>
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-2')) }}" alt="Partners">
                        </div>
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-3')) }}" alt="Partners">
                        </div>
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-4')) }}" alt="Partners">
                        </div>
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-5')) }}" alt="Partners">
                        </div>
                        <div class="partner-icon">
                            <img src="{{ URL::asset(Helper::pageContent('about-us','partner-icon-6')) }}" alt="Partners">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Partners -->
@endsection
