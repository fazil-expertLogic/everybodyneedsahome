@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Tables</li>
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
                    <h3 class="card-title">User Data</h3>
                </div>
                <div class="mb-3 text-end">
                    @if($allow_create)
                    <a href="{{ route('users.create') }}" class="btn bg-primary btn-sm badge" data-bs-toggle="tooltip" title="Add New">
                        <span><i class="fa fa-plus"></i></span>
                    </a>
                    @endif
                </div>
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="mb-3 text-end">
                        <div class="input-group w-100">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
                            </div>
                            <div class="col">
                                <input type="text" name="email" class="form-control" placeholder="E-mail" value="{{ request('email') }}">
                            </div>    
                            <input type="text" name="search" class="form-control bg-white" placeholder="Search here..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">users Name</th>
                                    <th class="wd-15p border-bottom-0">users Email</th>
                                    <th class="wd-25p border-bottom-0">Created ON</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users as $user )   
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        @if($allow_show)
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm badge" title="Show">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                        @if($allow_edit)
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm badge" title="Edit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                        @if($allow_delete)
                                        <button class="btn btn-danger btn-sm badge" title="Delete" onclick="confirmDelete('{{ route('users.destroy', $user->id) }}');">
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
                                <p>Total Entries: {{ $users->total() }}</p>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mb-0">
                                        {{-- Previous Button --}}
                                        @if ($users->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);" tabindex="-1">
                                                <i class="fa fa-angle-left"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->previousPageUrl() }}">
                                                <i class="fa fa-angle-left"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @endif

                                        {{-- Page Links --}}
                                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                                            <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                            </li>
                                            @endfor

                                            {{-- Next Button --}}
                                            @if ($users->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}">
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
    {{--
    
    --}}
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
    {{--
    
    --}}
