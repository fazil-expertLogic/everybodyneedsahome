@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('memberships.update', $membership->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="1" id="is_edit"/>
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Plan</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$membership->name}}" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="price" class="form-label">price<span class="text-danger">*</span></label>
                                                    <input type="text" name="price" class="form-control py-2" id="price" placeholder="price" value="{{$membership->price}}" required data-error="Please enter price">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="features" class="form-label">Features<span class="text-danger">*</span></label>
                                                    <input type="text" name="features" class="form-control py-2" id="features" placeholder="features" value="{{$membership->features}}" required data-error="Please enter features">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="description" class="form-label">description<span class="text-danger">*</span></label>
                                                    
                                                    <textarea class="form-control" id="description" name="description">{{$membership->description}}</textarea>
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