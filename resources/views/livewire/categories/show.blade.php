@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        <li class="breadcrumb-item"><a href="javascript:void(0);">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol><!-- End breadcrumb -->
    <div class="ms-auto">
        <!-- <div>
            <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Rating">
                <span>
                    <i class="fa fa-star"></i>
                </span>
            </a>
            <a href="{{ url('lockscreen') }}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="lock">
                <span>
                    <i class="fa fa-lock"></i>
                </span>
            </a>
            <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm"
                data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Add New">
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
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category</h3>
            </div>
            <div class="card-body">
                <p>Please fill the form below to edit category.</p>

                <form method="post" action="{{ route('categories.update',[$category->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" class="form-control" id="id" value="{{$category->id}}">
                    <div class="col-md-12">
                        <label for="property_name" class="form-label">Category Name*</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" value="{{$category->category_name}}" required disabled>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br />


                    <div class="col-12">
                       
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- ROW CLOSED -->
@endsection

<!-- SELECT2 JS -->

<!-- FORMVALIDATION JS -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>