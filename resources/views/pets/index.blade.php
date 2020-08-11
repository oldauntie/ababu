@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}
                    <button type="button" id="btnNew" class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <br>
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
                                        <th>{{__('translate.actions')}}</th>
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
@include('pets.modal.edit')
@include('pets.modal.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )

<link rel="stylesheet" type="text/css" href="{{url('/lib/DataTables-1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        var table = $('#pets').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: "{{ route('clinics.pets.list', [$clinic->id, 'datatable']) }}",
            columns: [
                {data: "id", name: "id", width: "1%"},
                {data: "name", name: "name", width: "150"},
                {data: "familiar_name", name: "familiar_name", width: "150"},
                {data: "firstname", name: "firstname", visible: false},
                {data: "lastname", name: "lastname", visible: false},
                {data: "owner", name: "owner",
                    render: function(data, type, row) {
                        return row.firstname + ' ' + row.lastname;
                    },                    
                },
                {data: "microchip", name: "microchip"},
                {data: "description", name: "description"},
                {data: "color", name: "color"},
                {data: "action", name: "action", width: "150px"},
            ],
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
        });


        // edit button
        $(document).on('click', '.pet-edit-button', function(){
            var selData = table.rows(".selected").data();
            var id = selData[0].id;

            $.ajax({
                url: '/clinics/{{$clinic->id}}/pets/' + id +'/get',
                type: 'get',
                success: function(pet){ 
                    // console.log(pet);
                    
                    // fill Modal with owner details                    
                    $('#pet-edit-name').val(pet.name);

                    $("#pet-edit-species_id").empty();
                    var speciesOption = new Option(pet.species.familiar_name, pet.species.species_id, false, false);
                    $('#pet-edit-species_id').append(speciesOption).trigger('change');

                    $("#pet-edit-owner_id").empty();
                    var ownerOption = new Option(pet.owner.firstname + ' ' + pet.owner.lastname, pet.owner_id, false, false);
                    $('#pet-edit-owner_id').append(ownerOption).trigger('change');
        
                    $('#pet-edit-sex').val(pet.sex)
                    $('#pet-edit-color').val(pet.color)
                    $('#pet-edit-description').val(pet.description)
                    $('#pet-edit-date_of_birth').val(pet.date_of_birth)

                    // Display Modal
                    $('#pet-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/owners/' + id);
                    $('#pet-edit-modal').modal('show');
                }
            });
        });
        
        // delete button
        $(document).on('click', '.pet-delete-button', function(){
            var row = table.rows(".selected").data();
            var id = row[0].id;
            $('#confirm-delete-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/' + id);
            $('#confirm-delete-modal').modal('show');
        });

    });


</script>
@endif
@endpush