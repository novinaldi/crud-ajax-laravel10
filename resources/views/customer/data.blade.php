@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Data Customer
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
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($data as $d) --}}
                    {{-- <tr> --}}
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    {{-- <td>{{ $d->fullname }}</td>
                            <td>{{ $d->gender }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->address }}</td>
                            <td>{{ $d->phone }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <script>
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
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });
        });
    </script>
@endsection
