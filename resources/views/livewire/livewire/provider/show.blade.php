@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        
                            <input type="hidden" value="1" id="is_edit"/>
                            <div class="signUpForm-step-holder">

                                <div id="section-1" class="signUpForm-step-wrap">
                                    
                                    <fieldset class="mt-4">

                                        <h3 class="section-form-title">Provider</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_name">
                                                    <label for="provider_name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="provider_name" class="form-control py-2" id="provider_name" placeholder="Your name" value="{{$provider->provider_name}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_company_name">
                                                    <label for="company_name" class="form-label">Company/Organization Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="company_name" value="{{$provider->comany_name}}" name="comany_name" placeholder="Company Name"  required data-error="Please enter company name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_type">
                                                    <label for="type" class="form-label">For Profit or Non-Profit?<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="type" name="type" aria-label="Select Type" required data-error="Please select" disabled>
                                                        <option value="">Please Select</option>
                                                        <option @if( $provider->type == 1 ) selected @endif value="1">Profit</option>
                                                        <option @if( $provider->type == 0 ) selected @endif value="0">Non-Profit</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_address">
                                                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="address" value="{{$provider->address}}" name="address" placeholder="Address" required data-error="Please enter address" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_city">
                                                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" class="form-control py-2" id="city" placeholder="City" value="{{$provider->city}}" required data-error="Please enter city" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_state">
                                                    <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" name="state" id="state" aria-label="" required data-error="Please enter state" disabled>
                                                        <option value="">Please Select</option>
                                                        <option  @if( $provider->state == "AL" ) selected @endif value="AL">Alabama</option>
                                                        <option  @if( $provider->state == "AK" ) selected @endif value="AK">Alaska</option>
                                                        <option  @if( $provider->state == "AZ" ) selected @endif value="AZ">Arizona</option>
                                                        <option  @if( $provider->state == "AR" ) selected @endif value="AR">Arkansas</option>
                                                        <option  @if( $provider->state == "CA" ) selected @endif value="CA">California</option>
                                                        <option  @if( $provider->state == "CO" ) selected @endif value="CO">Colorado</option>
                                                        <option  @if( $provider->state == "CT" ) selected @endif value="CT">Connecticut</option>
                                                        <option  @if( $provider->state == "DE" ) selected @endif value="DE">Delaware</option>
                                                        <option  @if( $provider->state == "FL" ) selected @endif value="FL">Florida</option>
                                                        <option  @if( $provider->state == "GA" ) selected @endif value="GA">Georgia</option>
                                                        <option  @if( $provider->state == "HI" ) selected @endif value="HI">Hawaii</option>
                                                        <option  @if( $provider->state == "ID" ) selected @endif value="ID">Idaho</option>
                                                        <option  @if( $provider->state == "IL" ) selected @endif value="IL">Illinois</option>
                                                        <option  @if( $provider->state == "IN" ) selected @endif value="IN">Indiana</option>
                                                        <option  @if( $provider->state == "IA" ) selected @endif value="IA">Iowa</option>
                                                        <option  @if( $provider->state == "KS" ) selected @endif value="KS">Kansas</option>
                                                        <option  @if( $provider->state == "KY" ) selected @endif value="KY">Kentucky</option>
                                                        <option  @if( $provider->state == "LA" ) selected @endif value="LA">Louisiana</option>
                                                        <option  @if( $provider->state == "ME" ) selected @endif value="ME">Maine</option>
                                                        <option  @if( $provider->state == "MD" ) selected @endif value="MD">Maryland</option>
                                                        <option  @if( $provider->state == "MA" ) selected @endif value="MA">Massachusetts</option>
                                                        <option  @if( $provider->state == "MI" ) selected @endif value="MI">Michigan</option>
                                                        <option  @if( $provider->state == "MN" ) selected @endif value="MN">Minnesota</option>
                                                        <option  @if( $provider->state == "MS" ) selected @endif value="MS">Mississippi</option>
                                                        <option  @if( $provider->state == "MO" ) selected @endif value="MO">Missouri</option>
                                                        <option  @if( $provider->state == "MT" ) selected @endif value="MT">Montana</option>
                                                        <option  @if( $provider->state == "NE" ) selected @endif value="NE">Nebraska</option>
                                                        <option  @if( $provider->state == "NV" ) selected @endif value="NV">Nevada</option>
                                                        <option  @if( $provider->state == "NH" ) selected @endif value="NH">New Hampshire</option>
                                                        <option  @if( $provider->state == "NJ" ) selected @endif value="NJ">New Jersey</option>
                                                        <option  @if( $provider->state == "NM" ) selected @endif value="NM">New Mexico</option>
                                                        <option  @if( $provider->state == "NY" ) selected @endif value="NY">New York</option>
                                                        <option  @if( $provider->state == "NC" ) selected @endif value="NC">North Carolina</option>
                                                        <option  @if( $provider->state == "ND" ) selected @endif value="ND">North Dakota</option>
                                                        <option  @if( $provider->state == "OH" ) selected @endif value="OH">Ohio</option>
                                                        <option  @if( $provider->state == "OK" ) selected @endif value="OK">Oklahoma</option>
                                                        <option  @if( $provider->state == "OR" ) selected @endif value="OR">Oregon</option>
                                                        <option  @if( $provider->state == "PA" ) selected @endif value="PA">Pennsylvania</option>
                                                        <option  @if( $provider->state == "RI" ) selected @endif value="RI">Rhode Island</option>
                                                        <option  @if( $provider->state == "SC" ) selected @endif value="SC">South Carolina</option>
                                                        <option  @if( $provider->state == "SD" ) selected @endif value="SD">South Dakota</option>
                                                        <option  @if( $provider->state == "TN" ) selected @endif value="TN">Tennessee</option>
                                                        <option  @if( $provider->state == "TX" ) selected @endif value="TX">Texas</option>
                                                        <option  @if( $provider->state == "UT" ) selected @endif value="UT">Utah</option>
                                                        <option  @if( $provider->state == "VT" ) selected @endif value="VT">Vermont</option>
                                                        <option  @if( $provider->state == "VA" ) selected @endif value="VA">Virginia</option>
                                                        <option  @if( $provider->state == "WA" ) selected @endif value="WA">Washington</option>
                                                        <option  @if( $provider->state == "WV" ) selected @endif value="WV">West Virginia</option>
                                                        <option  @if( $provider->state == "WI" ) selected @endif value="WI">Wisconsin</option>
                                                        <option  @if( $provider->state == "WY" ) selected @endif value="WY">Wyoming</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_zip">
                                                    <label for="zip" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 zip-input-mask" value="{{ $provider->zipcode }}" id="zip" name="zipcode" placeholder="zipcode" required data-error="Please enter zipcode" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_phone">
                                                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control py-2 phone-input-mask" id="phone" value="{{ $provider->phone }}" name="phone" placeholder="Phone" required data-error="Please enter phone" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_email">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="{{ $provider->email }}" required data-error="Please enter email" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_prov_website">
                                                    <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                                                    <input type="url" class="form-control py-2" id="website" name="website" placeholder="website" value="{{ $provider->website }}" required data-error="Please enter website" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label text-dark roboto-medium">Area Served<span class="text-danger">*</span></label>
                                                    <div class="d-flex flex-wrap">
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="1" id="Food" name="area_served" @if($provider->area_served == 1) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="Food">Food</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="2" id="Clothing" name="area_served" @if($provider->area_served == 2) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="Clothing">Clothing</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="3" id="Shelter" name="area_served" @if($provider->area_served == 3) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="Shelter">Shelter</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="5" id="Extra Income" name="area_served" @if($provider->area_served == 5) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="Extra Income">Extra Income</label>
                                                        </div>
                                                                                                
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="6" id="Main" name="area_served" @if($provider->area_served == 6) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="Main">Main</label>
                                                        </div>
                                                        
                                                        <div class="form-check me-3 mb-3">
                                                            <input class="form-check-input area-served" type="radio" value="7" id="other-area-served-option" name="area_served" @if($provider->area_served == 7) checked @endif onchange="toggleDiv()" disabled>
                                                            <label class="form-check-label1" for="other-area-served-option">Suggest A Category/Subcategory</label>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="cus_phone" class="form-label">Profile Image<span class="text-danger">*</span></label>
                                                            <img src="{{ asset('storage/' . $provider->profile_image) }}" alt="Main Picture" width="400px" />
                                                        </div>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12" id="childinfobox">
                                                <div class="col-sm-6 col-lg-6">
                                                <div class="custom-area-served" >
                                                    <label for="custom-area-served" class="form-label">Category<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="custom-area-served" name="custom_area_served" placeholder="Enter Other Category" value="{{ $provider->custom_area_served }}"  required data-error="Please enter custom area served" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                </div>
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
@endsection
@section('js')
<script src="{{asset('wizard-form/js/provider-form.js')}}"></script>
@endsection