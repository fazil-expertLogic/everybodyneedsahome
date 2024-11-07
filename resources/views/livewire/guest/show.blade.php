@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('clients.update', $client->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="1" id="is_edit"/>
                            @method('PUT')
                            <div class="signUpForm-step-holder">

                                <div id="section-1" class="signUpForm-step-wrap">
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
                                                <div class="form-group valid_cus_name">
                                                    <label for="cus_name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_name" class="form-control py-2" value="{{ $client->cus_name }}" id="cus_name" placeholder="Your name" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_email">
                                                    <label for="cus_email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="cus_email" class="form-control py-2" id="cus_email" placeholder="example@email.com" value="{{ $client->email }}" required data-error="Please enter email" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_dob">
                                                    <label for="cus_dob" class="form-label"> Date of Birth<span class="text-danger">*</span></label>
                                                    <input type="date" name="cus_dob" class="form-control py-2"id="cus_dob" placeholder="" value="{{ $client->cus_dob }}" required data-error="Please enter Date of Birth" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ss">
                                                    <label for="cus_ss" class="form-label">Social Security Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 ssn-input-mask" value="{{ $client->cus_ss }}" name="cus_ss" id="cus_ss" placeholder="*****" required data-error="Please enter Social Security Number" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ms">
                                                    <label for="cus_ms" class="form-label">Marital Status<span class="text-danger">*</span></label>
                                                    <select name="martial_status" class="form-select" id="cus_ms" aria-label="" required data-error="Please select marital status" disabled>
                                                        <option value="">Please Select</option>
                                                        <option @if( $client->martial_status  == 1) selected @endif value="1">Single</option>
                                                        <option @if( $client->martial_status  == 2) selected @endif value="2">Married</option>
                                                        <option @if( $client->martial_status  == 3) selected @endif value="3">Separated</option>
                                                        <option @if( $client->martial_status  == 4) selected @endif value="4">Divorced</option>
                                                        <option @if( $client->martial_status  == 5) selected @endif value="5">Widowed</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_is_child">
                                                    <label for="cus_is_child" class="form-label">Children<span class="text-danger">*</span></label>
                                                    <select name="cus_is_child" class="form-select" id="cus_is_child" aria-label="" required data-error="Please select Children" onchange="toggleDiv()" disabled>
                                                      <option value="">Please Select</option>
                                                      <option @if( $client->is_child  == 1) selected @endif value="1">Yes</option>
                                                      <option @if( $client->is_child  == 2) selected @endif value="2">No</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                  </div>
                                            </div>
            
                                            <div class="col-sm-12 col-lg-12" id="childinfobox">
                                                <div id="child-boxes-container">
                                                    @foreach ($client->ClientChild as $key => $clientChild)
                                        
                                                    <div class="row childBOX">
                                                        <div class="col-sm-6 col-lg-6">
                                                            <fieldset class="mb-3">
                                                                <label for="child_name_{{$key}}" class="form-label">Child Name<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control py-2" value="{{$clientChild->child_name}}" name="child_name[]" id="child_name_{{$key}}" disabled>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-sm-6 col-lg-6">
                                                            <fieldset class="">
                                                                <label for="child_age_{{$key}}" class="form-label">Child Age<span class="text-danger">*</span></label>
                                                                <select name="child_age[]" class="form-select" id="child_age_{{$key}}" aria-label="" disabled>
                                                                    <option @if( $clientChild->child_age == '0') selected @endif value="0" selected="">0+</option>
                                                                    <option @if( $clientChild->child_age == '1') selected @endif value="1">1</option>
                                                                    <option @if( $clientChild->child_age == '2') selected @endif value="2">2</option>
                                                                    <option @if( $clientChild->child_age == '3') selected @endif value="3">3</option>
                                                                    <option @if( $clientChild->child_age == '4') selected @endif value="4">4</option>
                                                                    <option @if( $clientChild->child_age == '5') selected @endif value="5">5</option>
                                                                    <option @if( $clientChild->child_age == '6') selected @endif value="6">6</option>
                                                                    <option @if( $clientChild->child_age == '7') selected @endif value="7">7</option>
                                                                    <option @if( $clientChild->child_age == '8') selected @endif value="8">8</option>
                                                                    <option @if( $clientChild->child_age == '9') selected @endif value="9">9</option>
                                                                    <option @if( $clientChild->child_age == '10') selected @endif value="10">10</option>
                                                                    <option @if( $clientChild->child_age == '11') selected @endif value="11">11</option>
                                                                    <option @if( $clientChild->child_age == '12') selected @endif value="12">12</option>
                                                                    <option @if( $clientChild->child_age == '13') selected @endif value="13">13</option>
                                                                    <option @if( $clientChild->child_age == '14') selected @endif value="14">14</option>
                                                                    <option @if( $clientChild->child_age == '15') selected @endif value="15">15</option>
                                                                    <option @if( $clientChild->child_age == '16') selected @endif value="16">16</option>
                                                                    <option @if( $clientChild->child_age == '17') selected @endif value="17">17</option>
                                                                    <option @if( $clientChild->child_age == '18') selected @endif value="18">18</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
            
                                                <div class="mb-3 text-end">
                                                    <a href="#" class="delete-child-box text-danger" style="display: none;">Delete</a> <span class="separator" style="display: none;">|</span>
                                                    <a href="#" id="add-new-child" onclick="addchild()" class="text-blue">Add new</a>
                                                </div>
                                            </div>
                                            <div id="child-info-container">
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_address">
                                                    <label for="cus_address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_address" class="form-control py-2" id="cus_address" placeholder="Address" value="{{$client->address}}" required data-error="Please enter address" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_city">
                                                    <label for="cus_city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_city" class="form-control py-2" id="cus_city" placeholder="City" value="{{$client->city}}" required data-error="Please enter city" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_state">
                                                    <label for="cus_state" class="form-label">State<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" name="cus_state" id="cus_state" aria-label="" required data-error="Please enter state" disabled>
                                                        <option value="">Please Select</option>
                                                        <option @if ($client->state == 'AL') selected @endif value="AL">Alabama</option>
                                                        <option @if ($client->state == 'AK') selected @endif value="AK">Alaska</option>
                                                        <option @if ($client->state == 'AZ') selected @endif value="AZ">Arizona</option>
                                                        <option @if ($client->state == 'AR') selected @endif value="AR">Arkansas</option>
                                                        <option @if ($client->state == 'CA') selected @endif value="CA">California</option>
                                                        <option @if ($client->state == 'CO') selected @endif value="CO">Colorado</option>
                                                        <option @if ($client->state == 'CT') selected @endif value="CT">Connecticut</option>
                                                        <option @if ($client->state == 'DE') selected @endif value="DE">Delaware</option>
                                                        <option @if ($client->state == 'FL') selected @endif value="FL">Florida</option>
                                                        <option @if ($client->state == 'GA') selected @endif value="GA">Georgia</option>
                                                        <option @if ($client->state == 'HI') selected @endif value="HI">Hawaii</option>
                                                        <option @if ($client->state == 'ID') selected @endif value="ID">Idaho</option>
                                                        <option @if ($client->state == 'IL') selected @endif value="IL">Illinois</option>
                                                        <option @if ($client->state == 'IN') selected @endif value="IN">Indiana</option>
                                                        <option @if ($client->state == 'IA') selected @endif value="IA">Iowa</option>
                                                        <option @if ($client->state == 'KS') selected @endif value="KS">Kansas</option>
                                                        <option @if ($client->state == 'KY') selected @endif value="KY">Kentucky</option>
                                                        <option @if ($client->state == 'LA') selected @endif value="LA">Louisiana</option>
                                                        <option @if ($client->state == 'ME') selected @endif value="ME">Maine</option>
                                                        <option @if ($client->state == 'MD') selected @endif value="MD">Maryland</option>
                                                        <option @if ($client->state == 'MA') selected @endif value="MA">Massachusetts</option>
                                                        <option @if ($client->state == 'MI') selected @endif value="MI">Michigan</option>
                                                        <option @if ($client->state == 'MN') selected @endif value="MN">Minnesota</option>
                                                        <option @if ($client->state == 'MS') selected @endif value="MS">Mississippi</option>
                                                        <option @if ($client->state == 'MO') selected @endif value="MO">Missouri</option>
                                                        <option @if ($client->state == 'MT') selected @endif value="MT">Montana</option>
                                                        <option @if ($client->state == 'NE') selected @endif value="NE">Nebraska</option>
                                                        <option @if ($client->state == 'NV') selected @endif value="NV">Nevada</option>
                                                        <option @if ($client->state == 'NH') selected @endif value="NH">New Hampshire</option>
                                                        <option @if ($client->state == 'NJ') selected @endif value="NJ">New Jersey</option>
                                                        <option @if ($client->state == 'NM') selected @endif value="NM">New Mexico</option>
                                                        <option @if ($client->state == 'NY') selected @endif value="NY">New York</option>
                                                        <option @if ($client->state == 'NC') selected @endif value="NC">North Carolina</option>
                                                        <option @if ($client->state == 'ND') selected @endif value="ND">North Dakota</option>
                                                        <option @if ($client->state == 'OH') selected @endif value="OH">Ohio</option>
                                                        <option @if ($client->state == 'OK') selected @endif value="OK">Oklahoma</option>
                                                        <option @if ($client->state == 'OR') selected @endif value="OR">Oregon</option>
                                                        <option @if ($client->state == 'PA') selected @endif value="PA">Pennsylvania</option>
                                                        <option @if ($client->state == 'RI') selected @endif value="RI">Rhode Island</option>
                                                        <option @if ($client->state == 'SC') selected @endif value="SC">South Carolina</option>
                                                        <option @if ($client->state == 'SD') selected @endif value="SD">South Dakota</option>
                                                        <option @if ($client->state == 'TN') selected @endif value="TN">Tennessee</option>
                                                        <option @if ($client->state == 'TX') selected @endif value="TX">Texas</option>
                                                        <option @if ($client->state == 'UT') selected @endif value="UT">Utah</option>
                                                        <option @if ($client->state == 'VT') selected @endif value="VT">Vermont</option>
                                                        <option @if ($client->state == 'VA') selected @endif value="VA">Virginia</option>
                                                        <option @if ($client->state == 'WA') selected @endif value="WA">Washington</option>
                                                        <option @if ($client->state == 'WV') selected @endif value="WV">West Virginia</option>
                                                        <option @if ($client->state == 'WI') selected @endif value="WI">Wisconsin</option>
                                                        <option @if ($client->state == 'WY') selected @endif value="WY">Wyoming</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_zip">
                                                    <label for="cus_zip" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_zip" class="form-control py-2 zip-input-mask" id="cus_zip" placeholder="Zip" value="{{$client->zipcode}}" required data-error="Please enter zipcode" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_phone">
                                                    <label for="cus_phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_phone" class="form-control py-2 phone-input-mask" id="cus_phone" placeholder="Phone" value="{{$client->phone}}" required data-error="Please enter phone" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="cus_phone" class="form-label">Profile Image<span class="text-danger">*</span></label>
                                                <img src="{{ asset('storage/' . $client->profile_image) }}" alt="Main Picture" width="400px" />
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
                                                <div class="form-group valid_cus_pp">
                                                    <label for="cus_pp" class="form-label">Are you currently on probation or parole?<span class="text-danger">*</span></label>
                                                    <select class="form-select" name="role" id="cus_pp" required data-error="Please select" disabled>
                                                        <option value="">Please select</option>
                                                        <option @if( $client->criminalHistories->role == 1) selected @endif value="1">Probation</option>
                                                        <option @if( $client->criminalHistories->role == 2) selected @endif value="2">Parole</option>
                                                        <option @if( $client->criminalHistories->role == 3) selected @endif value="3">Both</option>
                                                        <option @if( $client->criminalHistories->role == 4) selected @endif value="4">Fully Discharged</option>
                                                        <option @if( $client->criminalHistories->role == 5) selected @endif value="5">N/A</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_dfc">
                                                <label for="cus_dfc" class="form-label">Date of Conviction<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="cus_dfc" name="cus_dfc" value="{{ $client->criminalHistories->date_of_con }}" required data-error="Please enter date of conviction" disabled>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_con">
                                                <label for="cus_con" class="form-label">Conviction<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="cus_con" name="cus_con" value="{{ $client->criminalHistories->conviction }}" required data-error="Please enter conviction" disabled>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_conq">
                                                <label for="cus_conq" class="form-label">Consequence<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_conq" id="cus_conq" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->criminalHistories->conq == 1) selected @endif value="1">Probation</option>
                                                    <option @if( $client->criminalHistories->conq == 2) selected @endif value="2">Incarceration</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_sex_off">
                                                <label for="cus_sex_off" class="form-label">Are you a registered sex offender?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_sex_off" id="cus_sex_off" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->criminalHistories->is_sex_off == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->criminalHistories->is_sex_off == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_offend_minor">
                                                <label for="cus_is_offend_minor" class="form-label">Did your crime involve a minor?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_offend_minor" id="cus_is_offend_minor" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option  @if( $client->criminalHistories->is_offend_minor == 1) selected @endif value="1">Yes</option>
                                                    <option  @if( $client->criminalHistories->is_offend_minor == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
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
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_food">
                                                <label for="cus_food" class="form-label">Do you need food?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_food" name="cus_food" aria-label="Food" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_food == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_food == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_cloth">
                                                <label for="cus_cloth" class="form-label">Do you need clothing?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_cloth" name="cus_cloth" aria-label="Clothing" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_cloth == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_cloth == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_shelter">
                                                <label for="cus_shelter" class="form-label">Do you need shelter/housing?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_shelter" name="cus_shelter" aria-label="Shelter" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_shelter == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_shelter == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_tra">
                                                <label for="cus_tra" class="form-label">Do you need transportation?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_tra" name="cus_tra" aria-label="Transportation" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_transport == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_transport == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_emp">
                                                <label for="cus_emp" class="form-label">Do you need employment?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_emp" name="cus_emp" aria-label="Employment" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_emp == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_emp == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_extra_income">
                                                <label for="cus_extra_income" class="form-label">Do you need extra income (Gigs, Plasma, etc)?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_extra_income" name="cus_extra_income" aria-label="Extra Income" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->extra_incom == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->extra_incom == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_church">
                                                <label for="cus_church" class="form-label">Which church did you attend?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_church" name="cus_church" aria-label="Church" required data-error="Please select" disabled>
                                                    <option value="">Choose one</option>
                                                    <option @if( $client->surveys->church == "First Baptist Church") selected @endif  value="First Baptist Church">First Baptist Church</option>
                                                    <option @if( $client->surveys->church == "Second Presbyterian Church") selected @endif  value="Second Presbyterian Church">Second Presbyterian Church</option>
                                                    <option @if( $client->surveys->church == "Grace Lutheran Church") selected @endif  value="Grace Lutheran Church">Grace Lutheran Church</option>
                                                    <option @if( $client->surveys->church == "Saint Mary's Catholic Church") selected @endif  value="Saint Mary's Catholic Church">Saint Mary's Catholic Church</option>
                                                    <option @if( $client->surveys->church == "Community Church of Christ") selected @endif  value="Community Church of Christ">Community Church of Christ</option>
                                                    <option @if( $client->surveys->church == "Zion United Methodist Church") selected @endif  value="Zion United Methodist Church">Zion United Methodist Church</option>
                                                    <option @if( $client->surveys->church == "Faith Baptist Church") selected @endif  value="Faith Baptist Church">Faith Baptist Church</option>
                                                    <option @if( $client->surveys->church == "Emmanuel Episcopal Church") selected @endif  value="Emmanuel Episcopal Church">Emmanuel Episcopal Church</option>
                                                    <option @if( $client->surveys->church == "Mount Hope Church") selected @endif  value="Mount Hope Church">Mount Hope Church</option>
                                                    <option @if( $client->surveys->church == "Hope Community Church") selected @endif  value="Hope Community Church">Hope Community Church</option>
                                                    <option @if( $client->surveys->church == "Trinity United Church of Christ") selected @endif  value="Trinity United Church of Christ">Trinity United Church of Christ</option>
                                                    <option @if( $client->surveys->church == "New Life Assembly") selected @endif  value="New Life Assembly">New Life Assembly</option>
                                                    <option @if( $client->surveys->church == "Cornerstone Church") selected @endif  value="Cornerstone Church">Cornerstone Church</option>
                                                    <option @if( $client->surveys->church == "Calvary Baptist Church") selected @endif  value="Calvary Baptist Church">Calvary Baptist Church</option>
                                                    <option @if( $client->surveys->church == "Crossroads Church") selected @endif  value="Crossroads Church">Crossroads Church</option>
                                                    <option @if( $client->surveys->church == "City Harvest Church") selected @endif  value="City Harvest Church">City Harvest Church</option>
                                                    <option @if( $client->surveys->church == "New Hope Christian Church") selected @endif  value="New Hope Christian Church">New Hope Christian Church</option>
                                                    <option @if( $client->surveys->church == "Abundant Life Church") selected @endif  value="Abundant Life Church">Abundant Life Church</option>
                                                    <option @if( $client->surveys->church == "Victory Christian Church") selected @endif  value="Victory Christian Church">Victory Christian Church</option>
                                                    <option @if( $client->surveys->church == "Praise Chapel") selected @endif  value="Praise Chapel">Praise Chapel</option>
                                                    <option @if( $client->surveys->church == "other") selected @endif value="other">Other</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_other_church">
                                                <div id="custom-church-container" style="display: none;">
                                                    <label for="cus_other_church" class="form-label">Other Church Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="cus_other_church" name="cus_other_church" placeholder="Enter other church name" value="{{ $client->surveys->custom_church }}" disabled>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <!-- Hidden input for custom church name -->
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_bcert">
                                                <label for="cus_bcert" class="form-label">Do you have your birth certificate?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_bcert" name="cus_bcert" aria-label="Birth Certificate" required data-error="Please select" onchange="birthDiv()" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if( $client->surveys->is_bcert == 1) selected @endif value="1">Yes</option>
                                                    <option @if( $client->surveys->is_bcert == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_born_state">
                                                <div id="birthDiv">
                                                    <label for="cus_born_state" class="form-label">What state were you born?<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" id="cus_born_state" name="cus_born_state" aria-label="State"  data-error="Please select" disabled>
                                                        <option value="">Please select</option>
                                                        <option @if ($client->surveys->state_name == 'AL') selected @endif value="AL">Alabama</option>
                                                        <option @if ($client->surveys->state_name == 'AK') selected @endif value="AK">Alaska</option>
                                                        <option @if ($client->surveys->state_name == 'AZ') selected @endif value="AZ">Arizona</option>
                                                        <option @if ($client->surveys->state_name == 'AR') selected @endif value="AR">Arkansas</option>
                                                        <option @if ($client->surveys->state_name == 'CA') selected @endif value="CA">California</option>
                                                        <option @if ($client->surveys->state_name == 'CO') selected @endif value="CO">Colorado</option>
                                                        <option @if ($client->surveys->state_name == 'CT') selected @endif value="CT">Connecticut</option>
                                                        <option @if ($client->surveys->state_name == 'DE') selected @endif value="DE">Delaware</option>
                                                        <option @if ($client->surveys->state_name == 'FL') selected @endif value="FL">Florida</option>
                                                        <option @if ($client->surveys->state_name == 'GA') selected @endif value="GA">Georgia</option>
                                                        <option @if ($client->surveys->state_name == 'HI') selected @endif value="HI">Hawaii</option>
                                                        <option @if ($client->surveys->state_name == 'ID') selected @endif value="ID">Idaho</option>
                                                        <option @if ($client->surveys->state_name == 'IL') selected @endif value="IL">Illinois</option>
                                                        <option @if ($client->surveys->state_name == 'IN') selected @endif value="IN">Indiana</option>
                                                        <option @if ($client->surveys->state_name == 'IA') selected @endif value="IA">Iowa</option>
                                                        <option @if ($client->surveys->state_name == 'KS') selected @endif value="KS">Kansas</option>
                                                        <option @if ($client->surveys->state_name == 'KY') selected @endif value="KY">Kentucky</option>
                                                        <option @if ($client->surveys->state_name == 'LA') selected @endif value="LA">Louisiana</option>
                                                        <option @if ($client->surveys->state_name == 'ME') selected @endif value="ME">Maine</option>
                                                        <option @if ($client->surveys->state_name == 'MD') selected @endif value="MD">Maryland</option>
                                                        <option @if ($client->surveys->state_name == 'MA') selected @endif value="MA">Massachusetts</option>
                                                        <option @if ($client->surveys->state_name == 'MI') selected @endif value="MI">Michigan</option>
                                                        <option @if ($client->surveys->state_name == 'MN') selected @endif value="MN">Minnesota</option>
                                                        <option @if ($client->surveys->state_name == 'MS') selected @endif value="MS">Mississippi</option>
                                                        <option @if ($client->surveys->state_name == 'MO') selected @endif value="MO">Missouri</option>
                                                        <option @if ($client->surveys->state_name == 'MT') selected @endif value="MT">Montana</option>
                                                        <option @if ($client->surveys->state_name == 'NE') selected @endif value="NE">Nebraska</option>
                                                        <option @if ($client->surveys->state_name == 'NV') selected @endif value="NV">Nevada</option>
                                                        <option @if ($client->surveys->state_name == 'NH') selected @endif value="NH">New Hampshire</option>
                                                        <option @if ($client->surveys->state_name == 'NJ') selected @endif value="NJ">New Jersey</option>
                                                        <option @if ($client->surveys->state_name == 'NM') selected @endif value="NM">New Mexico</option>
                                                        <option @if ($client->surveys->state_name == 'NY') selected @endif value="NY">New York</option>
                                                        <option @if ($client->surveys->state_name == 'NC') selected @endif value="NC">North Carolina</option>
                                                        <option @if ($client->surveys->state_name == 'ND') selected @endif value="ND">North Dakota</option>
                                                        <option @if ($client->surveys->state_name == 'OH') selected @endif value="OH">Ohio</option>
                                                        <option @if ($client->surveys->state_name == 'OK') selected @endif value="OK">Oklahoma</option>
                                                        <option @if ($client->surveys->state_name == 'OR') selected @endif value="OR">Oregon</option>
                                                        <option @if ($client->surveys->state_name == 'PA') selected @endif value="PA">Pennsylvania</option>
                                                        <option @if ($client->surveys->state_name == 'RI') selected @endif value="RI">Rhode Island</option>
                                                        <option @if ($client->surveys->state_name == 'SC') selected @endif value="SC">South Carolina</option>
                                                        <option @if ($client->surveys->state_name == 'SD') selected @endif value="SD">South Dakota</option>
                                                        <option @if ($client->surveys->state_name == 'TN') selected @endif value="TN">Tennessee</option>
                                                        <option @if ($client->surveys->state_name == 'TX') selected @endif value="TX">Texas</option>
                                                        <option @if ($client->surveys->state_name == 'UT') selected @endif value="UT">Utah</option>
                                                        <option @if ($client->surveys->state_name == 'VT') selected @endif value="VT">Vermont</option>
                                                        <option @if ($client->surveys->state_name == 'VA') selected @endif value="VA">Virginia</option>
                                                        <option @if ($client->surveys->state_name == 'WA') selected @endif value="WA">Washington</option>
                                                        <option @if ($client->surveys->state_name == 'WV') selected @endif value="WV">West Virginia</option>
                                                        <option @if ($client->surveys->state_name == 'WI') selected @endif value="WI">Wisconsin</option>
                                                        <option @if ($client->surveys->state_name == 'WY') selected @endif value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_state_id">
                                                <label for="cus_state_id" class="form-label">Do you have state ID?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_state_id" name="cus_state_id" aria-label="is_state_id" required data-error="Please select"  onchange="stateDiv()" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if ($client->surveys->is_state_id == '1') selected @endif value="1">Yes</option>
                                                    <option @if ($client->surveys->is_state_id == '2') selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_state_no">
                                                <div id="stateDiv">
                                                    <label for="cus_state_no" class="form-label">Please enter the state number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_state_no" value="{{ $client->surveys->stateIDno }}" name="cus_state_no"  data-error="Please enter state no" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_d_lice">
                                                <label for="cus_d_lice" class="form-label">Do you have driving license?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_d_lice" name="cus_d_lice" aria-label="DL" required data-error="Please select"  onchange="licenseDiv()" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if ($client->surveys->is_DL == 1) selected @endif value="1">Yes</option>
                                                    <option @if ($client->surveys->is_DL == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_lice_no">
                                                <div id="licenseDiv">
                                                    <label for="cus_lice_no" class="form-label">Please enter the driving license number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_lice_no" value="{{ $client->surveys->DlicenseNo }}" name="cus_lice_no" data-error="Please enter license number" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_ss_card">
                                                <label for="cus_ss_card" class="form-label">Do you have a social security card?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="cus_ss_card" name="cus_ss_card" aria-label="Social Security Card" required data-error="Please select" onchange="securityDiv()" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if ($client->surveys->is_ss_card == 1) selected @endif  value="1">Yes</option>
                                                    <option @if ($client->surveys->is_ss_card == 2) selected @endif  value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_ssc_no">
                                                <div id="securityDiv">
                                                    <label for="cus_ssc_no" class="form-label">Please enter the SSN<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="cus_ssc_no" value="{{ $client->surveys->ss_number }}" name="cus_ssc_no" placeholder="******" data-error="Please enter the SSN" disabled>
                                                    <div class="help-block with-errors"></div>
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
                                        {{-- healthIns --}}
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_insurace">
                                                <label for="cus_insurace" class="form-label">Do you have a health insurance?<span class="text-danger">*</span></label>
                                                <select class="form-select mb-3" name="cus_insurace" id="cus_insurace" required data-error="Please select" onchange="insuranceDiv()">
                                                    <option value="">Please select</option>
                                                    <option @if ($client->healthIns->is_health == 1) selected @endif value="1">Yes</option>
                                                    <option @if ($client->healthIns->is_health == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>  
                
                                            <div id="insuranceDiv">
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_carrier">
                                                    <label for="cus_carrier">Carrier<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $client->healthIns->carrier }}" id="cus_carrier" name="cus_carrier"  data-error="Please select" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_mem_id">
                                                    <label for="cus_mem_id">Member ID<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $client->healthIns->mem_id }}" id="cus_mem_id" name="cus_mem_id"  data-error="Please select" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="col-sm-6 col-lg-6 form-group valid_cus_grp_no">
                                                    <label for="cus_grp_no">Group No<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $client->healthIns->grp_no }}" id="cus_grp_no" name="cus_grp_no"  data-error="Please select" disabled>
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
                                                    <div class="form-layer-step active">
                                                        <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">4- Health Insurance</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-layer-step currentstep">
                                                        <div class="form-layer-step-icon  activestep"><i class="fas fa-check"></i>
                                                        </div>
                                                        <p class="steptitle">5- Others info</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>

                                        {{-- <h3 class="section-form-title">Others info</h3> --}}
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_more_friends">
                                                <label for="cus_more_friends">Could you use more friends?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_more_friends" id="cus_more_friends" required data-error="Please select" onchange="friendsDiv()" disabled>                                    
                                                    <option value="">Please select</option>
                                                    <option @if ($client->info->more_friends == 1) selected @endif value="1">Yes</option>
                                                    <option @if ($client->info->more_friends == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_counselor">
                                                <div id="friendsDiv">
                                                    <label for="cus_counselor">Do you believe you could benefit from having a mentor or counselor?<span class="text-danger">*</span></label>
                                                    <select class="form-select" name="cus_counselor" id="cus_counselor"   data-error="Please select" disabled>
                                                        <option value="">Please select</option>
                                                        <option @if ($client->info->counselor == 1) selected @endif value="1">Yes</option>
                                                        <option @if ($client->info->counselor == 2) selected @endif value="2">No</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_inv_rom">
                                                <label for="cus_is_inv_rom">Are you looking for someone with whom you could be involved romantically?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_inv_rom" id="cus_is_inv_rom" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if ($client->info->is_inv_rom == 1) selected @endif value="1">Yes</option>
                                                    <option @if ($client->info->is_inv_rom == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_mental_ill">
                                                <label for="cus_is_mental_ill">Have you ever been diagnosed with a mental illness?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_mental_ill" id="cus_is_mental_ill" required data-error="Please select" disabled>
                                                    <option value="">Please select</option>
                                                    <option @if ($client->info->is_mental_ill == 1) selected @endif value="1">Yes</option>
                                                    <option @if ($client->info->is_mental_ill == 2) selected @endif value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_phy_dis">
                                                <label for="cus_phy_dis">Do you have any known physical disabilities<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="cus_phy_dis" name="cus_phy_dis"  required data-error="Please select" disabled>{{ $client->info->phy_dis }}</textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_comments">
                                                <label for="cus_comments">Please enter anything else you would like for us to know?</label><br>
                                                <textarea class="form-control" id="cus_comments" name="cus_comments" disabled>{{ $client->info->comments }}</textarea>
                                                
                                            </div>
                                        
                                            <div id="mgsFormSubmit" class="hidden"></div>
                                            <div id="final-step-buttons" class="form-group  signUpForm-step-5">
                                                <button class="btn btn-custom" type="button"
                                                    onclick="previousStep4()"><span class="fas fa-arrow-left"></span>
                                                    Back</button>
                                                
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
<script src="{{asset('wizard-form/js/reg-form.js')}}"></script>
@endsection