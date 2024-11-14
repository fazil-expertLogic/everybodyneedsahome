@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('menus.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Menu</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name @if ($errors->has('name')) has-error has-danger @endif">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{old('name')}}" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('name'))
                                                    <div class="help-block with-errors">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name @if ($errors->has('route')) has-error has-danger @endif">
                                                    <label for="route" class="form-label">Route<span class="text-danger">*</span></label>
                                                    <input type="text" name="route" class="form-control py-2" id="route" placeholder="route" value="{{old('route')}}" required data-error="Please enter route">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('route'))
                                                    <div class="help-block with-errors">{{ $errors->first('route') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name @if ($errors->has('icon')) has-error has-danger @endif">
                                                    <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                                    <input type="text" name="icon" class="form-control py-2" id="icon" placeholder="icon" value="{{old('icon')}}" required data-error="Please enter icon">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('icon'))
                                                    <div class="help-block with-errors">{{ $errors->first('icon') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_order_by @if ($errors->has('order_by')) has-error has-danger @endif">
                                                    <label for="order_by" class="form-label">Order By<span class="text-danger">*</span></label>
                                                    <input type="number" name="order_by" class="form-control py-2" id="order_by" placeholder="order by" value="{{old('order_by')}}" required data-error="Please enter order by">
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('order_by'))
                                                    <div class="help-block with-errors">{{ $errors->first('order_by') }}</div>
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