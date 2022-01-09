<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">{{__('translate.clinic')}} {{$clinic->name}}
                    {{__('translate.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="attachment-body-content">


                <form method="POST" action="{{route('clinics.update', $clinic)}}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}


                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__('translate.name')}}
                            *</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $clinic->name }}" autocomplete="name" required
                                maxlength="255">
                            <small id="help_clinic_name" class="form-text text-muted">{{__('help.clinic_name')}}</small>


                            @error('name')
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
                                value="{{ $clinic->description }}" autocomplete="description" maxlength="255">
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
                                value="{{ $clinic->manager }}" autocomplete="manager" maxlength="100">
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
                                value="{{ $clinic->code }}" autocomplete="code" maxlength="100">
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
                                value="{{ $clinic->address }}" autocomplete="address" maxlength="100">
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
                                value="{{ $clinic->postcode }}" autocomplete="postcode" maxlength="10">
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
                                value="{{ $clinic->city }}" autocomplete="city" maxlength="64">
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
                                value="{{ $clinic->phone }}" autocomplete="phone" maxlength="32">
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
                                value="{{ $clinic->website }}" autocomplete="website" maxlength="255">
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
                                value="{{ $clinic->email }}" autocomplete="email" maxlength="255">
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
                        <label for="logo" class="col-md-4 col-form-label text-md-right">{{__('translate.logo')}}</label>
                        
                        @if ($clinic->logo != '')
                        <img src="{{url('/images/' . $clinic->logo)}}" width="100">
                        @else
                        <img src="{{url('/images/no-image-available.svg')}}" width="100">
                        @endif

                        <div class="col-md-6">
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                                name="logo" accept="image/png, image/jpeg">
                            <small id="help_clinic_logo" class="form-text text-muted">{{__('help.clinic_logo')}}</small>

                            @error('logo')
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