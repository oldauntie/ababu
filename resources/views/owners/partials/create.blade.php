<!-- Attachment Modal -->
<div class="modal fade" id="owner-create-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.owner')}} {{__('translate.create')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="POST" id="owner-create-modal-form" action="{{ route('clinics.owners.store', $clinic) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="owner-create-firstname"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.firstname')}}*</label>

                        <div class="col-md-6">
                            <input id="owner-create-firstname" type="text"
                                class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}"
                                autocomplete="firstname" required maxlength="100">
                            <small class="form-text text-muted">{{__('help.owner_firstname')}}</small>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-lastname"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.lastname')}}*</label>

                        <div class="col-md-6">
                            <input id="owner-create-lastname" type="text"
                                class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"
                                autocomplete="lastname" required maxlength="100">
                            <small class="form-text text-muted">{{__('help.owner_lastname')}}</small>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-email"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.email')}}*</label>

                        <div class="col-md-6">
                            <input id="owner-create-email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                autocomplete="email" required maxlength="255">
                            <small class="form-text text-muted">{{__('help.owner_email')}}</small>


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-phone_primary"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.phone_primary')}}
                            * </label>

                        <div class="col-md-6">
                            <input id="owner-create-phone_primary" type="text"
                                class="form-control @error('phone_primary') is-invalid @enderror" name="phone_primary" value="{{ old('phone_primary') }}"
                                autocomplete="phone_primary" required maxlength="32">
                            <small class="form-text text-muted">{{__('help.owner_phone_primary')}}</small>


                            @error('phone_primary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-phone_secondary"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.phone_secondary')}}*</label>

                        <div class="col-md-6">
                            <input id="owner-create-phone_secondary" type="text"
                                class="form-control @error('phone_secondary') is-invalid @enderror" name="phone_secondary" value="{{ old('phone_secondary') }}"
                                autocomplete="phone_secondary" maxlength="32">
                            <small class="form-text text-muted">{{__('help.owner_phone_secondary')}}</small>


                            @error('phone_secondary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-address"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.address')}}</label>

                        <div class="col-md-6">
                            <input id="owner-create-address" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"
                                autocomplete="address" maxlength="100">
                            <small class="form-text text-muted">{{__('help.owner_address')}}</small>

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-postcode"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.postcode')}}</label>

                        <div class="col-md-6">
                            <input id="owner-create-postcode" type="text"
                                class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}"
                                autocomplete="postcode" maxlength="10">
                            <small class="form-text text-muted">{{__('help.owner_postcode')}}</small>


                            @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-city"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.city')}}</label>

                        <div class="col-md-6">
                            <input id="owner-create-city" type="text"
                                class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"
                                autocomplete="city" maxlength="64">
                            <small class="form-text text-muted">{{__('help.owner_city')}}</small>


                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-country_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('translate.country') }} *</label>

                        <div class="col-md-6">
                            <select id="owner-create-country_id" class="form-control" name="country_id">
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id')? "selected":"" }}>
                                    {{ $country->name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">{{__('help.owner_country')}}</small>

                            @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="owner-create-ssn"
                            class="col-md-4 col-form-label text-md-right">{{__('translate.ssn')}}</label>

                        <div class="col-md-6">
                            <input id="owner-create-ssn" type="text"
                                class="form-control @error('ssn') is-invalid @enderror" name="ssn" value="{{ old('ssn') }}"
                                autocomplete="ssn" maxlength="64">
                            <small class="form-text text-muted">{{__('help.owner_ssn')}}</small>


                            @error('ssn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
<!-- /Attachment Modal -->