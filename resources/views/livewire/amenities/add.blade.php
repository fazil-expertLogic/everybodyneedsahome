@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('amenities.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Amenity</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name  @if ($errors->has('name')) has-error has-danger @endif">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('name'))
                                                        <div class="help-block with-errors">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group valid_use_name  @if ($errors->has('icon')) has-error has-danger @endif">
                                                    <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                                    <input type="text" name="icon" class="form-control py-2" id="icon" placeholder="icon" value="" required data-error="Please enter icon">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('icon'))
                                                        <div class="help-block with-errors">{{ $errors->first('icon') }}</div>
                                                    @endif
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