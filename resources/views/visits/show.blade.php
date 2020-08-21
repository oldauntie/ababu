@extends('layouts.app')

@section('content')

<div class="container">
    <!-- card -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    {{__('translate.pet')}} {{ $pet->name }} ({{ $pet->species->familiar_name }}) {{$pet->sex}} -
                    {{ __('translate.age') }}: {{ $pet->age }} {{ __('translate.years') }}
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
                        <div class="col-lg-4" style="border: thin solid red;">
                            @include('problems.index')
                        </div>
                        <div class="col-lg-4" style="border: thin solid red;">
                            2
                        </div>
                        <div class="col-lg-4" style="border: thin solid red;">
                            3
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6" style="border: thin solid red;">
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
<!-- DataTable -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/DataTables-1.10.21/css/jquery.dataTables.min.css')}}" />
<script type="text/javascript" src="{{url('/lib/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox-v5.4.0/bootbox.min.js')}}"></script>

<!-- animate.css -->
<link rel="stylesheet" type="text/css" href="{{url('/lib/animate.css/4.1.0/animate.compat.css')}}" />

<script type="text/javascript">
    var problem_id;
    var diagnosis_id;
    $(function() {
        // owner overlay
        $('#owner-overlay-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            $('#owner-overlay-modal-label').html( button.text() );
        });

        $('.ok').on('click', function(e){
            // alert($("#problems tr.selected td:first").html());
            alert(problem_id);
            alert(diagnosis_id);
        });
        
    })
    
    
    $(document).on('click', '#testme', function(e){
        // alert('click 2');
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
</script>
@endpush