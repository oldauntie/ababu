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
                            <small> small... smaller </small>
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

                                    <select class="form-control" id="problem-filter-by" name="problem" aria-label="problem"
                                        aria-describedby="basic-addon">
                                        <option value="0"> -- {{ __('translate.problem_indipendent') }} -- </option>
                                        @foreach ($pet->problems as $problem)
                                            <option value="{{ $problem->id }}">
                                                {{ $problem->diagnosis->term_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-3">
                                <!-- button trigger show all problems collapsible -->
                                <a class="btn btn-sm btn-outline-dark" data-bs-toggle="collapse" href="#collapseProblems"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    {{ __('translate.expand') }}
                                </a>
                                <!-- End OF button trigger show all problems collapsible -->
                                <!-- button trigger problem modal -->
                                <a class="btn btn-sm btn-outline-success" href="#" role="button"
                                    data-bs-toggle="modal" data-bs-target="#newProblemModal">
                                    {{ __('translate.new') }}
                                </a>
                                <!-- End Of button trigger problem modal -->
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
                                                        <span
                                                            style="height: 12px; width: 12px; background-color: {{ $problem->color }}; border-radius: 50%; display: inline-block;">
                                                        </span>
                                                        {{ $problem->diagnosis->term_name }}
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <small>
                                                            {{ __('translate.active_from') }}:
                                                            {{ $problem->active_from->format(auth()->user()->locale->date_short_format) }}
                                                            {{ $problem->active_from->format(auth()->user()->locale->time_short_format) }}
                                                        </small>
                                                        <small>
                                                            <a class="btn btn-sm btn-outline-secondary" href="#"
                                                                role="button" data-bs-toggle="modal"
                                                                data-bs-target="#editProblemModal-{{ $problem->id }}">
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




                        <div class="row">
                            <div class="col-6">

                                <!-- Prescriptions Card & Table -->
                                <div class="card h-auto" style="max-height: 370px;">
                                    <div class="card-header">
                                        <div class="float-start">
                                            {{ __('translate.prescriptions') }}
                                        </div>
                                        <div class="float-end">
                                            <a class="btn btn-sm btn-outline-success" href="#" role="button"
                                                data-bs-toggle="modal" data-bs-target="#prescriptions-create-modal">
                                                {{ __('translate.new') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body overflow-y-auto">
                                        @if ($pet->prescriptions != null)
                                            <table class="table table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>{{ __('translate.date') }}</th>
                                                        <th>{{ __('translate.medicine') }}</th>
                                                        <th>{{ __('translate.problem') }}</th>
                                                        <th>{{ __('translate.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pet->prescriptions->sortBy([['prescription_date', 'desc']]) as $prescription)
                                                        <tr>
                                                            <td>{{ $prescription->prescription_date->format(auth()->user()->locale->date_short_format) }}
                                                            </td>
                                                            <td>{{ Str::limit($prescription->medicine->name, 12, ' [...]') }}
                                                            </td>
                                                            <td>{{ Str::limit($prescription->problem->diagnosis->term_name ?? '', 12, ' [...]') }}
                                                            </td>
                                                            <td class="">
                                                                <a href="{{ route('clinics.owners.pets.prescriptions.show', [$clinic, $owner, $pet, $prescription]) }}"
                                                                    class="btn btn-sm btn-outline-dark"><i
                                                                        class="bi-file"></i></a>
                                                                <a class="btn btn-sm btn-outline-primary" href="#"
                                                                    role="button" data-bs-toggle="modal"
                                                                    data-bs-target="#prescriptions-edit-modal"
                                                                    data-id="{{ $prescription->id }}">
                                                                    <i class="bi-pencil"></i>
                                                                </a>
                                                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('clinics.prescriptions.print', [$clinic, $prescription]) }}"
                                                                    role="button">
                                                                    <i class="bi-printer"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            {{ __('translate.prescriptions_zero_records') }}
                                        @endif
                                    </div>
                                </div>
                                <!-- End Of Prescriptions Card & Table -->

                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-start">
                                            {{ __('translate.examinations') }}
                                        </div>
                                        <div class="float-end">
                                            <a class="btn btn-sm btn-outline-success" href="#" role="button"
                                                data-bs-toggle="modal" data-bs-target="#examinations-create-modal">
                                                {{ __('translate.new') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($pet->examinations != null)
                                            <table class="table table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>{{ __('translate.date') }}</th>
                                                        <th>{{ __('translate.examination') }}</th>
                                                        <th>{{ __('translate.problem') }}</th>
                                                        <th>{{ __('translate.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pet->examinations->sortBy([['examination_date', 'desc']]) as $examination)
                                                        <tr>
                                                            <td>{{ $examination->examination_date->format(auth()->user()->locale->date_short_format) }}
                                                            </td>
                                                            <td>{{ Str::limit($examination->diagnostic_test->term_name, 12, ' [...]') }}
                                                            </td>
                                                            <td>{{ Str::limit($examination->problem->diagnosis->term_name ?? '', 12, ' [...]') }}
                                                            </td>
                                                            <td class="">
                                                                <a href="{{ route('clinics.owners.pets.examinations.show', [$clinic, $owner, $pet, $examination]) }}"
                                                                    class="btn btn-sm btn-outline-dark"><i
                                                                        class="bi-file"></i></a>
                                                                <a class="btn btn-sm btn-outline-primary" href="#"
                                                                    role="button" data-bs-toggle="modal"
                                                                    data-bs-target="#examinations-edit-modal"
                                                                    data-id="{{ $examination->id }}">
                                                                    <i class="bi-pencil"></i>
                                                                </a>
                                                                <a class="btn btn-sm btn-outline-secondary" href="#"
                                                                    role="button">
                                                                    <i class="bi-printer"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            {{ __('translate.examinations_zero_records') }}
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
                                            aria-controls="nav-biometrics"
                                            aria-selected="false">{{ __('translate.biometrics') }}</button>
                                        <button class="nav-link" id="nav-vaccinations-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-vaccinations" type="button" role="tab"
                                            aria-controls="nav-vaccinations"
                                            aria-selected="false">{{ __('translate.vaccinations') }}</button>
                                        <button class="nav-link" id="nav-attachments-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-attachments" type="button" role="tab"
                                            aria-controls="nav-attachments"
                                            aria-selected="false">{{ __('translate.attachments') }}</button>
                                        <button class="nav-link" id="nav-materials-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-materials" type="button" role="tab"
                                            aria-controls="nav-materials"
                                            aria-selected="false">{{ __('translate.materials') }}</button>
                                    </div>
                                </nav>

                                <div class="tab-content" id="visit-tabContent">
                                    <div class="tab-pane fade active show" id="nav-notes" role="tabpanel"
                                        aria-labelledby="nav-visit-tab" tabindex="0">
                                        @include('visits.notes.index')
                                    </div>
                                    <div class="tab-pane fade" id="nav-medical-history" role="tabpanel"
                                        aria-labelledby="nav-medical-history-tab" tabindex="0">
                                        @include('visits.medical_history')
                                    </div>

                                    <div class="tab-pane fade" id="nav-biometrics" role="tabpanel"
                                        aria-labelledby="nav-biometrics-tab" tabindex="0">
                                        @include('visits.biometrics.index')
                                    </div>
                                    <div class="tab-pane fade" id="nav-vaccinations" role="tabpanel"
                                        aria-labelledby="nav-vaccinations-tab" tabindex="0">
                                        @include('visits.vaccinations.index')
                                    </div>
                                    <div class="tab-pane fade" id="nav-attachments" role="tabpanel"
                                        aria-labelledby="nav-attachments-tab" tabindex="0">
                                        @include('visits.attachments')
                                    </div>

                                    <div class="tab-pane fade" id="nav-materials" role="tabpanel"
                                        aria-labelledby="nav-materials-tab" tabindex="0">
                                        @include('visits.materials')
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Biometric Create Modal -->
    @include('visits.biometrics.create')
    <!-- End Of Biometric Create Modal -->

    <!-- Biometric Edit Modal -->
    @foreach ($pet->biometrics as $biometric)
        @include('visits.biometrics.edit', ['biometric' => $biometric])
    @endforeach
    <!-- End Of Biometric Edit Modal -->

    <!-- Problem Create Modal -->
    @include('visits.problems.create')
    <!-- End Of Problem Create Modal -->

    <!-- Problem Edit Modal -->
    @foreach ($pet->problems as $problem)
        @include('visits.problems.edit', ['problem' => $problem])
    @endforeach
    <!-- End Of Problem Edit Modal -->

    <!-- Prescriptions New Modal -->
    @include('visits.prescriptions.create')
    <!-- End Of Prescription New Modal -->

    <!-- Prescriptions Edit Modal -->
    @include('visits.prescriptions.edit')
    <!-- End Of Prescription Edit Modal -->

    <!-- Examinations New Modal -->
    @include('visits.examinations.create')
    <!-- End Of Prescription New Modal -->

    <!-- Prescriptions Edit Modal -->
    @include('visits.examinations.edit')
    <!-- End Of Prescription Edit Modal -->

    <!-- Note Create Modal -->
    @include('visits.notes.create')
    <!-- End Of Note Create Modal -->

    <!-- Note Edit Modal -->
    @foreach ($pet->notes as $note)
        @include('visits.notes.edit', ['note' => $note])
    @endforeach
    <!-- End Of Note Edit Modal -->

    <!-- Vaccination Create Modal -->
    @include('visits.vaccinations.create')
    <!-- End Of Vaccination Create Modal -->

    <!-- Vaccination Edit Modal -->
    @foreach ($pet->vaccinations as $vaccination)
        @include('visits.vaccinations.edit', ['vaccination' => $vaccination])
    @endforeach
    <!-- End Of Vaccination Edit Modal -->

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

            $("#problem-filter-by").select2({
                tags: true,
                placeholder: "{{ __('translate.problem_filter_by') }}",
                tokenSeparators: [',']
            })
        });
    </script>
@endsection
