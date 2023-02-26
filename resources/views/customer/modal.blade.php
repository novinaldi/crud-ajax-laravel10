@fragment('modal-add')
    <!-- Modal -->
    <div class="modal fade" id="modalnew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalnewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalnewLabel">Add New Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('customer') }}" class="formsave" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control form-control-sm" name="fullname" id="fullname"
                                autofocus>
                            <div class="invalid-feedback err-fullname">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select form-select-sm" name="gender" id="gender">
                                <option value="" selected>-Pilih-</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            <div class="invalid-feedback err-gender">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                            <div class="invalid-feedback err-address">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail Address</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email"
                                placeholder="Input Your E-Mail Valid">
                            <div class="invalid-feedback err-email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control form-control-sm" name="phone" id="phone">
                            <div class="invalid-feedback err-phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" class="form-control form-control-sm" name="photo" id="photo">
                            <div class="invalid-feedback err-photo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btnsave">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('.formsave').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        iziToast.success({
                            title: 'Success',
                            message: response.success,
                            position: 'center'
                        });
                        $('#modalnew').modal('hide');
                        $('#datacustomer').DataTable().ajax.reload();
                    },
                    error: function(e) {
                        // alert(e.responseText);
                        if (e.status == 422) {
                            let err = e.responseJSON.errors;
                            if (err.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.err-fullname').html(err.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('#fullname').addClass('is-valid');
                                $('.err-fullname').html('');
                            }
                            if (err.gender) {
                                $('#gender').addClass('is-invalid');
                                $('.err-gender').html(err.gender);
                            } else {
                                $('#gender').removeClass('is-invalid');
                                $('#gender').addClass('is-valid');
                                $('.err-gender').html('');
                            }
                            if (err.address) {
                                $('#address').addClass('is-invalid');
                                $('.err-address').html(err.address);
                            } else {
                                $('#address').removeClass('is-invalid');
                                $('#address').addClass('is-valid');
                                $('.err-address').html('');
                            }
                            if (err.email) {
                                $('#email').addClass('is-invalid');
                                $('.err-email').html(err.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                                $('.err-email').html('');
                            }

                            if (err.phone) {
                                $('#phone').addClass('is-invalid');
                                $('.err-phone').html(err.phone);
                            } else {
                                $('#phone').removeClass('is-invalid');
                                $('#phone').addClass('is-valid');
                                $('.err-phone').html('');
                            }
                            if (err.photo) {
                                $('#photo').addClass('is-invalid');
                                $('.err-photo').html(err.photo);
                            } else {
                                $('#photo').removeClass('is-invalid');
                                $('#photo').addClass('is-valid');
                                $('.err-photo').html('');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endfragment
@fragment('modal-edit')
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modaleditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modaleditLabel">Form Edit Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('customer/' . $idcustomer) }}" class="formupdate"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $idcustomer }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control form-control-sm" name="fullname" id="fullname"
                                autofocus value="{{ $fullname }}">
                            <div class="invalid-feedback err-fullname">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select form-select-sm" name="gender" id="gender">
                                <option value="M" {{ $gender == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ $gender == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                            <div class="invalid-feedback err-gender">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3">{{ $address }}</textarea>
                            <div class="invalid-feedback err-address">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail Address</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email"
                                placeholder="Input Your E-Mail Valid" value="{{ $email }}">
                            <div class="invalid-feedback err-email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control form-control-sm" name="phone" id="phone"
                                value="{{ $phone }}">
                            <div class="invalid-feedback err-phone">
                            </div>
                        </div>
                        @if ($photo)
                            <div class="mb-3">
                                <label for="" class="form-label">Your Photo</label><br>
                                <a href="{{ asset('/images') . '/' . $photo }}" target="_blank">Preview</a>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="photo" class="form-label">
                                @if ($photo)
                                    Change Your Photo ?
                                @else
                                    Upload Photo
                                @endif
                            </label>
                            <input type="file" class="form-control form-control-sm" name="photo" id="photo">
                            <div class="invalid-feedback err-photo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btnsave">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('.formupdate').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        iziToast.success({
                            title: 'Success',
                            message: response.success,
                            position: 'center'
                        });
                        $('#modaledit').modal('hide');
                        $('#datacustomer').DataTable().ajax.reload();
                    },
                    error: function(e) {
                        // alert(e.responseText);
                        if (e.status == 422) {
                            let err = e.responseJSON.errors;
                            if (err.fullname) {
                                $('#fullname').addClass('is-invalid');
                                $('.err-fullname').html(err.fullname);
                            } else {
                                $('#fullname').removeClass('is-invalid');
                                $('#fullname').addClass('is-valid');
                                $('.err-fullname').html('');
                            }
                            if (err.gender) {
                                $('#gender').addClass('is-invalid');
                                $('.err-gender').html(err.gender);
                            } else {
                                $('#gender').removeClass('is-invalid');
                                $('#gender').addClass('is-valid');
                                $('.err-gender').html('');
                            }
                            if (err.address) {
                                $('#address').addClass('is-invalid');
                                $('.err-address').html(err.address);
                            } else {
                                $('#address').removeClass('is-invalid');
                                $('#address').addClass('is-valid');
                                $('.err-address').html('');
                            }
                            if (err.email) {
                                $('#email').addClass('is-invalid');
                                $('.err-email').html(err.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                                $('.err-email').html('');
                            }

                            if (err.phone) {
                                $('#phone').addClass('is-invalid');
                                $('.err-phone').html(err.phone);
                            } else {
                                $('#phone').removeClass('is-invalid');
                                $('#phone').addClass('is-valid');
                                $('.err-phone').html('');
                            }
                            if (err.photo) {
                                $('#photo').addClass('is-invalid');
                                $('.err-photo').html(err.photo);
                            } else {
                                $('#photo').removeClass('is-invalid');
                                $('#photo').addClass('is-valid');
                                $('.err-photo').html('');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endfragment
