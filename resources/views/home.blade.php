@extends('layouts.app')
<style>
    .center {
        text-align: center;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{__('help.logged_in')}}

                    @if(Auth::user()->clinics->count() > 0)
                    <ul>
                        @foreach (Auth::user()->clinics as $clinic)
                        <li>
                            <a href="{{ route('clinics.show', $clinic) }}">{{ $clinic->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    {{__('help.clinic_not_configured')}}
                    <div class="container">
                        <div class="row">
                            <div class="col center">
                                <button type="button"
                                    class="btn btn-primary btn-lg">{{__('translate.clinic_create')}}</button>
                                <small id="help_clinic_create"
                                    class="form-text text-muted">{{__('help.clinic_create')}}</small>
                            </div>
                            <div class="col center">
                                {{__('translate.or')}}
                            </div>
                            <div class="col center">
                                @include('clinics.join')
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection