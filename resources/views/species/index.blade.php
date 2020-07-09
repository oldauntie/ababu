@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{__('translate.clinic')}}
                    {{$clinic->name}}:
                    {{__('translate.species')}}
                    <small id="help_specie_admin" class="form-text text-muted">{{__('help.specie_admin')}}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('species.store', $clinic->id)}}">
                        @csrf

                        <div class="form-group row">
                            <label for="tsn">{{__('translate.specie')}}</label>
                            <div class="col-md-12">
                                <select id="tsn" name="tsn" class="form-control" required></select>
                                <small id="help_specie_select"
                                    class="form-text text-muted">{{__('help.specie_select')}}</small>

                                @error('tsn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="familiar_name">{{ __('translate.familiar_name') }}</label>

                            <div class="col-md-12">
                                <input id="familiar_name" type="text"
                                    class="form-control @error('familiar_name') is-invalid @enderror"
                                    name="familiar_name" value="{{ old('familiar_name') }}" required
                                    autocomplete="familiar_name" autofocus>

                                @error('familiar_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-secondary btn-lg">{{__('translate.add')}}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="col-md-4">
            <table id="users" class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>{{__('translate.tsn')}}</th>
                        <th>{{__('translate.complete_name')}}</th>
                        <th>{{__('translate.familiar_name')}}</th>
                        <th width="100px">{{__('translate.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($species as $specie)
                    <tr>
                        <td>{{$specie->tsn}}</td>
                        <td>{{$specie->life()->first()->complete_name}}</td>
                        <td>{{$specie->familiar_name}}</td>
                        <td>
                            <button class="btn btn-sm btn-primary open_modal"
                                value="{{$specie->id}}">{{__('translate.edit')}}</button>
                            <a href="#" onclick="return confirm('{{__('message.are_you_sure')}}')"
                                class="btn btn-sm btn-danger">{{__('translate.delete')}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>

@include('species.modal.edit')

@endsection


@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tsn").select2({
        ajax: { 
            placeholder: "Choose specie...",
            minimumInputLength: 3,
            url: "/lives/ajax/search/",
            dataType: 'json',
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
      });

    });

    $(document).on('click','.open_modal',function(){
        var url = "/species/ajax/get";
        var id= $(this).val();

        $.get(url + '/' + id, function (data) {
            //success data
            var json = JSON.parse(data);
            console.log(json);
            $('#modal-complete_name').val(json.complete_name);
            $('#modal-familiar_name').val(json.familiar_name);
            $('#modal-specie_id').val(id);

            var action = "species/" + id; 
            $("#modal-edit-form").attr("action", action);
            $('#edit-modal').modal('show');
        }) 

        console.log('id: ' + id);
 
    });
</script>

@endpush