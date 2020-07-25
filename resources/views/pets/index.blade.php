@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}<br>
                    <small>{{ __('help.pets_description') }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col col-md-12">
                            <table id="pets" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('translate.name')}}</th>
                                        <th>{{__('translate.species')}}</th>
                                        <th>{{__('translate.firstname')}}</th>
                                        <th>{{__('translate.lastname')}}</th>
                                        <th>{{__('translate.owner')}}</th>
                                        <th>{{__('translate.microchip')}}</th>
                                        <th>{{__('translate.description')}}</th>
                                        <th>{{__('translate.color')}}</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-12">
                            <h5>placeholder</h5>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.modal.edit')
@include('clinics.modal.invite')
@include('clinics.modal.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(function () {
    
    var table = $('#pets').DataTable({
        processing: true,
        serverSide: true,
        search: {
            caseInsensitive: true
        },
        ajax: "{{ route('pets.get', 0) }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'familiar_name', name: 'familiar_name'},
            {data: 'firstname', name: 'firstname', visible: false},
            {data: 'lastname', name: 'lastname', visible: false},
            {data: 'owner', 
            render: function ( data, type, row ) {
                return row.firstname +' '+ row.lastname;
            },
            name: 'owner'},
            {data: 'microchip', name: 'microchip'},
            {data: 'description', name: 'description'},
            {data: 'color', name: 'color'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { targets: 1, "width": "1%"},
        ]
    });
    
  });


    $(document).on('click','.open_modal_edit',function(){
        $('#edit-modal').modal('show');
    });

    $(document).on('click','.open_modal_invite',function(){
        $('#invite-modal').modal('show');
    });

    $(document).on('click','.open_modal_delete',function(){
        $('#confirm-delete-modal').modal('show');
    });
</script>
@endif
@endpush