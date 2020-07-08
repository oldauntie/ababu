@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.clinic')}} {{ $clinic->name }}
                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                    <a href="{{ route('clinics.edit', $clinic) }}" class="btn btn-sm btn-primary">{{__('translate.edit')}}</a>
                    <a href="{{ route('clinics.invite', $clinic) }}" class="btn btn-sm btn-secondary">{{__('translate.invite')}}</a>
                    @endif
                    <br>
                    <small>{{$clinic->description}}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">{{__('translate.pets')}}</a></li>
                        @canany(['root', 'admin'], $clinic)
                        <li><a href="{{route('clinics.users.list', $clinic)}}">{{__('translate.users')}}</a></li>
                        <li><a href="{{route('species.index', $clinic)}}">{{__('translate.species')}}</a></li>
                        @endcanany
                        <li><a href="#">{{__('translate.visits')}}</a></li>
                        <li><a href="#">{{__('translate.owners')}}</a></li>
                        <li><a href="#">{{__('translate.calendar')}}</a></li>
                    </ul>



                    clinic dashboard


                </div>
            </div>


        </div>
    </div>
</div>
@endsection