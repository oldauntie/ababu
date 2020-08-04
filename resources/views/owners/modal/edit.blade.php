<!-- Attachment Modal -->
<div class="modal fade" id="owner-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">{{__('translate.owner')}} {{__('translate.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="attachment-body-content">


                <form method="POST" id="owner-edit-modal-form" action="" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}


                    <div class="form-group row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{__('translate.firstname')}}*</label>

                        <div class="col-md-6">
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" value="" autocomplete="firstname" required autofocus
                                maxlength="255">
                            <small id="help_owenr_firstname" class="form-text text-muted">{{__('help.owner_firstname')}}</small>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{__('translate.lastname')}}*</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="" autocomplete="lastname" required autofocus
                                maxlength="255">
                            <small id="help_owenr_lastname" class="form-text text-muted">{{__('help.owner_lastname')}}</small>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{__('translate.address')}}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" value="" autocomplete="address" autofocus
                                maxlength="255">
                            <small id="help_owenr_address" class="form-text text-muted">{{__('help.owner_address')}}</small>

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">{{__('translate.postcode')}}</label>

                        <div class="col-md-6">
                            <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror"
                                name="postcode" value="" autocomplete="postcode" autofocus
                                maxlength="100">
                            <small id="help_owenr_postcode" class="form-text text-muted">{{__('help.owner_postcode')}}</small>


                            @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{__('translate.city')}}</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                name="city" value="" autocomplete="city" autofocus
                                maxlength="255">
                            <small id="help_owenr_city" class="form-text text-muted">{{__('help.owner_city')}}</small>


                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="ssn" class="col-md-4 col-form-label text-md-right">{{__('translate.ssn')}}</label>

                        <div class="col-md-6">
                            <input id="ssn" type="text" class="form-control @error('ssn') is-invalid @enderror"
                                name="ssn" value="" autocomplete="ssn" autofocus
                                maxlength="255">
                            <small id="help_owenr_ssn" class="form-text text-muted">{{__('help.owner_ssn')}}</small>


                            @error('ssn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{__('translate.phone')}}
                        * </label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="" autocomplete="phone" required autofocus
                                maxlength="255">
                            <small id="help_owenr_phone" class="form-text text-muted">{{__('help.owner_phone')}}</small>


                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label text-md-right">{{__('translate.mobile')}}*</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                name="mobile" value="" autocomplete="mobile" required autofocus
                                maxlength="255">
                            <small id="help_owenr_mobile" class="form-text text-muted">{{__('help.owner_mobile')}}</small>


                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{__('translate.email')}}*</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="" autocomplete="email" required autofocus
                                maxlength="255">
                            <small id="help_owenr_email" class="form-text text-muted">{{__('help.owner_email')}}</small>


                            @error('email')
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