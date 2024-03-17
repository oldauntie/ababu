@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ $clinic->name }}
                        <br>
                        <small>{{$clinic->description}}</small>
                    </div>
                    <div class="float-end">
                        @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                        <a href="{{ route('clinics.edit', [$clinic->id]) }}" class="btn btn-sm btn-primary">{{__('translate.edit')}}</a>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#invite-modal">{{__('translate.invite')}}</button>
                        <button class="btn btn-sm btn-danger open_modal_delete">{{__('translate.delete')}}</button>
                        @endif
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
                            Messages [placeholder]
                        </div>
                    </dif>
                    <dif class="row">
                        <div class="col-6">
                            Recent visits [placeholder]
                        </div>
                    </dif>



                </div>
            </div>
        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.partials.invite')
@endif

@endsection
