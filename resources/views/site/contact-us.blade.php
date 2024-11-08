<?php $page = 'contact-us'; 
use App\Helpers\Helper;
?>
@extends('site.layout.mainlayout')
@section('content')
    @component('site.components.breadcrumb')
        @slot('title')
        {!! Helper::pageContent('contact-us','contact-us title') !!}
        @endslot
        @slot('li_1')
        {!! Helper::pageContent('contact-us','contact-us li_1') !!}
        @endslot
        @slot('li_2')
        {!! Helper::pageContent('contact-us','contact-us li_2') !!}
        @endslot
    @endcomponent

    <!-- Contact us -->
    <section class="section contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 d-flex">
                                <div class="card">
                                    <div class="card-body contact-info flex-fill">
                                        <h3>{!! Helper::pageContent('contact-us','contact-section-h3_1') !!}</h3>
                                        <p>{!! Helper::pageContent('contact-us','contact-section-p_1') !!}</p>
                                        <a href="javascript:void(0);" class="btn-primary d-inline-block">{!! Helper::pageContent('contact-us','contact-section-a_1') !!}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex">
                                <div class="card">
                                    <div class="card-body contact-info flex-fill">
                                        <h3>{!! Helper::pageContent('contact-us','contact-section-h3_2') !!}</h3>
                                        <p>{!! Helper::pageContent('contact-us','contact-section-p_2') !!}</p>
                                        <a href="{{ url('faq') }}" class="btn-primary d-inline-block">{!! Helper::pageContent('contact-us','contact-section-a_2') !!}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('/assets/img/contact.jpg') }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Contact us -->

    <!-- Contact Info Details -->
    <section class="section contact-info-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('contactUsSendEmail') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3>{!! Helper::pageContent('contact-us','contact-info-sec-h3') !!}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>{!! Helper::pageContent('contact-us','contact-info-sec-label_1') !!}</label>
                                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>{!! Helper::pageContent('contact-us','contact-info-sec-label_2') !!}</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Enter Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>{!! Helper::pageContent('contact-us','contact-info-sec-label_3') !!}</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="select">
                                                <option value="0">Select </option>
                                                <option value="India">India</option>
                                                <option value="United States">United States</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Qatar">Qatar</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>{!! Helper::pageContent('contact-us','contact-info-sec-label_4') !!}</label>
                                            <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{!! Helper::pageContent('contact-us','contact-info-sec-label_5') !!}</label>
                                            <textarea class="form-control" name="comment" rows="14" placeholder="Comments"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn-primary">{!! Helper::pageContent('contact-us','contact-info-sec-btn') !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h3>{!! Helper::pageContent('contact-us','contact-info-sec-h3_1') !!}</h3>
                    <div class="row">
                        <div class="col-lg-12 d-flex">
                            <div class="flex-fill">
                                <div class="contact-info-details d-flex align-items-center">
                                    <span><img src="{{ URL::asset('/assets/img/icons/phone.svg') }}" alt="Image"></span>
                                    <div>
                                        <h4>{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-h4') !!}</h4>
                                        <a href="tel:{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-tel1') !!}">{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-tel1') !!}</a>,
                                        <a href="tel:{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-tel2') !!}">{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-tel2') !!}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex">
                            <div class="flex-fill">
                                <div class="contact-info-details d-flex align-items-center">
                                    <span><img src="{{ URL::asset('/assets/img/icons/mail.svg') }}" alt="Image"></span>
                                    <div>
                                        <h4>{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-h4_1') !!}</h4>
                                        <a href="mailto:{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-a') !!}">{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-a') !!}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex">
                            <div class="flex-fill">
                                <div class="contact-info-details d-flex align-items-center">
                                    <span><img src="{{ URL::asset('/assets/img/icons/map-pin.svg') }}"
                                            alt="Image"></span>
                                    <div>
                                        <h4>{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-h4_2') !!}</h4>
                                        <p>{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-p_1') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map-location">
                        <h3>{!! Helper::pageContent('contact-us','contact-info-sec contact-info-details-h3') !!}</h3>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.8862835683544!2d-73.98256668525309!3d41.93829486962529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89dd0ee3286615b7%3A0x42bfa96cc2ce4381!2s132%20Kingston%20St%2C%20Kingston%2C%20NY%2012401%2C%20USA!5e0!3m2!1sen!2sin!4v1670922579281!5m2!1sen!2sin"
                            height="359"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Contact Info Details -->
@endsection
