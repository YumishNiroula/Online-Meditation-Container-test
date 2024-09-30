@extends('admin.admin_master')

@section('title', 'User List')

@push('links')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.1/r-2.2.9/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css" />
@endpush

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User List Table</h4>
                    @can('user_create')
                        <button class="btn add-new btn-primary mt-50" tabindex="0" aria-controls="DataTables_Table_0"
                            type="button" data-bs-toggle="modal" data-bs-target="#addUser"><span>Add
                                User</span></button>
                    @endcan
                </div>
                <div class="table-responsive" style="padding: 10px">
                    <table id="datatables" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                @can('role_access')
                                    <th>Role</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($user->image != null)
                                            <div class="avatar avatar-xl">
                                                <img src="{{ 'uploads/user_avatar/' . $user->image }}" alt="avatar">
                                            </div>
                                        @else
                                            <div class="avatar bg-light-danger avatar-xl">
                                                <span class="avatar-content">{{ substr($user->name, 0, 2) }}</span>
                                            </div>
                                        @endif

                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @can('role_access')
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $role)
                                                    <span class="badge badge-light-warning">{{ $role }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    @endcan
                                    <td>
                                        @can('user_edit')
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('user_delete')
                                            <form id="delete" action="{{ route('users.destroy', $user) }}" method="post"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Add New User Information</h1>
                    </div>
                    <form class="row gy-1 pt-75" action="{{ route('users.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Salman F Rahman"
                                data-msg="Please enter your first name" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddUserEmail">Email</label>
                            <input type="text" id="modalAddUserEmail" name="email" class="form-control"
                                placeholder="info@student.oulu.fi" />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="login-password" type="password"
                                    name="password" placeholder="············" aria-describedby="login-password"
                                    tabindex="2"><span class="input-group-text cursor-pointer"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="formFile" class="form-label">Profile Photo</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        @php
                            $logUser = Illuminate\Support\Facades\Auth::user();
                            $check = $logUser->roles->pluck('name')->contains('Super Admin');
                            $check2 = $logUser->roles->pluck('name')->contains('Admin');
                            $userRole = $user->roles->pluck('name');

                            if ($check) {
                                $roles = Spatie\Permission\Models\Role::all()->pluck('name');
                            } elseif ($check2) {
                                $roles = Spatie\Permission\Models\Role::whereNotIn('name', [$userRole, 'Super Admin'])->pluck('name');
                            } else {
                                $roles = Spatie\Permission\Models\Role::whereNotIn('name', [$userRole, 'Super Admin', 'Admin'])->pluck('name');
                            }
                        @endphp
                        <div class="col-12">
                            <label class="form-label">User Role</label>
                            <select name="role" class="form-select" aria-label="Default select example">
                                <option selected disabled>Status</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">
                                        {{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add User Modal -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Edit User Information</h1>
                    </div>
                    <form class="row gy-1 pt-75" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="user_avatar" id="user_avatar">
                        <div class="col-12">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="" class="form-control"
                                placeholder="Salman F Rahman" data-msg="Please enter your first name" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddUserEmail">Email</label>
                            <input type="text" id="modalAddUserEmail" name="email" class="form-control"
                                placeholder="info@student.oulu.fi" />
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="login-password" type="password"
                                    name="password" placeholder="············" aria-describedby="login-password"
                                    tabindex="2"><span class="input-group-text cursor-pointer"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="formFile" class="form-label">Profile Photo</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="col-12">
                            <label class="form-label">User Role</label>
                            <select name="role" class="form-select" aria-label="Default select example">
                                <option selected disabled>Status</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">
                                        {{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">Update</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit User Modal -->


@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.1/r-2.2.9/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>
@endpush
