@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.pet_create') }}
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

                        <form method="POST" action="{{ route('clinics.owners.pets.store', [$clinic->id, $owner->id]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" maxlength="100" required
                                    placeholder="{{ __('translate.name') }}">
                                <label for="name">{{ __('translate.name') }}</label>
                            </div>

                            <!-- species -->
                            <div class="form-floating mb-3">
                                <select class="form-select @error('species_id') is-invalid @enderror" name="species_id" id="species_id" aria-label="{{ __('translate.species') }}">
                                    @foreach ($clinic->species as $species)
                                    <option value="{{ $species->id }}">{{ $species->familiar_name }}</option>                                        
                                    @endforeach
                                </select>
                                <label for="species_id">{{ __('translate.species') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="breed" type="text"
                                    class="form-control @error('breed') is-invalid @enderror" name="breed"
                                    value="{{ old('breed') }}" maxlength="255"
                                    placeholder="{{ __('translate.breed') }}">
                                <label for="breed">{{ __('translate.breed') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="sex" id="sex"
                                    aria-label="{{ __('translate.sex') }}">
                                    @foreach (\App\Models\Pet::SEXES as $sex)
                                        <option value="{{ $sex }}" {{ $sex == old('sex') ? 'selected' : null }}>
                                            {{ $sex }}</option>
                                    @endforeach                                 
                                </select>
                                <label for="sex">{{ __('translate.sex') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="date_of_birth" type="date"
                                    class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}" placeholder="{{ __('translate.date_of_birth') }}" required>
                                <label for="date_of_birth">{{ __('translate.date_of_birth') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="date_of_death" type="date"
                                    class="form-control @error('date_of_death') is-invalid @enderror" name="date_of_death"
                                    value="{{ old('date_of_death') }}" placeholder="{{ __('translate.date_of_death') }}">
                                <label for="date_of_death">{{ __('translate.date_of_death') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="{{ __('translate.description') }}">{{ old('description') }}</textarea>
                                <label for="description">{{ __('translate.description') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="color" type="text"
                                    class="form-control @error('color') is-invalid @enderror" name="color"
                                    value="{{ old('color') }}" maxlength="100" placeholder="{{ __('translate.color') }}">
                                <label for="color">{{ __('translate.color') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="distinguishing_mark" type="text"
                                    class="form-control @error('distinguishing_mark') is-invalid @enderror" name="distinguishing_mark"
                                    value="{{ old('distinguishing_mark') }}" maxlength="100" placeholder="{{ __('translate.distinguishing_mark') }}">
                                <label for="distinguishing_mark">{{ __('translate.distinguishing_mark') }}</label>
                            </div>

                            {{-- 
                            <div class="form-floating mb-3">
                                <select class="form-select" name="reproductive_status" id="reproductive_status"
                                    aria-label="{{ __('translate.reproductive_status') }}">
                                    @foreach (\App\Models\Pet::REPRODUCTIVE_STATUSES as $reproductive_status)
                                        <option value="{{ $reproductive_status }}" {{ $sex == old('reproductive_status') ? 'selected' : null }}>
                                            {{ $reproductive_status }}</option>
                                    @endforeach                                 
                                </select>
                                <label for="reproductive_status">{{ __('translate.reproductive_status') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="life_style" id="life_style"
                                    aria-label="{{ __('translate.life_style') }}">
                                    @foreach (\App\Models\Pet::LIFE_STYLES as $life_style)
                                        <option value="{{ $life_style }}" {{ $sex == old('life_style') ? 'selected' : null }}>
                                            {{ $life_style }}</option>
                                    @endforeach                                 
                                </select>
                                <label for="life_style">{{ __('translate.life_style') }}</label>
                            </div>
                            --}}


                            <div class="form-floating mb-3">
                                <input id="microchip" type="text"
                                    class="form-control @error('microchip') is-invalid @enderror" name="microchip"
                                    value="{{ old('microchip') }}" maxlength="64"
                                    placeholder="{{ __('translate.microchip') }}">
                                <label for="microchip">{{ __('translate.microchip') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="microchip_location" type="text"
                                    class="form-control @error('microchip_location') is-invalid @enderror"
                                    name="microchip_location" value="{{ old('microchip_location') }}" maxlength="100"
                                    placeholder="{{ __('translate.microchip_location') }}">
                                <label for="microchip_location">{{ __('translate.microchip_location') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="tatuatge" type="text"
                                    class="form-control @error('tatuatge') is-invalid @enderror" name="tatuatge"
                                    value="{{ old('tatuatge') }}" maxlength="64"
                                    placeholder="{{ __('translate.tatuatge') }}">
                                <label for="tatuatge">{{ __('translate.tatuatge') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="tatuatge_location" type="text"
                                    class="form-control @error('tatuatge_location') is-invalid @enderror"
                                    name="tatuatge_location" value="{{ old('tatuatge_location') }}" maxlength="100"
                                    placeholder="{{ __('translate.tatuatge_location') }}">
                                <label for="tatuatge_location">{{ __('translate.tatuatge_location') }}</label>
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
