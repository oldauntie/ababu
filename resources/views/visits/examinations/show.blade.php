@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.examination_show') }}
                            <br>
                            <small>
                                {{ $examination->diagnostic_test->term_name }}
                            </small>
                        </div>
                        <div class="float-end">
                            {{ session()->flash('set_active_tab', 'notes') }}
                            <a href="{{ url()->previous() }}"
                                class="btn btn-sm btn-outline-secondary">{{ __('translate.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">


                        <div class="card">
                            <div class="card-header">
                                {{ __('translate.examination') }} {{ $examination->diagnostic_test->term_name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.examination') }}:
                                        {{ $examination->diagnostic_test->term_name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.problem') }}:
                                        {{ $examination->problem->diagnosis->term_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date') }}: {{ $examination->examination_date }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">{{ __('translate.result') }}:
                                        {{ $examination->result }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.medical_report') }}:
                                        {{ $examination->medical_report }}</div>
                                </div>

                                <div class="row">
                                    <div class="col">{{ __('translate.notes') }}: {{ $examination->notes }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.print_notes') }}:
                                        [{{ $examination->print_notes ? 'x' : '  ' }}]</div>
                                    <div class="col">{{ __('translate.in_evidence') }}:
                                        [{{ $examination->in_evidence ? 'x' : '  ' }}]</div>
                                    <div class="col">{{ __('translate.is_pathologic') }}:
                                        [{{ $examination->is_pathologic ? 'x' : '  ' }}]</div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ __('translate.pet') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.name') }}: {{ $examination->pet->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.age') }}: {{ $examination->pet->age->years }}Y
                                        {{ $examination->pet->age->months }}m
                                        {{ $examination->pet->age->days }}d</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.breed') }}: {{ $examination->pet->breed }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.sex') }}: {{ $examination->pet->sex }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date_of_birth') }}:
                                        {{ $examination->pet->date_of_birth->format(auth()->user()->locale->date_short_format) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date_of_death') }}:
                                        {{ !is_null($examination->pet->date_of_death) ? $examination->pet->date_of_death->format(auth()->user()->locale->date_short_format) : '' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ __('translate.owner') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.name') }}:
                                        {{ $examination->pet->owner->lastname . ', ' . $examination->pet->owner->firstname }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.address') }}:
                                        {{ $examination->pet->owner->address . ', ' . $examination->pet->owner->postcode . ', ' . $examination->pet->owner->city }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.ssn') }}: {{ $examination->pet->owner->ssn }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}:
                                        {{ $examination->pet->owner->phone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}:
                                        <a href="mailto:{{ $examination->pet->owner->email }}">{{ $examination->pet->owner->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ __('translate.clinic') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.name') }}:
                                        {{ $examination->pet->owner->clinic->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.description') }}:
                                        {{ $examination->pet->owner->clinic->description }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.manager') }}:
                                        {{ $examination->pet->owner->clinic->manager }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.code') }}:
                                        {{ $examination->pet->owner->clinic->code }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.address') }}:
                                        {{ $examination->pet->owner->clinic->address }},
                                        {{ $examination->pet->owner->clinic->postcode }} -
                                        {{ $examination->pet->owner->clinic->city }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}:
                                        {{ $examination->pet->owner->clinic->phone }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.website') }}:
                                        <a
                                            href="http://{{ $examination->pet->owner->clinic->website }}">{{ $examination->pet->owner->clinic->website }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}: <a
                                            href="mailto:{{ $examination->pet->owner->clinic->email }}">{{ $examination->pet->owner->clinic->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ __('translate.veterinary') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.name') }}:
                                        {{ $examination->user->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.ssn') }}: {{ $examination->user->ssn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.registration') }}:
                                        {{ $examination->user->registration }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}: {{ $examination->user->phone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.mobile') }}: {{ $examination->user->mobile }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}: <a href="mailto:{{ $examination->user->email }}">{{ $examination->user->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>
                            {{ __('translate.created_at') }}: {{ $examination->created_at }}
                            {{ __('translate.updated_at') }}: {{ $examination->updated_at }} {{ __('translate.by') }}
                            {{ $examination->user->name }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
