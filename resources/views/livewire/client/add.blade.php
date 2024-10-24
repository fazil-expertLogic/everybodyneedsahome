@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix mt-8">
                    <div class="col-md-6 offset-md-3">
                        <form id="signUpForm" name="signUpForm" data-toggle="validator" class="signUpForm"
                            enctype="multipart/form-data">
                            <div class="signUpForm-step-holder">

                                <div id="section-1" class="signUpForm-step-wrap">

                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 0%;"></div>
                                            </div>
                                            
                                            <div class="form-layer-step currentstep">
                                                <div class="form-layer-step-icon activestep"><i
                                                        class="fas fa-unlock-alt"></i></div>
                                                <p class="steptitle">1- Basic Information</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                </div>
                                                <p class="steptitle">2- Criminal History</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                <p class="steptitle">3- Needs Survey</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">4- Health Insurance</p>
                                            </div>

                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">5- Others info</p>
                                            </div>
                                            
                                        </div>

                                        <h3 class="section-form-title">Basic Information</h3>
                                        <div class="help-block with-errors mandatory-error"></div>
                                        {{--        ------------------------------remove------------------------------                  --}}
                                        {{-- <div class="form-group validuname">
                                            <input class="form-control" name="uname" id="uname" type="text"
                                                placeholder="UserName*" required data-error="Please enter UserName">
                                            <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group validemail">
                                            <input class="form-control" name="email" id="email" type="email"
                                                placeholder="Email*" required data-error="Please enter valid email">
                                            <div class="input-group-icon"><i class="fas fa-envelope"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group validpass">
                                            <input class="form-control" name="pass" id="pass" type="password"
                                                placeholder="Password* at least 6 character" required
                                                data-error="Please enter password">
                                            <div class="input-group-icon"><i class="fas fa-key"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="cpass" id="cpass" type="password"
                                                placeholder="Confirm Password*" required
                                                data-error="Please retype password">
                                            <div class="input-group-icon"><i class="fas fa-key"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div> --}}
                                        {{--        ------------------------------remove------------------------------                  --}}
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_name">
                                                    <label for="cus_name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_name" class="form-control py-2" value="" id="cus_name" placeholder="Your name" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_email">
                                                    <label for="cus_email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="cus_email" class="form-control py-2" id="cus_email" placeholder="example@email.com" value="" required data-error="Please enter email">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_dob">
                                                    <label for="cus_dob" class="form-label"> Date of Birth<span class="text-danger">*</span></label>
                                                    <input type="date" name="cus_dob" class="form-control py-2"id="cus_dob" placeholder="" value="" required data-error="Please enter Date of Birth">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ss">
                                                    <label for="cus_ss" class="form-label">Social Security Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2 ssn-input-mask" value="" name="cus_ss" id="cus_ss" placeholder="*****" required data-error="Please enter Social Security Number">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_ms">
                                                    <label for="cus_ms" class="form-label">Marital Status<span class="text-danger">*</span></label>
                                                    <select name="martial_status" class="form-select" id="cus_ms" aria-label="" required data-error="Please select marital status">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Single</option>
                                                        <option value="2">Married</option>
                                                        <option value="3">Separated</option>
                                                        <option value="4">Divorced</option>
                                                        <option value="5">Widowed</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_is_child">
                                                    <label for="cus_is_child" class="form-label">Children<span class="text-danger">*</span></label>
                                                    <select name="cus_is_child" class="form-select" id="cus_is_child" aria-label="" required data-error="Please select Children">
                                                        <option value="">Please Select</option>
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
            
                                            <div class="col-sm-12 col-lg-12" style="display: none;" id="childinfobox">
                                                <div id="child-boxes-container">
                                                        <div class="row childBOX">
                                                            <div class="col-sm-6 col-lg-6">
                                                                <fieldset class="mb-3">
                                                                    <label for="child_name_0" class="form-label">Child Name<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control py-2" value="" name="child_name[]" id="child_name_0">
                                                                </fieldset>
                                                            </div>
            
                                                            <div class="col-sm-6 col-lg-6">
                                                                <fieldset class="">
                                                                    <label for="child_age_0" class="form-label">Child Age<span class="text-danger">*</span></label>
                                                                    <select name="child_age[]" class="form-select" id="child_age_0" aria-label="">
            
                                                                                                                                        <option value="0" selected="">
                                                                                0+
                                                                            </option>
                                                                                                                                        <option value="1">
                                                                                1
                                                                            </option>
                                                                                                                                        <option value="2">
                                                                                2
                                                                            </option>
                                                                                                                                        <option value="3">
                                                                                3
                                                                            </option>
                                                                                                                                        <option value="4">
                                                                                4
                                                                            </option>
                                                                                                                                        <option value="5">
                                                                                5
                                                                            </option>
                                                                                                                                        <option value="6">
                                                                                6
                                                                            </option>
                                                                                                                                        <option value="7">
                                                                                7
                                                                            </option>
                                                                                                                                        <option value="8">
                                                                                8
                                                                            </option>
                                                                                                                                        <option value="9">
                                                                                9
                                                                            </option>
                                                                                                                                        <option value="10">
                                                                                10
                                                                            </option>
                                                                                                                                        <option value="11">
                                                                                11
                                                                            </option>
                                                                                                                                        <option value="12">
                                                                                12
                                                                            </option>
                                                                                                                                        <option value="13">
                                                                                13
                                                                            </option>
                                                                                                                                        <option value="14">
                                                                                14
                                                                            </option>
                                                                                                                                        <option value="15">
                                                                                15
                                                                            </option>
                                                                                                                                        <option value="16">
                                                                                16
                                                                            </option>
                                                                                                                                        <option value="17">
                                                                                17
                                                                            </option>
                                                                                                                                        <option value="18">
                                                                                18
                                                                            </option>
                                                                                                                                </select>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                                                        </div>
            
                                                <div class="mb-3 text-end">
                                                    <a href="#" class="delete-child-box text-danger" style="display: none;">Delete</a> <span class="separator" style="display: none;">|</span>
                                                    <a href="#" id="add-new-child" class="text-blue">Add new</a>
                                                </div>
                                            </div>
            
            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_address">
                                                    <label for="cus_address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_address" class="form-control py-2" id="cus_address" placeholder="Address" value="" required data-error="Please enter address">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_city">
                                                    <label for="cus_city" class="form-label">City<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_city" class="form-control py-2" id="cus_city" placeholder="City" value="" required data-error="Please enter city">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_state">
                                                    <label for="cus_state" class="form-label">State<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" name="cus_state" id="cus_state" aria-label="" required data-error="Please enter state">
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
                                                <div class="form-group valid_cus_zip">
                                                    <label for="cus_zip" class="form-label">Zip<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_zip" class="form-control py-2 zip-input-mask" id="cus_zip" placeholder="Zip" value="" required data-error="Please enter zipcode">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_phone">
                                                    <label for="cus_phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                                    <input type="text" name="cus_phone" class="form-control py-2 phone-input-mask" id="cus_phone" placeholder="Phone" value="" required data-error="Please enter phone">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
            
                                        </div>
                                        <div class="form-group signUpForm-step-1">
                                            <button class="btn btn-default disable" type="button">Are you
                                                ready!</button>
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
                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
                                                <p class="steptitle">1- Basic Information</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step currentstep">
                                                <div class="form-layer-step-icon activestep"><i class="fas fa-user"></i>
                                                </div>
                                                <p class="steptitle">2- Criminal History</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                <p class="steptitle">3- Needs Survey</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">4- Health Insurance</p>
                                            </div>
                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">5- Others info</p>
                                            </div>
                                        </div>

                                        <h3 class="section-form-title">Criminal History</h3>
                                        <div class="help-block with-errors mandatory-error"></div>
                                        {{--  ------------------------------remove------------------------------  --}}
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_pp">
                                                    <label for="cus_pp" class="form-label">Are you currently on probation or parole?<span class="text-danger">*</span></label>
                                                    <select class="form-select" name="role" id="cus_pp" required data-error="Please select">
                                                        <option value="">Please select</option>
                                                        <option value="1">Probation</option>
                                                        <option value="2">Parole</option>
                                                        <option value="3">Both</option>
                                                        <option value="4">Fully Discharged</option>
                                                        <option value="5">N/A</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_dfc">
                                                <label for="cus_dfc" class="form-label">Date of Conviction<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="cus_dfc" name="cus_dfc" value="" required data-error="Please enter date of conviction">
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_con">
                                                <label for="cus_con" class="form-label">Conviction<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="cus_con" name="cus_con" value="" required data-error="Please enter conviction">
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_conq">
                                                <label for="cus_conq" class="form-label">Consequence<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_conq" id="cus_conq" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Probation</option>
                                                    <option value="2">Incarceration</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_sex_off">
                                                <label for="cus_sex_off" class="form-label">Are you a registered sex offender?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_sex_off" id="cus_sex_off" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
            
                                            <div class="col-sm-6 col-lg-6 form-group valid_cus_is_offend_minor">
                                                <label for="cus_is_offend_minor" class="form-label">Did your crime involve a minor?<span class="text-danger">*</span></label>
                                                <select class="form-select" name="cus_is_offend_minor" id="cus_is_offend_minor" required data-error="Please select">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
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
                                    <h3 class="section-title">Step 3 of 4</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 62.25%;">
                                                </div>
                                            </div>
                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
                                                <p class="steptitle">Account</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                </div>
                                                <p class="steptitle">Personal</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step currentstep">
                                                <div class="form-layer-step-icon activestep"><i
                                                        class="far fa-credit-card"></i></div>
                                                <p class="steptitle">Payment Info</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step">
                                                <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">Confirm</p>
                                            </div>
                                            
                                        </div>

                                        <h3 class="section-title">Payment Details: </h3>
                                        <div class="help-block with-errors mandatory-error"></div>
                                        <div class="form-group validpaymenttype">
                                            <select class="form-control" name="paymenttype" id="paymenttype"
                                                title="" required data-error="Please Select Payment Type">
                                                <option value="">--- Select Your Payment Type* ---
                                                </option>
                                                <option value="Master Card">Master Card</option>
                                                <option value="Visa Card">Visa Card</option>
                                            </select>
                                            <div class="input-group-icon"><i class="fas fa-venus"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group validhname">
                                            <input class="form-control" name="hname" id="hname" type="text"
                                                placeholder="Card Holder Name*" required
                                                data-error="Please enter Card Holder Name">
                                            <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group validcardnumber">
                                            <input class="form-control" name="cardnumber" id="cardnumber" type="text"
                                                pattern="\d*" placeholder="Card Number*" required
                                                data-error="Please enter valid card number">
                                            <div class="input-group-icon"><i class="far fa-credit-card"></i>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group validcvc">
                                            <input class="form-control" name="cvc" id="cvc" type="text"
                                                maxlength="3" pattern="\d*" placeholder="CVC*" required
                                                data-error="Please enter CVC">
                                            <div class="input-group-icon"><i class="far fa-credit-card"></i>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div id="sandbox-container2" class="form-group validexpirydate">
                                            <input class="form-control" name="expirydate" id="expirydate" type="text"
                                                placeholder="Expiry Date*" required data-error="Please enter Expiry Date">
                                            <div class="input-group-icon"><i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group validagree">
                                            <ul class="mgsstyle-checkbox mgscheckbox-style list-unstyled">
                                                <li><input name="aggre" id="aggre" type="checkbox" value="1"
                                                        required data-error="Required Consent"><label for="aggre">
                                                        Agree with <a href="javascript:void(0)">Terms &amp;
                                                            Conditions</a></label></li>
                                            </ul>
                                            <div class="help-block with-errors"></div>
                                        </div>



                                        <div class="row">
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="food" class="form-label">Do you need food?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="food" name="is_food" aria-label="Food">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes
                                                    </option>
                                                    <option value="2">No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="clothing" class="form-label">Do you need clothing?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="clothing" name="is_cloth" aria-label="Clothing">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="shelter" class="form-label">Do you need shelter/housing?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="shelter" name="is_shelter" aria-label="Shelter">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">
                                                        No</option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="transportation" class="form-label">Do you need transportation?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="transportation" name="is_transport" aria-label="Transportation">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">
                                                        No</option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="employment" class="form-label">Do you need employment?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="employment" name="is_emp" aria-label="Employment">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes
                                                    </option>
                                                    <option value="2">No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="exIncome" class="form-label">Do you need extra income (Gigs, Plasma, etc)?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="exIncome" name="extra_incom" aria-label="Extra Income">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes
                                                    </option>
                                                    <option value="2">
                                                        No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="church" class="form-label">Which church did you attend?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="church" name="church" aria-label="Church">
                                                    <option value="">Choose one</option>
                                                                                                <option value="First Baptist Church">
                                                            First Baptist Church</option>
                                                                                                <option value="Second Presbyterian Church">
                                                            Second Presbyterian Church</option>
                                                                                                <option value="Grace Lutheran Church">
                                                            Grace Lutheran Church</option>
                                                                                                <option value="Saint Mary's Catholic Church">
                                                            Saint Mary's Catholic Church</option>
                                                                                                <option value="Community Church of Christ">
                                                            Community Church of Christ</option>
                                                                                                <option value="Zion United Methodist Church">
                                                            Zion United Methodist Church</option>
                                                                                                <option value="Faith Baptist Church">
                                                            Faith Baptist Church</option>
                                                                                                <option value="Emmanuel Episcopal Church">
                                                            Emmanuel Episcopal Church</option>
                                                                                                <option value="Mount Hope Church">
                                                            Mount Hope Church</option>
                                                                                                <option value="Hope Community Church">
                                                            Hope Community Church</option>
                                                                                                <option value="Trinity United Church of Christ">
                                                            Trinity United Church of Christ</option>
                                                                                                <option value="New Life Assembly">
                                                            New Life Assembly</option>
                                                                                                <option value="Cornerstone Church">
                                                            Cornerstone Church</option>
                                                                                                <option value="Calvary Baptist Church">
                                                            Calvary Baptist Church</option>
                                                                                                <option value="Crossroads Church">
                                                            Crossroads Church</option>
                                                                                                <option value="City Harvest Church">
                                                            City Harvest Church</option>
                                                                                                <option value="New Hope Christian Church">
                                                            New Hope Christian Church</option>
                                                                                                <option value="Abundant Life Church">
                                                            Abundant Life Church</option>
                                                                                                <option value="Victory Christian Church">
                                                            Victory Christian Church</option>
                                                                                                <option value="Praise Chapel">
                                                            Praise Chapel</option>
                                                                                            <option value="other">
                                                        Other</option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
            
                                                <div id="custom-church-container" style="display: none;">
                                                    <label for="church" class="form-label">Other Church Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="custom_church" name="custom_church" placeholder="Enter other church name" value=" ">
                                                </div>
                                            </fieldset>
                                            <!-- Hidden input for custom church name -->
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="bCertificate" class="form-label">Do you have your birth certificate?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="is_yourID" name="is_bcert" aria-label="Birth Certificate">
                                                    <option value="">Please select</option>
            
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">
                                                        No</option>
                                                </select>
                                            </fieldset>
            
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
            
                                                <div id="statebox" style="display: block;">
                                                    <label for="bState" class="form-label">What state were you born?<span class="text-danger">*</span></label>
                                                    <select class="form-select py-2" id="bState" name="state_name" aria-label="State">
                                                        <option value="">Please select</option>
                                                                                                        <option value="AL">
                                                                Alabama</option>
                                                                                                        <option value="AK">
                                                                Alaska</option>
                                                                                                        <option value="AZ">
                                                                Arizona</option>
                                                                                                        <option value="AR">
                                                                Arkansas</option>
                                                                                                        <option value="CA">
                                                                California</option>
                                                                                                        <option value="CO">
                                                                Colorado</option>
                                                                                                        <option value="CT">
                                                                Connecticut</option>
                                                                                                        <option value="DE">
                                                                Delaware</option>
                                                                                                        <option value="FL">
                                                                Florida</option>
                                                                                                        <option value="GA">
                                                                Georgia</option>
                                                                                                        <option value="HI">
                                                                Hawaii</option>
                                                                                                        <option value="ID">
                                                                Idaho</option>
                                                                                                        <option value="IL">
                                                                Illinois</option>
                                                                                                        <option value="IN">
                                                                Indiana</option>
                                                                                                        <option value="IA">
                                                                Iowa</option>
                                                                                                        <option value="KS">
                                                                Kansas</option>
                                                                                                        <option value="KY">
                                                                Kentucky</option>
                                                                                                        <option value="LA">
                                                                Louisiana</option>
                                                                                                        <option value="ME">
                                                                Maine</option>
                                                                                                        <option value="MD">
                                                                Maryland</option>
                                                                                                        <option value="MA">
                                                                Massachusetts</option>
                                                                                                        <option value="MI">
                                                                Michigan</option>
                                                                                                        <option value="MN">
                                                                Minnesota</option>
                                                                                                        <option value="MS">
                                                                Mississippi</option>
                                                                                                        <option value="MO">
                                                                Missouri</option>
                                                                                                        <option value="MT">
                                                                Montana</option>
                                                                                                        <option value="NE">
                                                                Nebraska</option>
                                                                                                        <option value="NV">
                                                                Nevada</option>
                                                                                                        <option value="NH">
                                                                New Hampshire</option>
                                                                                                        <option value="NJ">
                                                                New Jersey</option>
                                                                                                        <option value="NM">
                                                                New Mexico</option>
                                                                                                        <option value="NY">
                                                                New York</option>
                                                                                                        <option value="NC">
                                                                North Carolina</option>
                                                                                                        <option value="ND">
                                                                North Dakota</option>
                                                                                                        <option value="OH">
                                                                Ohio</option>
                                                                                                        <option value="OK">
                                                                Oklahoma</option>
                                                                                                        <option value="OR">
                                                                Oregon</option>
                                                                                                        <option value="PA">
                                                                Pennsylvania</option>
                                                                                                        <option value="RI">
                                                                Rhode Island</option>
                                                                                                        <option value="SC">
                                                                South Carolina</option>
                                                                                                        <option value="SD">
                                                                South Dakota</option>
                                                                                                        <option value="TN">
                                                                Tennessee</option>
                                                                                                        <option value="TX">
                                                                Texas</option>
                                                                                                        <option value="UT">
                                                                Utah</option>
                                                                                                        <option value="VT">
                                                                Vermont</option>
                                                                                                        <option value="VA">
                                                                Virginia</option>
                                                                                                        <option value="WA">
                                                                Washington</option>
                                                                                                        <option value="WV">
                                                                West Virginia</option>
                                                                                                        <option value="WI">
                                                                Wisconsin</option>
                                                                                                        <option value="WY">
                                                                Wyoming</option>
                                                                                                </select>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="is_state_id" class="form-label">Do you have state ID?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="is_statedID" name="is_state_id" aria-label="is_state_id">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">
                                                        No</option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
            
                                                <div id="stateidbox" style="display: block;">
                                                    <label for="StateNo" class="form-label">Please enter the state number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="stateIDno" value="" name="stateIDno">
                                                </div>
                                            </fieldset>
            
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="dl" class="form-label">Do you have driving license?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="is_DL" name="is_DL" aria-label="DL">
                                                    <option value="">Please select</option>
                                                    <option value="1">Yes
                                                    </option>
                                                    <option value="2">No
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <div id="licencebox" style="display: none;">
                                                    <label for="licno" class="form-label">Please enter the driving license
                                                        number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="licenseNo" value="" name="DlicenseNo">
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <label for="SocialCard" class="form-label">Do you have a social security card?<span class="text-danger">*</span></label>
                                                <select class="form-select py-2" id="SocialCard" name="is_ss_card" aria-label="Social Security Card">
                                                    <option value="">Please select</option>
                                                    <option value="1">
                                                        Yes</option>
                                                    <option value="2">
                                                        No</option>
                                                </select>
                                            </fieldset>
            
                                            <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                <div id="ssnbox" style="display: block;">
                                                    <label for="StateNo" class="form-label">Please enter the SSN<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control py-2" id="StateNo" value="" name="ss_number" placeholder="******">
                                                </div>
                                            </fieldset>
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
                                    <h3 class="section-title">Step 4 of 4: Review &amp; Submit</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
                                                <p class="steptitle">Account</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                </div>
                                                <p class="steptitle">Personal</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                <p class="steptitle">Payment Info</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step currentstep">
                                                <div class="form-layer-step-icon activestep"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">Confirm</p>
                                            </div>
                                            
                                        </div>

                                        <h3 class="section-form-title">Confirm Details</h3>
                                        <div class="row">
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <div id="profile-Image"><img id="userPhoto" src="#"
                                                        alt="Prifile Image" /></div>
                                                <h3>Profile Image</h3>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Account Information</h5>
                                                <p id="unameData"></p>
                                                <p id="emailData"></p>
                                                <p id="passData"></p>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Personal Information:</h5>
                                                <p id="firstNameData"></p>
                                                <p id="lastNameData"></p>
                                                <p id="genderData"></p>
                                                <p id="birthdateData"></p>
                                                <p id="addressData"></p>
                                                <p id="emailaddressData"></p>
                                                <p id="phoneData"></p>
                                                <p id="preferedcontactData"></p>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Payment Information:</h5>
                                                <p id="paymenttypeData"></p>
                                                <p id="hnameData"></p>
                                                <p id="cardnumberData"></p>
                                                <p id="cvcData"></p>
                                                <p id="expirydateData"></p>
                                            </div>
                                            <div class="help-block with-errors mandatory-error"></div>
                                            <div class="form-group col-sm-12">
                                                <div id="humanCheckCaptchaBox"></div>
                                                <div id="firstDigit"></div> + <div id="secondDigit"></div> =
                                                <input name="humanCheckCaptchaInput" id="humanCheckCaptchaInput"
                                                    placeholder="" maxlength="3" class="form-control" type="text"
                                                    required data-error="Please solve Captcha">
                                                <div class="help-block with-errors"></div>
                                            </div>



                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div id="AggreData"><strong>Agree with terms &amp;
                                                            conditions:</strong> <input name="aggre" id="aggre2"
                                                            value="1" checked disabled type="checkbox"></div>
                                                </div>





                                                <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                    <label for="is_insurace" class="form-label">Do you have a health insurance?<span class="text-danger">*</span></label>
                                                    <select class="form-select mb-3" name="is_health" id="is_insurace">
                    
                                                        <option value="">Please select</option>
                                                        <option value="1">
                    
                                                            Yes</option>
                                                        <option value="2">
                                                            No</option>
                                                    </select>
                                                </fieldset>
                    
                                                <input type="hidden" name="gl_ID" value="195">
                    
                    
                                                <div id="ins_box" style="display: block;">
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="carrier">Carrier<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="carrier" name="carrier">
                                                    </fieldset>
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="mem_id">Member ID<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="mem_id" name="mem_id">
                                                    </fieldset>
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="grp_no">Group No<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="grp_no" name="grp_no">
                                                    </fieldset>
                                                </div>
                                                <div id="mgsFormSubmit" class="hidden"></div>
                                                <div id="final-step-buttons" class="form-group  signUpForm-step-4">
                                                    <button class="btn btn-custom" type="button"
                                                        onclick="previousStep3()"><span class="fas fa-arrow-left"></span>
                                                        Back</button>
                                                    <button id="Submit" class="btn btn-custom float-end"
                                                        type="submit">Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="section-5" class="signUpForm-step-wrap review-submit-section slide-right">
                                    <h3 class="section-title">Step 4 of 4: Review &amp; Submit</h3>
                                    <fieldset>
                                        <div class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                            <div class="form-layer-progress">
                                                <div class="form-layer-progress-line" style="width: 100%;">
                                                </div>
                                            </div>
                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-unlock-alt"></i></div>
                                                <p class="steptitle">Account</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                </div>
                                                <p class="steptitle">Personal</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step active">
                                                <div class="form-layer-step-icon"><i class="far fa-credit-card"></i></div>
                                                <p class="steptitle">Payment Info</p>
                                            </div>
                                            

                                            
                                            <div class="form-layer-step currentstep">
                                                <div class="form-layer-step-icon activestep"><i class="fas fa-check"></i>
                                                </div>
                                                <p class="steptitle">Confirm</p>
                                            </div>
                                            
                                        </div>

                                        <h3 class="section-form-title">Confirm Details</h3>
                                        <div class="row">
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <div id="profile-Image"><img id="userPhoto" src="#"
                                                        alt="Prifile Image" /></div>
                                                <h3>Profile Image</h3>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Account Information</h5>
                                                <p id="unameData"></p>
                                                <p id="emailData"></p>
                                                <p id="passData"></p>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Personal Information:</h5>
                                                <p id="firstNameData"></p>
                                                <p id="lastNameData"></p>
                                                <p id="genderData"></p>
                                                <p id="birthdateData"></p>
                                                <p id="addressData"></p>
                                                <p id="emailaddressData"></p>
                                                <p id="phoneData"></p>
                                                <p id="preferedcontactData"></p>
                                            </div>
                                            <div class="contentBoxMargin col-sm-12 text-center">
                                                <h5>Payment Information:</h5>
                                                <p id="paymenttypeData"></p>
                                                <p id="hnameData"></p>
                                                <p id="cardnumberData"></p>
                                                <p id="cvcData"></p>
                                                <p id="expirydateData"></p>
                                            </div>
                                            <div class="help-block with-errors mandatory-error"></div>
                                            <div class="form-group col-sm-12">
                                                <div id="humanCheckCaptchaBox"></div>
                                                <div id="firstDigit"></div> + <div id="secondDigit"></div> =
                                                <input name="humanCheckCaptchaInput" id="humanCheckCaptchaInput"
                                                    placeholder="" maxlength="3" class="form-control" type="text"
                                                    required data-error="Please solve Captcha">
                                                <div class="help-block with-errors"></div>
                                            </div>



                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div id="AggreData"><strong>Agree with terms &amp;
                                                            conditions:</strong> <input name="aggre" id="aggre2"
                                                            value="1" checked disabled type="checkbox"></div>
                                                </div>





                                                <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                    <label for="is_insurace" class="form-label">Do you have a health insurance?<span class="text-danger">*</span></label>
                                                    <select class="form-select mb-3" name="is_health" id="is_insurace">
                    
                                                        <option value="">Please select</option>
                                                        <option value="1">
                    
                                                            Yes</option>
                                                        <option value="2">
                                                            No</option>
                                                    </select>
                                                </fieldset>
                    
                                                <input type="hidden" name="gl_ID" value="195">
                    
                    
                                                <div id="ins_box" style="display: block;">
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="carrier">Carrier<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="carrier" name="carrier">
                                                    </fieldset>
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="mem_id">Member ID<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="mem_id" name="mem_id">
                                                    </fieldset>
                                                    <fieldset class="mb-3 col-sm-6 col-lg-6">
                                                        <label for="grp_no">Group No<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="" id="grp_no" name="grp_no">
                                                    </fieldset>
                                                </div>
                                                <div id="mgsFormSubmit" class="hidden"></div>
                                                <div id="final-step-buttons" class="form-group  signUpForm-step-4">
                                                    <button class="btn btn-custom" type="button"
                                                        onclick="previousStep3()"><span class="fas fa-arrow-left"></span>
                                                        Back</button>
                                                    <button id="Submit" class="btn btn-custom float-end"
                                                        type="submit">Submit </button>
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
