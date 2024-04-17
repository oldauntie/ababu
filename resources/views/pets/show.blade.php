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
                            {{ __('translate.age') }} {{ $pet->age->years }}Y {{ $pet->age->months }}m {{ $pet->age->days }}d
                            <br>
                            <small> small </small>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('clinics.owners.pets.edit', [$clinic, $owner, $pet]) }}" class="btn btn-sm btn-outline-primary">{{ __('translate.edit') }}</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">{{ __('translate.delete') }}</a>
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
                            <div class="col-12">
                                card body
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
