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
                    <br />
                    <small>{{ __('translate.owner') }}: {{ $pet->owner->fullname }}:
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
                                        aria-selected="true">{{__('translate.treatments')}} &
                                        {{__('translate.vaccinations')}}</a>
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
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
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
@include('owners.partials.overlay')
@endif

@endsection

@push('scripts')
<!-- Select2 -->
<script type="text/javascript" src="{{url('/lib/select2/4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2/4.1.0-beta.1/dist/css/select2.min.css')}}" />

<!-- DataTable -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/datatables/1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/datatables/1.10.21/js/jquery.dataTables.min.js')}}"></script>

<!-- DatePicker -->
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker/1.9.0/dist/js/bootstrap-datepicker.min.js')}}"
    charset="UTF-8"></script>
@if(auth()->user()->locale->id != 'en-US')
<script type="text/javascript"
    src="{{url('/lib/bootstrap-datepicker/1.9.0/dist/locales/bootstrap-datepicker.' . auth()->user()->locale->short_code . '.min.js')}}"
    charset="UTF-8"></script>
@endif
<link rel="stylesheet" type="text/css"
    href="{{url('/lib/bootstrap-datepicker/1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox/5.4.0/bootbox.min.js')}}"></script>

<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment/2.27.0/moment-with-locales.js')}}"></script>

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

</script>
@endpush