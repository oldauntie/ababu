@extends('layouts.app')

@section('content')
<style>
    .btn-group-xs>.btn,
    .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.pets')}}
                    <button type="button" id="btnNew" class="btn btn-sm btn-primary">{{__('translate.new')}}</button>
                    <br>
                    <small>{{ __('help.pets_description') }}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col col-md-12">
                            <table id="pets" class="display compact" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('translate.name')}}</th>
                                        <th>{{__('translate.species')}}</th>
                                        <th>{{__('translate.firstname')}}</th>
                                        <th>{{__('translate.lastname')}}</th>
                                        <th>{{__('translate.owner')}}</th>
                                        <th>{{__('translate.microchip')}}</th>
                                        <th>{{__('translate.description')}}</th>
                                        <th>{{__('translate.color')}}</th>
                                        <th>{{__('translate.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- first row detail -->
                    <div class="row">
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                    </div>
                    <!-- second row detail -->
                    <div class="row">
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                        <div class="col col-md-4">
                            <h5>placeholder</h5>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.modal.edit')
@include('clinics.modal.invite')
@include('pets.modal.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(function() {
        var table = $('#pets').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: "{{ route('clinics.pets.list', [0, 'datatable']) }}",
            columns: [
                {data: "id", name: "id", width: "1%"},
                {data: "name", name: "name", width: "150"},
                {data: "familiar_name", name: "familiar_name", width: "150"},
                {data: "firstname", name: "firstname", visible: false},
                {data: "lastname", name: "lastname", visible: false},
                {data: "owner", name: "owner",
                    render: function(data, type, row) {
                        return row.firstname + ' ' + row.lastname;
                    },                    
                },
                {data: "microchip", name: "microchip"},
                {data: "description", name: "description"},
                {data: "color", name: "color"},
                {data: "action", name: "action", width: "150px"},
            ],
        });

        $('#pets tbody').on('click', 'tr', function() {
            var rowData = table.row(this).data();
            // console.log(rowData.id)
            
            if ($(this).hasClass('selected')) {
                // $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        // delete button
        $(document).on('click', '.pet-delete-button', function(){
            var row = table.rows(".selected").data();
            var id = row[0].id;
            $('#confirm-delete-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/' + id);
            $('#confirm-delete-modal').modal('show');
        });

    });


</script>
@endif
@endpush