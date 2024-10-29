@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('roles.store') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Role</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="Your name" value="" required data-error="Please enter name">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 col-lg-12">
                                                @foreach ( $menus as $key => $menu)
                                                    <h3>{{ $menu->name }} </h3>
                                                    <input type="hidden" id="menu_id" name="menu_id[{{$key}}]" value="{{$menu->id}}">
                                                    <div class="row">
                                                        <div class="col-sm-1 col-lg-1"></div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_listing" name="permissions[{{$menu->id}}][is_listing]" value="1">
                                                            <label for="is_listing"> Listing </label>
                                                        </div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_show" name="permissions[{{$menu->id}}][is_show]" value="1">
                                                            <label for="is_show"> show </label>
                                                        </div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_create" name="permissions[{{$menu->id}}][is_create]" value="1">
                                                            <label for="is_create"> Create </label>
                                                        </div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_edit" name="permissions[{{$menu->id}}][is_edit]" value="1">
                                                            <label for="is_edit"> Edit </label>
                                                        </div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_delete" name="permissions[{{$menu->id}}][is_delete]" value="1">
                                                            <label for="is_delete"> Delete</label>
                                                        </div>
                                                        <div class="col-sm-1 col-lg-1"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="form-group signUpForm-step-1" style="margin-top: 50px;">
                                            <button class="btn btn-default disable" type="button">Are you
                                                ready!</button>
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