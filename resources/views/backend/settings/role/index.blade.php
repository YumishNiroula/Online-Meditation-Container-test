@extends('admin.admin_master')

@section('content')

    <!-- Role cards -->
    <div class="row">

        @foreach ($roles as $role)

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            @php
                                $users = App\Models\User::role($role->name)->get();
                            @endphp
                            <span>Total {{ $users->count() }} users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach ($users->take(10) as $user)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="{{ $user->name }}" class="avatar avatar-sm pull-u') }}p">


                                        @if ($user->image != null)
                                            <img class="rounded-circle" src="{{ '/uploads/user_avatar/' . $user->image }}"
                                                alt="Avatar" />
                                        @else
                                            <div class="avatar bg-light-danger avatar-sm">
                                                <span class="avatar-content">{{ substr($user->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <div>Role Name</div>
                                <h4 class="fw-bolder">{{ $role->name }}</h4>
                                @can('role_edit')
                                    <a href="{{ route('roles.edit', $role) }}" class="role-edit-modal">
                                        <small class="fw-bolder">Edit Role</small>
                                    </a>
                                @endcan
                            </div>
                            @can('role_delete')
                                <form id="delete" action="{{ route('roles.destroy', $role) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-flat-danger waves-effect">
                                        <i data-feather='trash-2'></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        @can('role_create')
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end justify-content-center h-70">
                                <img src="{{ asset('backend/app-assets/images/illustration/faq-illustrations.svg') }}"
                                    class="img-fluid mt-2" alt="Image" width="85" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="stretched-link text-nowrap add-new-role">
                                    <span class="btn btn-primary mb-1">Add New Role</span>
                                </a>
                                <p class="mb-0">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

    </div>
    <!--/ Role cards -->


    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Add New Role</h1>
                        <p>Set role permissions</p>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" class="row" action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" id="modalRoleName" name="name" class="form-control"
                                placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                        </div>
                        <h5 class="mt-2 pt-50">Please Select Role Permissions</h5>

                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                {{-- <div class="custom-controls-stacked"> --}}
                                @foreach ($permissions as $permission)
                                    <div class="form-check me-3 me-lg-5 m-2">
                                        <input type="checkbox" class="form-check-input" name="permission[]"
                                            value="{{ $permission->name }}" />
                                        <label class="form-check-label" for="modalRolePermissions">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                                {{-- </div> --}}
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <h4 class="mt-2 pt-50">Role Permissions</h4>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap fw-bolder">Role Management</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementRead" name="permission[]" value="role_show" />
                                                        <label class="form-check-label" for="userManagementRead"> Read
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementWrite" name="permission[]"
                                                            value="role_edit" />
                                                        <label class="form-check-label" for="userManagementWrite"> Write
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementWrite" name="permission[]"
                                                            value="role_create" />
                                                        <label class="form-check-label" for="userManagementWrite"> Create
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="userManagementCreate" name="permission[]"
                                                            value="role_delete" />
                                                        <label class="form-check-label" for="userManagementCreate"> Delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div> --}}
                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->

@endsection
