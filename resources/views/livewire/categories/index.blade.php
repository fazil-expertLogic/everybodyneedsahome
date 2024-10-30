@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
        <li class="breadcrumb-item active" aria-current="page">User List</li>
    </ol>
    <div class="ms-auto">
        <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm">
            <span><i class="fa fa-star"></i></span>
        </a>
        <a href="{{ url('lockscreen') }}" class="btn bg-primary-transparent text-primary mx-2 btn-sm">
            <span><i class="fa fa-lock"></i></span>
        </a>
        <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm">
            <span><i class="fa fa-plus"></i></span>
        </a>
    </div>
</div>

<!-- ROW -->
<div class="row">
    <div class="col-lg-12">
        <!-- Search Input -->
        <div class="input-group mb-5 float-end">
            <input type="text" class="form-control" placeholder="Search here..." wire:model="search">
            <button type="button" class="btn btn-primary">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Category List -->
        <div class="e-panel card">
            <div class="card-header">
                <h2 class="card-title">Categories</h2>
                <div class="page-options">
                    <select class="form-control select2 w-auto" wire:change="sortByDate">
                        <option value="asc" @if($sortDirection == 'asc') selected @endif>Latest</option>
                        <option value="desc" @if($sortDirection == 'desc') selected @endif>Oldest</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="e-table">
                    <div class="table-responsive table-lg">
                        <table class="table table-bordered text-dark">
                            <thead>
                                <tr>
                                    <th class="text-center text-dark fw-semibold">All</th>
                                    <th class="text-dark fw-semibold w-25">Person</th>
                                    <th class="text-dark fw-semibold">Date</th>
                                    <th class="text-center fw-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="custom-control custom-control-inline custom-checkbox">
                                            <input class="custom-control-input" id="item-{{ $category->id }}" type="checkbox"> 
                                            <label class="custom-control-label" for="item-{{ $category->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold mx-2">{{ $category->category_name }}</h6>
                                    </td>
                                    <td class="text-nowrap align-middle">
                                        <span>{{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group align-top br-7">
                                            <button class="btn btn-sm btn-primary badge" type="button">Edit</button>
                                            <button class="btn btn-sm btn-primary badge" type="button" wire:click="delete({{ $category->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Livewire Pagination -->
                    <div class="float-end">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ROW -->

@endsection

@section('scripts')
<script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>
@vite('resources/assets/js/select2.js')
@endsection
