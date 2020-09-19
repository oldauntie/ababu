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
<div class="modal fade" id="examination-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.examination')}} {{__('translate.insert')}} /
                    {{__('translate.edit')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="examination-edit-modal-form" action="">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">

                        <!-- column 1 -->
                        <div class="col-md-12">
                            <fieldset>
                                <legend>{{__('translate.examination')}}</legend>
                                <!-- Medicine name -->
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <label for="examination-edit-medicine"
                                            class="text-md-right">{{__('translate.medicine')}}</label>
                                        <input type="hidden" name="medicine_id" value="" id="examination-edit-medicine_id">
                                        <input type="text" name="medicine" value="" id="examination-edit-medicine"
                                            class="form-control form-control-sm" disabled>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <!-- Date of examination -->
                                    <div class="col-3">
                                        <label for="examination-edit-date_of_examination"
                                            class="text-md-right">{{__('translate.date_of_examination')}}*</label>
                                        <input name="date_of_examination" value="" type="text"
                                            id="examination-edit-date_of_examination"
                                            class="form-control form-control-sm" disabled>
                                    </div>
                                    <!-- Quantity -->
                                    <div class="col-2">
                                        <label for="examination-edit-quantity"
                                            class="text-md-right">{{__('translate.quantity')}}*</label>
                                        <input type="number" name="quantity" value="" id="examination-edit-quantity"
                                            min="0" max="99"
                                            class="form-control form-control-sm @error('quantity') is-invalid @enderror"
                                            autocomplete="quantity" required autofocus>
                                    </div>
                                    <!-- Dosage -->
                                    <div class="col-3">
                                        <label for="examination-edit-dosage"
                                            class="text-md-right">{{__('translate.dosage')}}*</label>
                                        <input type="text" name="dosage" value="" id="examination-edit-dosage"
                                            maxlength="255"
                                            class="form-control form-control-sm @error('dosage') is-invalid @enderror"
                                            autocomplete="dosage" required autofocus>
                                    </div>
                                    <!-- In Evidence -->
                                    <div class="col-4 align-self-end">
                                        <div class="checkbox">
                                            <img class="align-center" title="{{ __('translate.in_evidence') }}"
                                                src="{{url('/images/icons/in_evidence.png')}}">
                                            <input type="checkbox" name="in_evidence" value="1"
                                                id="examination-edit-in_evidence">
                                            <label class="align-center" style="margin-bottom: 0px;"
                                                for="examination-edit-in_evidence">
                                                {{ __('translate.in_evidence') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Problem -->
                                <div class="row">
                                    <div class="col-12">
                                        <label for="examination-edit-problem"
                                            class="text-md-right">{{__('translate.problem')}}</label>
                                        <div class="input-group">
                                            <select name="problem" id="examination-edit-problem"
                                                class="form-control form-control-sm" disabled>
                                                <option value="">{{ __('translate.problem_indipendent') }}</option>
                                                @foreach ($problems as $problem)
                                                <option value="{{ $problem->id }}">{{ $problem->diagnosis->term_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="problem_id" value=""
                                                id="examination-edit-problem_id">
                                            <button type="button" id="lock" class="btn btn-light lock"
                                                data-toggle="button" aria-pressed="false" autocomplete="off"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="row">
                                    <div class="col-12">
                                        <label for="examination-edit-notes"
                                            class="text-md-right">{{__('translate.notes')}}</label>
                                        <div class="input-group">
                                            <textarea name="notes" id="examination-edit-notes" rows="2"
                                                style="min-width: 100%"
                                                class="form-control form-control-sml">{{ old('notes') }}</textarea>

                                            <small
                                                class="form-text text-muted">{{__('help.examination_notes')}}</small>
                                            @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input type="checkbox" name="print_notes" value="1"
                                            id="examination-edit-print_notes">
                                        <label for="examination-edit-print_notes"
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
                            <button type="button" id="examination-edit-delete-button" class="btn btn-danger btn-sm">{{__('translate.delete')}}</button>
                            <button type="button" id="examination-edit-print-button" class="btn btn-info btn-sm">{{__('translate.print')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('translate.close')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer justify-content-between">
                <div class="row" style="width: 95%">
                    <div class="col-2">{{ __('translate.created_at') }}</div>
                    <div class="col-2" id="examination-edit-created_at">00:00:00</div>
                    <div class="col-2">{{ __('translate.updated_at') }}</div>
                    <div class="col-2" id="examination-edit-updated_at">00:00:00</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        // lock / unlock button
        $('#lock').click(function(){
            // change icon
            $(this).toggleClass( 'lock unlock' );
            // unlock problem_id control
            var status = $('#examination-edit-problem').prop('disabled');
            $('#examination-edit-problem').prop('disabled', !status);
        })

        // on problem change set problem_id hidden input value 
        $('#examination-edit-problem').on('change', function(){
            $('#examination-edit-problem_id').val($(this).val());
        });
    });
</script>

@endpush