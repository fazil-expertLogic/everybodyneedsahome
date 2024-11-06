@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('propertyReview.update', $property_review->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="1" id="is_edit"/>
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title"> Property Review</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <label for="name" class="form-label">Property Title<span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$property_review->property->property_name}}" disabled>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <label for="name" class="form-label">Reviewer Name<span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$property_review->reviewer_name}}" disabled>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <label for="name" class="form-label">Reviewer Email<span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$property_review->reviewer_email}}" disabled>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <label for="name" class="form-label">Reviewer Rating<span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$property_review->rating}}" disabled>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                                <label for="name" class="form-label">Reviewer Rating<span class="text-danger">*</span></label>
                                                <textarea disabled style="width:100%;" > {{$property_review->comment}}</textarea>
                                            </div>
                                            
                                            <div class="col-sm-6 col-lg-6 form-group valid_approved @if ($errors->has('approved')) has-error has-danger @endif">
                                                <label for="approved" class="form-label">Approved<span class="text-danger">*</span></label>
                                                <select disabled class="form-select mb-3" name="approved" id="approved" required data-error="Please select">
                                                    <option @if($property_review->approved == '1') selected @endif value="1">Yes</option>
                                                    <option @if($property_review->approved == '0') selected @endif value="0">No</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                 @if ($errors->has('approved'))
                                                    <div class="help-block with-errors">{{ $errors->first('approved') }}</div>
                                                @endif
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