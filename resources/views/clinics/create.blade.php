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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('translate.name')}}
                                *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus required
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
                            <label for="country_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('translate.country') }} *</label>

                            <div class="col-md-6">
                                <select name="country_id" id="country_id" class="form-control">
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id')? "selected":"" }}>
                                        {{ $country->name }}</option>
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
                                    value="{{ old('description') }}" autocomplete="description"
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
                            <label for="manager"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.manager')}}</label>
                        
                            <div class="col-md-6">
                                <input id="manager" type="text"
                                    class="form-control @error('manager') is-invalid @enderror" name="manager"
                                    value="{{ old('manager', Auth::user()->name) }}" autocomplete="manager"
                                    maxlength="100">
                                <small id="help_clinic_manager"
                                    class="form-text text-muted">{{__('help.clinic_manager')}}</small>
                        
                        
                                @error('manager')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="code"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.code')}}</label>
                        
                            <div class="col-md-6">
                                <input id="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ old('code') }}" autocomplete="code"
                                    maxlength="100">
                                <small id="help_clinic_code"
                                    class="form-text text-muted">{{__('help.clinic_code')}}</small>
                        
                        
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.address')}}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" autocomplete="address"
                                    maxlength="100">
                                <small id="help_clinic_address"
                                    class="form-text text-muted">{{__('help.clinic_address')}}</small>


                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="postcode"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.postcode')}}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text"
                                    class="form-control @error('postcode') is-invalid @enderror" name="postcode"
                                    value="{{ old('postcode') }}" autocomplete="postcode"
                                    maxlength="10">
                                <small id="help_clinic_postcode"
                                    class="form-text text-muted">{{__('help.clinic_postcode')}}</small>


                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="city"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.city')}}</label>

                            <div class="col-md-6">
                                <input id="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ old('city') }}" autocomplete="city"
                                    maxlength="64">
                                <small id="help_clinic_city"
                                    class="form-text text-muted">{{__('help.clinic_city')}}</small>


                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="phone"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.phone')}}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" autocomplete="phone"
                                    maxlength="32">
                                <small id="help_clinic_phone"
                                    class="form-text text-muted">{{__('help.clinic_phone')}}</small>


                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="website"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.website')}}</label>

                            <div class="col-md-6">
                                <input id="website" type="text"
                                    class="form-control @error('website') is-invalid @enderror" name="website"
                                    value="{{ old('website') }}" autocomplete="website"
                                    maxlength="255">
                                <small id="help_clinic_website"
                                    class="form-text text-muted">{{__('help.clinic_website')}}</small>


                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email"
                                    maxlength="255">
                                <small id="help_clinic_email"
                                    class="form-text text-muted">{{__('help.clinic_email')}}</small>


                                @error('email')
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


                        <div class="form-group row">
                            <label for="species-add-common"
                                class="col-md-4 col-form-label text-md-right">{{__('translate.species_add_common')}}</label>

                            <div class="col-md-6">
                                <input id="species-add-common" type="checkbox"
                                    name="species_add_common" checked>
                                <small
                                    class="form-text text-muted">{{__('help.species_add_common')}}</small>
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