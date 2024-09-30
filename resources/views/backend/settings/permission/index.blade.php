@extends('admin.admin_master')

@section('title', 'Permission List')

@push('links')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.1/r-2.2.9/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css" />
@endpush

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permission List Table</h4>
                    @can('permission_create')
                        <button class="btn add-new btn-primary mt-50" tabindex="0" aria-controls="DataTables_Table_0"
                            type="button" data-bs-toggle="modal" data-bs-target="#addPermissionModal"><span>Add
                                Permission</span></button>
                    @endcan
                </div>
                <div class="table-responsive" style="padding: 10px">
                    <table id="datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Permission Modal -->
    <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Add New Permission</h1>
                        <p>Permissions you may use and assign to your users.</p>
                    </div>
                    <form id="addPermissionForm" class="row" action="{{ route('permissions.store') }}"
                        method="post">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="modalPermissionName">Permission Name</label>
                            <input type="text" id="modalPermissionName" name="name" class="form-control"
                                placeholder="Permission Name" autofocus data-msg="Please enter permission name" required />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2 me-1">Create Permission</button>
                            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Permission Modal -->

    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 pt-0">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Edit Permission</h1>
                        <p>Edit permission as per your requirements.</p>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading">Warning!</h6>
                        <div class="alert-body">
                            By editing the permission name, you might break the system permissions functionality. Please
                            ensure you're
                            absolutely certain before proceeding.
                        </div>
                    </div>

                    <form id="editPermissionForm" class="row" onsubmit="return false">
                        <div class="col-sm-9">
                            <label class="form-label" for="editPermissionName">Permission Name</label>
                            <input type="text" id="editPermissionName" name="editPermissionName" class="form-control"
                                placeholder="Enter a permission name" tabindex="-1"
                                data-msg="Please enter permission name" />
                        </div>
                        <div class="col-sm-3 ps-sm-0">
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Permission Modal -->


@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.1/r-2.2.9/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js">
    </script>

    <script type="text/javascript">
        $(function() {
            var table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                deferRender: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                ajax: "{{ route('permissions.getAllData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "columnDefs": [{
                    "targets": [0, 1, 2],
                    "className": "text-center"
                }],
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
            });
        });
    </script>
@endpush
