@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.prescription_show') }}
                            <br>
                            <small>
                                {{ $prescription->medicine->name }}
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
                                {{ __('translate.prescription') }} {{ $prescription->medicine->name }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.medicine') }}: {{ $prescription->medicine->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.problem') }}:
                                        {{ $prescription->problem->diagnosis->term_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date') }}: {{ $prescription->prescription_date }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">{{ __('translate.dosage') }}:
                                        {{ $prescription->dosage }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.quantity') }}:
                                        {{ $prescription->quantity }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.duration') }}:
                                        {{ $prescription->duration }}</div>
                                </div>

                                <div class="row">
                                    <div class="col">{{ __('translate.notes') }}: {{ $prescription->notes }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.print_notes') }}:
                                        [{{ $prescription->print_notes ? 'x' : '  ' }}]</div>
                                    <div class="col">{{ __('translate.in_evidence') }}:
                                        [{{ $prescription->in_evidence ? 'x' : '  ' }}]</div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                {{ __('translate.pet') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">{{ __('translate.name') }}: {{ $prescription->pet->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.age') }}: {{ $prescription->pet->age->years }}Y
                                        {{ $prescription->pet->age->months }}m
                                        {{ $prescription->pet->age->days }}d</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.breed') }}: {{ $prescription->pet->breed }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.sex') }}: {{ $prescription->pet->sex }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date_of_birth') }}:
                                        {{ $prescription->pet->date_of_birth->format(auth()->user()->locale->date_short_format) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.date_of_death') }}:
                                        {{ !is_null($prescription->pet->date_of_death) ? $prescription->pet->date_of_death->format(auth()->user()->locale->date_short_format) : '' }}
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
                                    <div class="col">{{ __('translate.name') }}: {{ $prescription->pet->owner->lastname . ', ' . $prescription->pet->owner->firstname }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.address') }}:
                                        {{ $prescription->pet->owner->address . ', ' . $prescription->pet->owner->postcode . ', ' . $prescription->pet->owner->city }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.ssn') }}: {{ $prescription->pet->owner->ssn }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}:
                                        {{ $prescription->pet->owner->phone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}:
                                        {{ $prescription->pet->owner->email }}
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
                                        {{ $prescription->pet->owner->clinic->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.description') }}:
                                        {{ $prescription->pet->owner->clinic->description }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.manager') }}:
                                        {{ $prescription->pet->owner->clinic->manager }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.code') }}:
                                        {{ $prescription->pet->owner->clinic->code }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.address') }}:
                                        {{ $prescription->pet->owner->clinic->address }},
                                        {{ $prescription->pet->owner->clinic->postcode }} -
                                        {{ $prescription->pet->owner->clinic->city }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}:
                                        {{ $prescription->pet->owner->clinic->phone }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.website') }}:
                                        <a
                                            href="http://{{ $prescription->pet->owner->clinic->email }}">{{ $prescription->pet->owner->clinic->website }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}: <a
                                            href="mailto: {{ $prescription->pet->owner->clinic->email }}">{{ $prescription->pet->owner->clinic->email }}</a>
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
                                        {{ $prescription->user->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.ssn') }}: {{ $prescription->user->ssn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.registration') }}:
                                        {{ $prescription->user->registration }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.phone') }}: {{ $prescription->user->phone }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.mobile') }}: {{ $prescription->user->mobile }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">{{ __('translate.email') }}: {{ $prescription->user->email }}
                                    </div>
                                </div>
                            </div>
                        </div>













                        <div class="row">

                            {{-- 
                            <table class="w100 float-left border">
                                <tr>
                                    <td colspan="7" class="border-bottom uppercase bold">{{ __('translate.medicine') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="border-bottom">id: {{ $prescription->medicine->id }}
                                        {!! $generator->getBarcode($prescription->medicine->id, $generator::TYPE_CODE_128) !!}</td>
                                    <td colspan="4" class="border-bottom">external id:
                                        {{ $prescription->medicine->external_id }} {!! $generator->getBarcode($prescription->medicine->external_id, $generator::TYPE_CODE_128) !!}</td>
                                </tr>
                                <tr>
                                    <td class="border bold">{{ __('translate.medicine_external_id') }}</td>
                                    <td class="border bold">{{ __('translate.name') }}</td>
                                    <td class="border bold">{{ __('translate.medicine_pharmaceutical_form') }}</td>
                                    <td class="border bold">{{ __('translate.quantity') }}</td>
                                    <td class="border bold">{{ __('translate.dosage') }}</td>
                                    <td class="border bold">{{ __('translate.duration') }}</td>
                                    <td class="border bold">{{ __('translate.target_species') }}</td>
                                </tr>
                                <tr>
                                    <td class="border">{{ $prescription->medicine->external_id }}</td>
                                    <td class="border">{{ $prescription->medicine->name }}</td>
                                    <td class="border">{{ $prescription->medicine->pharmaceutical_form }}</td>
                                    <td class="border">{{ $prescription->quantity }}</td>
                                    <td class="border">{{ $prescription->dosage }}</td>
                                    <td class="border">{{ $prescription->duration }}</td>
                                    <td class="border">{{ $prescription->medicine->target_species }}</td>
                                </tr>
                            </table>
                            --}}

                        </div>










                    </div>
                    <div class="card-footer">
                        <small>
                            {{ __('translate.created_at') }}: {{ $prescription->created_at }}
                            {{ __('translate.updated_at') }}: {{ $prescription->updated_at }} {{ __('translate.by') }}
                            {{ $prescription->user->name }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
