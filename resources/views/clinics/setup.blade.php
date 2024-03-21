@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Home</div>

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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
