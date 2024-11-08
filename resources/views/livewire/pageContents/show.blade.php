@extends('layouts.wizard-form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrap clearfix">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('pageContents.update', $pageContent->id) }}" id="signUpForm" class="signUpForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="signUpForm-step-holder">
                                <div id="section-1" class="signUpForm-step-wrap">
                                    <fieldset>
                                        <h3 class="section-form-title">Show Page Content</h3>
                                        <div class="help-block with-errors mandatory-error"></div>

                                        <div class="row">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_page_url @if ($errors->has('page_url')) has-error has-danger @endif">
                                                    <label for="page_url" class="form-label">Page Url<span class="text-danger">*</span></label>
                                                    <input type="text" name="page_url" class="form-control py-2" id="page_url" placeholder="Page Url" value="{{old('page_url',$pageContent->page_url)}}" required data-error="Please enter page url" disabled>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('page_url'))
                                                        <div class="help-block with-errors">{{ $errors->first('page_url') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group valid_variable @if ($errors->has('variable')) has-error has-danger @endif">
                                                    <label for="variable" class="form-label">Variable<span class="text-danger">*</span></label>
                                                    <input type="text" name="variable" class="form-control py-2" id="variable" placeholder="Variable" value="{{old('variable',$pageContent->variable)}}" required data-error="Please enter Variable" disabled>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('variable'))
                                                        <div class="help-block with-errors">{{ $errors->first('variable') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group valid_text @if ($errors->has('text')) has-error has-danger @endif">
                                                    <label for="text" class="form-label">Text<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="text" name="text"  required data-error="Please Enter Text">{{$pageContent->text}}</textarea>
                                                    <div class="help-block with-errors"></div>
                                                    @if ($errors->has('text'))
                                                        <div class="help-block with-errors">{{ $errors->first('text') }}</div>
                                                    @endif
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