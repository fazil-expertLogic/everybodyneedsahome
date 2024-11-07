@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        <li class="breadcrumb-item"><a href="javascript:void(0);">guest</a></li>
        <li class="breadcrumb-item active" aria-current="page">guest Tables</li>
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
                <h3 class="card-title">Guest Data</h3>
                @if($allow_create)
                <a href="{{ route('guests.create') }}" class="btn bg-primary ms-auto" data-bs-toggle="tooltip" title="Add New">
                    <span><i class="fa fa-plus"></i> </span>
                </a>
                @endif
            </div>
            <div class="mb-3 text-end">

            </div>
            <form action="{{ route('guests.index') }}" method="GET">
                <div class="mb-3 text-end">
                    <div class="input-group w-100">
                        <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="guest Name" value="{{ request('name') }}">
                        </div>
                        <div class="col">
                            <input type="text" name="email" class="form-control" placeholder="email" value="{{ request('email') }}">
                        </div>
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="search" value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
            </form>
            <div class="card-body">
                <div class="table-responsive">

                    <!-- Pagination Links -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">guest Name</th>
                                        <th class="wd-15p border-bottom-0">guest Date of birth</th>
                                        <th class="wd-20p border-bottom-0">guest Address</th>
                                        <th class="wd-15p border-bottom-0">City</th>
                                        <th class="wd-10p border-bottom-0">State</th>
                                        <th class="wd-25p border-bottom-0">Created ON</th>
                                        <th class="wd-25p border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $guest)
                                    <tr>
                                        <td>{{$guest->name}}</td>
                                        <td>{{$guest->dob}}</td>
                                        <td>{{$guest->address}}</td>
                                        <td>{{$guest->city}}</td>
                                        <td>{{$guest->state}}</td>
                                        <td>{{$guest->created_at}}</td>
                                        <td>
                                          

                                            @if($allow_show)
                                            <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-warning  btn-sm badge" title="Show">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($allow_edit)
                                            <a href="{{ route('guests.edit', $guest->id) }}" class="btn  btn-primary btn-sm badge" type="button" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($allow_delete)
                                            <button class="btn  btn-danger btn-sm badge" title="Delete" onclick="confirmDelete('{{ route('guests.destroy', $guest->id) }}');">
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
                               
                                <div class="card-body">
                                    <!-- Display total entry count -->
                                    <p>Total Entries: {{ $guests->total() }}</p>

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center mb-0">
                                            {{-- Previous Button --}}
                                            @if ($guests->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);" tabindex="-1">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $guests->previousPageUrl() }}">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            @endif

                                            {{-- Page Links --}}
                                            @for ($i = 1; $i <= $guests->lastPage(); $i++)
                                                <li class="page-item {{ ($guests->currentPage() == $i) ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $guests->url($i) }}">{{ $i }}</a>
                                                </li>
                                                @endfor

                                                {{-- Next Button --}}
                                                @if ($guests->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $guests->nextPageUrl() }}">
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
        @vite('resources/assets/js/select2.js')

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
        @vite('resources/assets/js/table-data.js')