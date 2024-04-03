@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ $owner->firstname }} {{ $owner->lastname }}
                            <br>
                            <small>{{ $owner->address }}, {{ $owner->postcode }} {{ $owner->city }} 
                                {{ $owner->phone_primary }} {{ $owner->phone_secondary }} <a
                                    href="mailto:{{ $owner->email }}">{{ $owner->email }}</a> </small>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('clinics.edit', [$owner->id]) }}"
                                class="btn btn-sm btn-primary">{{ __('translate.edit') }}</a>
                            <a href="#" class="btn btn-sm btn-danger">{{ __('translate.delete') }}</a>
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



                        <dif class="row">
                            <div class="col-6">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>{{ __('translate.name') }}</th>
                                            <th>{{ __('translate.sex') }}</th>
                                            <th>{{ __('translate.breed') }}</th>
                                            <th>{{ __('translate.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($owner->pets as $pet)
                                            <tr>
                                                <td>{{ $pet->name }}</td>
                                                <td>{{ $pet->sex }}</td>
                                                <td>{{ $pet->breed }}</td>
                                                <td><a href="#"
                                                        class="btn btn-sm btn-outline-primary">{{ __('translate.select') }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </dif>
                        <dif class="row">
                            <div class="col-6">
                                Calendar [placeholder]
                            </div>
                        </dif>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRoleByClinicId('admin', $clinic->id))
        @include('clinics.partials.invite')
    @endif

@endsection
