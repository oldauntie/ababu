@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">




                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ $clinic->name }}

                            <br>
                            <small>{{ $clinic->description }}</small>
                        </div>
                        <div class="float-end">
                            @if (Auth::user()->hasRoleByClinicId('admin', $clinic->id))
                                <a href="{{ route('clinics.show', $clinic->id) }}"
                                    class="btn btn-sm btn-secondary">{{ __('translate.back') }}</a>
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





















                        <form method="POST" action="{{ route('clinics.update', $clinic) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}


                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $clinic->name }}" maxlength="255" required
                                    placeholder="{{ __('translate.name') }}">
                                <label for="name">{{ __('translate.name') }}</label>
                            </div>
                            {{--
                            @error('name')
                                <div class="text-warning">{{ $message }}</div>
                            @enderror
                            --}}

                            <div class="form-floating mb-3">
                                <input id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $clinic->description }}" maxlength="255"
                                    placeholder="{{ __('translate.description') }}">
                                <label for="description">{{ __('translate.description') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="manager" type="text"
                                    class="form-control @error('manager') is-invalid @enderror" name="manager"
                                    value="{{ $clinic->manager }}" maxlength="100"
                                    placeholder="{{ __('translate.manager') }}">
                                <label for="manager">{{ __('translate.manager') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="code" type="text"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ $clinic->code }}" maxlength="100" placeholder="{{ __('translate.code') }}">
                                <label for="code">{{ __('translate.code') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ $clinic->address }}" maxlength="100"
                                    placeholder="{{ __('translate.address') }}">
                                <label for="address">{{ __('translate.address') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="postcode" type="text"
                                    class="form-control @error('postcode') is-invalid @enderror" name="postcode"
                                    value="{{ $clinic->postcode }}" maxlength="10"
                                    placeholder="{{ __('translate.postcode') }}">
                                <label for="postcode">{{ __('translate.postcode') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $clinic->city }}" maxlength="64" placeholder="{{ __('translate.city') }}">
                                <label for="city">{{ __('translate.city') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ $clinic->phone }}" maxlength="32" placeholder="{{ __('translate.phone') }}">
                                <label for="phone">{{ __('translate.phone') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="website" type="text"
                                    class="form-control @error('website') is-invalid @enderror" name="website"
                                    value="{{ $clinic->website }}" maxlength="255"
                                    placeholder="{{ __('translate.website') }}">
                                <label for="website">{{ __('translate.website') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $clinic->email }}" maxlength="255"
                                    placeholder="{{ __('translate.email') }}">
                                <label for="email">{{ __('translate.email') }}</label>
                            </div>


                            {{-- --}}



                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="logo"
                                        class="col-md-4 col-form-label text-md-right">{{ __('translate.logo') }}</label>
                                    <input id="logo" type="file"
                                        class="form-control form-control-lg @error('logo') is-invalid @enderror"
                                        name="logo" accept="image/png, image/jpeg">
                                    <small id="help_clinic_logo"
                                        class="form-text text-muted">{{ __('help.clinic_logo') }}</small>
                                </div>
                                <div class="col-md-6">
                                    @if ($clinic->logo != '')
                                        <img src="{{ url('/images/' . $clinic->logo) }}" class="img-thumbnail">
                                    @else
                                        <img src="{{ url('/images/no-image-available.svg') }}" class="img-thumbnail">
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit"
                                        class="btn btn-secondary btn-lg">{{ __('translate.save') }}</button>
                                </div>
                            </div>
                        </form>












                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Auth::user()->hasRoleByClinicId('admin', $clinic->id))
    @include('clinics.partials.invite')
@endif
