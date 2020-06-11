@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.Users')}}
                </div>

                <div class="card-body">
                    <table id="users" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>email</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<script>
    $(function () {
    
    var table = $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.ajax') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { targets: 1, "width": "1%"},
        ]
    });
    
  });
</script>

@endpush