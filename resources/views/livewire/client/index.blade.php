@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        <li class="breadcrumb-item"><a href="javascript:void(0);">Client</a></li>
        <li class="breadcrumb-item active" aria-current="page">Client Tables</li>
    </ol><!-- End breadcrumb -->
    <div class="ms-auto">
        <div>
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
        </div>
    </div>
</div>
<!-- END PAGE-HEADER -->

<!-- ROW -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Client Data</h3>
                @if($allow_create)
                <a href="{{ route('clients.create') }}" class="btn bg-primary ms-auto" data-bs-toggle="tooltip" title="Add New">
                    <span><i class="fa fa-plus"></i> </span>
                </a>
                @endif
            </div>
            <div class="mb-3 text-end">

            </div>
            <form action="{{ route('clients.index') }}" method="GET">
                <div class="mb-3 text-end">
                    <div class="input-group w-100">
                        <div class="col">
                            <input type="text" name="cus_name" class="form-control" placeholder="Client Name" value="{{ request('cus_name') }}">
                        </div>
                        <div class="col">
                            <input type="text" name="city" class="form-control" placeholder="City" value="{{ request('city') }}">
                        </div>
                        <div class="col">
                            <input type="text" name="state" class="form-control" placeholder="State" value="{{ request('state') }}">
                        </div>
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
                                        <th class="wd-15p border-bottom-0">Client Name</th>
                                        <th class="wd-15p border-bottom-0">Client Date of birth</th>
                                        <th class="wd-20p border-bottom-0">Client Address</th>
                                        <th class="wd-15p border-bottom-0">City</th>
                                        <th class="wd-10p border-bottom-0">State</th>
                                        <th class="wd-25p border-bottom-0">Created ON</th>
                                        <th class="wd-25p border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client->cus_name}}</td>
                                        <td>{{$client->cus_dob}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->city}}</td>
                                        <td>{{$client->state}}</td>
                                        <td>{{$client->created_at}}</td>
                                        <td>
                                            <a href="{{ route('clients.mail', $client->id) }}"
                                                class="btn btn-sm btn-success badge" type="button">
                                                <i class="fa fa-envelope" title="Email"></i></a>

                                            @if($allow_show)
                                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-warning badge btn-sm" title="Show">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($allow_edit)
                                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-primary badge" type="button" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($allow_delete)
                                            <button class="btn btn-sm btn-danger badge" title="Delete" onclick="confirmDelete('{{ route('clients.destroy', $client->id) }}');">
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
                                    <p>Total Entries: {{ $clients->total() }}</p>

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center mb-0">
                                            {{-- Previous Button --}}
                                            @if ($clients->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);" tabindex="-1">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $clients->previousPageUrl() }}">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            @endif

                                            {{-- Page Links --}}
                                            @for ($i = 1; $i <= $clients->lastPage(); $i++)
                                                <li class="page-item {{ ($clients->currentPage() == $i) ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $clients->url($i) }}">{{ $i }}</a>
                                                </li>
                                                @endfor

                                                {{-- Next Button --}}
                                                @if ($clients->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $clients->nextPageUrl() }}">
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