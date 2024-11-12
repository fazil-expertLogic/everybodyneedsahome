@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('users.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Users</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="Your name" value="{{old('name')}}" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_email">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="{{old('email')}}" required data-error="Please enter email">
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
                                                <div class="form-group valid_use_role">
                                                    <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="role" name="role" required data-error="Please user role">
                                                        <option value="">Please Select</option>
                                                        @foreach ( $roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
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