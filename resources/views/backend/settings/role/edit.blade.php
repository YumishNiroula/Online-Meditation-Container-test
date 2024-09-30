@extends('admin.admin_master')

@section('title', 'Edit Role & Permission')

@section('content')

    {{-- @dd($role->name, (string)$rolePermissions) --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Role & Permission</h3>
        </div>
        <div class="card-body">
            <form id="addRoleForm" class="row" action="{{ route('roles.update', $role) }}" method="post">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label class="form-label" for="modalRoleName">Role Name</label>
                    <input type="text" id="modalRoleName" name="name" value="{{ $role->name }}" class="form-control"
                        placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <h5 class="mt-2 pt-50">Please Select Role Permissions</h5>
                @error('permission')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-12">
                    <div class="d-flex flex-wrap">
                        <div class="custom-controls-stacked">
                            @foreach ($permissions as $permission)
                                <div class="form-check me-3 me-lg-5 m-2">
                                    <input type="checkbox" class="form-check-input" id="{{ $permission->id }}"
                                        name="permission[]" value="{{ $permission->name }}" @if ($permission->name == $rolePermissions->pluck('name')->contains($permission->name)) checked @endif>
                                    <label class="form-check-label" for="modalRolePermissions">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
