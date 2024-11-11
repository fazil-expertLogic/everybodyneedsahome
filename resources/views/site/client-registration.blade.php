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
                        <form method="post" action="{{ route('clients.client_registration_post') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <h3 class="section-form-title mt-3">Client Registration</h3>
                                    <h3 class="section-title">Step 1 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 0%;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-poll"></i>
                                                        </div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Basic Information</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_name @if($errors->has('cus_name')) has-error has-danger @endif">
                                                    <label for="cus_name" class="form-label">Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="cus_name" class="form-control py-2"
                                                        value="{{old('cus_name')}}" id="cus_name" placeholder="Your name" required
                                                        data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_name'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_email @if($errors->has('cus_email')) has-error has-danger @endif">
                                                    <label for="cus_email" class="form-label"> Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" name="cus_email" class="form-control py-2"
                                                        id="cus_email" placeholder="example@email.com" value="{{old('cus_email')}}"
                                                        required data-error="Please enter email">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_email'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_email') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_pass @if($errors->has('pass')) has-error has-danger @endif">
                                                    <label for="pass" class="form-label">password<span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass"
                                                        name="pass" placeholder="password" required
                                                        data-error="Please enter password">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('pass'))
                                                        <div class="help-block with-errors">{{ $errors->first('pass') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_cpass @if($errors->has('pass_confirmation')) has-error has-danger @endif">
                                                    <label for="pass_confirmation" class="form-label">Confirm Password
                                                        <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2"
                                                        id="pass_confirmation" name="pass_confirmation"
                                                        placeholder="Confirm Password" required
                                                        data-error="Please enter confirm password">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('pass_confirmation'))
                                                        <div class="help-block with-errors">{{ $errors->first('pass_confirmation') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_dob @if($errors->has('cus_dob')) has-error has-danger @endif">
                                                    <label for="cus_dob" class="form-label"> Date of Birth<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" name="cus_dob"
                                                        class="form-control py-2"id="cus_dob" placeholder=""
                                                        value="{{old('cus_dob')}}" required data-error="Please enter Date of Birth">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_dob'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_dob') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ss @if($errors->has('cus_ss')) has-error has-danger @endif">
                                                    <label for="cus_ss" class="form-label">Social Security Number<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 ssn-input-mask"
                                                        value="{{old('cus_ss')}}" name="cus_ss" id="cus_ss" placeholder="*****"
                                                        required data-error="Please enter Social Security Number">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_ss'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_ss') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ms @if($errors->has('martial_status')) has-error has-danger @endif">
                                                    <label for="cus_ms" class="form-label">Marital Status<span
                                                            class="text-danger">*</span></label>
                                                    <select name="martial_status" class="form-select" id="cus_ms"
                                                        aria-label="" required data-error="Please select marital status">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Single</option>
                                                        <option value="2">Married</option>
                                                        <option value="3">Separated</option>
                                                        <option value="4">Divorced</option>
                                                        <option value="5">Widowed</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('martial_status'))
                                                        <div class="help-block with-errors">{{ $errors->first('martial_status') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_is_child @if($errors->has('cus_is_child')) has-error has-danger @endif">
                                                    <label for="cus_is_child" class="form-label">Children<span
                                                            class="text-danger">*</span></label>
                                                    <select name="cus_is_child" class="form-select" id="cus_is_child"
                                                        aria-label="" required data-error="Please select Children"
                                                        onchange="toggleDiv()">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_is_child'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_is_child') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12" id="childinfobox">
                                                <div id="child-boxes-container">
                                                    <div class="row childBOX">
                                                        <div class="col-sm-6 col-lg-6">
                                                            <fieldset class="mb-3">
                                                                <div class="@if($errors->has('child_name')) has-error has-danger @endif">
                                                                <label for="child_name_0" class="form-label">Child
                                                                    Name<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control py-2"
                                                                    value="{{old('child_name')}}" name="child_name[]" id="child_name_0">
                                                                    @if ($errors->has('child_name'))
                                                                        <div class="help-block with-errors">{{ $errors->first('child_name') }}</div>
                                                                    @endif
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="col-sm-6 col-lg-6">
                                                            <fieldset class="">
                                                                <div class="@if($errors->has('child_age')) has-error has-danger @endif">
                                                                <label for="child_age_0" class="form-label">Child Age<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="child_age[]" class="form-select"
                                                                    id="child_age_0" aria-label="">
                                                                    <option value="0" selected="">0+</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="17">17</option>
                                                                    <option value="18">18</option>
                                                                </select>
                                                                @if ($errors->has('child_age'))
                                                                    <div class="help-block with-errors">{{ $errors->first('child_age') }}</div>
                                                                @endif
                                                            </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 text-end">
                                                    <a href="#" class="delete-child-box text-danger"
                                                        style="display: none;">Delete</a> <span class="separator"
                                                        style="display: none;">|</span>
                                                    <a href="#" id="add-new-child" onclick="addchild()"
                                                        class="text-blue">Add new</a>
                                                </div>
                                            </div>
                                            <div id="child-info-container">
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_address @if($errors->has('cus_address')) has-error has-danger @endif">
                                                    <label for="cus_address" class="form-label">Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="cus_address" class="form-control py-2"
                                                        id="cus_address" placeholder="Address" value="{{old('cus_address')}}" required
                                                        data-error="Please enter address">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_address'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_address') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_city @if($errors->has('cus_city')) has-error has-danger @endif">
                                                    <label for="cus_city" class="form-label">City<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="cus_city" class="form-control py-2"
                                                        id="cus_city" placeholder="City" value="{{old('cus_city')}}" required
                                                        data-error="Please enter city">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_city'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_city') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_state @if($errors->has('cus_state')) has-error has-danger @endif">
                                                    <label for="cus_state" class="form-label">State<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select py-2" name="cus_state" id="cus_state"
                                                        aria-label="" required data-error="Please enter state">
                                                        <option value="">Please Select</option>
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
                                                    @if ($errors->has('cus_state'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_state') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_zip @if($errors->has('cus_zip')) has-error has-danger @endif">
                                                    <label for="cus_zip" class="form-label">Zip<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="cus_zip"
                                                        class="form-control py-2 zip-input-mask" id="cus_zip"
                                                        placeholder="Zip" value="{{old('cus_zip')}}" required
                                                        data-error="Please enter zipcode">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_zip'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_zip') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_phone @if($errors->has('cus_phone')) has-error has-danger @endif">
                                                    <label for="cus_phone" class="form-label">Phone<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="cus_phone"
                                                        class="form-control py-2 phone-input-mask" id="cus_phone"
                                                        placeholder="Phone" value="{{old('cus_phone')}}" required
                                                        data-error="Please enter phone">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_phone'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_phone') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-12">
                                                <div class="@if($errors->has('main_picture')) has-error has-danger @endif">
                                                <label for="main_picture" class="form-label">Main Picture*</label>
                                                <input type="file" class="form-control" aria-label="file example"
                                                    name="main_picture">
                                                <div class="invalid-feedback">Example invalid form file feedback</div>
                                                @if ($errors->has('main_picture'))
                                                    <div class="help-block with-errors">{{ $errors->first('main_picture') }}</div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group signUpForm-step-1">
                                          
                                            <button class="btn btn-custom float-end" onclick="nextStep2()"
                                                type="button">Next <span class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-2" class="signUpForm-step-wrap slide-right">
                                    <h3 class="section-title">Step 2 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 37.25%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-poll"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Criminal History</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_pp">
                                                    <div class="@if($errors->has('role')) has-error has-danger @endif">
                                                    <label for="cus_pp" class="form-label">Are you currently on
                                                        probation or parole?<span class="text-danger">*</span></label>
                                                    <select class="form-select" name="role" id="cus_pp" required
                                                        data-error="Please select">
                                                        <option value="">Please select</option>
                                                        <option value="1">Probation</option>
                                                        <option value="2">Parole</option>
                                                        <option value="3">Both</option>
                                                        <option value="4">Fully Discharged</option>
                                                        <option value="5">N/A</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('role'))
                                                        <div class="help-block with-errors">{{ $errors->first('role') }}</div>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_dfc @if($errors->has('cus_dfc')) has-error has-danger @endif">
                                                <label for="cus_dfc" class="form-label">Date of Conviction<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="cus_dfc" name="cus_dfc"
                                                    value="{{old('cus_dfc')}}" required data-error="Please enter date of conviction">
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_dfc'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_dfc') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_con @if($errors->has('cus_con')) has-error has-danger @endif">
                                                <label for="cus_con" class="form-label">Conviction<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="cus_con" name="cus_con"
                                                    value="{{old('cus_con')}}" required data-error="Please enter conviction">
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_con'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_con') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_conq @if($errors->has('cus_conq')) has-error has-danger @endif">
                                                <label for="cus_conq" class="form-label">Consequence<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_conq" id="cus_conq" required
                                                    data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Probation</option>
                                                    <option value="2">Incarceration</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_conq'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_conq') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_sex_off @if($errors->has('cus_sex_off')) has-error has-danger @endif">
                                                <label for="cus_sex_off" class="form-label">Are you a registered sex
                                                    offender?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_sex_off" id="cus_sex_off" required
                                                    data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_sex_off'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_sex_off') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_offend_minor @if($errors->has('cus_is_offend_minor')) has-error has-danger @endif">
                                                <label for="cus_is_offend_minor" class="form-label">Did your crime involve
                                                    a minor?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_offend_minor"
                                                    id="cus_is_offend_minor" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_is_offend_minor'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_is_offend_minor') }}</div>
                                                @endif
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
                                    <h3 class="section-title">Step 3 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 62.25%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-poll"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Needs Survey</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_food @if($errors->has('cus_food')) has-error has-danger @endif">
                                                <label for="cus_food" class="form-label">Do you need food?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_food" name="cus_food"
                                                    aria-label="Food" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_food'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_food') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_cloth @if($errors->has('cus_cloth')) has-error has-danger @endif">
                                                <label for="cus_cloth" class="form-label">Do you need clothing?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_cloth" name="cus_cloth"
                                                    aria-label="Clothing" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_cloth'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_cloth') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_shelter @if($errors->has('cus_shelter')) has-error has-danger @endif">
                                                <label for="cus_shelter" class="form-label">Do you need
                                                    shelter/housing?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_shelter" name="cus_shelter"
                                                    aria-label="Shelter" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_shelter'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_shelter') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_tra @if($errors->has('cus_tra')) has-error has-danger @endif">
                                                <label for="cus_tra" class="form-label">Do you need transportation?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_tra" name="cus_tra"
                                                    aria-label="Transportation" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_tra'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_tra') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_emp  @if($errors->has('cus_emp')) has-error has-danger @endif">
                                                <label for="cus_emp" class="form-label">Do you need employment?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_emp" name="cus_emp"
                                                    aria-label="Employment" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_emp'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_emp') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_extra_income @if($errors->has('cus_extra_income')) has-error has-danger @endif">
                                                <label for="cus_extra_income" class="form-label">Do you need extra income
                                                    (Gigs, Plasma, etc)?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_extra_income"
                                                    name="cus_extra_income" aria-label="Extra Income" required
                                                    data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_extra_income'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_extra_income') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_church @if($errors->has('cus_church')) has-error has-danger @endif">
                                                <label for="cus_church" class="form-label">Which church did you
                                                    attend?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_church" name="cus_church"
                                                    aria-label="Church" required data-error="Please select">
                                                    <option value="">Choose one</option>
                                                    <option value="First Baptist Church">First Baptist Church</option>
                                                    <option value="Second Presbyterian Church">Second Presbyterian Church
                                                    </option>
                                                    <option value="Grace Lutheran Church">Grace Lutheran Church</option>
                                                    <option value="Saint Mary's Catholic Church">Saint Mary's Catholic
                                                        Church</option>
                                                    <option value="Community Church of Christ">Community Church of Christ
                                                    </option>
                                                    <option value="Zion United Methodist Church">Zion United Methodist
                                                        Church</option>
                                                    <option value="Faith Baptist Church">Faith Baptist Church</option>
                                                    <option value="Emmanuel Episcopal Church">Emmanuel Episcopal Church
                                                    </option>
                                                    <option value="Mount Hope Church">Mount Hope Church</option>
                                                    <option value="Hope Community Church">Hope Community Church</option>
                                                    <option value="Trinity United Church of Christ">Trinity United Church
                                                        of Christ</option>
                                                    <option value="New Life Assembly">New Life Assembly</option>
                                                    <option value="Cornerstone Church">Cornerstone Church</option>
                                                    <option value="Calvary Baptist Church">Calvary Baptist Church</option>
                                                    <option value="Crossroads Church">Crossroads Church</option>
                                                    <option value="City Harvest Church">City Harvest Church</option>
                                                    <option value="New Hope Christian Church">New Hope Christian Church
                                                    </option>
                                                    <option value="Abundant Life Church">Abundant Life Church</option>
                                                    <option value="Victory Christian Church">Victory Christian Church
                                                    </option>
                                                    <option value="Praise Chapel">Praise Chapel</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_church'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_church') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_other_church">
                                                <div id="custom-church-container @if($errors->has('cus_other_church')) has-error has-danger @endif" style="display: none;">
                                                    <label for="cus_other_church" class="form-label">Other Church
                                                        Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="cus_other_church"
                                                        name="cus_other_church" placeholder="Enter other church name"
                                                        value="{{old('cus_other_church')}}">
                                                        <div class="help-block with-errors"></div>
                                                        @if ($errors->has('cus_other_church'))
                                                            <div class="help-block with-errors">{{ $errors->first('cus_other_church') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                            <!-- Hidden input for custom church name -->
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_bcert @if($errors->has('cus_bcert')) has-error has-danger @endif">
                                                <label for="cus_bcert" class="form-label">Do you have your birth
                                                    certificate?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_bcert" name="cus_bcert"
                                                    aria-label="Birth Certificate" required data-error="Please select"
                                                    onchange="birthDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_bcert'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_bcert') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_born_state">
                                                <div id="birthDiv">
                                                    <div class="@if($errors->has('cus_born_state')) has-error has-danger @endif">
                                                    <label for="cus_born_state" class="form-label">What state were you
                                                        born?<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" id="cus_born_state"
                                                        name="cus_born_state" aria-label="State"
                                                        data-error="Please select">
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
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_born_state'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_born_state') }}</div>
                                                @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_state_id @if($errors->has('cus_state_id')) has-error has-danger @endif">
                                                <label for="cus_state_id" class="form-label">Do you have state ID?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_state_id" name="cus_state_id"
                                                    aria-label="is_state_id" required data-error="Please select"
                                                    onchange="stateDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_state_id'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_state_id') }}</div>
                                                @endif
                                            </div>

                                            <div id="stateDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_state_no @if($errors->has('cus_state_no')) has-error has-danger @endif">
                                                    <label for="cus_state_no" class="form-label">Please enter the state
                                                        number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_state_no"
                                                        value="{{old('cus_state_no')}}" name="cus_state_no"
                                                        data-error="Please enter state no">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_state_no'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_state_no') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_d_lice @if($errors->has('cus_d_lice')) has-error has-danger @endif">
                                                <label for="cus_d_lice" class="form-label">Do you have driving
                                                    license?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_d_lice" name="cus_d_lice"
                                                    aria-label="DL" required data-error="Please select"
                                                    onchange="licenseDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_d_lice'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_d_lice') }}</div>
                                                @endif
                                            </div>

                                            <div id="licenseDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_lice_no @if($errors->has('cus_lice_no')) has-error has-danger @endif">
                                                    <label for="cus_lice_no" class="form-label">Please enter the driving
                                                        license number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_lice_no"
                                                        value="{{old('cus_lice_no')}}" name="cus_lice_no"
                                                        data-error="Please enter license number">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_lice_no'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_lice_no') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_ss_card  @if($errors->has('cus_ss_card')) has-error has-danger @endif">
                                                <label for="cus_ss_card" class="form-label">Do you have a social security
                                                    card?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_ss_card" name="cus_ss_card"
                                                    aria-label="Social Security Card" required data-error="Please select"
                                                    onchange="securityDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_ss_card'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_ss_card') }}</div>
                                                @endif
                                            </div>

                                            <div id="securityDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_ssc_no @if($errors->has('cus_ssc_no')) has-error has-danger @endif">
                                                    <label for="cus_ssc_no" class="form-label">Please enter the SSN<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_ssc_no"
                                                        value="{{old('cus_ssc_no')}}" name="cus_ssc_no" placeholder="******"
                                                        data-error="Please enter the SSN">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_ssc_no'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_ssc_no') }}</div>
                                                    @endif
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
                                    <h3 class="section-title">Step 4 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-poll"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Health Insurance</h3> --}}

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_insurace @if($errors->has('cus_insurace')) has-error has-danger @endif">
                                                <label for="cus_insurace" class="form-label">Do you have a health
                                                    insurance?<span class="text-danger">*</span></label>
                                                <select class="form-select mb-3" name="cus_insurace" id="cus_insurace"
                                                    required data-error="Please select" onchange="insuranceDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_insurace'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_insurace') }}</div>
                                                @endif
                                            </div>

                                            <div id="insuranceDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_carrier @if($errors->has('cus_carrier')) has-error has-danger @endif">
                                                    <label for="cus_carrier">Carrier<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('cus_carrier')}}"
                                                        id="cus_carrier" name="cus_carrier" data-error="Please select">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_carrier'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_carrier') }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_mem_id @if($errors->has('cus_mem_id')) has-error has-danger @endif">
                                                    <label for="cus_mem_id">Member ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('cus_mem_id')}}"
                                                        id="cus_mem_id" name="cus_mem_id" data-error="Please select">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_mem_id'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_mem_id') }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_grp_no @if($errors->has('cus_grp_no')) has-error has-danger @endif">
                                                    <label for="cus_grp_no">Group No<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('cus_grp_no')}}"
                                                        id="cus_grp_no" name="cus_grp_no" data-error="Please select">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_grp_no'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_grp_no') }}</div>
                                                    @endif
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
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-5" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-title">Step 5 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-poll"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon  activestep"><i
                                                                class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Others info</h3> --}}
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_more_friends @if($errors->has('cus_more_friends')) has-error has-danger @endif">
                                                <label for="cus_more_friends">Could you use more friends?<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_more_friends" id="cus_more_friends"
                                                    required data-error="Please select" onchange="friendsDiv()">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_more_friends'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_more_friends') }}</div>
                                                @endif
                                            </div>

                                            <div id="friendsDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_counselor @if($errors->has('cus_counselor')) has-error has-danger @endif">
                                                    <label for="cus_counselor">Do you believe you could benefit from having
                                                        a mentor or counselor?<span class="text-danger">*</span></label>
                                                    <select class="form-select" name="cus_counselor" id="cus_counselor"
                                                        data-error="Please select">
                                                        <option value="">Please select</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('cus_counselor'))
                                                        <div class="help-block with-errors">{{ $errors->first('cus_counselor') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_inv_rom @if($errors->has('cus_is_inv_rom')) has-error has-danger @endif">
                                                <label for="cus_is_inv_rom">Are you looking for someone with whom you could
                                                    be involved romantically?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_inv_rom" id="cus_is_inv_rom"
                                                    required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_is_inv_rom'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_is_inv_rom') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_mental_ill @if($errors->has('cus_is_mental_ill')) has-error has-danger @endif">
                                                <label for="cus_is_mental_ill">Have you ever been diagnosed with a mental
                                                    illness?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_mental_ill"
                                                    id="cus_is_mental_ill" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_is_mental_ill'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_is_mental_ill') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_phy_dis @if($errors->has('cus_phy_dis')) has-error has-danger @endif">
                                                <label for="cus_phy_dis">Do you have any known physical disabilities<span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="cus_phy_dis" name="cus_phy_dis" required data-error="Please select"></textarea>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('cus_phy_dis'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_phy_dis') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_comments @if($errors->has('cus_comments')) has-error has-danger @endif">
                                                <label for="cus_comments">Please enter anything else you would like for us
                                                    to know?</label><br>
                                                <textarea class="form-control" id="cus_comments" name="cus_comments"></textarea>
                                                @if ($errors->has('cus_comments'))
                                                    <div class="help-block with-errors">{{ $errors->first('cus_comments') }}</div>
                                                @endif
                                            </div>

                                            
                                            <div id="final-step-buttons" class="form-group  signUpForm-step-5">
                                                <button class="btn btn-custom" type="button"
                                                    onclick="previousStep5()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                    <button class="btn btn-custom float-end" type="button"
                                                    onclick="nextStep6()">Next <span
                                                        class="fas fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div id="section-6" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-title">Step 6 of 6</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-poll"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fa-solid fa-suitcase-medical"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon  activestep"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">6- Payment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Others info</h3> --}}
                                        <div class="row">
                                            
                                            <div class="container">
                                                <div class="text-center mb-4">
                                                    <!-- Radio buttons for Monthly and Yearly tabs -->
                                                    <input type="radio" name="plan" id="monthly-tab" class="radio-tab" checked onchange="payment_plan()" style="display: none;">
                                                    <label for="monthly-tab" class="radio-label btn btn-outline-primary"  >Monthly</label>
                                            
                                                    <input type="radio" name="plan" id="yearly-tab" class="radio-tab" onchange="payment_plan()" style="display: none;">
                                                    <label for="yearly-tab" class="radio-label btn btn-outline-primary">Yearly</label>
                                                </div>
                                            
                                                <div class="tab-content" id="pricing-tabContent">
                                                    <!-- Monthly Pricing -->
                                                    <div class="tab-pane fade show active" id="monthly" role="tabpanel">
                                                        <div class="row justify-content-center">
                                                            @foreach ( $membershipsMonthly as $membership)
                                                            <div class="col-lg-4 col-md-6 mb-4">
                                                                <div class="card text-center shadow">
                                                                    <div class="card-header text-white" style="background-color: #3e3e3e">
                                                                        <input type="radio" name="membership_id" value="{{ $membership->id }}">
                                                                        <h3>{{$membership->name}}</h3>
                                                                        <p class="text-center">{{$membership->price}}</p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Key Features</h5>
                                                                        <ul class="list-unstyled">
                                                                            @foreach(explode('^', $membership->features) as $feature)
                                                                                <li class="text-start"><i class="fa-regular fa-check-square me-2"></i>{{$feature}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                            
                                                    <!-- Yearly Pricing -->
                                                    <div class="tab-pane fade" id="yearly" role="tabpanel">
                                                        <div class="row justify-content-center">
                                                            @foreach ( $membershipsYearly as $membership)
                                                            <div class="col-lg-4 col-md-6 mb-4">
                                                                <div class="card text-center shadow">
                                                                    <div class="card-header text-white" style="background-color: #3e3e3e">
                                                                        <input type="radio" name="membership_id" value="{{ $membership->id }}">
                                                                        <h3>{{$membership->name}}</h3>
                                                                        <p class="text-center">{{$membership->price}}</p>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Key Features</h5>
                                                                        <ul class="list-unstyled">
                                                                            @foreach(explode('^', $membership->features) as $feature)
                                                                                <li class="text-start"><i class="fa-regular fa-check-square me-2"></i>{{$feature}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            

                                            <div id="mgsFormSubmit" class="hidden"></div>
                                            <div id="final-step-buttons" class="form-group  signUpForm-step-6">
                                                <button class="btn btn-custom" type="button"
                                                    onclick="previousStep5()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                    <button id="Submit" class="btn btn-custom float-end" type="submit"
                                                    onclick="nextStep7()">Submit </button>
                                            </div>
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
    <script src="{{ asset('wizard-form/js/reg-form.js') }}"></script>
@endsection
