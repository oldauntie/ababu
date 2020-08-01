@extends('layouts.app')

@section('content')
<style>
    .btn-group-xs>.btn,
    .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}<br>
                    <small>{{ __('help.pets_description') }}</small>
                    <button type="button" id="btnNew" class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <button type="button" id="btnEdit" class="btn btn-sm btn-secondary" disabled>{{__('translate.edit')}}</button>
                    <button type="button" id="btnVisit" class="btn btn-sm btn-dark" disabled>{{__('translate.visit')}}</button>
                    <button type="button" id="btnDelete" class="btn btn-sm btn-danger" disabled>{{__('translate.delete')}}</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col col-md-12">
                            <table id="pets" class="display compact" style="width:100%">
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
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- first row detail -->
                    <div class="row">
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                    </div>
                    <!-- second row detail -->
                    <div class="row">
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
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
    $(function() {
        var table = $('#pets').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: "{{ route('clinics.pets.list', 0) }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'familiar_name',
                    name: 'familiar_name'
                },
                {
                    data: 'firstname',
                    name: 'firstname',
                    visible: false
                },
                {
                    data: 'lastname',
                    name: 'lastname',
                    visible: false
                },
                {
                    data: 'owner',
                    render: function(data, type, row) {
                        return row.firstname + ' ' + row.lastname;
                    },
                    name: 'owner'
                },
                {
                    data: 'microchip',
                    name: 'microchip'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'color',
                    name: 'color'
                },
            ],
            columnDefs: [{
                    targets: 0,
                    "width": "1%"
                },
                {
                    targets: 1,
                    "width": "150px"
                },
                {
                    targets: 2,
                    "width": "150px"
                },
                {
                    targets: 3,
                    "width": "150px"
                },
            ]
        });

        $('#pets tbody').on('click', 'tr', function() {
            var rowData = table.row(this).data();
            // console.log(rowData.id)
            
            if ($(this).hasClass('selected')) {
                // $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

            $('#btnEdit').prop('disabled', false);
            $('#btnVisit').prop('disabled', false);
            $('#btnDelete').prop('disabled', false);
        });


        $('#btnEdit').click(function() {
            var selData = table.rows(".selected").data();
            console.log(selData[0].id);
        });
    });


    $(document).on('click', '.open_modal_edit', function() {
        $('#edit-modal').modal('show');
    });

    $(document).on('click', '.open_modal_invite', function() {
        $('#invite-modal').modal('show');
    });

    $(document).on('click', '.open_modal_delete', function() {
        $('#confirm-delete-modal').modal('show');
    });
</script>
@endif
@endpush