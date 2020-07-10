@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.clinic')}} {{ $clinic->name }}
                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                    <a href="{{ route('clinics.edit', $clinic) }}"
                        class="btn btn-sm btn-primary">{{__('translate.edit')}} old</a>
                    <button class="btn btn-sm btn-primary open_modal_edit" value="1">{{__('translate.edit')}}</button>
                    <a href="{{ route('clinics.invite', $clinic) }}"
                        class="btn btn-sm btn-secondary">{{__('translate.invite')}} old</a>
                    <button class="btn btn-sm btn-primary open_modal_invite"
                        value="1">{{__('translate.invite')}}</button>
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
                        <li><a href="{{route('clinics.species.index', $clinic)}}">{{__('translate.species')}}</a></li>
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

@include('clinics.modal.edit')
@include('clinics.modal.invite')

@endsection




@push('scripts')
<script type="text/javascript">
    $(document).on('click','.open_modal_edit',function(){
        $('#edit-modal').modal('show');
    });

    $(document).on('click','.open_modal_invite',function(){
        $('#invite-modal').modal('show');
    });
</script>

@endpush