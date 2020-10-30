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
                    {{ __('translate.age') }}: {{ $pet->age->years }} {{ __('translate.years') }},
                    {{ $pet->age->months }} {{ __('translate.months') }}, {{ $pet->age->days }}
                    {{ __('translate.days') }}
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
                        <div class="col-lg-4">
                            @include('examinations.index')
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            @include('notes.index')
                        </div>
                        <div class="col-lg-6">







                            <!-- Tab Headers -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home"
                                        aria-selected="true">{{__('translate.treatments')}} & {{__('translate.vaccinations')}}</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">{{__('translate.materials')}}</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                        href="#nav-contact" role="tab" aria-controls="nav-contact"
                                        aria-selected="false">{{__('translate.certificates')}}</a>
                                </div>
                            </nav>
                            <!-- Tab Content -->
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @include('treatments.index')
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">materials</div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">certificates</div>
                            </div>






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
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/js/bootstrap-datepicker.min.js')}}"
    charset="UTF-8"></script>
@if(auth()->user()->locale->id != 'en-US')
<script type="text/javascript"
    src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/locales/bootstrap-datepicker.' . auth()->user()->locale->short_code . '.min.js')}}"
    charset="UTF-8"></script>
@endif
<link rel="stylesheet" type="text/css"
    href="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />

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
        initExaminationsTable(e.problem_id);
    }

    // init Prescriptions Table
    function initPrescriptionsTable(problem_id){
        prescriptions_table.ajax.url( '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/prescriptions/list/' + problem_id + '/datatable' ).load();
    }

    // init Examinations Table
    function initExaminationsTable(problem_id){
        examinations_table.ajax.url( '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/list/' + problem_id + '/datatable' ).load();
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
                        return '<img src="{{url('/images/icons/in_evidence.png')}}">';
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
                    '<td>{{ __('translate.qty') }}:</td>'+
                    '<td>'+d.quantity+'</td>'+
                    '<td>{{ __('translate.dosage') }}:</td>'+
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
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.prescription_delete')}} </small>",
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
    
        // lock / unlock button
        $('#prescription-edit-button-lock').click(function(){
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
        $('#prescription-edit-date_of_prescription').val(prescription.date_of_prescription);
        $('#prescription-edit-quantity').val(prescription.quantity);
        $('#prescription-edit-dosage').val(prescription.dosage);

        $('#prescription-edit-in_evidence').prop("checked", !! + prescription.in_evidence);
        $('#prescription-edit-notes').val(prescription.notes);
        $('#prescription-edit-print_notes').prop("checked", !! + prescription.print_notes);
        $('#prescription-edit-created_at').html(prescription.created_at);
        $('#prescription-edit-updated_at').html(prescription.updated_at);

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



    /* *********************************************** *
    Examinations
    * ************************************************ */
    $(function() {
        // define main examinations table
        examinations_table = $('#examinations').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging:   false,
            ordering: false,
            info:     false,
            language : {
                zeroRecords: "{{__('translate.examinations_zero_records')}}"             
            },
            ajax: "{{ route('clinics.examinations.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
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
                {data: "term_name", name: "term_name", render: function(data, type, full, meta){
                    if(type === 'display'){
                        data = strtrunc(data, 19);
                    }
                    return data;
                }},
                {data: "in_evidence", name: "in_evidence", render: function(data){
                    if(data == 1){
                        return '<img src="{{url('/images/icons/in_evidence.png')}}">';
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
            return '<table cellpadding="5" cellspacing="0" border="0" width="100%" style="padding-left:50px;">'+
                '<tr>'+
                    '<td colspan="2">{{__('translate.examination_result')}}' + (d.result == null ? "":d.result) + '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>{{__('translate.is_pathologic')}}:</td>'+
                    '<td>'+d.is_pathologic+'</td>'
                '</tr>'+
            '</table>';
        }


        // Add event listener for opening and closing details
        $('#examinations tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = examinations_table.row( tr );

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


        $('#examinations tbody').on('click', 'tr.master-row', function() {
            if (!$(this).hasClass('selected')) {
                examinations_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        // examination table double click
        $('#examinations tbody').on('dblclick', 'tr.master-row', function(){
            var selData = examinations_table.rows(".selected").data();
            var id = selData[0].id;

            editExamination(id);
        });


        // Select2 medicine selection (search) 
        $("#diagnostic_test_id").select2({
            ajax: { 
                placeholder: "Choose a Diagnostic Test...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/diagnostic_tests/search/",
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

        $("#diagnostic_test_id").on("select2:select", function(e) { 
            var id = e.params.data.id;
            createExamination(id);
            // clear selection
            $('#diagnostic_test_id').val(null).trigger('change');
        });


        // delete button
        $(document).on('click', '#examination-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.examination')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.examination_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#examination-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/' + id);
                        $('#examination-edit-delete-form').submit();
                    }
                }
            });
        });


        // lock / unlock problem button on Examination modal form
        $('#examination-edit-button-lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#examination-edit-problem').prop('disabled');
            $('#examination-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#examination-edit-problem').on('change', function(){
            $('#examination-edit-problem_id').val($(this).val());
        });
    
    });

    // retrieve an empty examination and pass it to 
    function createExamination(diagnostic_test_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/create/' + diagnostic_test_id;

        // if selected, it add a problem_id to creation url
        if(problem_id > 0){
            create_url += '/' + problem_id
        }
        
        $.ajax({
            url: create_url,
            type: 'get',
            success: function(examination)
            {
                openExaminationEditModal(examination);
            }
        });
    }

    // retrieve a examination given an id
    function editExamination(id){
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/edit/' + id,
            type: 'get',
            success: function(examination)
            {
                openExaminationEditModal(examination);
            }
        });
    }

    // open examination form for edit
    function openExaminationEditModal(examination){
        examination = examination;

        $('#examination-edit-diagnostic_test_id').val(examination.diagnostic_test.id);
        $('#examination-edit-diagnostic_test').val(examination.diagnostic_test.term_name);
        $('#examination-edit-date_of_examination').val(examination.date_of_examination);
        $('#examination-edit-in_evidence').prop("checked", !! + examination.in_evidence);
        
        $('#examination-edit-problem').val(examination.problem_id);
        $('#examination-edit-problem_id').val(examination.problem_id);
        $('#examination-edit-is_pathologic').prop("checked", !! + examination.is_pathologic);
        $('#examination-edit-result').val(examination.result);
        $('#examination-edit-medical_report').val(examination.medical_report);
        
        $('#examination-edit-notes').val(examination.notes);
        $('#examination-edit-print_notes').prop("checked", !! + examination.print_notes);
        $('#examination-edit-created_at').html(examination.created_at);
        $('#examination-edit-updated_at').html(examination.updated_at);

        // Set action and method
        if(examination.id > 0)
        {
            $('#examination-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/examinations/' + examination.id);
            $('#examination-edit-modal-form input[name="_method"]').val('PUT');

            $('#examination-edit-delete-button').attr('disabled', false);
            $('#examination-edit-delete-button').val(examination.id);
            $('#examination-edit-print-button').attr('disabled', false);
        }else{
            $('#examination-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pet/{{$pet->id}}/examinations');
            $('#examination-edit-modal-form input[name="_method"]').val('POST');
            
            $('#examination-edit-delete-button').attr('disabled', true);
            $('#examination-edit-print-button').attr('disabled', true);
        }

        $('#examination-edit-modal').modal('show');
    }






    /* *********************************************** *
    Treatments
    * ************************************************ */

    $(function() {
        // define main treatmentss table
        treatments_table = $('#treatments').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging:   false,
            ordering: false,
            info:     false,
            language : {
                zeroRecords: "{{__('translate.treatments_zero_records')}}"             
            },
            ajax: "{{ route('clinics.treatments.list', [$clinic->id, $pet->id, 0, 'datatable']) }}",
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
                    var created_at = moment.utc(data);
                    return created_at.format( created_at.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
                }},
                {data: "term_name", name: "term_name", render: function(data, type, full, meta){
                    if(type === 'display'){
                        data = strtrunc(data, 19);
                    }
                    return data;
                }},
                {data: "recall_at", name: "recall_at", render: function(data){
                    if(data != null){
                        var recall_at = moment.utc(data);
                        return recall_at.format( recall_at.locale('{{auth()->user()->locale->short_code}}').localeData().longDateFormat('L') );
                    }else{
                        return "no recall set";
                    }
                }},
                {data: "notes", name: "noteds", visible: false},
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
            return '<table cellpadding="5" cellspacing="0" border="0" width="100%" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>{{__('translate.notes')}}:</td>'+
                    '<td>'+d.notes+'</td>'
                '</tr>'+
            '</table>';
        }


        // Add event listener for opening and closing details
        $('#treatments tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = treatments_table.row( tr );

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


        $('#treatments tbody').on('click', 'tr.master-row', function() {
            if (!$(this).hasClass('selected')) {
                treatments_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        // examination table double click
        $('#treatments tbody').on('dblclick', 'tr.master-row', function(){
            var selData = treatments_table.rows(".selected").data();
            var id = selData[0].id;

            editExamination(id);
        });


        // Select2 medicine selection (search) 
        $("#diagnostic_test_id").select2({
            ajax: { 
                placeholder: "Choose a Diagnostic Test...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/diagnostic_tests/search/",
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

        $("#diagnostic_test_id").on("select2:select", function(e) { 
            var id = e.params.data.id;
            createExamination(id);
            // clear selection
            $('#diagnostic_test_id').val(null).trigger('change');
        });


        // delete button
        $(document).on('click', '#examination-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.examination')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.examination_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#examination-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/examinations/' + id);
                        $('#examination-edit-delete-form').submit();
                    }
                }
            });
        });


        // lock / unlock problem button on Examination modal form
        $('#examination-edit-button-lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#examination-edit-problem').prop('disabled');
            $('#examination-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#examination-edit-problem').on('change', function(){
            $('#examination-edit-problem_id').val($(this).val());
        });
    
    });







</script>
@endpush