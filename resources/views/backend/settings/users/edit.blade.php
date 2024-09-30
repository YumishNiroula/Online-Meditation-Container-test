@extends('admin.admin_master')

@section('title', 'Edit User Details')

@section('content')

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User Details</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('users.update', $user) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="first-name">Full Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control" name="name"
                                            placeholder="Full Name" value="{{ $user->name }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="email-id">Email</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" id="email" class="form-control" name="email"
                                            placeholder="Email" value="{{ $user->email }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @hasrole('Super Admin|Admin')
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">New Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="Password">
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-danger m-2">You are not allowed to change password, please ask your
                                    admin to reset user password.</span>
                            @endhasrole

                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Profile Photo</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Select Role</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="role" class="form-select" aria-label="Default select example">
                                            <option selected disabled value="{{ substr($userRole, 2, -2) }}">Current Role
                                                Assigned:
                                                "{{ substr($userRole, 2, -2) }}"</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">
                                                    {{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit"
                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">Update</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3">
            <h5>Profile Photo</h5>
            <div class="m-1">
                <img id="showImage"
                    src="{{ !empty($user->image) ? url('uploads/user_avatar/' . $user->image) : url('uploads/no_image.jpg') }}"
                    style="width: 100px; border: 1px solid #000000;">
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').on('change', function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>

@endpush
