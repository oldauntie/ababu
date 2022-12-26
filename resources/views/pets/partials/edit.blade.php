<!-- Attachment Modal -->
<div class="modal fade" id="pet-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.pet')}} {{__('translate.edit')}}
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
                        <div class="col-md-7">

                            <!-- owner -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pet-edit-owner_id">{{__('translate.owner')}}*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex">
                                        <select id="pet-edit-owner_id" name="owner_id" required></select>
                                        <a href="/clinics/{{$clinic->id}}/owners") }}" id="owner-new-button"
                                            class="btn btn-sm btn-primary">{{__('translate.go')}}</a>
                                    </div>
                                    <small class="form-text text-muted">{{__('help.owner_select')}}</small>
                                    @error('owner_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- name -->
                            <label for="pet-edit-name" class="text-md-right">{{__('translate.name')}}*</label>
                            <input id="pet-edit-name" type="text"
                                class="form-control  form-control-sm @error('name') is-invalid @enderror" name="name"
                                value="" autocomplete="name" required maxlength="255">
                            <small class="form-text text-muted">{{__('help.pet_name')}}</small>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <!-- species -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pet-edit-species_id">{{__('translate.species')}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select id="pet-edit-species_id" name="species_id" class="form-control"
                                        required></select>
                                    <small class="form-text text-muted">{{__('help.species_select')}}</small>
                                    @error('species_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- breed -->
                            <label for="pet-edit-breed" class="text-md-right">{{__('translate.breed')}}</label>
                            <input id="pet-edit-breed" type="text"
                                class="form-control  form-control-sm @error('breed') is-invalid @enderror" name="breed"
                                value="" autocomplete="breed" maxlength="255">
                            <small class="form-text text-muted">{{__('help.pet_breed')}}</small>
                            @error('breed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            
                            <!-- sex and color -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="pet-edit-sex" class="text-md-right">{{__('translate.sex')}}*</label>
                                    <select name="sex" class="form-control" id="pet-edit-sex">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                        <option value="0">0</option>
                                    </select>

                                    <small class="form-text text-muted">{{__('help.pet_sex')}}</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="pet-edit-color" class="text-md-right">{{__('translate.color')}}*</label>
                                    <input id="pet-edit-color" type="text"
                                        class="form-control  form-control-sm @error('color') is-invalid @enderror"
                                        name="color" value="" autocomplete="color" maxlength="255">
                                    <small class="form-text text-muted">{{__('help.pet_color')}}</small>

                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- description -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pet-edit-description">{{__('translate.description')}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea id="pet-edit-description" name="description" rows="3" cols="50"
                                        class="form-contro form-control-sml">{{{ old('description') }}}</textarea>

                                    <small class="form-text text-muted">{{__('help.pet_description')}}</small>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- age -->
                            <div class="row">
                                <!-- date of birth -->
                                <div class="col-md-3">
                                    <label for="pet-edit-date_of_birth"
                                        class="text-md-right">{{__('translate.date_of_birth')}}*</label>
                                    <input id="pet-edit-date_of_birth" type="text"
                                        class="form-control form-control-sm datepicker @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="" autocomplete="date_of_birth" required
                                        maxlength="64">
                                    <small class="form-text text-muted">{{__('help.pet_date_of_birth')}}</small>
                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- date of death -->
                                <div class="col-md-3">
                                    <label for="pet-edit-date_of_death"
                                        class="text-md-right">{{__('translate.date_of_death')}}</label>
                                    <input id="pet-edit-date_of_death" type="text"
                                        class="form-control form-control-sm input-sm datepicker @error('date_of_death') is-invalid @enderror"
                                        name="date_of_death" value="" autocomplete="date_of_death"
                                        maxlength="64">
                                    <small class="form-text text-muted">{{__('help.pet_date_of_death')}}</small>
                                    @error('date_of_death')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- years -->
                                <div class="col-md-2">
                                    <label for="pet-edit-age-years"
                                        class="text-md-right">{{__('translate.years')}}</label>
                                    <input id="pet-edit-age-years" type="text" class="form-control form-control-sm"
                                        value="">
                                </div>

                                <!-- months -->
                                <div class="col-md-2">
                                    <label for="pet-edit-age-months"
                                        class="text-md-right">{{__('translate.months')}}</label>
                                    <input id="pet-edit-age-months" type="text" class="form-control form-control-sm"
                                        value="">
                                </div>

                                <!-- days -->
                                <div class="col-md-2">
                                    <label for="pet-edit-age-days"
                                        class="text-md-right">{{__('translate.days')}}</label>
                                    <input id="pet-edit-age-days" type="text" class="form-control form-control-sm"
                                        value="">
                                </div>

                            </div>
                        </div>

                        <!-- column 2 -->
                        <div class="col-md-5">
                            <fieldset>
                                <legend>{{__('translate.microchip')}}</legend>

                                <!-- microchip -->
                                <label for="pet-edit-microchip"
                                    class="text-md-right">{{__('translate.microchip')}}</label>
                                <input id="pet-edit-microchip" type="text"
                                    class="form-control form-control-sm @error('microchip') is-invalid @enderror"
                                    name="microchip" value="" autocomplete="microchip" maxlength="64">
                                <small class="form-text text-muted">{{__('help.pet_microchip')}}</small>
                                @error('microchip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <!-- microchip_location -->
                                <label for="pet-edit-microchip_location"
                                    class="text-md-right">{{__('translate.microchip_location')}}</label>
                                <input id="pet-edit-microchip_location" type="text"
                                    class="form-control form-control-sm @error('microchip_location') is-invalid @enderror"
                                    name="microchip_location" value="" autocomplete="microchip_location"
                                    maxlength="100">
                                <small class="form-text text-muted">{{__('help.pet_microchip_location')}}</small>
                                @error('microchip_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </fieldset>


                            <fieldset>
                                <legend>{{__('translate.tatuatge')}}</legend>

                                <!-- tatuatge -->
                                <label for="pet-edit-tatuatge"
                                    class="text-md-right">{{__('translate.tatuatge')}}</label>
                                <input id="pet-edit-tatuatge" type="text"
                                    class="form-control form-control-sm @error('tatuatge') is-invalid @enderror"
                                    name="tatuatge" value="" autocomplete="tatuatge" maxlength="64">
                                <small class="form-text text-muted">{{__('help.pet_tatuatge')}}</small>
                                @error('tatuatge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <!-- tatuatge_location -->
                                <label for="pet-edit-tatuatge_location"
                                    class="text-md-right">{{__('translate.tatuatge_location')}}</label>
                                <input id="pet-edit-tatuatge_location" type="text"
                                    class="form-control form-control-sm @error('tatuatge_location') is-invalid @enderror"
                                    name="tatuatge_location" value="" autocomplete="tatuatge_location"
                                    maxlength="100">
                                <small class="form-text text-muted">{{__('help.pet_tatuatge_location')}}</small>
                                @error('tatuatge_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

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

<!-- select2 -->
<script type="text/javascript" src="{{url('/lib/select2/4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2/4.1.0-beta.1/dist/css/select2.min.css')}}" />

<!-- datatable -->
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker/1.9.0/dist/js/bootstrap-datepicker.min.js')}}"
    charset="UTF-8"></script>
@if(auth()->user()->locale->id != 'en-US')
<script type="text/javascript"
    src="{{url('/lib/bootstrap-datepicker/1.9.0/dist/locales/bootstrap-datepicker.' . auth()->user()->locale->short_code . '.min.js')}}"
    charset="UTF-8"></script>
@endif
<link rel="stylesheet" type="text/css"
    href="{{url('/lib/bootstrap-datepicker/1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />

<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment/2.27.0/moment-with-locales.js')}}"></script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#pet-edit-species_id").select2({
            ajax: { 
                placeholder: "Choose species...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/species/search/",
                dataType: "json",
                dropdownAutoWidth : true,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });


        $("#pet-edit-owner_id").select2({
            ajax: { 
                placeholder: "Choose owner...",
                minimumInputLength: 3,
                url: "/clinics/{{$clinic->id}}/owners/search/",
                dataType: "json",
                dropdownAutoWidth : true,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        
        var date_of_death = $('#pet-edit-date_of_death').datepicker({
            // format: "dd/mm/yyyy",
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            
        }).on('hide', function(e) {
            setAge('edit');
        });

        var date_of_birth = $('#pet-edit-date_of_birth').datepicker({
            // format: "dd/mm/yyyy",
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
        }).on('changeDate', function(e) {
            
        }).on('hide', function(e) {
            $('#pet-edit-date_of_death').datepicker('setStartDate', $('#pet-edit-date_of_birth').val() );
            setAge('edit');
        });

        
    });
</script>

@endpush