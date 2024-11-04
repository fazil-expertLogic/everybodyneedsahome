@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('properties.update') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$property->id}}">
                            <div class="signUpForm-step-holder">

                                <div id="section-1" class="signUpForm-step-wrap">
                                    <h3 class="section-title">Step 1 of 4</h3>
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
                                                        <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
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
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Basic Information</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_name @if ($errors->has('property_name')) has-error has-danger @endif">
                                                    <label for="property_name" class="form-label">Property Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="property_name" class="form-control py-2" value="{{$property->property_name}}" id="property_name" placeholder="Enter Property Name" required data-error="Please enter the Property Name.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_name'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6 form-group valid_property_description @if ($errors->has('property_description')) has-error has-danger @endif">
                                                <label for="property_description">Property Description<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="property_description" name="property_description"  required data-error="Please enter the Property Description.">{{$property->property_description}}</textarea>
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('property_description'))
                                                    <div class="help-block with-errors">{{ $errors->first('property_description') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_address @if ($errors->has('property_address')) has-error has-danger @endif">
                                                    <label for="property_address" class="form-label">Property Address<span class="text-danger">*</span></label>
                                                    <input type="text" name="property_address" class="form-control py-2" value="{{$property->property_address}}" id="property_address" placeholder="Enter Property Address" required data-error="Please enter the Property Address.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_address'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_address') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_city @if ($errors->has('city')) has-error has-danger @endif">
                                                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="city" class="form-control py-2" value="{{$property->city}}" id="city" placeholder="Enter Property City" required data-error="Please enter the Property city.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('city'))
                                                        <div class="help-block with-errors">{{ $errors->first('city') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_state @if ($errors->has('state')) has-error has-danger @endif">
                                                    <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                                                    <select name="state" class="form-select" id="state" aria-label="" required data-error="Please select state">
                                                        <option value="">Please Select</option>
                                                        <option @if ($property->state == "USA") selected @endif value="USA">USA</option>
                                                        <option @if ($property->state == "Berlin") selected @endif value="Berlin">Berlin</option>
                                                        <option @if ($property->state == "Manchester") selected @endif value="Manchester">Manchester</option>
                                                        <option @if ($property->state == "Flynn") selected @endif value="Flynn">Flynn</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('state'))
                                                        <div class="help-block with-errors">{{ $errors->first('state') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_zipcode @if ($errors->has('zipcode')) has-error has-danger @endif">
                                                    <label for="zipcode" class="form-label">Property zipcode<span class="text-danger">*</span></label>
                                                    <input type="text" name="zipcode" class="form-control py-2" value="{{$property->zipcode}}" id="zipcode" placeholder="Enter Property zipcode" required data-error="Please enter the Property zipcode.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('zipcode'))
                                                        <div class="help-block with-errors">{{ $errors->first('zipcode') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_category @if ($errors->has('category')) has-error has-danger @endif">
                                                    <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                                                    <select name="category_id" class="form-select" id="category" aria-label="" required data-error="Please select category">
                                                        <option value="">Please Select</option>
                                                        @foreach ($categories as $category)
                                                            <option @if($category->id == $property->category_id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('category'))
                                                        <div class="help-block with-errors">{{ $errors->first('category') }}</div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="checkbox" name="is_feature" id="is_feature" value="1" {{ old('is_feature') ? 'checked' : '' }} @if($property->is_feature == 1) checked @endif>
                                                    <label for="is_feature">Is Featured</label>
                                                    &nbsp;&nbsp;
                                                    <input type="checkbox" name="is_new" id="is_new" value="1" {{ old('is_new') ? 'checked' : '' }} @if($property->is_new == 1) checked @endif>
                                                    <label for="is_new">Is New</label>
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
                                    <h3 class="section-title">Step 2 of 4</h3>
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
                                                        <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
                                                        <p class="steptitle">1- Basic Information</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i class="fas fa-user"></i>
                                                        </div>
                                                        <p class="steptitle">2- Criminal History</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
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
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>
                                        {{-- <h3 class="section-form-title">Criminal History</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_management_address @if ($errors->has('property_management_address')) has-error has-danger @endif">
                                                    <label for="property_management_address" class="form-label">Property Management Address<span class="text-danger">*</span></label>
                                                    <input type="text" name="property_management_address" class="form-control py-2" value="{{$property->property_management_address}}" id="property_management_address" placeholder="Enter Property Management Address" required data-error="Please enter the Property Management Address.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_management_address'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_management_address') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_management_city @if ($errors->has('property_management_city')) has-error has-danger @endif">
                                                    <label for="property_management_city" class="form-label">Property Management City<span class="text-danger">*</span></label>
                                                    <input type="text" name="property_management_city" class="form-control py-2" value="{{$property->property_management_city}}" id="property_management_city" placeholder="Enter Property property_management_city" required data-error="Please enter the Property Management City.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_management_city'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_management_city') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_management_state  @if ($errors->has('property_management_state')) has-error has-danger @endif">
                                                    <label for="property_management_state" class="form-label">Property Management State<span class="text-danger">*</span></label>
                                                    <select name="property_management_state" class="form-select" id="property_management_state" aria-label="" required data-error="Please select property_management_state">
                                                        <option value="">Please Select</option>
                                                        <option @if ($property->property_management_state == "USA") selected @endif value="USA">USA</option>
                                                        <option @if ($property->property_management_state == "Berlin") selected @endif value="Berlin">Berlin</option>
                                                        <option @if ($property->property_management_state == "Manchester") selected @endif value="Manchester">Manchester</option>
                                                        <option @if ($property->property_management_state == "Flynn") selected @endif value="Flynn">Flynn</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_management_state'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_management_state') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_property_management_zipcode @if ($errors->has('property_management_zipcode')) has-error has-danger @endif">
                                                    <label for="property_management_zipcode" class="form-label">Property Management Zipcode<span class="text-danger">*</span></label>
                                                    <input type="text" name="property_management_zipcode" class="form-control py-2" value="{{$property->property_management_zipcode}}" id="property_management_zipcode" placeholder="Enter Property zipcode" required data-error="Please enter the Property zipcode.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('property_management_zipcode'))
                                                        <div class="help-block with-errors">{{ $errors->first('property_management_zipcode') }}</div>
                                                    @endif
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
                                    <h3 class="section-title">Step 3 of 4</h3>
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
                                                        <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
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
                                                                class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
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
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>
                                        
                                        {{-- <h3 class="section-form-title">Needs Survey</h3> --}}
                                        <div class="help-block with-errors mandatory-error"></div>
                                       
                                        <div class="row">
                                            
                                            <p>Do you charge by the bed, bath Room or entire unit/house? *</p>
                                            <p> By Bed</p>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_number_of_beds @if ($errors->has('number_of_beds')) has-error has-danger @endif">
                                                    <label for="number_of_beds" class="form-label">How many beds are available to rent?<span class="text-danger">*</span></label>
                                                    <input type="number" name="number_of_beds" class="form-control py-2" value="{{$property->number_of_beds}}" id="number_of_beds" placeholder="How many beds are available to rent" required data-error="Please enter How many beds are available to rent">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('number_of_beds'))
                                                        <div class="help-block with-errors">{{ $errors->first('number_of_beds') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_rent_bed @if ($errors->has('rent_bed')) has-error has-danger @endif">
                                                    <label for="rent_bed" class="form-label">Rent by Bed<span class="text-danger">*</span></label>
                                                    <input type="number" name="rent_bed" class="form-control py-2" value="{{$property->rent_bed}}" id="rent_bed" placeholder="Please enter the number of Beds." required data-error="Please enter the number of Beds.">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('rent_bed'))
                                                    <div class="help-block with-errors">{{ $errors->first('rent_bed') }}</div>
                                                @endif
                                                </div>
                                            </div>

                                            <p>Add Bed Details</p>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_bed_deposit @if ($errors->has('bed_deposit')) has-error has-danger @endif">
                                                    <label for="bed_deposit" class="form-label">Deposit<span class="text-danger">*</span></label>
                                                    <input type="number" name="bed_deposit" class="form-control py-2" value="{{$property->bed_deposit}}" id="bed_deposit" placeholder="Please enter the Deposit." required data-error="Please enter the Deposit.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('bed_deposit'))
                                                        <div class="help-block with-errors">{{ $errors->first('bed_deposit') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_bed_fee @if ($errors->has('bed_fee')) has-error has-danger @endif">
                                                    <label for="bed_fee" class="form-label">Fee<span class="text-danger">*</span></label>
                                                    <input type="number" name="bed_fee" class="form-control py-2" value="{{$property->bed_fee}}" id="bed_fee" placeholder="Please enter the Fee." required data-error="Please enter the Fee.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('bed_fee'))
                                                        <div class="help-block with-errors">{{ $errors->first('bed_fee') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <p> By Bed Room</p>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_number_of_bedrooms @if ($errors->has('number_of_bedrooms')) has-error has-danger @endif">
                                                    <label for="number_of_bedrooms" class="form-label">How many bedrooms are available to rent?<span class="text-danger">*</span></label>
                                                    <input type="number" name="number_of_bedrooms" class="form-control py-2" value="{{$property->number_of_bedrooms}}" id="number_of_bedrooms" placeholder="How many bedrooms are available to rent" required data-error="Please enter How many bedrooms are available to rent">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('number_of_bedrooms'))
                                                        <div class="help-block with-errors">{{ $errors->first('number_of_bedrooms') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_stay_one_bedroom @if ($errors->has('stay_one_bedroom')) has-error has-danger @endif">
                                                    <label for="stay_one_bedroom" class="form-label">People allowed to stay in one bedroom?<span class="text-danger">*</span></label>
                                                    <input type="number" name="stay_one_bedroom" class="form-control py-2" value="{{$property->stay_one_bedroom}}" id="stay_one_bedroom" placeholder=" Please enter the number Of People allowed to stay in one bedroom." required data-error=" Please enter the number Of People allowed to stay in one bedroom.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('stay_one_bedroom'))
                                                        <div class="help-block with-errors">{{ $errors->first('stay_one_bedroom') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            
                    

                                            <p>Add Bedroom Details</p>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_bedroom_deposit @if ($errors->has('bedroom_deposit')) has-error has-danger @endif">
                                                    <label for="bedroom_deposit" class="form-label">Deposit<span class="text-danger">*</span></label>
                                                    <input type="number" name="bedroom_deposit" class="form-control py-2" value="{{$property->bedroom_deposit}}" id="bedroom_deposit" placeholder="Please enter the Deposit." required data-error="Please enter the Deposit.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('bedroom_deposit'))
                                                        <div class="help-block with-errors">{{ $errors->first('bedroom_deposit') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_bedroom_fee @if ($errors->has('bedroom_fee')) has-error has-danger @endif">
                                                    <label for="bedroom_fee" class="form-label">Fee<span class="text-danger">*</span></label>
                                                    <input type="number" name="bedroom_fee" class="form-control py-2" value="{{$property->bedroom_fee}}" id="bedroom_fee" placeholder="Please enter Fee." required data-error="Please enter fee.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('bedroom_fee'))
                                                        <div class="help-block with-errors">{{ $errors->first('bedroom_fee') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- -----------------------------------------------------------------------------------------------------------------------------}}
                                            <p> By Unit/House</p>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_number_of_bedrooms_house @if ($errors->has('number_of_bedrooms_house')) has-error has-danger @endif">
                                                    <label for="number_of_bedrooms_house" class="form-label">How many bedrooms are there in the house?<span class="text-danger">*</span></label>
                                                    <input type="number" name="number_of_bedrooms_house" class="form-control py-2" value="{{$property->number_of_bedrooms_house}}" id="number_of_bedrooms_house" placeholder=" Please enter the number of bedrooms are there in the house." required data-error=" Please enter the number of bedrooms are there in the house.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('number_of_bedrooms_house'))
                                                        <div class="help-block with-errors">{{ $errors->first('number_of_bedrooms_house') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_number_of_bath_house @if ($errors->has('number_of_bath_house')) has-error has-danger @endif">
                                                    <label for="number_of_bath_house" class="form-label">How many baths are there in the house? <span class="text-danger">*</span></label>
                                                    <input type="number" name="number_of_bath_house" class="form-control py-2" value="{{$property->number_of_bath_house}}" id="number_of_bath_house" placeholder="Please enter the number Of baths are there in the house." required data-error="Please enter the number Of baths are there in the house.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('number_of_bath_house'))
                                                        <div class="help-block with-errors">{{ $errors->first('number_of_bath_house') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_utilities_inscluded @if ($errors->has('utilities_inscluded')) has-error has-danger @endif">
                                                <label for="utilities_inscluded" class="form-label">Are Utilities included?<span class="text-danger">*</span></label>
                                                <select class="form-select mb-3" name="utilities_inscluded" id="utilities_inscluded" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option @if($property->is_property_occupied == '1') selected @endif value="1">Yes</option>
                                                    <option @if($property->is_property_occupied == '0') selected @endif value="0">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                 @if ($errors->has('utilities_inscluded'))
                                                        <div class="help-block with-errors">{{ $errors->first('utilities_inscluded') }}</div>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_rent_unit @if ($errors->has('rent_unit')) has-error has-danger @endif">
                                                    <label for="rent_unit" class="form-label">Rent for the Unit/House<span class="text-danger">*</span></label>
                                                    <input type="number" name="rent_unit" class="form-control py-2" value="{{$property->rent_unit}}" id="rent_unit" placeholder="Please enter Rent for the Unit/House." required data-error="Please enter Rent for the Unit/House.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('rent_unit'))
                                                        <div class="help-block with-errors">{{ $errors->first('rent_unit') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <p>Add Unit/House Details</p>
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_unit_deposit @if ($errors->has('unit_deposit')) has-error has-danger @endif">
                                                    <label for="unit_deposit" class="form-label">Deposit<span class="text-danger">*</span></label>
                                                    <input type="number" name="unit_deposit" class="form-control py-2" value="{{$property->unit_deposit}}" id="unit_deposit" placeholder="Please enter the Deposit." required data-error="Please enter the Deposit.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('unit_deposit'))
                                                        <div class="help-block with-errors">{{ $errors->first('unit_deposit') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_unit_fee @if ($errors->has('unit_fee')) has-error has-danger @endif">
                                                    <label for="unit_fee" class="form-label">Fee<span class="text-danger">*</span></label>
                                                    <input type="number" name="unit_fee" class="form-control py-2" value="{{$property->unit_fee}}" id="unit_fee" placeholder="Please enter Fee." required data-error="Please enter fee.">
                                                    <div class="help-block with-errors"></div>
                                                     @if ($errors->has('unit_fee'))
                                                        <div class="help-block with-errors">{{ $errors->first('unit_fee') }}</div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-lg-6 form-group valid_is_property_occupied @if ($errors->has('is_property_occupied')) has-error has-danger @endif">
                                                <label for="is_property_occupied" class="form-label">Is property occupied?<span class="text-danger">*</span></label>
                                                <select class="form-select mb-3" name="is_property_occupied" id="is_property_occupied" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option  @if($property->is_property_occupied == '1') selected @endif value="1">Yes</option>
                                                    <option  @if($property->is_property_occupied == '0') selected @endif value="0">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                 @if ($errors->has('is_property_occupied'))
                                                        <div class="help-block with-errors">{{ $errors->first('is_property_occupied') }}</div>
                                                    @endif
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
                                    <h3 class="section-title">Step 4 of 4</h3>
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
                                                        <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
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
                                                        <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                        <p class="steptitle">3- Needs Survey</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon activestep"><i class="fas fa-check"></i>
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
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Health Insurance</h3> --}}

                                        <div class="row">
                                            
                
                                            {{-- -------------------- --}}

                                            <div class="col-sm-12 col-md-12 col-lg-12 form-group valid_main_picture @if ($errors->has('main_picture')) has-error has-danger @endif">
                                                <label for="main_picture" class="form-label invalid">Main Picture*</label>
                                                <input type="file" class="form-control" aria-label="file example" name="main_picture" required data-error="Please select">
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('main_picture'))
                                                <div class="help-block with-errors">{{ $errors->first('main_picture') }}</div>
                                            @endif
                                            </div>


                                            <div class="col-sm-12 col-md-12 col-lg-12 form-group valid_more_picture @if ($errors->has('more_picture')) has-error has-danger @endif">
                                                <label for="more_picture" class="form-label">More Pictures*</label>
                                                <input type="file" class="form-control" aria-label="file example" name="more_picture[]" multiple  required data-error="Please select">
                                                <div class="help-block with-errors"></div>
                                                @if ($errors->has('more_picture'))
                                                <div class="help-block with-errors">{{ $errors->first('more_picture') }}</div>
                                            @endif
                                            </div>

                                            <div class="form-group signUpForm-step-4">
                                                <button class="btn btn-custom" type="button" 
                                                    onclick="previousStep3()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                    <button id="Submit" class="btn btn-custom float-end"
                                                    type="submit" onclick="nextStep6()">Submit </button>
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
<script src="{{asset('wizard-form/js/property-form.js')}}"></script>
@endsection