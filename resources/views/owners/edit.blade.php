@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.owner_create') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ url()->previous() }}"
                                class="btn btn-sm btn-outline-secondary">{{ __('translate.back') }}</a>
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

                        <form method="POST" action="{{ route('clinics.owners.update', [$clinic->id, $owner->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}


                            <div class="form-floating mb-3">
                                <input id="firstname" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                    value="{{ $owner->firstname }}" maxlength="100" required
                                    placeholder="{{ __('translate.firstname') }}">
                                <label for="name">{{ __('translate.firstname') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ $owner->lastname }}" maxlength="100" required
                                    placeholder="{{ __('translate.lastname') }}">
                                <label for="name">{{ __('translate.lastname') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $owner->email }}" maxlength="255" required
                                    placeholder="{{ __('translate.email') }}">
                                <label for="email">{{ __('translate.email') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="phone_primary" type="text"
                                    class="form-control @error('phone_primary') is-invalid @enderror" name="phone_primary"
                                    value="{{ $owner->phone_primary }}" maxlength="32" required
                                    placeholder="{{ __('translate.phone_primary') }}">
                                <label for="phone_primary">{{ __('translate.phone_primary') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="phone_secondary" type="text"
                                    class="form-control @error('phone_secondary') is-invalid @enderror"
                                    name="phone_secondary" value="{{ $owner->phone_secondary }}" maxlength="32" required
                                    placeholder="{{ __('translate.phone_secondary') }}">
                                <label for="phone_secondary">{{ __('translate.phone_secondary') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ $owner->address }}" maxlength="100"
                                    placeholder="{{ __('translate.address') }}">
                                <label for="address">{{ __('translate.address') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="postcode" type="text"
                                    class="form-control @error('postcode') is-invalid @enderror" name="postcode"
                                    value="{{ $owner->postcode }}" maxlength="10"
                                    placeholder="{{ __('translate.postcode') }}">
                                <label for="postcode">{{ __('translate.postcode') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $owner->city }}" maxlength="64" placeholder="{{ __('translate.city') }}">
                                <label for="city">{{ __('translate.city') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="country_id" id="country_id"
                                    aria-label="{{ __('translate.country') }}">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $country->id == $owner->country_id ? 'selected' : '' }}> {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <label for="country_id">{{ __('translate.country') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="ssn" type="text" class="form-control @error('ssn') is-invalid @enderror"
                                    name="ssn" value="{{ $owner->ssn }}" maxlength="64"
                                    placeholder="{{ __('translate.ssn') }}">
                                <label for="ssn">{{ __('translate.ssn') }}</label>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col text-center">
                                    <button type="submit"
                                        class="btn btn-outline-success btn-lg">{{ __('translate.save') }}</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
