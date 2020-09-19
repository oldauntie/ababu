<!-- style -->
<style>
    #examinations tbody tr.selected {
        color: white;
        background-color: lightseagreen;
    }

    #examinations td {
        border-left: none;
        border-right: none;
    }

    #prescriptions tbody tr.selected {
        color: white;
        background-color: lightseagreen;
    }

    #prescriptions td {
        border-left: none;
        border-right: none;
    }

    td.details-control {
        background: url('{{url('/images/icons/add.png')}}') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('{{url('/images/icons/delete.png')}}') no-repeat center center;
    }
</style>

@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- card -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <b>{{ $pet->name }}</b> ({{ $pet->species->familiar_name }}) {{ $pet->sex }} -
                    {{ __('translate.age') }}: {{ $pet->age->years }} {{ __('translate.years') }}, {{ $pet->age->months }} {{ __('translate.months') }}, {{ $pet->age->days }} {{ __('translate.days') }}
                    <button type="button" id="testme" class="btn btn-sm btn-primary">test me</button>
                    <br>
                    <small>Owner: {{ $pet->owner->fullname }}:
                        <a href="#" id="owner-details-phone" data-toggle="modal"
                            data-target="#owner-overlay-modal">{{ $pet->owner->phone }}</a>
                        <a href="#" id="owner-details-phone" data-toggle="modal"
                            data-target="#owner-overlay-modal">{{ $pet->owner->mobile }}</a>
                        <a href="mailto:{{ $pet->owner->email }}">{{ $pet->owner->email }}</a>
                    </small>
                </div>

                <!-- card body -->
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

                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            @include('problems.index')
                        </div>
                        <div class="col-lg-4">
                            @include('prescriptions.index')
                        </div>
                        <div class="col-lg-4" style="border: thin solid red;">
                            @include('examinations.index')
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6" style="border: thin solid red;">
                            <button id="ok" name="ok" class="ok">ok</button>
                            5
                        </div>
                        <div class="col-lg-6" style="border: thin solid red;">
                            6
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasAnyRolesByClinicId(['admin', 'veterinarian'], $clinic->id) )
@include('owners.modal.overlay')
@endif

@endsection

@push('scripts')
<!-- Select2 -->
<script type="text/javascript" src="{{url('/lib/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2-4.1.0-beta.1/dist/css/select2.min.css')}}" />

<!-- DataTable -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/DataTables-1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>

<!-- DatePicker -->
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/js/bootstrap-datepicker.min.js')}}" charset="UTF-8"></script>
@if(auth()->user()->locale->id != 'en-US')
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/locales/bootstrap-datepicker.' . auth()->user()->locale->short_code . '.min.js')}}" charset="UTF-8"></script>
@endif
<link rel="stylesheet" type="text/css" href="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox-v5.4.0/bootbox.min.js')}}"></script>

<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment-v2.27.0/moment-with-locales.js')}}"></script>

<!-- animate.css -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/animate.css/4.1.0/animate.compat.css')}}" />

<script type="text/javascript">
    var problem_id = 0;
    var diagnosis_id = 0;
    var prescription = {};

    $(function() {
        // owner mobile & phone number overlay
        $('#owner-overlay-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            $('#owner-overlay-modal-label').html( button.text() );
        });

        /*
        $('.ok').on('click', function(e){
            alert(problem_id);
            alert(diagnosis_id);
        });
        */
    });

    $(document).on('click', '#testme', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: "This is an alert with additional classes!",
            className: 'rubberBand animated',
            callback: function(result) {
                if (result) {
                    alert('click');
                    $('#student_delete_form').submit();
                }
            }
        });
    });

    // add event listener
    $(document).on("change_problem", changeProblem);

    // change_problem event handler
    function changeProblem(e) {
        problem_id = e.problem_id;
        initPrescriptionsTable(e.problem_id);
    }

    // init Prescriptions Table
    function initPrescriptionsTable(problem_id){
        prescriptions_table.ajax.url( '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/list/' + problem_id + '/datatable' ).load();
    }



    /* *********************************************** *
    Prescription
    * ************************************************ */


    $(function() {
        // define main prescriptions table
        prescriptions_table = $('#prescriptions').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging:   false,
            ordering: false,
            info:     false,
            language : {
                zeroRecords: "{{__('translate.prescriptions_zero_records')}}"             
            },
            ajax: "{{ route('clinics.prescriptions.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
            rowCallback: function (row, data) {
                $(row).addClass('master-row');
            },
            columns: [
                {
                    className: "details-control",
                    orderable:      false,
                    data:           null,
                    defaultContent: ""
                },
                {data: "id", name: "id", visible: false},
                {data: "created_at", name: "created_at", render: function(data){
                    var updated = moment.utc(data);
                    return updated.format( updated.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
                }},
                {data: "name", name: "name", render: function(data, type, full, meta){
                    if(type === 'display'){
                        data = strtrunc(data, 19);
                    }
                    return data;
                }},
                {data: "quantity", name: "quantity", visible: false},
                {data: "dosage", name: "dosage", visible: false},
                {data: "in_evidence", name: "in_evidence", render: function(data){
                    if(data == 1){
                        return '<img src="{{url('/images/icons/prescription_in_evidence.png')}}">';
                    }else{
                        return "";
                    }
                }}
            ],
        });

        // used to create datatable teaser
        function strtrunc(str, max, add){
            add = add || '...';
            return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
        };


        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td colspan="4">' + d.name + '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>q.ty:</td>'+
                    '<td>'+d.quantity+'</td>'+
                    '<td>dosage:</td>'+
                    '<td>'+d.dosage+'</td>'+
                '</tr>'+
            '</table>';
        }


        // Add event listener for opening and closing details
        $('#prescriptions tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = prescriptions_table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );


        $('#prescriptions tbody').on('click', 'tr.master-row', function() {
            if (!$(this).hasClass('selected')) {
                prescriptions_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        // prescription table double click
        $('#prescriptions tbody').on('dblclick', 'tr.master-row', function(){
            var selData = prescriptions_table.rows(".selected").data();
            var id = selData[0].id;

            editPrescription(id);
        });


        // Select2 medicine selection (search) 
        $("#medicine_id").select2({
            ajax: { 
                placeholder: "Choose a medicine...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/medicines/search/",
                dataType: "json",
                dropdownAutoWidth : true,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $("#medicine_id").on("select2:select", function(e) { 
            var id = e.params.data.id;
            createPrescription(id);
            // clear selection
            $('#medicine_id').val(null).trigger('change');
        });


        // delete button
        $(document).on('click', '#prescription-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.prescription')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.pet_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#prescription-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/' + id);
                        $('#prescription-edit-delete-form').submit();
                    }
                }
            });
        });
    
    });

    // retrieve an empty prescription and pass it to 
    function createPrescription(medicine_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/create/' + medicine_id;

        // if selected, it add a problem_id to creation url
        if(problem_id > 0){
            create_url += '/' + problem_id
        }
        
        $.ajax({
            url: create_url,
            type: 'get',
            success: function(prescription)
            {
                openPrescriptionEditModal(prescription);
            }
        });
    }

    // retrieve a prescription given an id
    function editPrescription(id){
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/edit/' + id,
            type: 'get',
            success: function(prescription)
            {
                openPrescriptionEditModal(prescription);
            }
        });
    }

    // open prescription form for edit
    function openPrescriptionEditModal(prescription){
        prescription = prescription;
        $('#prescription-edit-prescription_id').val(prescription.id);
        $('#prescription-edit-medicine_id').val(prescription.medicine.id);
        $('#prescription-edit-problem').val(prescription.problem_id);
        $('#prescription-edit-problem_id').val(prescription.problem_id);
        $('#prescription-edit-medicine').val(prescription.medicine.name);
        $('#prescription-edit-date_of_prescription').val(prescription.created_at);
        $('#prescription-edit-quantity').val(prescription.quantity);
        $('#prescription-edit-dosage').val(prescription.dosage);

        $('#prescription-edit-in_evidence').prop("checked", !! + prescription.in_evidence);
        $('#prescription-edit-notes').val(prescription.notes);
        $('#prescription-edit-print_notes').prop("checked", !! + prescription.print_notes);

        // Set action and method
        if(prescription.id > 0)
        {
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions/' + prescription.id);
            $('#prescription-edit-modal-form input[name="_method"]').val('PUT');

            $('#prescription-edit-delete-button').attr('disabled', false);
            $('#prescription-edit-delete-button').val(prescription.id);
            $('#prescription-edit-print-button').attr('disabled', false);
        }else{
            $('#prescription-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/prescriptions');
            $('#prescription-edit-modal-form input[name="_method"]').val('POST');
            
            $('#prescription-edit-delete-button').attr('disabled', true);
            $('#prescription-edit-print-button').attr('disabled', true);
        }

        $('#prescription-edit-modal').modal('show');
    }

    $(document).ready(function(){
        // lock / unlock button
        $('#lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#prescription-edit-problem').prop('disabled');
            $('#prescription-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#prescription-edit-problem').on('change', function(){
            $('#prescription-edit-problem_id').val($(this).val());
        });
    });



    /* *********************************************** *
    Examinations
    * ************************************************ */

</script>
@endpush