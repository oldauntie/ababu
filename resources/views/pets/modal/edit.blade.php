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


                            <!-- name -->
                            <label for="pet-edit-name" class="text-md-right">{{__('translate.name')}}*</label>
                            <input id="pet-edit-name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name" value=""
                                autocomplete="name" required autofocus maxlength="255">
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
                                    <select id="pet-edit-species_id" name="species_id" class="form-control" required></select>
                                    <small class="form-text text-muted">{{__('help.species_select')}}</small>
                                    @error('species_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- owner -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pet-edit-owner_id">{{__('translate.owner')}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select id="pet-edit-owner_id" name="owner_id" class="form-control" required></select>
                                    <small class="form-text text-muted">{{__('help.owner_select')}}</small>
                                    @error('owner_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- sex and color -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="pet-edit-sex" class="text-md-right">{{__('translate.sex')}}*</label>
                                    <input id="pet-edit-sex" type="text"
                                        class="form-control @error('sex') is-invalid @enderror" name="sex" value=""
                                        autocomplete="sex" autofocus maxlength="255">
                                    <small class="form-text text-muted">{{__('help.pet_sex')}}</small>
                                    @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="pet-edit-color" class="text-md-right">{{__('translate.color')}}*</label>
                                    <input id="pet-edit-color" type="text"
                                        class="form-control @error('color') is-invalid @enderror" name="color" value=""
                                        autocomplete="color" autofocus maxlength="255">
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
                                    <textarea id="pet-edit-description" name="description" rows="3" cols="50" onKeyPress
                                        class="form-control">{{{ old('description') }}}</textarea>

                                    <small class="form-text text-muted">{{__('help.pet_description')}}</small>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- age -->
                            <fieldset style="border: thin solid black; padding: 7px">
                                <legend style="padding: 7px">{{__('translate.age')}}</legend>







                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- date of birth -->
                                        <label for="pet-edit-date_of_birth"
                                            class="text-md-right">{{__('translate.date_of_birth')}}*</label>
                                        <input id="pet-edit-date_of_birth" type="text"
                                            class="form-control datepicker @error('date_of_birth') is-invalid @enderror"
                                            name="date_of_birth" value="" autocomplete="date_of_birth" required
                                            autofocus maxlength="64">
                                        <small class="form-text text-muted">{{__('help.age')}}</small>
                                        @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <!-- date of death -->
                                        <label for="pet-edit-date_of_death"
                                            class="text-md-right">{{__('translate.date_of_death')}}</label>
                                        <input id="pet-edit-date_of_death" type="text"
                                            class="form-control datepicker @error('date_of_death') is-invalid @enderror"
                                            name="date_of_death" value="" autocomplete="date_of_death" autofocus
                                            maxlength="64">
                                        <small class="form-text text-muted">{{__('help.age')}}</small>
                                        @error('date_of_death')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </fieldset>


                        </div>

                        <!-- column 2 -->
                        <div class="col-md-5">
                            <fieldset style="border: thin solid black; padding: 7px">
                                <legend style="padding: 7px">{{__('translate.microchip')}}</legend>

                                <label for="pet-edit-microchip"
                                    class="text-md-right">{{__('translate.microchip')}}*</label>
                                <input id="pet-edit-microchip" type="text"
                                    class="form-control @error('microchip') is-invalid @enderror" name="microchip"
                                    value="" autocomplete="microchip" autofocus maxlength="64">
                                <small class="form-text text-muted">{{__('help.microchip')}}</small>

                                @error('microchip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="pet-edit-microchip_location"
                                    class="text-md-right">{{__('translate.microchip_location')}}</label>
                                <input id="pet-edit-microchip_location" type="text"
                                    class="form-control @error('microchip_location') is-invalid @enderror"
                                    name="microchip_location" value="" autocomplete="microchip_location" required
                                    autofocus maxlength="100">
                                <small class="form-text text-muted">{{__('help.pet_name')}}</small>

                                @error('microchip_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </fieldset>


                            <fieldset style="border: thin solid black; padding: 7px">
                                <legend style="padding: 7px">{{__('translate.tatuatge')}}</legend>

                                <label for="pet-edit-tatuatge"
                                    class="text-md-right">{{__('translate.tatuatge')}}*</label>
                                <input id="pet-edit-tatuatge" type="text"
                                    class="form-control @error('tatuatge') is-invalid @enderror" name="tatuatge"
                                    value="" autocomplete="tatuatge" autofocus maxlength="64">
                                <small class="form-text text-muted">{{__('help.tatuatge')}}</small>

                                @error('tatuatge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="pet-edit-tatuatge_location"
                                    class="text-md-right">{{__('translate.tatuatge_location')}}</label>
                                <input id="pet-edit-tatuatge_location" type="text"
                                    class="form-control @error('tatuatge_location') is-invalid @enderror"
                                    name="tatuatge_location" value="" autocomplete="tatuatge_location" required
                                    autofocus maxlength="100">
                                <small class="form-text text-muted">{{__('help.pet_name')}}</small>

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
                            <button type="submit" class="btn btn-secondary btn-lg">{{__('translate.save')}}</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
<!-- /Attachment Modal -->
<style>
    select+.select2-container {
        width: 100% !important;
    }
</style>

@push('scripts')

<script type="text/javascript" src="{{url('/lib/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/lib/select2-4.1.0-beta.1/dist/css/select2.min.css')}}" />

<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/js/bootstrap-datepicker.min.js')}}">
</script>
<link rel="stylesheet" type="text/css"
    href="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />



<script type="text/javascript">
    $(document).ready(function(){
        $("#species_id").select2({
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

        $("#owner_id").select2({
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

        // $('.datepicker').datepicker();


        $('#pet-edit-date_of_birth').datepicker({
            format: "dd-M-yy",
            todayHighlight:'TRUE',
            autoclose: true,
            minDate: 0,
            maxDate: '+1Y+6M',
            onSelect: function (dateStr) {
                var min = $(this).datepicker('getDate'); 
                $("#pet-edit-date_of_death").datepicker('option', 'minDate', min || '0');
            }
        });
        

        $('#pet-edit-date_of_death').datepicker({
            format: "dd-M-yy",
            todayHighlight:'TRUE',
            autoclose: true,
            minDate: '0',
            maxDate: '+1Y+6M',
            onSelect: function (dateStr) {
                var max = $(this).datepicker('getDate'); 
                // $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M');
                var start = $("#pet-edit-date_of_birth").datepicker("getDate");
                var end = $("#pet-edit-date_of_death").datepicker("getDate");
                var days = (end - start) / (1000 * 60 * 60 * 24);
                // $("#days").val(days);
                console.log(days);
            }
        }); 


    });
</script>

@endpush