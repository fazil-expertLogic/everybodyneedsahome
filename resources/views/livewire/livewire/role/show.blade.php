@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('roles.update', $role->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="1" id="is_edit"/>
                            @method('PUT')
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Edit Roles</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="Your name" value="{{ $role->name }}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                @foreach ($menus as $key => $menu)
                                                    @php
                                                        $menuPermission = $permissions->firstWhere('menu_id', $menu->id);
                                                    @endphp
                                            
                                                    <h3>{{ $menu->name }}</h3>
                                                    <input type="hidden" id="menu_id" name="menu_id[{{ $key }}]" value="{{ $menu->id }}">
                                            
                                                    <div class="row">
                                                        <div class="col-sm-1 col-lg-1"></div>
                                            
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_listing_{{ $menu->id }}" name="permissions[{{ $menu->id }}][is_listing]" readonly value="1" {{ $menuPermission && $menuPermission->is_listing ? 'checked' : '' }} >
                                                            <label for="is_listing_{{ $menu->id }}"> Listing </label>
                                                        </div>
                                            
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_show_{{ $menu->id }}" name="permissions[{{ $menu->id }}][is_show]" readonly value="1" {{ $menuPermission && $menuPermission->is_show ? 'checked' : '' }} >
                                                            <label for="is_show_{{ $menu->id }}"> Show </label>
                                                        </div>
                                            
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_create_{{ $menu->id }}" name="permissions[{{ $menu->id }}][is_create]" readonly value="1" {{ $menuPermission && $menuPermission->is_create ? 'checked' : '' }} >
                                                            <label for="is_create_{{ $menu->id }}"> Create </label>
                                                        </div>
                                            
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_edit_{{ $menu->id }}" name="permissions[{{ $menu->id }}][is_edit]" readonly value="1" {{ $menuPermission && $menuPermission->is_edit ? 'checked' : '' }} >
                                                            <label for="is_edit_{{ $menu->id }}"> Edit </label>
                                                        </div>
                                            
                                                        <div class="col-sm-2 col-lg-2">
                                                            <input type="checkbox" id="is_delete_{{ $menu->id }}" name="permissions[{{ $menu->id }}][is_delete]" readonly value="1" {{ $menuPermission && $menuPermission->is_delete ? 'checked' : '' }} >
                                                            <label for="is_delete_{{ $menu->id }}"> Delete</label>
                                                        </div>
                                            
                                                        <div class="col-sm-1 col-lg-1"></div>
                                                    </div>
                                                @endforeach
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