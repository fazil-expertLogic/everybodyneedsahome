@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('menus.update', $menu->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="1" id="is_edit"/>
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">view Menu Detail</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="name" value="{{$menu->name}}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group valid_use_name">
                                                    <label for="route" class="form-label">Route<span class="text-danger">*</span></label>
                                                    <input type="text" name="route" class="form-control py-2" id="route" placeholder="route" value="{{$menu->route}}" required data-error="Please enter route" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group valid_use_name">
                                                    <label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
                                                    <input type="text" name="icon" class="form-control py-2" id="icon" placeholder="icon" value="{{$menu->icon}}" required data-error="Please enter icon" disabled>
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