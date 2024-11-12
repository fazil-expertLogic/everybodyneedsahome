
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('providers.provider_registration_post') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <h3 class="section-form-title">Create New Provider</h3>
                                    <h3 class="section-title">Step 1 of 3</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 0%;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep">
                                                            <i class="fas fa-unlock-alt"></i>
                                                        </div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">2- Payment</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">3- Payment</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>

                                        
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 @if($errors->has('provider_name')) has-error has-danger @endif">
                                                <div class="form-group valid_prov_name  @if($errors->has('provider_name')) has-error has-danger @endif">
                                                    <label for="provider_name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="provider_name" class="form-control py-2" id="provider_name" placeholder="Your name" value="{{old('provider_name')}}" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('provider_name'))
                                                        <div class="help-block with-errors">{{ $errors->first('provider_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6 @if($errors->has('company_name')) has-error has-danger @endif">
                                                <div class="form-group valid_prov_company_name @if($errors->has('company_name')) has-error has-danger @endif">
                                                    <label for="company_name" class="form-label">Company/Organization Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="company_name" name="comany_name" placeholder="Company Name" value="{{old('company_name')}}" required data-error="Please enter company name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('company_name'))
                                                        <div class="help-block with-errors">{{ $errors->first('company_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 @if($errors->has('pass')) has-error has-danger @endif">
                                                <div class="form-group valid_use_pass  @if($errors->has('pass')) has-error has-danger @endif">
                                                    <label for="pass" class="form-label">password<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass" name="pass" placeholder="password" required data-error="Please enter password">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('pass'))
                                                        <div class="help-block with-errors">{{ $errors->first('pass') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 @if($errors->has('pass_confirmation')) has-error has-danger @endif">
                                                <div class="form-group valid_use_cpass">
                                                    <label for="pass_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass_confirmation" name="pass_confirmation" placeholder="Confirm Password" required data-error="Please enter confirm password">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('pass_confirmation'))
                                                        <div class="help-block with-errors">{{ $errors->first('pass_confirmation') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 @if($errors->has('type')) has-error has-danger @endif">
                                                <div class="form-group valid_prov_type">
                                                    <label for="type" class="form-label">For Profit or Non-Profit?<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="type" name="type" aria-label="Select Type" required data-error="Please select">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Profit</option>
                                                        <option value="0">Non-Profit</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('type'))
                                                        <div class="help-block with-errors">{{ $errors->first('type') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 @if($errors->has('address')) has-error has-danger @endif">
                                                <div class="form-group valid_prov_address">
                                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="address" name="address" value="{{old('address')}}" placeholder="Address" required data-error="Please enter address">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('address'))
                                                        <div class="help-block with-errors">{{ $errors->first('address') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 @if($errors->has('city')) has-error has-danger @endif">
                                                <div class="form-group valid_prov_city">
                                                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" class="form-control py-2" id="city" placeholder="City" value="{{old('city')}}" required data-error="Please enter city">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('city'))
                                                        <div class="help-block with-errors">{{ $errors->first('city') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_state @if($errors->has('state')) has-error has-danger @endif">
                                                    <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" name="state" id="state" aria-label="" required data-error="Please enter state">
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
                                                    @if ($errors->has('state'))
                                                        <div class="help-block with-errors">{{ $errors->first('state') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_zip @if($errors->has('zipcode')) has-error has-danger @endif">
                                                    <label for="zip" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 zip-input-mask" value="{{old('zipcode')}}" id="zip" name="zipcode" placeholder="zipcode" required data-error="Please enter zipcode">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('zipcode'))
                                                        <div class="help-block with-errors">{{ $errors->first('zipcode') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_phone @if($errors->has('phone')) has-error has-danger @endif">
                                                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control py-2 phone-input-mask" id="phone"  value="{{old('phone')}}" name="phone" placeholder="Phone" required data-error="Please enter phone">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('phone'))
                                                        <div class="help-block with-errors">{{ $errors->first('phone') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_email @if($errors->has('email')) has-error has-danger @endif">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="{{old('email')}}" required data-error="Please enter email">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('email'))
                                                        <div class="help-block with-errors">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_website @if($errors->has('website')) has-error has-danger @endif">
                                                    <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                                                    <input type="url" class="form-control py-2" value="{{old('website')}}" id="website" name="website" placeholder="website" required data-error="Please enter website">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('website'))
                                                        <div class="help-block with-errors">{{ $errors->first('website') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label text-dark roboto-medium">Area Served<span class="text-danger">*</span></label>
                                                    <div class="d-flex flex-wrap">
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="1" id="Food" name="area_served" checked onchange="toggleDiv()">
                                                            <label class="form-check-label" for="Food">Food</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="2" id="Clothing" name="area_served" onchange="toggleDiv()">
                                                            <label class="form-check-label" for="Clothing">Clothing</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="3" id="Shelter" name="area_served" onchange="toggleDiv()">
                                                            <label class="form-check-label" for="Shelter">Shelter</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="5" id="Extra Income" name="area_served" onchange="toggleDiv()">
                                                            <label class="form-check-label" for="Extra Income">Extra Income</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="6" id="Main" name="area_served" onchange="toggleDiv()">
                                                            <label class="form-check-label" for="Main">Main</label>
                                                        </div>
                                                        
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="7" id="other-area-served-option" name="area_served" onchange="toggleDiv()">
                                                            <label class="form-check-label" for="other-area-served-option">Suggest A Category/Subcategory</label>
                                                        </div>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12" id="childinfobox">
                                                <div class="col-sm-6 col-lg-6">
                                                <div class="custom-area-served @if($errors->has('custom_area_served')) has-error has-danger @endif">
                                                    <label for="custom-area-served" class="form-label">Category<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="custom-area-served" name="custom_area_served" placeholder="Enter Other Category" value="{{old('custom_area_served')}}"  data-error="Please enter custom area served">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('custom_area_served'))
                                                        <div class="help-block with-errors">{{ $errors->first('custom_area_served') }}</div>
                                                    @endif
                                                </div>
                                                </div>
                                            </div>

                                            <div class="mb-12">
                                                <div class="@if($errors->has('main_picture')) has-error has-danger @endif">
                                                <label for="main_picture" class="form-label">Main Picture*</label>
                                                <input type="file" class="form-control" aria-label="file example" name="main_picture">
                                                <div class="invalid-feedback">Example invalid form file feedback</div>
                                                @if ($errors->has('main_picture'))
                                                    <div class="help-block with-errors">{{ $errors->first('main_picture') }}</div>
                                                @endif
                                                </div>
                                            </div>
                                            

                                        </div>
                                        
                                        <div class="form-group signUpForm-step-1" style="margin-top: 50px;">
                                           
                                          
                                                <button class="btn btn-custom float-end" onclick="nextStep2()"
                                                type="button">Next <span class="fas fa-arrow-right"></span></button>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-2" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-form-title">Create New Provider</h3>
                                    <h3 class="section-title">Step 2 of 3</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"></div>
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
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">2- Payment</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon">
                                                            <i class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">3- Payment</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
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
                                                                        <input type="radio" id="membership_id" name="membership_id" value="{{ $membership->id }}">
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
                                                                        <input type="radio" id="membership_id" name="membership_id" value="{{ $membership->id }}">
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
                                                    onclick="previousStep1()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                    
                                                    <button class="btn btn-custom float-end" onclick="nextStep3()"
                                                type="button">Next <span class="fas fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                
                                <div id="section-3" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-form-title">Create New Provider</h3>
                                    <h3 class="section-title">Step 3 of 3</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-2">
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">2- Package</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon  activestep"><i
                                                                class="fa fa-credit-card"></i>
                                                        </div>
                                                        <p class="steptitle">3- Payment</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container">

                                                <div class="form-row row card-related">
                                                    <label for="card-element">Credit or debit card</label>
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Move card-errors outside of card-element -->
                                                    <div id="card-errors" role="alert"></div>
                                                    <div id="empty-element"></div>
                                                </div>
                                                
                                                
                                            </div>

                                            <div id="mgsFormSubmit" class="hidden"></div>
                                            <div id="final-step-buttons" class="form-group  signUpForm-step-6">
                                                <button class="btn btn-custom" type="button"
                                                    onclick="previousStep2()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                    <button id="Submit" class="btn btn-custom float-end" type="submit"
                                                    onclick="nextStep4()">Submit </button>
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
    {{-- <script src="{{ asset('build/assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/plugins/p-scroll/pscroll.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/plugins/sidemenu/sidemenu.js') }}"></script> --}}
    {{-- <script src="{{ asset('build/assets/plugins/sidebar/sidebar.js') }}"></script> --}}
    @vite('resources/js/app.js')



    <script src="{{ asset('wizard-form/js/jquery-3.5.1.min.js') }}"></script>
    <!-- bootstrap-datepicker Js -->
    <script src="{{ asset('wizard-form/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Form validator Js -->
    <script src="{{ asset('wizard-form/js/validator.min.js') }}"></script>
    <!-- sweetalert Js -->
    <script src="{{ asset('wizard-form/js/sweetalert.min.js') }}"></script>

    <script src="{{ asset('wizard-form/js/provider-form.js') }}"></script>
@endsection
