@extends('admin.admin_master')

@section('title', 'General Settings')



@section('content')


    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">System Details</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('app-settings.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">System Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control" name="name"
                                            placeholder="Online Meditation" value="{{ $app->system_name }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">System Logo</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="image" name="image">
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
            <h5>Company Logo</h5>
            <div class="m-1">
                <img id="showImage"
                    src="{{ !empty($app->image) ? url('uploads/logo/' . $app->image) : url('uploads/no_image.jpg') }}"
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
