@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ $pet->name }} -
                            {{ $pet->species->familiar_name }}{{ empty($pet->breed) ? '' : ' (' . $pet->breed . ')' }}
                            {{ __('translate.age') }} {{ $pet->age->years }}Y {{ $pet->age->months }}m
                            {{ $pet->age->days }}d
                            <br>
                            <small> small </small>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('clinics.owners.pets.edit', [$clinic, $owner, $pet]) }}"
                                class="btn btn-sm btn-outline-primary">{{ __('translate.edit') }}</a>
                            <a class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#pet_delete_confirmation">{{ __('translate.delete') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        <div class="row">
                            <div class="col-12">

                                <nav>
                                    <div class="nav nav-tabs" id="visit-tab" role="tablist">


                                        <button class="nav-link active" id="nav-medical-history-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-medical-history" type="button" role="tab"
                                            aria-controls="nav-medical-history"
                                            aria-selected="true">{{ __('translate.medical_history') }}</button>
                                        <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-notes" type="button" role="tab"
                                            aria-controls="nav-notes" aria-selected="false">{{ __('translate.notes') }}</button>
                                        <button class="nav-link" id="nav-biometrics-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-biometrics" type="button" role="tab"
                                            aria-controls="nav-biometrics" aria-selected="false">Biometrics</button>
                                        <button class="nav-link" id="nav-vaccinations-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-vaccinations" type="button" role="tab"
                                            aria-controls="nav-vaccinations" aria-selected="false">Vaccinations</button>
                                        <button class="nav-link" id="nav-attachments-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-attachments" type="button" role="tab"
                                            aria-controls="nav-attachments" aria-selected="false">Attachments</button>

                                        <button class="nav-link" id="nav-materials-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-materials" type="button" role="tab"
                                            aria-controls="nav-materials" aria-selected="false">Materials</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="visit-tabContent">


                                    <div class="tab-pane fade active show" id="nav-medical-history" role="tabpanel"
                                        aria-labelledby="nav-medical-history-tab" tabindex="0">

                                        @include('pets.visits.medical_history')

                                    </div>

                                    <div class="tab-pane fade" id="nav-notes" role="tabpanel"
                                        aria-labelledby="nav-visit-tab" tabindex="0">

                                        @include('pets.visits.notes.index')

                                    </div>
                                    <div class="tab-pane fade" id="nav-biometrics" role="tabpanel"
                                        aria-labelledby="nav-biometrics-tab" tabindex="0">

                                        @include('pets.visits.biometrics')

                                    </div>
                                    <div class="tab-pane fade" id="nav-vaccinations" role="tabpanel"
                                        aria-labelledby="nav-vaccinations-tab" tabindex="0">

                                        @include('pets.visits.vaccinations')

                                    </div>
                                    <div class="tab-pane fade" id="nav-attachments" role="tabpanel"
                                        aria-labelledby="nav-attachments-tab" tabindex="0">

                                        @include('pets.visits.attachments')

                                    </div>

                                    <div class="tab-pane fade" id="nav-materials" role="tabpanel"
                                        aria-labelledby="nav-materials-tab" tabindex="0">

                                        @include('pets.visits.materials')

                                    </div>
                                </div>


                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.delete', [
        'id' => 'pet_delete_confirmation',
        'action' => route('clinics.owners.pets.destroy', [$clinic, $owner, $pet]),
        'title' => __('message.are_you_sure'),
        'body' => __('message.confirm_record_deletion') . " {$pet->name} ({$pet->species->familiar_name})",
    ])


    <script type="module">
        $(function() {
            @if(session('set_active_tab'))
                $('#nav-{{session('set_active_tab')}}-tab').trigger('click');
            @endif


            $("#btn_test").click(function() {
                $('#nav-biometrics-tab').trigger('click');
            });
        });
    </script>
@endsection
