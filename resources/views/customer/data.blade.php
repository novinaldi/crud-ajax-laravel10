@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    Data Customer
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd">
                        <i class="fas fa-plus"></i> Add New
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datacustomer" class="display table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>FullName</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="viewmodal" style="display: none;"></div>
    <div class="viewmodaledit" style="display: none;"></div>
    <script>
        function editdata(id) {
            $.ajax({
                type: "GET",
                url: "{{ url('customer') }}" + '/' + id,
                success: function(response) {
                    $('.viewmodaledit').html(response).show();
                    $('#modaledit').on('shown.bs.modal', function(e) {
                        $('#fullname').focus();
                    });
                    $('#modaledit').modal('show');
                },
                error: function(e) {
                    alert(e.responseText);
                }
            });
        }

        function removedata(id) {
            iziToast.show({
                theme: 'dark',
                icon: 'fas fa-question-circle',
                title: 'Warning',
                message: 'Are you sure delete this data ?',
                position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)',
                buttons: [
                    ['<button>Ok</button>', function(instance, toast) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('customer') }}" + '/' + id,
                            dataType: "json",
                            success: function(response) {
                                iziToast.success({
                                    title: 'Success',
                                    message: response.success,
                                    position: 'topCenter'
                                });
                                $('#datacustomer').DataTable().ajax.reload();
                            },
                            error: function(e) {
                                alert(e.responseText);
                            }
                        });
                    }, true], // true to focus
                    ['<button>Close</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                        }, toast);
                    }]
                ]
            });
        }
        $(document).ready(function() {
            $('#datacustomer').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#btnAdd').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ url('customer/form') }}",
                    data: {
                        st: 'new'
                    },
                    success: function(response) {
                        $('.viewmodal').html(response).show();
                        $('#modalnew').on('shown.bs.modal', function(e) {
                            $('#fullname').focus();
                        });
                        $('#modalnew').modal('show');
                    },
                    error: function(e) {
                        alert(e.responseText);
                    }
                });
            });
            $('#btnEdit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ url('customer/form') }}",
                    data: {
                        st: 'edit'
                    },
                    success: function(response) {
                        alert(response);
                    },
                    error: function(e) {
                        alert(e.responseText);
                    }
                });
            });
        });
    </script>
@endsection
