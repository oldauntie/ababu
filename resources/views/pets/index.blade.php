@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}
                    <button type="button" id="pet-create-button"
                        class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <br>

                    <small>{{ __('help.pets_description') }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- open modal if errors -->
                    @if ($errors->any())
                    @if($errors->has('pet_id'))
                    <script>
                        $(function() {
                            openPetEditModal( {{$errors->first('pet_id')}} )
                        })
                    </script>
                    @else
                    <script>
                        $(function() {
                            $( "#pet-create-button" ).trigger( "click" );
                        })
                    </script>
                    @endif
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
                                        <th>{{__('translate.updated_at')}}</th>
                                        <th>{{__('translate.actions')}}</th>
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
    </div>
</div>

@include('pets.partials.delete')
@include('pets.partials.edit')
@include('pets.partials.create')
@include('pets.partials.confirm-delete')

@endsection

@push('scripts')
<!-- DataTable -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/datatables/1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/datatables/1.10.21/js/jquery.dataTables.min.js')}}"></script>

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox/5.4.0/bootbox.min.js')}}"></script>

<!-- animate.css -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/animate.css/4.1.0/animate.compat.css')}}" />

<script type="text/javascript">
    $(function() {
        // load Pet main datatable
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
                {data: "updated_at", name: "updated_at", render:function(data){
                    var updated = moment.utc(data);
                    return updated.format( updated.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('LLL') );
                }},
                {data: "action", name: "action", width: "150px"},
            ],
        });

        // set color on selected row
        $('#pets tbody').on('click', 'tr', function() {
            if (!$(this).hasClass('selected')) {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        // visit button
        $(document).on('click', '.pet-visit-button', function(){
            var selData = table.rows(".selected").data();
            var id = selData[0].id;

            location.href = "/clinics/{{$clinic->id}}/visits/" + id;
        });

        // edit button
        $(document).on('click', '.pet-edit-button', function(){
            var selData = table.rows(".selected").data();
            var id = selData[0].id;

            openPetEditModal(id);
        });
        
        // delete button
        $(document).on('click', '.pet-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.pet')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.pet_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        var row = table.rows(".selected").data();
                        var id = row[0].id;
                        $('#pet-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/' + id);
                        
                        $('#pet-edit-delete-form').submit();
                    }
                }
            });
        });
        
        // create button
        $(document).on('click', '#pet-create-button', function(){
            $('#pet-create-modal').modal('show');
        });
    });

    // open modal form for edit purpose
    function openPetEditModal(id)
    {
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/' + id +'/get',
            type: 'get',
            success: function(pet){ 
                // fill Modal with pet details                    
                $('#pet-edit-breed').val(pet.breed);
                $('#pet-edit-name').val(pet.name);

                $("#pet-edit-species_id").empty();
                var speciesOption = new Option(pet.species.familiar_name, pet.species.id, false, false);
                $('#pet-edit-species_id').append(speciesOption).trigger('change');

                $("#pet-edit-owner_id").empty();
                var ownerOption = new Option(pet.owner.firstname + ' ' + pet.owner.lastname, pet.owner_id, false, false);
                $('#pet-edit-owner_id').append(ownerOption).trigger('change');
    
                $('#pet-edit-sex').val(pet.sex)
                $('#pet-edit-color').val(pet.color)
                $('#pet-edit-description').val(pet.description)

                $('#pet-edit-date_of_birth').val(pet.date_of_birth)
                $('#pet-edit-date_of_birth').datepicker('update');

                $('#pet-edit-date_of_death').val(pet.date_of_death);
                $('#pet-edit-date_of_death').datepicker('update');

                $('#pet-edit-microchip').val(pet.microchip)
                $('#pet-edit-microchip_location').val(pet.microchip_location)
                $('#pet-edit-tatuatge').val(pet.tatuatge)
                $('#pet-edit-tatuatge_location').val(pet.tatuatge_location)

                $('#pet-edit-created_at').html(pet.created_at)
                $('#pet-edit-updated_at').html(pet.updated_at)

                setAge('edit');
                
                // Display Modal
                $('#pet-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/' + id);
                $('#pet-edit-modal').modal('show');
            }
        });
    }

    function setAge(operation)
    {
        var a = moment().locale('{{auth()->user()->locale->short_code}}');
        var b = moment().locale('{{auth()->user()->locale->short_code}}');

        if( $('#pet-' + operation + '-date_of_death').val() != ''){
            a = moment($('#pet-' + operation + '-date_of_death').val(), a.localeData().longDateFormat('L'));
        }
        b = moment($('#pet-' + operation + '-date_of_birth').val(), b.localeData().longDateFormat('L'));

        var years = a.diff(b, 'year');
        b.add(years, 'years');

        var months = a.diff(b, 'months');
        b.add(months, 'months');

        var days = a.diff(b, 'days');

        // console.log(years + ' years ' + months + ' months ' + days + ' days');

        if(years >= 0 && months >= 0 && days >= 0 ){
            $('#pet-' + operation + '-age-years').val(years);
            $('#pet-' + operation + '-age-months').val(months);
            $('#pet-' + operation + '-age-days').val(days);
        } else {
            // show an alert
            bootbox.alert("{{ __('message.pet_date_of_death_warning') }}", function() {
                // console.log("Alert Callback when OK is pressed");
            });

            // empty age inputs
            $('#pet-' + operation + '-age-years').val('');
            $('#pet-' + operation + '-age-months').val('');
            $('#pet-' + operation + '-age-days').val('');

            // empty datepicker
            $('#pet-' + operation + '-date_of_death').val('')
            $('#pet-' + operation + '-date_of_death').datepicker('update');
        }
    }
</script>
@endpush