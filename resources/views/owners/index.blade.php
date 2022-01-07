@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.owners')}}
                    <button type="button" id="owner-new-button"
                        class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <br>
                    <small>{{ __('help.owners_description') }}</small>
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
                                        <th>{{__('translate.phone_primary')}}</th>
                                        <th>{{__('translate.phone_secondary')}}</th>
                                        <th>{{__('translate.email')}}</th>
                                        <th>{{__('translate.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr class="divider">

                    <!-- TABS -->
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

                            <div class="tab-content">
                                <!-- tab 1 content -->
                                <div class="tab-pane fade show active" id="pets-tab-pane" role="tabpanel"
                                    aria-labelledby="pets-tab">
                                    <table id="pets" class="display compact" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('translate.name')}}</th>
                                                <th>{{__('translate.sex')}}</th>
                                                <th>{{__('translate.description')}}</th>
                                                <th>{{__('translate.actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- / tab 1 content -->

                                <!-- tab 2 content -->
                                <div class="tab-pane fade" id="owners-tab-pane" role="tabpanel"
                                    aria-labelledby="owners-tab">
                                    <div class="row">
                                        <div class="col-2" id="owner-details-firstname"></div>
                                        <div class="col-2" id="owner-details-lastname"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2" id="owner-details-address"></div>
                                        <div class="col-2" id="owner-details-city"></div>
                                        <div class="col-2" id="owner-details-postcode"></div>
                                    </div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="#" id="owner-details-phone_primary" data-toggle="modal"
                                                data-target="#owner-overlay-modal">
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <a href="#" id="owner-details-phone_secondary" data-toggle="modal"
                                                data-target="#owner-overlay-modal">
                                            </a>
                                        </div>
                                        <div class="col-3" id="owner-details-email"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- / tab 2 content -->
                        </div>
                    </div>
                </div>
                <!-- / TABS -->
            </div>
        </div>


    </div>
</div>
</div>

@if( Auth::user()->hasAnyRolesByClinicId(['admin', 'veterinarian'], $clinic->id) )
@include('owners.partials.create')
@include('owners.partials.edit')
@include('owners.partials.confirm-delete')
@include('owners.partials.overlay')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasAnyRolesByClinicId(['admin', 'veterinarian'], $clinic->id) )

<link rel="stylesheet" type="text/css" href="{{url('/lib/datatables/1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/datatables/1.10.21/js/jquery.dataTables.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        // owners table definition
        var table = $('#owners').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: "{{ route('clinics.owners.list', $clinic->id) }}",
            columns: [
                {data: "id", name: "id", visible: false, searchable: false},
                {data: "firstname", name: "firstname"},
                {data: "lastname", name: "lastname"},
                {data: "address", name: "address", width: "150px"},
                {data: "postcode", name: "postcode"},
                {data: "city", name: "city" },
                {data: "phone_primary", name: "phone_primary"},
                {data: "phone_secondary", name: "phone_secondary"},
                {data: "email", name: "email", 
                render: function(data, type, row, meta){
                        if(type === "display"){
                            data = '<a href=mailto:"' + data + '">' + data + '</a>';
                        }
                        return data;
                    }
                },
                {data: "action", name: "action", searchable: false, width: "100"},

            ],
            bPaginate: false,
            bLengthChange: false,
            bFilter: true,
            bInfo: false,
            bAutoWidth: false,
        } );

        // pet table definition
        var table_pets = $('#pets').DataTable( {
		    data : [],
            columns: [
                {data: "id", name: "id", visible: false, searchable: false},
                {data: "name", name: "name"},
                {data: "sex", name: "sex"},
                {data: "description", name: "description"},
                {data: "action", name: "action", searchable: false, width: "150px"},
            ],
            bPaginate: false,
            bLengthChange: false,
            bFilter: false,
            bInfo: false,
            bAutoWidth: false,
	    } );

        // on filter enter
        table.on( 'search.dt', function () {
            table_pets.clear().draw();
        } );

        // owners row selection
        $('#owners tbody').on('click', 'tr', function() {
            var rowData = table.row(this).data();
            var id = rowData.id;
            
            // load pets list by owner
            if(rowData != undefined && id > 0){
                table_pets.ajax.url("/clinics/{{$clinic->id}}/owners/" + id + "/pets/list/datatable").load();
            }

            // load owner details
            $.ajax({
                url: '/clinics/{{$clinic->id}}/owners/' + id +'/get',
                type: 'get',
                // data: {userid: userid},
                success: function(owner){ 
                    // fill with owner details                    
                    $('#owner-details-firstname').html(owner.firstname);
                    $('#owner-details-lastname').html(owner.lastname);
                    $('#owner-details-address').html(owner.address);
                    $('#owner-details-postcode').html(owner.postcode);
                    $('#owner-details-city').html(owner.city);
                    $('#owner-details-phone_primary').html(owner.phone_primary);
                    $('#owner-details-phone_secondary').html(owner.phone_secondary);
                    $('#owner-details-email').html('<a href="mailto:' + owner.email + '"">' + owner.email + '</a>');
                }
            });
            
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
            }
        });

        // new button
        $('#owner-new-button').click(function() {
            $('#owner-create-modal').modal('show');
        });

        // edit button
        $(document).on('click', '.owner-edit-button', function(){
            var selData = table.rows(".selected").data();
            var id = selData[0].id;

            $.ajax({
                url: '/clinics/{{$clinic->id}}/owners/' + id +'/get',
                type: 'get',
                // data: {userid: userid},
                success: function(owner){ 
                    // fill Modal with owner details                    
                    $('#owner-edit-firstname').val(owner.firstname)
                    $('#owner-edit-lastname').val(owner.lastname)
                    $('#owner-edit-address').val(owner.address)
                    $('#owner-edit-postcode').val(owner.postcode)
                    $('#owner-edit-city').val(owner.city)
                    $('#owner-edit-country_id').val(owner.country_id)
                    $('#owner-edit-ssn').val(owner.ssn)
                    $('#owner-edit-phone_primary').val(owner.phone_primary)
                    $('#owner-edit-phone_secondary').val(owner.phone_secondary)
                    $('#owner-edit-email').val(owner.email)

                    // Display Modal
                    $('#owner-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/owners/' + id);
                    $('#owner-edit-modal').modal('show');
                }
            });
        });


        // delete button
        $(document).on('click', '.owner-delete-button', function(){
            var row = table.rows(".selected").data();
            var id = row[0].id;
            $('#confirm-delete-modal-form').attr('action', '/clinics/{{$clinic->id}}/owners/' + id);
            $('#confirm-delete-modal').modal('show');
        });

        // visit button
        $(document).on('click', '.pet-visit-button', function(){
            var selData = table_pets.rows(".selected").data();
            if(selData.length > 0)
            {
                var pet_id = selData[0].id;
                location.href = "/clinics/{{ $clinic->id }}/visits/" + pet_id;
            }
        });

        $('#owner-overlay-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            $('#owner-overlay-modal-label').html( button.text() );
        });
    });



</script>
@endif
@endpush