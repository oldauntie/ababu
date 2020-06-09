@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.clinic_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('clinics.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.clinic_name')}} *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    maxlength="255">
                                <small id="help_clinic_name"
                                    class="form-text text-muted">{{__('help.clinic_name')}}</small>


                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.clinic_description')}}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description"
                                    value="{{ old('description') }}" autocomplete="description" autofocus>
                                <small id="help_clinic_description"
                                    class="form-text text-muted">{{__('help.clinic_description')}}</small>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="logo"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.clinic_logo')}}</label>

                            <div class="col-md-6">
                                <input id="logo" type="text" class="form-control" name="logo" value="{{ old('logo') }}"
                                    autocomplete="logo" autofocus>
                                <small id="help_clinic_logo"
                                    class="form-text text-muted">{{__('help.clinic_logo')}}</small>

                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary btn-lg">{{__('translate.save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection