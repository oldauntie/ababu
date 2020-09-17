<style>
    .lock {
        width: 32px;
        height: 32px;
        background-image: url("{{url('/images/icons/lock.png')}}");
        background-repeat: no-repeat;
        background-position: center;
    }

    .unlock {
        width: 32px;
        height: 32px;
        background-image: url("{{url('/images/icons/lock_open.png')}}");
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<!-- Attachment Modal -->
<div class="modal fade" id="prescription-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.prescription')}} {{__('translate.insert')}} /
                    {{__('translate.edit')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="prescription-edit-modal-form" action="">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">

                        <!-- column 1 -->
                        <div class="col-md-12">
                            <fieldset>
                                <legend>{{__('translate.prescription')}}</legend>
                                <!-- Medicine name -->
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <label for="prescription-edit-medicine"
                                            class="text-md-right">{{__('translate.medicine')}}</label>
                                        <input type="hidden" name="medicine_id" value=""
                                            id="prescription-edit-medicine_id" class="form-control form-control-sm">
                                        <input type="text" name="medicine" value="" id="prescription-edit-medicine"
                                            class="form-control form-control-sm" disabled>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <!-- Date of prescription -->
                                    <div class="col-3">
                                        <label for="prescription-edit-date_of_prescription"
                                            class="text-md-right">{{__('translate.date_of_prescription')}}*</label>
                                        <input name="date_of_prescription" value="" type="text"
                                            id="prescription-edit-date_of_prescription"
                                            class="form-control form-control-sm" disabled>
                                    </div>
                                    <!-- Quantity -->
                                    <div class="col-2">
                                        <label for="prescription-edit-quantity"
                                            class="text-md-right">{{__('translate.quantity')}}*</label>
                                        <input type="number" name="quantity" value="" id="prescription-edit-quantity"
                                            min="0" max="99"
                                            class="form-control form-control-sm @error('quantity') is-invalid @enderror"
                                            autocomplete="quantity" required autofocus>
                                    </div>
                                    <!-- Dosage -->
                                    <div class="col-3">
                                        <label for="prescription-edit-dosage"
                                            class="text-md-right">{{__('translate.dosage')}}*</label>
                                        <input type="text" name="dosage" value="" id="prescription-edit-dosage"
                                            maxlength="255"
                                            class="form-control form-control-sm @error('dosage') is-invalid @enderror"
                                            autocomplete="dosage" required autofocus>
                                    </div>
                                    <!-- In Evidence -->
                                    <div class="col-4 align-self-end">
                                        <div class="checkbox">
                                            <img class="align-center" title="{{ __('translate.in_evidence') }}"
                                                src="{{url('/images/icons/prescription_in_evidence.png')}}">
                                            <input type="checkbox" name="in_evidence" value="1"
                                                id="prescription-edit-in_evidence">
                                            <label class="align-center" style="margin-bottom: 0px;"
                                                for="prescription-edit-in_evidence">
                                                {{ __('translate.in_evidence') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Problem -->
                                <div class="row">
                                    <div class="col-12">
                                        <label for="prescription-edit-problem"
                                            class="text-md-right">{{__('translate.problem')}}</label>
                                        <div class="input-group">
                                            <select name="problem" id="prescription-edit-problem"
                                                class="form-control form-control-sm" disabled>
                                                <option value="">{{ __('translate.problem_indipendent') }}</option>
                                                @foreach ($problems as $problem)
                                                <option value="{{ $problem->id }}">{{ $problem->diagnosis->term_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="problem_id" value=""
                                                id="prescription-edit-problem_id">
                                            <button type="button" id="lock" class="btn btn-light lock"
                                                data-toggle="button" aria-pressed="false" autocomplete="off"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="row">
                                    <div class="col-12">
                                        <label for="prescription-edit-notes"
                                            class="text-md-right">{{__('translate.notes')}}</label>
                                        <div class="input-group">
                                            <textarea name="notes" id="prescription-edit-notes" rows="2"
                                                style="min-width: 100%"
                                                class="form-control form-control-sml">{{ old('notes') }}</textarea>

                                            <small
                                                class="form-text text-muted">{{__('help.prescription_notes')}}</small>
                                            @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input type="checkbox" name="print_notes" value="1"
                                            id="prescription-edit-print_notes">
                                        <label for="prescription-edit-print_notes"
                                            name="print_notes">{{ __('translate.print_notes')}}</label>

                                    </div>
                                </div>

                            </fieldset>

                            <!-- clinical data -->
                            <fieldset>
                                <legend>{{__('translate.medicine_detail')}}</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        {{__('translate.medicine_detail')}}
                                    </div>
                                </div>
                            </fieldset>



                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.save')}}</button>
                            <button type="button" class="btn btn-danger btn-sm">{{__('translate.delete')}}</button>
                            <button type="button" class="btn btn-info btn-sm">{{__('translate.print')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('translate.close')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer justify-content-between">
                <div class="row" style="width: 95%">
                    <div class="col-2">{{ __('translate.created_at') }}</div>
                    <div class="col-2" id="prescription-edit-created_at">00:00:00</div>
                    <div class="col-2">{{ __('translate.updated_at') }}</div>
                    <div class="col-2" id="prescription-edit-updated_at">00:00:00</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')

<!-- datatable -->
<script type="text/javascript" src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/js/bootstrap-datepicker.min.js')}}"
    charset="UTF-8"></script>
@if(auth()->user()->locale->id != 'en-US')
<script type="text/javascript"
    src="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/locales/bootstrap-datepicker.' . auth()->user()->locale->short_code . '.min.js')}}"
    charset="UTF-8"></script>
@endif
<link rel="stylesheet" type="text/css"
    href="{{url('/lib/bootstrap-datepicker-v1.9.0/dist/css/bootstrap-datepicker.min.css')}}" />

<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment-v2.27.0/moment-with-locales.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function(){

        var active_from = $('#prescription-edit-active_from').datepicker({
            // format: "dd/mm/yyyy",
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            
        }).on('hide', function(e) {
            setAtAge();
        });

        // lock / unlock button
        $('#lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#prescription-edit-problem').prop('disabled');
            $('#prescription-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#prescription-edit-problem').on('change', function(){
            $('#prescription-edit-problem_id').val($(this).val());
        });

    });

    function setAtAge()
    {
        // active_from
        var a = moment().locale('{{auth()->user()->locale->short_code}}');
        
        // date of birth
        var b = moment().locale('{{auth()->user()->locale->short_code}}');

        if( $('#prescription-edit-active_from').val() != ''){
            a = moment($('#prescription-edit-active_from').val(), a.localeData().longDateFormat('L'));
        }

        b = moment('{{$pet->date_of_birth->format( auth()->user()->locale->date_short_format )}}', b.localeData().longDateFormat('L'));

        var years = a.diff(b, 'year');
        $('#prescription-edit-at_age').val(years);
    }
</script>

@endpush