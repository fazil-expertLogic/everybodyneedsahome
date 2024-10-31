@extends('layouts.app')

@section('styles')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <li class="breadcrumb-item active" aria-current="page">Mail Compose</li>
    </ol>
    <div class="ms-auto">
        <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm" title="Rating">
            <span><i class="fa fa-star"></i></span>
        </a>
        <a href="{{url('lockscreen')}}" class="btn bg-primary-transparent text-primary mx-2 btn-sm" title="lock">
            <span><i class="fa fa-lock"></i></span>
        </a>
        <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm" title="Add New">
            <span><i class="fa fa-plus"></i></span>
        </a>
    </div>
</div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i>
    {{ session('success') }}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="list-group list-group-transparent mb-0 mail-inbox">
                <div class="m-4 text-center">
                    <a href="javascript:void(0);" class="btn btn-primary br-7 btn-lg btn-block">Compose</a>
                </div>
                <div>
                    <a href="{{route('clients.inbox',[$id])}}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <span class=" fw-semibold me-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ms-auto badge bg-success">14</span>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item d-flex align-items-center">
                        <span class="icons"><i class="fa fa-rocket"></i></span>Sent
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="card">
            <form method="post" action="{{route('clients.send-mail')}}">
                @csrf
                <div class="inbox card-body">

                    <div class="form-row mb-4">
                        <label class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label"> Clients</label>
                        <div class="col-9 col-sm-10 col-md-9 col-lg-10">
                            <input value="{{$client->email}}" disabled class="form-control">
                            <input type="hidden" name="receiver_id" value="{{$client->id}}"  class="form-control">

                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <label class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label">Subject</label>
                        <div class="col-9 col-sm-10 col-md-9 col-lg-10">
                            <input type="text" class="form-control" id="subject" placeholder="Type Subject" name="subject">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <label class="col-3 col-sm-2 col-md-3 col-lg-2 col-form-label">Message</label>
                        <div class="col-9 col-sm-10 col-md-9 col-lg-10">
                            <textarea class="form-control" id="message" name="message" rows="12" placeholder="Click here to reply"></textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex">

                    <div class="ms-auto btn-list">
                        <button type="button" class="btn btn-danger btn-space me-2">Discard</button>
                        <button type="submit" class="btn btn-primary btn-space">Send message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2-show-search').select2({
            placeholder: "Choose one (with searchbox)",
            minimumResultsForSearch: 0 // Always show search box
        });
    });
</script>