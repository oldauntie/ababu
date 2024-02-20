@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $clinic->name }}
                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                    
                    <a href="#" class="btn btn-sm btn-primary open_modal_edit">{{__('translate.edit')}}</a>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#invite-modal">{{__('translate.invite')}}</button>
                    <button class="btn btn-sm btn-danger open_modal_delete">{{__('translate.delete')}}</button>
                    
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

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    here is the clinic [body]




                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.partials.invite')
@endif
