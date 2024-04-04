@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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

                <!-- As a heading -->
                <nav class="navbar border-bottom border-body" data-bs-theme="dark">
                    <div class="float-start">
                        {{ Auth::user()->clinics->count() > 1 ? __('translate.clinic_your_clinics') : __('translate.clinic_your_clinic') }}
                    </div>

                    <div class="float-end">
                        <a href="{{ route('clinics.create') }}"
                            class="btn btn-sm btn-outline-success me-2">{{ __('translate.create') }}</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                            data-bs-target="#clinicJoinModal">
                            {{ __('translate.join') }}
                        </button>
                    </div>
                </nav>


                @if (Auth::user()->clinics->count() > 0)
                    @foreach (Auth::user()->clinics as $clinic)
                        <div class="card m-3">
                            <div class="card-header">
                                <div class="float-start">
                                    <a href="{{ route('clinics.show', $clinic) }}">{{ $clinic->name }}
                                        ({{ $clinic->country->name }} - {{ Auth::user()->locale->language }})
                                    </a>
                                </div>
                                <div class="float-end">
                                    <a href="{{ route('clinics.show', $clinic) }}"
                                        class="btn btn-sm btn-outline-primary">{{ __('translate.select') }}</a>
                                </div>
                            </div>

                            <div class="card-body">


                                {{ $clinic->description }}<br>
                                {{ $clinic->address }}, {{ $clinic->city }}, {{ $clinic->postcode }}<br>
                                <b>{{ __('translate.phone') }}: {{ $clinic->phone }}</b><br>
                                <b>{{ __('translate.email') }}: {{ $clinic->email }}</b><br>
                                <b>{{ __('translate.website') }}: {{ $clinic->website }}</b>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <div class="row">
                            <div class="col-5 center">
                                <a href="{{ route('clinics.create') }}"
                                    class="btn btn-primary btn-lg">{{ __('translate.clinic_create') }}</a>
                                <br>
                                <small id="help_clinic_create"
                                    class="form-text text-muted">{{ __('help.clinic_create') }}</small>
                            </div>
                            <div class="col-1 center">
                                {{ __('translate.or') }}
                            </div>
                            <div class="col-6 center">
                                @include('clinics.partials.join')
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="clinicJoinModal" tabindex="-1" aria-labelledby="clinicJoinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="clinicJoinModalLabel">{{ __('translate.clinic_join') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('clinics.partials.join')
                </div>
            </div>
        </div>
    </div>



@endsection
