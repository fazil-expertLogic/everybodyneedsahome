<?php $page = 'register'; ?>
@extends('site.layout.mainlayout')

@section('content')
    <link rel="icon" href="{{ asset('build/assets/images/brand/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('build/assets/images/brand/favicon.ico') }}" type="image/x-icon">
    <link id="style" href="{{ asset('build/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- @vite(['resources/sass/app.scss']) --}}
    <link href="{{ asset('build/assets/iconfonts/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/iconfonts/animated.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <!-- Bootstrap Stylesheets -->
    <link rel="stylesheet" href="{{ asset('wizard-form/css/bootstrap.min.css') }}">
    <!-- Font Awesome Stylesheets -->
    <link rel="stylesheet" href="{{ asset('wizard-form/css/fontawesome/all.min.css') }}">
    <!-- bootstrap-datepicker Stylesheets -->
    <link rel="stylesheet" href="{{ asset('wizard-form/css/bootstrap-datepicker3.min.css') }}">
    <!-- sweetalert Stylesheets -->
    <link rel="stylesheet" href="{{ asset('wizard-form/css/sweetalert.css') }}" type="text/css">
    <!-- Template Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('wizard-form/css/reg-form.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('wizard-form/css/reg-form-modern.css') }}" type="text/css">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('guests.guest_registration_post') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <h3 class="section-form-title mt-3">Guest Registration</h3>
                                    <h3 class="section-title">Step 1 of 5</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 0%;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Personal Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Contact Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="far fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">3- Housing and Legal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- References and Emergency Contact</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Employment and Financial Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <input type="hidden" name="front" class="form-control py-2" value="front">
                                                <div class="form-group valid_name @if($errors->has('name')) has-error has-danger @endif">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" value="{{old('name')}}" id="name" placeholder="Your name" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('name'))
                                                        <div class="help-block with-errors">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_email">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="{{old('email')}}" required data-error="Please enter email">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group validpass">
                                                    <label for="pass" class="form-label">Password<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass" name="pass" placeholder="password" required data-error="Please enter password">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group validpass">
                                                    <label for="pass_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass_confirmation" name="pass_confirmation" placeholder="Confirm Password" required data-error="Please enter confirm password">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_ssn @if($errors->has('snn')) has-error has-danger @endif">
                                                    <label for="ssn" class="form-label">Social Security Number<span  class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 ssn-input-mask"  value="{{old('snn')}}" name="ssn" id="ssn" placeholder="*****"  required data-error="Please enter Social Security Number">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('snn'))
                                                        <div class="help-block with-errors">{{ $errors->first('snn') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_dob">
                                                    <label for="dob" class="form-label"> Date of Birth<span class="text-danger">*</span></label>
                                                    <input type="date" name="dob" class="form-control py-2"id="dob" placeholder="" value="{{old('dob')}}" required data-error="Please enter Date of Birth">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group signUpForm-step-1">
                                          
                                            <button class="btn btn-custom float-end" onclick="nextStep2()"
                                                type="button">Next <span class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-2" class="signUpForm-step-wrap slide-right">
                                    <h3 class="section-title">Step 2 of 5</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 37.25%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Personal Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Contact Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Housing and Legal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- References and Emergency Contac</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Employment and Financial Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>


                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">

                                            <div class="col-sm-6 col-lg-6 form-group valid_address">
                                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required data-error="Please enter address">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_address2">
                                                <label for="address2" class="form-label">Address2<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address2" name="address2" value="{{old('address2')}}" required data-error="Please enter address">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_city">
                                                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required data-error="Please enter city">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_state">
                                                <label for="state" class="form-label"> State <span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="state" name="state" aria-label="State" data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_zip_code">
                                                    <label for="zip_code" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" name="zip_code" class="form-control py-2 zip-input-mask" id="zip_code" placeholder="Zip Code" value="{{old('zip_code')}}" required data-error="Please enter Zip Code">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_phone">
                                                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="text" name="phone" class="form-control py-2 phone-input-mask" id="phone" placeholder="Phone" value="{{old('phone')}}" required data-error="Please enter phone">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group signUpForm-step-2">
                                            <button class="btn btn-custom" type="button" onclick="previousStep1()"><span
                                                    class="fas fa-arrow-left"></span> Back</button>
                                            <button class="btn btn-custom float-end" type="button"
                                                onclick="nextStep3()">Next <span
                                                    class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-3" class="signUpForm-step-wrap slide-right">
                                    <h3 class="section-title">Step 3 of 5</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 62.25%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Personal Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Contact Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Housing and Legal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- References and Emergency Contac</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Employment and Financial Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">

                                            <div class="col-sm-6 col-lg-6 form-group valid_evicted">
                                                <label for="evicted" class="form-label">Have you ever been evicted?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="evicted" name="evicted" aria-label="Evicted" required data-error="Please select evicted" onchange="evictedDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            {{-- evicted --}}
                                            <div id="evictedDiv">
                                                <p>Eviction Details:</p>
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_eviction_property_name">
                                                            <label for="eviction_property_name" class="form-label">Eviction Property Name<span class="text-danger">*</span></label>
                                                            <input type="text" name="eviction_property_name" class="form-control py-2 zip-input-mask" id="eviction_property_name" placeholder="Property Name" value="{{old('eviction_property_name')}}" data-error="Please enter Property Name">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_eviction_manager_name">
                                                            <label for="eviction_manager_name" class="form-label">Eviction Manager's Name<span class="text-danger">*</span></label>
                                                            <input type="text" name="eviction_manager_name" class="form-control py-2 zip-input-mask" id="eviction_manager_name" placeholder="Manager Name" value="{{old('eviction_manager_name')}}" data-error="Please enter Manager Name">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_eviction_address">
                                                            <label for="eviction_address" class="form-label">Eviction Address<span class="text-danger">*</span></label>
                                                            <input type="text" name="eviction_address" class="form-control py-2 zip-input-mask" id="eviction_address" placeholder="Eviction Address" value="{{old('eviction_address')}}" data-error="Please enter Property Name">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_eviction_phone">
                                                            <label for="eviction_phone" class="form-label">Eviction phone<span class="text-danger">*</span></label>
                                                            <input type="text" name="eviction_phone" class="form-control py-2 eviction_phone-input-mask" id="eviction_phone" placeholder="eviction_phone" value="{{old('eviction_phone')}}" data-error="Please enter eviction_phone">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_eviction_date">
                                                            <label for="eviction_date" class="form-label"> Date of Eviction<span class="text-danger">*</span></label>
                                                            <input type="date" name="eviction_date" class="form-control py-2"id="eviction_date" placeholder="" value="{{old('eviction_date')}}" data-error="Please enter Date of Eviction">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6 form-group valid_eviction_comments">
                                                        <label for="eviction_comments">Comments<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="eviction_comments" name="eviction_comments"  data-error="Please select"></textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                </div>
                                            </div>  

                                            <div class="col-sm-6 col-lg-6 form-group valid_convicted">
                                                <label for="convicted" class="form-label">Have you ever been convicted of a crime?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="convicted" name="convicted" aria-label="convicted" required data-error="Please select convicted" onchange="convictedDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            {{-- convicted  --}}
                                            <div id="convictedDiv">
                                                <p>Conviction Details:</p>
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_conviction_year">
                                                            <label for="conviction_year" class="form-label">Year<span class="text-danger">*</span></label>
                                                            <input type="text" name="conviction_year" class="form-control py-2" id="conviction_year" placeholder="Conviction Year" value="{{old('conviction_year')}}" data-error="Please enter Conviction Year">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_conviction_charge">
                                                            <label for="conviction_charge" class="form-label">Charge/Conviction<span class="text-danger">*</span></label>
                                                            <input type="text" name="conviction_charge" class="form-control py-2" id="conviction_charge" placeholder="Charge/Conviction" value="{{old('conviction_charge')}}" data-error="Please enter Charge/Conviction">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6">
                                                        <div class="form-group valid_conviction_sentence">
                                                            <label for="conviction_sentence" class="form-label">Sentence<span class="text-danger">*</span></label>
                                                            <input type="text" name="conviction_sentence" class="form-control py-2" id="conviction_sentence" placeholder="Sentence" value="{{old('conviction_sentence')}}" data-error="Please enter Sentence">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-lg-6 form-group valid_sex_offender">
                                                        <label for="sex_offender" class="form-label">Are you a registered sex offender?<span class="text-danger">*</span></label>
                                                        <select class="form-select py-2" id="sex_offender" name="sex_offender" aria-label="sex_offender"  data-error="Please select sex_offender" onchange="sexOffenderDiv()">
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    {{-- sexOffenderDiv --}}
                                                    <div id='sexOffenderDiv'>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-lg-6 form-group valid_victim_minor">
                                                                <label for="victim_minor" class="form-label">Was your victim a minor?<span class="text-danger">*</span></label>
                                                                <select class="form-select py-2" id="victim_minor" name="victim_minor" aria-label="victim_minor"  data-error="Please select Victim Minor">
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="form-group valid_age_difference">
                                                                    <label for="age_difference" class="form-label">How many years apart were you in age from your victim?<span class="text-danger">*</span></label>
                                                                    <input type="text" name="age_difference" class="form-control py-2" id="age_difference" placeholder="Age Difference" value="{{old('age_difference')}}" data-error="Please enter Age Difference">
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-sm-6 col-lg-6 form-group valid_probation">
                                                        <label for="probation" class="form-label">Are you currently on probation or parole?<span class="text-danger">*</span></label>
                                                        <select class="form-select py-2" id="probation" name="probation" aria-label="probation" data-error="Please select probation" onchange="probationDiv()">
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    {{-- sexOffenderDiv --}}
                                                    <div id='probationDiv'>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="form-group valid_probation_officer_name">
                                                                    <label for="probation_officer_name" class="form-label">Supervising Officer Name<span class="text-danger">*</span></label>
                                                                    <input type="text" name="probation_officer_name" class="form-control py-2" id="probation_officer_name" placeholder="Supervising Officer Name" value="{{old('probation_officer_name')}}" data-error="Please enter Supervising Officer Name">
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="form-group valid_probation_officer_phone">
                                                                    <label for="probation_officer_phone" class="form-label">Supervising Officer Phone<span class="text-danger">*</span></label>
                                                                    <input type="text" name="probation_officer_phone" class="form-control py-2" id="probation_officer_phone" placeholder="Supervising Officer Phone" value="{{old('probation_officer_phone')}}" data-error="Please enter Supervising Officer Phone">
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="form-group valid_probation_officer_email">
                                                                    <label for="probation_officer_email" class="form-label">Supervising Officer Email<span class="text-danger">*</span></label>
                                                                    <input type="text" name="probation_officer_email" class="form-control py-2" id="probation_officer_email" placeholder="Supervising Officer Email" value="{{old('probation_officer_email')}}" data-error="Please enter Supervising Officer Email">
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>

                                        <div class="form-group signUpForm-step-3">
                                            <button class="btn btn-custom" type="button" onclick="previousStep2()"><span
                                                    class="fas fa-arrow-left"></span> Back</button>
                                            <button class="btn btn-custom float-end" type="button"
                                                onclick="nextStep4()">Next <span
                                                    class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-4" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-title">Step 4 of 5</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Personal Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Contact Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Housing and Legal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- References and Emergency Contac</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Employment and Financial Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            
                                            <div class="col-sm-6 col-lg-6 form-group valid_ref1_name">
                                                <label for="ref1_name">Reference 1 - Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref1_name')}}" id="ref1_name" name="ref1_name" data-error="Please enter Reference 1 - Name">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref1_phone">
                                                <label for="ref1_phone">Reference 1 - Phone<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref1_phone')}}" id="ref1_phone" name="ref1_phone" data-error="Please enter Reference 1 - Phone">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref1_email">
                                                <label for="ref1_email">Reference 1 - Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref1_email')}}" id="ref1_email" name="ref1_email" data-error="Please enter Reference 1 - Email">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref2_name">
                                                <label for="ref2_name">Reference 2 - Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref2_name')}}" id="ref2_name" name="ref2_name" data-error="Please enter Reference 2 - Name">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref2_phone">
                                                <label for="ref2_phone">Reference 2 - Phone<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref2_phone')}}" id="ref2_phone" name="ref2_phone" data-error="Please enter Reference 2 - Phone">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref2_email">
                                                <label for="ref2_email">Reference 2 - Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref2_email')}}" id="ref2_email" name="ref2_email" data-error="Please enter Reference 2 - Email">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref3_name">
                                                <label for="ref3_name">Reference 3 - Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref3_name')}}" id="ref3_name" name="ref3_name" data-error="Please enter Reference 3 - Name">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref3_phone">
                                                <label for="ref3_phone">Reference 3 - Phone<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref3_phone')}}" id="ref3_phone" name="ref3_phone" data-error="Please enter Reference 3 - Phone">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_ref3_email">
                                                <label for="ref3_email">Reference 3 - Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('ref3_email')}}" id="ref3_email" name="ref3_email" data-error="Please enter Reference 3 - Email">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                            </div>

                                            {{-- Emergency --}}
                                            <div class="col-sm-6 col-lg-6 form-group valid_emergency_contact_name">
                                                <label for="emergency_contact_name">Emergency Contact Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('emergency_contact_name')}}" id="emergency_contact_name" name="emergency_contact_name" data-error="Please enter Reference 3 - Name">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_emergency_contact_phone">
                                                <label for="emergency_contact_phone">Emergency Contact Phone<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('emergency_contact_phone')}}" id="emergency_contact_phone" name="emergency_contact_phone" data-error="Please enter Reference 3 - Phone">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_emergency_contact_email">
                                                <label for="emergency_contact_email">Emergency Contact Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('emergency_contact_email')}}" id="emergency_contact_email" name="emergency_contact_email" data-error="Please enter Reference 3 - Email">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                        </div>

                                        <div class="form-group signUpForm-step-4">
                                            <button class="btn btn-custom" type="button"
                                                onclick="previousStep3()"><span class="fas fa-arrow-left"></span>
                                                Back</button>
                                            <button class="btn btn-custom float-end" type="button"
                                                onclick="nextStep5()">Next <span
                                                    class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-5" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-title">Step 5 of 5</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Personal Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Contact Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Housing and Legal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- References and Emergency Contac</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon  activestep"><i
                                                                class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Employment and Financial Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_employer_name">
                                                <label for="employer_name">Employer Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('employer_name')}}" id="employer_name" name="employer_name" data-error="Please Enter Employer Name">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_employer_phone">
                                                <label for="employer_phone">Employer Phone<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('employer_phone')}}" id="employer_phone" name="employer_phone" data-error="Please Enter Employer Phone">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_income">
                                                <label for="income">Income<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="{{old('income')}}" id="income" name="income" data-error="Please Enter Income">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_expenses">
                                                <label for="expenses">Expenses<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="{{old('expenses')}}" id="expenses" name="expenses" data-error="Please Enter expenses">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_rental_budget">
                                                <label for="rental_budget">Rental Budget<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" value="{{old('rental_budget')}}" id="rental_budget" name="rental_budget" data-error="Please Enter Rental Budget">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div id="mgsFormSubmit" class="hidden"></div>
                                        <div id="final-step-buttons" class="form-group  signUpForm-step-5">
                                            <button class="btn btn-custom" type="button"
                                                onclick="previousStep4()"><span class="fas fa-arrow-left"></span>
                                                Back</button>
                                            <button id="Submit" class="btn btn-custom float-end" type="submit"
                                                onclick="nextStep6()">Submit </button>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('build/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('build/assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/sidemenu/sidemenu.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/sidebar/sidebar.js') }}"></script> --}}
    @vite('resources/js/app.js')



    <script src="{{ asset('wizard-form/js/jquery-3.5.1.min.js') }}"></script>
    <!-- bootstrap-datepicker Js -->
    <script src="{{ asset('wizard-form/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Form validator Js -->
    <script src="{{ asset('wizard-form/js/validator.min.js') }}"></script>
    <!-- sweetalert Js -->
    <script src="{{ asset('wizard-form/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('wizard-form/js/guest-form.js') }}"></script>
@endsection
