@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('users.update', $user->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="1" id="is_edit"/>
                            @method('PUT')
                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Create New Users</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_name">
                                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control py-2" id="name" placeholder="Your name" value="{{ $user->name }}" required data-error="Please enter name" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_email">
                                                    <label for="email" class="form-label"> Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control py-2" id="email" placeholder="example@email.com" value="{{ $user->email }}" required data-error="Please enter email" disabled>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_use_role">
                                                    <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="role" name="role" required data-error="Please user role" disabled>
                                                        <option value="">Please Select</option>
                                                        @foreach ( $roles as $role)
                                                            <option @if( $role->id == $user->role_id ) selected @endif  value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
            
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