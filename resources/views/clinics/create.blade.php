@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.clinic_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('clinics.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.name')}} *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" required autofocus maxlength="255">
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
                            <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('translate.country') }} *</label>

                            <div class="col-md-6">
                                <select name="country_id" id="country_id" class="form-control">
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"  {{ old('country_id')? "selected":"" }}>{{ $country->name }}</option>  
                                    @endforeach
                                </select>
                                <small id="help_clinic_country"
                                    class="form-text text-muted">{{__('help.clinic_country')}}</small>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.description')}}</label>

                            <div class="col-md-6">
                                <input id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') }}" autocomplete="description" autofocus
                                    maxlength="255">
                                <small id="help_clinic_description"
                                    class="form-text text-muted">{{__('help.clinic_description')}}</small>


                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="logo"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.logo')}}</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                                    name="logo" accept="image/png, image/jpeg">
                                <small id="help_clinic_logo"
                                    class="form-text text-muted">{{__('help.clinic_logo')}}</small>

                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror



                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary ">{{__('translate.save')}}</button>
                                <a href="{{route('home')}}" class="btn btn-secondary">{{__('translate.done')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection