@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('post_assign_permission') }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Permissions</h3>
                                        <div class="help-block with-errors mandatory-error"></div>
                                        <div class="row">
                                            <input type="hidden" id="plan_id" name="plan_id" value="{{$plan_id}}">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_cus_is_child">
                                                    <label for="plan_id" class="form-label">Plan<span class="text-danger">*</span></label>
                                                    <select name="plan_id" class="form-select" id="plan_id" aria-label="" required data-error="Please select plan_id" disabled>
                                                      <option value="">Please Select</option>
                                                        @foreach ($membership as $member_ship_id => $member_ship)
                                                        <option value="{{$member_ship_id}}"@if($member_ship_id == $plan_id)  selected @endif>{{ $member_ship }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                  </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                @foreach ( $plan_menus as $key => $plan_menu)
                                                    @php
                                                        $menuPermission = $plan_permissions->firstWhere('plan_menu_id', $plan_menu->id);
                                                    @endphp
                                                    <h3>{{ $plan_menu->name }} </h3>
                                                    <input type="hidden" id="plan_menu_id" name="plan_menu_id[{{$key}}]" value="{{$plan_menu->id}}">
                                                    <div class="row">
                                                        <div class="col-sm-1 col-lg-1"></div>
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_view" name="permissions[{{$plan_menu->id}}][is_view]" value="1" {{ $menuPermission && $menuPermission->is_view ? 'checked' : '' }}>
                                                            <label for="is_view"> Is View </label>
                                                        </div>
                                                        <div class="col-sm-1 col-lg-1"></div>
                                                    </div>
                                                @endforeach
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