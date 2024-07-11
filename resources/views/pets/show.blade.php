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

                        <form class="row g-3 align-items-center mb-3">
                            <div class="col-9">
                                <div class="input-group">

                                    {{-- 
                                    <div class="input-group-text">{{ __('translate.filter_by') }}</div>
                                    
                                    <select class="form-control" id="problem-select21" name="problem" aria-label="problem"
                                    aria-describedby="basic-addon1">
                                    @foreach ($diagnoses as $problem)
                                    <option value="{{ $problem->id }}">{{ $problem->term_name }}
                                    </option>
                                    @endforeach
                                    </select>
                                    {{ dump($pet->problems) }}
                                    --}}

                                    <select class="form-control" id="problem-filter-by" name="problem" aria-label="problem"
                                        aria-describedby="basic-addon" multiple="multiple">
                                        @foreach ($pet->problems as $problem)
                                            <option value="{{ $problem->id }}">
                                                {{ $problem->diagnosis->term_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-3">
                                {{--
                                    <!-- button trigger for problem filtering collapsible -->
                                    <a class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" href="#"
                                    role="button">
                                    {{ __('translate.filter_by') }}
                                    </a>
                                --}}
                                <!-- button trigger show all problems collapsible -->
                                <a class="btn btn-sm btn-outline-dark" data-bs-toggle="collapse" href="#collapseProblems"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    {{ __('translate.expand') }}
                                </a>
                                <!-- button trigger problem modal -->
                                <a class="btn btn-sm btn-outline-success" href="#" role="button"
                                    data-bs-toggle="modal" data-bs-target="#newProblemModal">
                                    {{ __('translate.new') }}
                                </a>
                            </div>
                        </form>

                        <div class="col-12">
                            <!-- All Problems Collapsible -->
                            <div class="collapse" id="collapseProblems">
                                <div class="card card-body">
                                    <ol class="list-group">
                                        @foreach ($pet->problems as $problem)
                                            <div class="list-group-item">

                                                <div class="d-flex w-100 justify-content-between">
                                                    <div class="d-inline-block">
                                                        @if ($problem->key_problem == 1)
                                                            <img title="{{ __('translate.problem_key_problem') }}"
                                                                src="{{ url('/images/icons/problem_key_problem.png') }}">
                                                        @else
                                                            <img title="{{ __('translate.problem_key_problem_disabled') }}"
                                                                src="{{ url('/images/icons/problem_key_problem_disabled.png') }}">
                                                        @endif
                                                        <img
                                                            src="{{ url('/images/icons/problem_status_' . $problem->status_id . '.png') }}">
                                                        {{ $problem->diagnosis->term_name }}
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <small>
                                                            {{ __('translate.active_from') }}:
                                                            {{ $problem->created_at->format(auth()->user()->locale->date_short_format) }}
                                                        </small>
                                                        <small>
                                                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('clinics.owners.pets.problems.edit', [$clinic, $owner, $pet, $problem]) }}"
                                                                role="button">
                                                                {{ __('translate.edit') }}
                                                            </a>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div>
                                                    <small>
                                                        {{ $problem->description }}
                                                    </small>
                                                </div>
                                                <div>
                                                    <small>
                                                        {{ $problem->notes }}
                                                    </small>
                                                </div>

                                            </div>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            <!-- End Of All Problems Collapsible -->
                        </div>

                        <!-- Problem New Modal -->
                        @include('pets.visits.problems.create')
                        <!-- End Of Problem New Modal -->


                        <div class="row">
                            <div class="col-6">


                                <div class="card">
                                    <div class="card-header">
                                        {{ __('translate.prescriptions') }}
                                    </div>
                                    <div class="card-body">
                                        @if ($pet->prescriptions != null)
                                        @else
                                            {{ __('translate.prescriptions_zero_records') }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('translate.examinations') }}
                                    </div>
                                    <div class="card-body">
                                        @if ($pet->examinations != null)
                                        @else
                                            {{ __('translate.prescriptions_zero_records') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">

                                <nav>
                                    <div class="nav nav-tabs" id="visit-tab" role="tablist">
                                        <button class="nav-link active" id="nav-notes-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-notes" type="button" role="tab"
                                            aria-controls="nav-notes"
                                            aria-selected="false">{{ __('translate.notes') }}</button>
                                        <button class="nav-link" id="nav-medical-history-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-medical-history" type="button" role="tab"
                                            aria-controls="nav-medical-history"
                                            aria-selected="true">{{ __('translate.medical_history') }}</button>
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
                                    <div class="tab-pane fade active show" id="nav-notes" role="tabpanel"
                                        aria-labelledby="nav-visit-tab" tabindex="0">
                                        @include('pets.visits.notes.index')
                                    </div>
                                    <div class="tab-pane fade" id="nav-medical-history" role="tabpanel"
                                        aria-labelledby="nav-medical-history-tab" tabindex="0">
                                        @include('pets.visits.medical_history')
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
            // set the active tab baseed on session variable set server-side
            @if (session('set_active_tab'))
                $('#nav-{{ session('set_active_tab') }}-tab').trigger('click');
            @endif

            // $('#problem-select2').select2();
            $("#problem-filter-by").select2({
                tags: true,
                placeholder: "{{ __('translate.problem_filter_by') }}",
                tokenSeparators: [',']
            })
        });
    </script>
@endsection
