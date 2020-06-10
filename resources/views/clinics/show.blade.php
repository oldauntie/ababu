@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.Clinic')}} {{ $clinic->name }}
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
                        <li><a href="{{route('clinics.pets.index', $clinic->id)}}">{{__('translate.Pets')}}</a></li>
                        <li><a href="{{route('clinics.users.index', $clinic->id)}}">{{__('translate.Users')}}</a></li>
                        <li><a href="#">Visits</a></li>
                        <li><a href="#">Owners</a></li>
                        <li><a href="#">Calendar</a></li>
                    </ul>



                    clinic dashboard


                </div>
            </div>


        </div>
    </div>
</div>
@endsection