<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    User Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex-box">
                    <form id="userProfileForm" action="{{ route('users.update', ['userId' => $user->id]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label" style="color: #fff">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="username"
                                    placeholder="Username" value="{{ $user->username }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label" style="color: #fff">First
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="First Name" value="{{ $user->first_name }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 col-form-label" style="color: #fff">Last
                                Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Last Name" value="{{ $user->last_name }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-sm-2 col-form-label" style="color: #fff">Birth
                                Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday"
                                    placeholder=" Birthday" value="{{ $user->birthdate }}" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label" style="color: #fff">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" value="{{ $user->user->email }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label" style="color: #fff">Password<span
                                    style="color: red;"> *</span>
                            </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="color-btn btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" form="userProfileForm" class="color-btn btn btn-secondary">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
