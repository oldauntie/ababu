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
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    @if(Auth::user()->clinics->count() > 0)

                    {{Auth::user()->clinics->count()>1?__('translate.clinic_your_clinics'):__('translate.clinic_your_clinic')}}

                    <ul>
                        @foreach (Auth::user()->clinics as $clinic)
                        <li>
                            <a href="{{ route('clinics.show', $clinic) }}">{{ $clinic->name }}
                                ({{$clinic->country->name}} - {{Auth::user()->locale->language}})</a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    

                    <div class="container">
                        <div class="row">
                            <div class="col-5 center">
                                <a href="{{ route('clinics.create') }}"
                                    class="btn btn-primary btn-lg">{{__('translate.clinic_create')}}</a>
                                <small id="help_clinic_create"
                                    class="form-text text-muted">{{__('help.clinic_create')}}</small>
                            </div>
                            <div class="col-1 center">
                                {{__('translate.or')}}
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
    </div>
</div>
@endsection