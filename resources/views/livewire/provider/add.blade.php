@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('providers.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">

                                <div id="section-1" class="signUpForm-step-wrap">
                                    {{-- <h3 class="section-title">Step 1 of 1</h3> --}}
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            {{-- <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 0%;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i
                                                                class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Provider Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div> --}}

                                        <h3 class="section-form-title">Create New Provider</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_name">
                                                    <label for="provider_name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="provider_name" class="form-control py-2" id="provider_name" placeholder="Your name" value="" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_company_name">
                                                    <label for="company_name" class="form-label">Company/Organization Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="company_name" name="comany_name" placeholder="Company Name"  required data-error="Please enter company name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_pass">
                                                    <label for="pass" class="form-label">password<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass" name="pass" placeholder="password" required data-error="Please enter password">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_cpass">
                                                    <label for="pass_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control py-2" id="pass_confirmation" name="pass_confirmation" placeholder="Confirm Password" required data-error="Please enter confirm password">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_type">
                                                    <label for="type" class="form-label">For Profit or Non-Profit?<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="type" name="type" aria-label="Select Type" required data-error="Please select">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Profit</option>
                                                        <option value="0">Non-Profit</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_address">
                                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="address" name="address" placeholder="Address" required data-error="Please enter address">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_city">
                                                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" class="form-control py-2" id="city" placeholder="City" value="" required data-error="Please enter city">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_state">
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
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_zip">
                                                    <label for="zip" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 zip-input-mask" id="zip" name="zipcode" placeholder="zipcode" required data-error="Please enter zipcode">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_phone">
                                                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control py-2 phone-input-mask" id="phone" name="phone" placeholder="Phone" required data-error="Please enter phone">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_email">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="" required data-error="Please enter email">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_website">
                                                    <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                                                    <input type="url" class="form-control py-2" id="website" name="website" placeholder="website" required data-error="Please enter website">
                                                    <div class="help-block with-errors"></div>
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
                                                <div class="custom-area-served" >
                                                    <label for="custom-area-served" class="form-label">Category<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="custom-area-served" name="custom_area_served" placeholder="Enter Other Category" value=""  data-error="Please enter custom area served">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="mb-12">
                                                <label for="main_picture" class="form-label">Main Picture*</label>
                                                <input type="file" class="form-control" aria-label="file example" name="main_picture">
                                                <div class="invalid-feedback">Example invalid form file feedback</div>
                                            </div>

                                        </div>
                                        
                                        <div class="form-group signUpForm-step-1" style="margin-top: 50px;">
                                            
                                            <button id="Submit" class="btn btn-custom float-end"
                                                    type="submit" onclick="nextStep2()">Submit </button>
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
@endsection
@section('js')
<script src="{{asset('wizard-form/js/provider-form.js')}}"></script>
@endsection