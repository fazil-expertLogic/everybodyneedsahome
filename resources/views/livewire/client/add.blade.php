@extends('layouts.wizard-form')

@section('content')
    <div class="signupForm-section wrapper">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-wrap clearfix">
                                <h2 class="form-title">RegForm - Advanced Multi Step Registration HTML Ajax Form</h2>
                                <div class="col-md-6 offset-md-3">
                                    <form id="signUpForm" name="signUpForm" data-toggle="validator" class="signUpForm"
                                        enctype="multipart/form-data">
                                        <div class="signUpForm-step-holder">

                                            <div id="section-1" class="signUpForm-step-wrap">
                                                <h3 class="section-title">Step 1 of 4</h3>
                                                <fieldset>
                                                    <div
                                                        class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                                        <div class="form-layer-progress">
                                                            <div class="form-layer-progress-line" style="width: 0%;"></div>
                                                        </div>
                                                        <!-- Step 1 -->
                                                        <div class="form-layer-step currentstep">
                                                            <div class="form-layer-step-icon activestep"><i
                                                                    class="fas fa-unlock-alt"></i></div>
                                                            <p class="steptitle">Account</p>
                                                        </div>
                                                        <!-- Step 1 -->

                                                        <!-- Step 2 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                            </div>
                                                            <p class="steptitle">Personal</p>
                                                        </div>
                                                        <!-- Step 2 -->

                                                        <!-- Step 3 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="far fa-credit-card"></i></div>
                                                            <p class="steptitle">Payment Info</p>
                                                        </div>
                                                        <!-- Step 3 -->

                                                        <!-- Step 4 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                            </div>
                                                            <p class="steptitle">Confirm</p>
                                                        </div>
                                                        <!-- Step 4 -->
                                                    </div>

                                                    <h3 class="section-form-title">Account Information</h3>
                                                    <div class="help-block with-errors mandatory-error"></div>
                                                    <div class="form-group validuname">
                                                        <input class="form-control" name="uname" id="uname"
                                                            type="text" placeholder="UserName*" required
                                                            data-error="Please enter UserName">
                                                        <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validemail">
                                                        <input class="form-control" name="email" id="email"
                                                            type="email" placeholder="Email*" required
                                                            data-error="Please enter valid email">
                                                        <div class="input-group-icon"><i class="fas fa-envelope"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validpass">
                                                        <input class="form-control" name="pass" id="pass"
                                                            type="password" placeholder="Password* at least 6 character"
                                                            required data-error="Please enter password">
                                                        <div class="input-group-icon"><i class="fas fa-key"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" name="cpass" id="cpass"
                                                            type="password" placeholder="Confirm Password*" required
                                                            data-error="Please retype password">
                                                        <div class="input-group-icon"><i class="fas fa-key"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group signUpForm-step-1">
                                                        <button class="btn btn-default disable" type="button">Are you
                                                            ready!</button>
                                                        <button class="btn btn-custom float-end" onclick="nextStep2()"
                                                            type="button">Next <span
                                                                class="fas fa-arrow-right"></span></button>
                                                    </div>
                                                </fieldset>
                                            </div><!-- end section -->

                                            <div id="section-2" class="signUpForm-step-wrap slide-right">
                                                <h3 class="section-title">Step 2 of 4</h3>
                                                <fieldset>
                                                    <div
                                                        class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                                        <div class="form-layer-progress">
                                                            <div class="form-layer-progress-line" style="width: 37.25%;">
                                                            </div>
                                                        </div>
                                                        <!-- Step 1 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="fas fa-unlock-alt"></i></div>
                                                            <p class="steptitle">Account</p>
                                                        </div>
                                                        <!-- Step 1 -->

                                                        <!-- Step 2 -->
                                                        <div class="form-layer-step currentstep">
                                                            <div class="form-layer-step-icon activestep"><i
                                                                    class="fas fa-user"></i></div>
                                                            <p class="steptitle">Personal</p>
                                                        </div>
                                                        <!-- Step 2 -->

                                                        <!-- Step 3 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="far fa-credit-card"></i></div>
                                                            <p class="steptitle">Payment Info</p>
                                                        </div>
                                                        <!-- Step 3 -->

                                                        <!-- Step 4 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                            </div>
                                                            <p class="steptitle">Confirm</p>
                                                        </div>
                                                        <!-- Step 4 -->
                                                    </div>

                                                    <h3 class="section-form-title">Personal Information</h3>
                                                    <div class="help-block with-errors mandatory-error"></div>
                                                    <div class="form-group validfname">
                                                        <input class="form-control" name="fname" id="fname"
                                                            type="text" placeholder="First Name*" required
                                                            data-error="Please enter First Name">
                                                        <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validlname">
                                                        <input class="form-control" name="lname" id="lname"
                                                            type="text" placeholder="Last Name*" required
                                                            data-error="Please enter Last Name">
                                                        <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validgender">
                                                        <select class="form-control" name="gender" id="gender"
                                                            title="" required data-error="Please Select Gender">
                                                            <option value="">--- Select Your Gender* ---</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Femal">Female</option>
                                                        </select>
                                                        <div class="input-group-icon"><i class="fas fa-venus"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div id="date-of-birth" class="form-group validbirthdate">
                                                        <input class="form-control" name="birthdate" id="birthdate"
                                                            type="text" placeholder="Date Of Birth*" required
                                                            data-error="Please enter Date Of Birth">
                                                        <div class="input-group-icon"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validaddress">
                                                        <input class="form-control" name="address" id="address"
                                                            type="text" placeholder="Address*" required
                                                            data-error="Please enter address">
                                                        <div class="input-group-icon"><i
                                                                class="fas fa-map-marker-alt"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validphone">
                                                        <input class="form-control" name="phone" id="phone"
                                                            type="text" placeholder="Phone*" required
                                                            data-error="Please enter valid phone">
                                                        <div class="input-group-icon"><i class="fas fa-phone"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validpreferedcontact">
                                                        <strong>Prefered Contact Method*: </strong>
                                                        <ul class="radio-inline mgsradio-circle-buttons list-unstyled">
                                                            <li>
                                                                <input type="radio" name="preferedcontact"
                                                                    id="preferedcontact1" value="email" required
                                                                    data-error="Please Select Contact Method" />
                                                                <label for="preferedcontact1">email</label>
                                                                <div class="check"></div>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="preferedcontact"
                                                                    id="preferedcontact2" value="Phone" required
                                                                    data-error="Please Select Contact Method" />
                                                                <label for="preferedcontact2">Phone</label>
                                                                <div class="check"></div>
                                                            </li>
                                                        </ul>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <h3 class="section-form-title">Profile Image</h3>
                                                    <div class="form-group attachmentFile">
                                                        <label class="input-group-btn">
                                                            <span class="btn">
                                                                Browse&hellip; <input name="userfile" id="userfile"
                                                                    type="file">
                                                            </span>
                                                        </label>
                                                        <input type="text" id="attachedFile" class="form-control"
                                                            placeholder="Browse to select file" readonly>
                                                    </div><!-- end form-group -->
                                                    <div class="form-group signUpForm-step-2">
                                                        <button class="btn btn-custom" type="button"
                                                            onclick="previousStep1()"><span
                                                                class="fas fa-arrow-left"></span> Back</button>
                                                        <button class="btn btn-custom float-end" type="button"
                                                            onclick="nextStep3()">Next <span
                                                                class="fas fa-arrow-right"></span></button>
                                                    </div>
                                                </fieldset>
                                            </div><!-- end section -->

                                            <div id="section-3" class="signUpForm-step-wrap slide-right">
                                                <h3 class="section-title">Step 3 of 4</h3>
                                                <fieldset>
                                                    <div
                                                        class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                                        <div class="form-layer-progress">
                                                            <div class="form-layer-progress-line" style="width: 62.25%;">
                                                            </div>
                                                        </div>
                                                        <!-- Step 1 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="fas fa-unlock-alt"></i></div>
                                                            <p class="steptitle">Account</p>
                                                        </div>
                                                        <!-- Step 1 -->

                                                        <!-- Step 2 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                            </div>
                                                            <p class="steptitle">Personal</p>
                                                        </div>
                                                        <!-- Step 2 -->

                                                        <!-- Step 3 -->
                                                        <div class="form-layer-step currentstep">
                                                            <div class="form-layer-step-icon activestep"><i
                                                                    class="far fa-credit-card"></i></div>
                                                            <p class="steptitle">Payment Info</p>
                                                        </div>
                                                        <!-- Step 3 -->

                                                        <!-- Step 4 -->
                                                        <div class="form-layer-step">
                                                            <div class="form-layer-step-icon"><i class="fas fa-check"></i>
                                                            </div>
                                                            <p class="steptitle">Confirm</p>
                                                        </div>
                                                        <!-- Step 4 -->
                                                    </div>

                                                    <h3 class="section-title">Payment Details: </h3>
                                                    <div class="help-block with-errors mandatory-error"></div>
                                                    <div class="form-group validpaymenttype">
                                                        <select class="form-control" name="paymenttype" id="paymenttype"
                                                            title="" required
                                                            data-error="Please Select Payment Type">
                                                            <option value="">--- Select Your Payment Type* ---
                                                            </option>
                                                            <option value="Master Card">Master Card</option>
                                                            <option value="Visa Card">Visa Card</option>
                                                        </select>
                                                        <div class="input-group-icon"><i class="fas fa-venus"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validhname">
                                                        <input class="form-control" name="hname" id="hname"
                                                            type="text" placeholder="Card Holder Name*" required
                                                            data-error="Please enter Card Holder Name">
                                                        <div class="input-group-icon"><i class="fas fa-user"></i></div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validcardnumber">
                                                        <input class="form-control" name="cardnumber" id="cardnumber"
                                                            type="text" pattern="\d*" placeholder="Card Number*"
                                                            required data-error="Please enter valid card number">
                                                        <div class="input-group-icon"><i class="far fa-credit-card"></i>
                                                        </div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group validcvc">
                                                        <input class="form-control" name="cvc" id="cvc"
                                                            type="text" maxlength="3" pattern="\d*"
                                                            placeholder="CVC*" required data-error="Please enter CVC">
                                                        <div class="input-group-icon"><i class="far fa-credit-card"></i>
                                                        </div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div id="sandbox-container2" class="form-group validexpirydate">
                                                        <input class="form-control" name="expirydate" id="expirydate"
                                                            type="text" placeholder="Expiry Date*" required
                                                            data-error="Please enter Expiry Date">
                                                        <div class="input-group-icon"><i class="fas fa-calendar-alt"></i>
                                                        </div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="form-group validagree">
                                                        <ul class="mgsstyle-checkbox mgscheckbox-style list-unstyled">
                                                            <li><input name="aggre" id="aggre" type="checkbox"
                                                                    value="1" required
                                                                    data-error="Required Consent"><label for="aggre">
                                                                    Agree with <a href="javascript:void(0)">Terms &amp;
                                                                        Conditions</a></label></li>
                                                        </ul>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group signUpForm-step-3">
                                                        <button class="btn btn-custom" type="button"
                                                            onclick="previousStep2()"><span
                                                                class="fas fa-arrow-left"></span> Back</button>
                                                        <button class="btn btn-custom float-end" type="button"
                                                            onclick="nextStep4()">Next <span
                                                                class="fas fa-arrow-right"></span></button>
                                                    </div>
                                                </fieldset>
                                            </div><!-- end section -->

                                            <div id="section-4"
                                                class="signUpForm-step-wrap review-submit-section slide-right">
                                                <h3 class="section-title">Step 4 of 4: Review &amp; Submit</h3>
                                                <fieldset>
                                                    <div
                                                        class="form-layer-steps mgscmultisteptheme2 form-layer-tolal-steps-4">
                                                        <div class="form-layer-progress">
                                                            <div class="form-layer-progress-line" style="width: 100%;">
                                                            </div>
                                                        </div>
                                                        <!-- Step 1 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="fas fa-unlock-alt"></i></div>
                                                            <p class="steptitle">Account</p>
                                                        </div>
                                                        <!-- Step 1 -->

                                                        <!-- Step 2 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i class="fas fa-user"></i>
                                                            </div>
                                                            <p class="steptitle">Personal</p>
                                                        </div>
                                                        <!-- Step 2 -->

                                                        <!-- Step 3 -->
                                                        <div class="form-layer-step active">
                                                            <div class="form-layer-step-icon"><i
                                                                    class="far fa-credit-card"></i></div>
                                                            <p class="steptitle">Payment Info</p>
                                                        </div>
                                                        <!-- Step 3 -->

                                                        <!-- Step 4 -->
                                                        <div class="form-layer-step currentstep">
                                                            <div class="form-layer-step-icon activestep"><i
                                                                    class="fas fa-check"></i></div>
                                                            <p class="steptitle">Confirm</p>
                                                        </div>
                                                        <!-- Step 4 -->
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
                                                            <input name="humanCheckCaptchaInput"
                                                                id="humanCheckCaptchaInput" placeholder="" maxlength="3"
                                                                class="form-control" type="text" required
                                                                data-error="Please solve Captcha">
                                                            <div class="help-block with-errors"></div>
                                                        </div><!-- end form-group -->
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div id="AggreData"><strong>Agree with terms &amp;
                                                                        conditions:</strong> <input name="aggre"
                                                                        id="aggre2" value="1" checked disabled
                                                                        type="checkbox"></div>
                                                            </div>
                                                            <div id="mgsFormSubmit" class="hidden"></div>
                                                            <div id="final-step-buttons"
                                                                class="form-group  signUpForm-step-4">
                                                                <button class="btn btn-custom" type="button"
                                                                    onclick="previousStep3()"><span
                                                                        class="fas fa-arrow-left"></span> Back</button>
                                                                <button id="Submit" class="btn btn-custom float-end"
                                                                    type="submit">Submit </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div><!-- end section -->

                                        </div><!-- end section-wrap -->
                                    </form>
                                </div><!-- end col -->
                            </div><!-- end form-wrap -->
                        </div><!-- end col-sm-12 -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="footer-top col-sm-12">
                            <p class="text-center copyright">&copy; <span id="mgsYear"></span> RegForm. <a
                                    href="https://1.envato.market/AYdWK" target="_blank">MGScoder</a> All rights reserved.
                                <a href="https://1.envato.market/4B6j9" class="footer-site-link" target="_blank">Buy
                                    RegForm Script</a></p>
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div><!-- end container -->
            </div><!-- end display-table-cell -->
        </div><!-- end display-table -->
    </div>
@endsection
