@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}<br>
                    <small>{{ __('help.pets_description') }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h5>placeholder</h5>
                    
                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.modal.edit')
@include('clinics.modal.invite')
@include('clinics.modal.confirm-delete')
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