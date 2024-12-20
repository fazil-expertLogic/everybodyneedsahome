@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">Memberships</a></li>
            <li class="breadcrumb-item active" aria-current="page">Memberships Tables</li>
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
    <!-- END PAGE-HEADER -->

    <!-- ROW -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Memberships Data</h3>
                </div>
                <div class="mb-3 text-end">
                    @if ($allow_create)
                        <a href="{{ route('memberships.create') }}" class="btn bg-primary" data-bs-toggle="tooltip"
                            title="Add New">
                            <span><i class="fa fa-plus"></i></span>
                        </a>
                    @endif
                </div>
                <form action="{{ route('memberships.index') }}" method="GET">
                    <div class="mb-3 text-end">
                        <div class="input-group w-100">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="name"
                                    value="{{ request('name') }}">
                            </div>

                            <div class="col">
                                <input type="text" name="price" class="form-control" placeholder="price"
                                    value="{{ request('price') }}">
                            </div>

                            <input type="text" name="search" class="form-control bg-white" placeholder="Search here..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
                {{--  --------------------------------- export ------------------------------------- --}}
                <form action="{{ route('memberships.export') }}" method="get">
                    <div class="mb-3 text-end">
                        <div class="input-group w-100">
                            <div class="col">
                                <input type="date" name="start_date" class="form-control" placeholder="Start Date"
                                    value="{{ now()->startOfMonth()->toDateString() }}">
                            </div>
                            <div class="col">
                                <input type="date" name="end_date" class="form-control" placeholder="End Date"
                                    value="{{ now()->toDateString() }}">
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
                {{--  --------------------------------- export ------------------------------------- --}}
                {{--  --------------------------------- import ------------------------------------- --}}
                <button type="button" class="btn btn-primary w-10 ms-auto" data-bs-toggle="modal" data-bs-target="#import">
                    Import CSV
                </button>
                {{--  --------------------------------- import ------------------------------------- --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">price</th>
                                    <th class="wd-15p border-bottom-0">Plan Type</th>
                                    <th class="wd-25p border-bottom-0">Created ON</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($memberships as $membership)
                                    <tr>
                                        <td>{{ $membership->name }}</td>
                                        <td>{{ $membership->price }}</td>
                                        <td>{{ $membership->plan_type }}</td>
                                        <td>{{ $membership->created_at }}</td>
                                        <td>
                                            @if ($allow_show)
                                                <a href="{{ route('memberships.show', $membership->id) }}"
                                                    class="btn btn-warning btn-sm badge" title="Show">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                            @if ($allow_show)
                                                <a href="{{ route('assign_permission', $membership->id) }}"
                                                    class="btn btn-info btn-sm badge" title="Show">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            @if ($allow_edit)
                                                <a href="{{ route('memberships.edit', $membership->id) }}"
                                                    class="btn btn-primary btn-sm badge" title="Edit">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                            @if ($allow_delete)
                                                <button class="btn btn-danger btn-sm badge" title="Delete"
                                                    onclick="confirmDelete('{{ route('memberships.destroy', $membership->id) }}');">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Pagination Center Alignment</h2>
                            </div>
                            <div class="card-body">
                                <!-- Display total entry count -->
                                <p>Total Entries: {{ $memberships->total() }}</p>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mb-0">
                                        {{-- Previous Button --}}
                                        @if ($memberships->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);" tabindex="-1">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $memberships->previousPageUrl() }}">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Links --}}
                                        @for ($i = 1; $i <= $memberships->lastPage(); $i++)
                                            <li class="page-item {{ $memberships->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $memberships->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Next Button --}}
                                        @if ($memberships->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $memberships->nextPageUrl() }}">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this property?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ------------------------------------------------- import ------------------------------------------------- --}}
    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Import CSV File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('memberships.import') }}" method="POST" enctype="multipart/form-data"
                    id="modalForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="csv_file">Choose CSV File:</label>
                            <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ------------------------------------------------- import ------------------------------------------------- --}}
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SELECT2 JS -->
<script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>
<script>
    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url; // Set the action of the form
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Initialize the modal
        deleteModal.show(); // Show the modal
    }
</script>


<!-- DATA TABLE JS -->
<script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
