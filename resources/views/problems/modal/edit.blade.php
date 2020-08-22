<!-- Attachment Modal -->
<div class="modal fade" id="pet-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.problem')}} {{__('translate.edit')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="pet-edit-modal-form" action="" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">
                        <div class="col-md-4">


                        </div>

                        <!-- column 2 -->
                        <div class="col-md-8">
                            <div class="row justify-content-center" style="border: thin solid red">
                                <div class="col-3" style="border: thin solid red">
                                    <label for="pet-edit-name" class="text-md-right">{{__('translate.name')}}*</label>
                                    <input id="pet-edit-name" type="text"
                                        class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                        name="name" value="" autocomplete="name" required autofocus maxlength="255">
                                </div>
                                <div class="col-2" style="border: thin solid red">
                                    <label for="pet-edit-name" class="text-md-right">{{__('translate.name')}}*</label>
                                    <input id="pet-edit-name" type="text"
                                        class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                        name="name" value="" autocomplete="name" required autofocus maxlength="255">

                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="pet-edit-name"
                                                class="text-md-right">{{__('translate.name')}}*</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <input id="pet-edit-name" type="text"
                                                class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                                name="name" value="" autocomplete="name" required autofocus
                                                maxlength="255">

                                        </div>
                                        <div class="col-8">
                                            <input id="pet-edit-name" type="text"
                                                class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                                name="name" value="" autocomplete="name" required autofocus
                                                maxlength="255">

                                        </div>
                                    </div>


                                </div>

                            </div>
                            <fieldset>
                                <legend>{{__('translate.microchip')}}</legend>

                            </fieldset>


                            <fieldset>
                                <legend>{{__('translate.tatuatge')}}</legend>

                            </fieldset>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.save')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-dismiss="modal">{{__('translate.close')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <div class="row" style="width: 95%">
                    <div class="col-2">{{ __('translate.created_at') }}</div>
                    <div class="col-2" id="pet-edit-created_at">00:00:00</div>
                    <div class="col-2">{{ __('translate.updated_at') }}</div>
                    <div class="col-2" id="pet-edit-updated_at">00:00:00</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')

<script type="text/javascript">

</script>

@endpush