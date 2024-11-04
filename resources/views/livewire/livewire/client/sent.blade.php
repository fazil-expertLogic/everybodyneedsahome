@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mail Inbox</li>
    </ol><!-- End breadcrumb -->
    <div class="ms-auto">
        <!-- <div>
            <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                data-bs-original-title="Rating">
                <span>
                    <i class="fa fa-star"></i>
                </span>
            </a>
            <a href="{{url('lockscreen')}}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                data-bs-original-title="lock">
                <span>
                    <i class="fa fa-lock"></i>
                </span>
            </a>
            <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm" data-bs-toggle="tooltip"
                title="" data-bs-placement="bottom" data-bs-original-title="Add New">
                <span>
                    <i class="fa fa-plus"></i>
                </span>
            </a>
        </div> -->
    </div>
</div>
<!-- END PAGE HEADER -->

<!-- ROW -->
<div class="row">
    <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="list-group list-group-transparent border-bottom-0 mb-0 mail-inbox">
                <div class="m-4 text-center">
                    <a href="{{url('email-compose')}}"
                        class="btn btn-primary btn-lg d-grid">Compose</a>
                </div>
                <a href="{{url('email-compose')}}"
                    class="list-group-item d-flex align-items-center">
                    <span class="icons"><i class="fa fa-inbox"></i></span> Inbox <span
                        class="ms-auto badge bg-primary bradius">4</span>
                </a>

                <a href="javascript:void(0)"
                    class="list-group-item d-flex align-items-center">
                    <span class="icons"><i class="fa fa-rocket"></i></span>Sent
                </a>

            </div>

        </div>
    </div>
    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Inbox</h3>
                <div class="mailsearch">
                    <input class="form-control" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="inbox p-0">
                    <ul class="mail_list list-group list-unstyled">

                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="controls">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                class="custom-control-input" id="checkbox-1">
                                            <label for="checkbox-1"
                                                class="custom-control-label"></label>
                                        </div>
                                        <a href="javascript:void(0);"
                                            class="favourite text-muted hidden-sm-down"
                                            data-bs-toggle="active"><i class="fa fa-star mt-1"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="javascript:void(0);" class="me-2">Velit a labore</a>
                                        <small class="float-end text-muted-dark fw-semibold mt-1"><time class="hidden-sm-down"
                                                datetime="2017">12:35 AM</time><i
                                                class="fa fa-paperclip ms-2"></i> </small>
                                    </div>
                                    <p class="msg">Lorem Ipsum is simply dumm dummy text of the printing
                                        and
                                        typesetting industry. </p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ROW -->


@endsection

@section('scripts')

@endsection