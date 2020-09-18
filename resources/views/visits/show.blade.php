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
                        <div class="col-lg-4" style="border: thin solid red;">
                            @include('prescriptions.index')
                        </div>
                        <div class="col-lg-4" style="border: thin solid red;">
                            3
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
</script>
@endpush