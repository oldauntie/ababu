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
                    {{__('translate.owners')}}<br>
                    <small>{{ __('help.owners_description') }}</small>
                    <button type="button" id="btnNew" class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <button type="button" id="btnEdit" class="btn btn-sm btn-secondary"
                        disabled>{{__('translate.edit')}}</button>
                    <button type="button" id="btnDelete" class="btn btn-sm btn-danger"
                        disabled>{{__('translate.delete')}}</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col col-md-12">
                            <table id="owners" class="display compact" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('translate.firstname')}}</th>
                                        <th>{{__('translate.lastname')}}</th>
                                        <th>{{__('translate.address')}}</th>
                                        <th>{{__('translate.postcode')}}</th>
                                        <th>{{__('translate.city')}}</th>
                                        <th>{{__('translate.phone')}}</th>
                                        <th>{{__('translate.mobile')}}</th>
                                        <th>{{__('translate.email')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- first row detail -->
                    <div class="row">
                        <div class="col col-md-12">
                            <!-- tab headers -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pets-tab-pane"
                                        role="tab" aria-controls="pets"
                                        aria-selected="true">{{__('translate.pets')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="owners-tab" data-toggle="tab" href="#owners-tab-pane"
                                        role="tab" aria-controls="owners"
                                        aria-selected="false">{{__('translate.details')}}</a>
                                </li>
                            </ul>
                            <!-- / tab headers -->

                            <!-- tab 1 content -->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pets-tab-pane" role="tabpanel"
                                    aria-labelledby="pets-tab">
                                    <table id="pets" class="display compact" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('translate.name')}}</th>
                                                <th>{{__('translate.gender')}}</th>
                                                <th>{{__('translate.description')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                    <nav class="navbar navbar-expand-lg navbar-light bg-light disabled">
                                        <button type="button" id="btnVisit" class="btn btn-sm btn-primary"
                                            disabled>{{__('translate.visit')}}</button>
                                    </nav>



                                </div>
                                <!-- / tab 1 content -->

                                <!-- tab 2 content -->
                                <div class="tab-pane fade" id="owners-tab-pane" role="tabpanel"
                                    aria-labelledby="owners-tab">
                                    owners placeholder
                                </div>
                                <!-- / tab 2 content -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasAnyRolesByClinicId(['admin', 'veterinarian'], $clinic->id) )
@include('owners.modal.edit')
@include('owners.modal.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasAnyRolesByClinicId(['admin', 'veterinarian'], $clinic->id) )
<!--
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
-->
<link rel="stylesheet" type="text/css" href="{{url('/lib/DataTables-1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>


<script type="text/javascript">
    $(function() {
        // owners table definition
        var table = $('#owners').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: "{{ route('clinics.owners.list', 0) }}",
            columns: [
                {data: "id", name: "id", visible: false, searchable: false},
                {data: "firstname", name: "firstname"},
                {data: "lastname", name: "lastname"},
                {data: "address", name: "address", width: "150px"},
                {data: "postcode", name: "postcode"},
                {data: "city", name: "city" },
                {data: "phone", name: "phone"},
                {data: "mobile", name: "mobile"},
                {data: "email", name: "email", 
                render: function(data, type, row, meta){
                        if(type === "display"){
                            data = '<a href=mailto:"' + data + '">' + data + '</a>';
                        }
                        return data;
                    }
                },
            ]
        } );

        // pet table definition
        var table_pets = $('#pets').DataTable( {
		    data : [],
            columns: [
                {data: "id", name: "id", visible: false, searchable: false},
                {data: "name", name: "name"},
                {data: "gender", name: "gender"},
                {data: "description", name: "description"},
            ],
            bPaginate: false,
            bLengthChange: false,
            bFilter: false,
            bInfo: false,
            bAutoWidth: false,
	    } );

        // on filter enter
        table.on( 'search.dt', function () {
            $('#btnEdit').prop('disabled', true);
            $('#btnDelete').prop('disabled', true);
            $('#btnVisit').prop('disabled', true);
            table_pets.clear().draw();
        } );

        // owners row selection
        $('#owners tbody').on('click', 'tr', function() {
            var rowData = table.row(this).data();
            
            if(rowData != undefined && rowData.id > 0){
                table_pets.ajax.url("/clinics/{{$clinic->id}}/owners/" + rowData.id + "/pets/list/datatable").load();
                $('#btnVisit').prop('disabled', true);

                $('#btnEdit').prop('disabled', false);
                $('#btnDelete').prop('disabled', false);
            }
            
            if ($(this).hasClass('selected')) {
                // $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }


        });


        // pets row selection
        $('#pets tbody').on('click', 'tr', function() {
            var rowData = table_pets.row(this).data();
            
            if(rowData != undefined && rowData.id > 0)
            {
                table_pets.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('#btnVisit').prop('disabled', false);
            }

        });

        // new button
        $('#btnNew').click(function() {
            console.log('new record');
        });

        // edit button
        $('#btnEdit').click(function() {
            var selData = table.rows(".selected").data();
            var id = selData[0].id;
            console.log('edit: ' + selData[0].id);

            $.ajax({
                url: '/clinics/{{$clinic->id}}/owners/' + id +'/get',
                type: 'get',
                // data: {userid: userid},
                success: function(owner){ 
                    // fill Modal with owner details                    
                    $('#firstname').val(owner.firstname)
                    $('#lastname').val(owner.lastname)
                    $('#address').val(owner.address)
                    $('#postcode').val(owner.postcode)
                    $('#city').val(owner.city)
                    $('#ssn').val(owner.ssn)
                    $('#phone').val(owner.phone)
                    $('#mobile').val(owner.mobile)
                    $('#email').val(owner.email)


                    // Display Modal
                    $('#owner-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/owners/' + id);
                    $('#owner-edit-modal').modal('show');
                }
            });


        });

        // delete button
        $('#btnDelete').click(function() {
            var row = table.rows(".selected").data();
            var id = row[0].id;
            $('#confirm-delete-modal-form').attr('action', '/clinics/{{$clinic->id}}/owners/' + id);
            $('#confirm-delete-modal').modal('show');
        });


        $('#owner-edit-modal').on('show.bs.modal', function (event) {
            console.log(event);
            /*
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes

            var modal = $(this)
            console.log(id)
            $("#docsForm").attr("action", "/contact_delete/" + id+"/");
            */
        })

        // visit button
        $('#btnVisit').click(function() {
            var selData = table_pets.rows(".selected").data();
            if(selData.length > 0)
            {
                var pet_id = selData[0].id;
                console.log('visit: ' +pet_id);
            }
        });
    });
    
</script>
@endif
@endpush