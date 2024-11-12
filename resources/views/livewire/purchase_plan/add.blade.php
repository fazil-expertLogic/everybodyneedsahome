@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('purchase_plans.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Assigine Membership Plan</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group valid_user_id @if ($errors->has('user_id')) has-error has-danger @endif">
                                                    <label for="user_id" class="form-label">User<span class="text-danger">*</span></label>
                                                    <select name="user_id" class="form-select" id="user_id" aria-label="" required data-error="Please select user">
                                                        <option value="">Please Select</option>
                                                        @foreach ($users as $user_id => $user)
                                                            <option value="{{$user_id}}">{{$user}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('user_id'))
                                                        <div class="help-block with-errors">{{ $errors->first('user_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-row row card-related">
                                                <label for="card-element">Credit or debit card</label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Move card-errors outside of card-element -->
                                                <div id="card-errors" role="alert"></div>
                                                <div id="empty-element"></div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group valid_member_ship_id @if ($errors->has('member_ship_id')) has-error has-danger @endif">
                                                    <label for="member_ship_id" class="form-label">member plan<span class="text-danger">*</span></label>
                                                    <select name="member_ship_id" class="form-select" id="member_ship_id" aria-label="" required data-error="Please select member plan">
                                                        <option value="">Please Select</option>
                                                        @foreach ($member_ships as $member_ship_id => $member_ship)
                                                            <option value="{{$member_ship_id}}">{{$member_ship}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('member_ship_id'))
                                                        <div class="help-block with-errors">{{ $errors->first('member_ship_id') }}</div>
                                                    @endif
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
<script src="{{asset('wizard-form/js/user-form.js')}}"></script>
@endsection