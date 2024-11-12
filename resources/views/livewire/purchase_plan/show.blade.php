@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">View Purchase Plan Detail</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">User Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->user->name}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Membership Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->membership->name}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Purchase Date<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->purchase_date}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Stripe Token<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->stripeToken}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Last4<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->last4}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>


                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Exp Month<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->exp_month}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Exp Year<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$purchase_plan->exp_year}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group signUpForm-step-1" style="margin-top: 50px;">
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
<script src="{{asset('wizard-form/js/user-form.js')}}"></script>
@endsection