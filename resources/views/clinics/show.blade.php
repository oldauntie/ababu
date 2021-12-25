@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.clinic')}} {{ $clinic->name }}
                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                    <button class="btn btn-sm btn-primary open_modal_edit">{{__('translate.edit')}}</button>
                    <button class="btn btn-sm btn-secondary open_modal_invite">{{__('translate.invite')}}</button>
                    <button class="btn btn-sm btn-danger open_modal_delete">{{__('translate.delete')}}</button>
                    @endif
                    [{{ __('translate.dashboard') }} ]
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
                        <li><a href="{{route('clinics.pets.index', $clinic)}}">{{__('translate.pets')}}</a></li>
                        <li><a href="#">{{__('translate.visits')}}</a></li>
                        <li><a href="{{route('clinics.owners.index', $clinic)}}">{{__('translate.owners')}}</a></li>
                        <li><a href="{{route('clinics.calendars.show', $clinic)}}">{{__('translate.calendar')}}</a></li>
                    </ul>
                    
                    @canany(['root', 'admin'], $clinic)
                    <h5>Admin Links</h5>
                    <ul>
                        <li><a href="{{route('clinics.users.list', $clinic)}}">{{__('translate.users')}}</a></li>
                        <li><a href="{{route('clinics.species.index', $clinic)}}">{{__('translate.species')}}</a></li>
                    </ul>
                    @endcanany
                    
                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.partials.edit')
@include('clinics.partials.invite')
@include('clinics.partials.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
<script type="text/javascript">
    $(document).on('click','.open_modal_edit',function(){
        $('#edit-modal').modal('show');
    });

    $(document).on('click','.open_modal_invite',function(){
        $('#invite-modal').modal('show');
    });

    $(document).on('click','.open_modal_delete',function(){
        $('#confirm-delete-modal').modal('show');
    });
</script>
@endif
@endpush