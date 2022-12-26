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
<div class="modal fade" id="treatment-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.treatment')}} / {{__('translate.vaccination')}}
                    ({{__('translate.insert')}} /
                    {{__('translate.edit')}})
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="treatment-edit-modal-form" action="">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">

                        <!-- column 1 -->
                        <div class="col-md-12">
                            <fieldset>
                                <legend>{{__('translate.treatment')}}</legend>
                                <!-- Procedure name -->
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <label for="treatment-edit-procedure"
                                            class="text-md-right">{{__('translate.procedure')}}</label>
                                        <div class="input-group">
                                            <input type="text" name="procedure_id" value=""
                                                id="treatment-edit-procedure_id" readonly>
                                            <input type="text" name="procedure" value="" id="treatment-edit-procedure"
                                                class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>{{__('translate.notes')}}</legend>

                                <!-- Executed At / Recall At -->
                                <div class="row">
                                    <div class="col-6">
                                        <label class="align-center" style="" for="treatment-edit-executed_at">
                                            {{ __('translate.executed_at') }}
                                        </label>
                                        <input name="executed_at" value="" type="text" id="treatment-edit-executed_at"
                                            class="">
                                    </div>
                                    <div class="col-6">
                                        <label class="align-center" style="" for="treatment-edit-recall_at">
                                            {{ __('translate.recall_at') }}
                                        </label>
                                        <input name="recall_at" value="" type="text" id="treatment-edit-recall_at"
                                            class="">
                                    </div>
                                </div>


                                <!-- Drug Batch -->
                                <div class="row">
                                    <div class="col-6">
                                        <label class="align-center" style="" for="treatment-edit-drug_batch">
                                            {{ __('translate.drug_batch') }}
                                        </label>
                                        <input name="drug_batch" value="" type="text" id="treatment-edit-drug_batch"
                                            class="">
                                    </div>
                                    <div class="col-6">
                                        <label class="align-center" style="" for="treatment-edit-drug_batch_expires_at">
                                            {{ __('translate.expires_at') }}
                                        </label>
                                        <input name="drug_batch_expires_at" value="" type="text"
                                            id="treatment-edit-drug_batch_expires_at" class="">
                                    </div>
                                </div>


                                <!-- Notes -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <textarea name="notes" id="treatment-edit-notes" rows="5"
                                                style="min-width: 100%"
                                                class="form-control form-control-sml">{{ old('notes') }}</textarea>

                                            <small class="form-text text-muted">{{__('help.treatment_notes')}}</small>
                                            @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <input type="checkbox" name="print_notes" value="1"
                                            id="treatment-edit-print_notes">
                                        <label for="treatment-edit-print_notes">{{ __('translate.print_notes')}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.save')}}</button>
                            <button type="button" id="treatment-edit-delete-button"
                                class="btn btn-danger btn-sm">{{__('translate.delete')}}</button>
                            <button type="button" id="treatment-edit-print-button"
                                class="btn btn-info btn-sm">{{__('translate.print')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-dismiss="modal">{{__('translate.close')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer justify-content-left">
                <div class="row" style="width: 95%">
                    <div class="col-2">{{ __('translate.created_at') }}</div>
                    <div class="col-3" id="treatment-edit-created_at"></div>
                    <div class="col-2">{{ __('translate.updated_at') }}</div>
                    <div class="col-3" id="treatment-edit-updated_at"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        // enable datepicker for control
        var active_from = $('#treatment-edit-recall_at').datepicker({
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            //
        }).on('hide', function(e) {
            //
        });

        // enable datepicker for control
        var active_from = $('#treatment-edit-executed_at').datepicker({
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            //
        }).on('hide', function(e) {
            //
        });

        // enable datepicker for control
        var active_from = $('#treatment-edit-drug_batch_expires_at').datepicker({
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            //
        }).on('hide', function(e) {
            //
        });

        // delete button
        $(document).on('click', '#treatment-edit-delete-button', function(e){
            e.preventDefault();
            bootbox.confirm({
                title: "{{__('translate.treatment')}} {{__('translate.delete')}}",
                message: "<div>{{ __('message.are_you_sure') }}</div><small> {{__('help.treatment_delete')}} </small>",
                className: 'rubberBand animated',
                callback: function(result) {
                    if (result) {
                        // get button value
                        var id = e.target.value;
                        $('#treatment-edit-delete-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments/' + id);
                        $('#treatment-edit-delete-form').submit();
                    }
                }
            });
        });

        // print button
        $(document).on('click', '#treatment-edit-print-button', function(e){            
            var id = e.target.value;
            
            print_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments/' + id + '/print';
            window.open(print_url);
        });

    });


    // retrieve an empty examination and pass it to 
    function createTreatment(procedure_id){
        create_url = '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments/' + procedure_id + '/create';
        
        // alert(create_url);
        $.ajax({
            url: create_url,
            type: 'get',
            success: function(treatment)
            {
                openTreatmentEditModal(treatment);
            }
        });
    }

    // retrieve a treatment given an id
    function editTreatment(id){
        $.ajax({
            url: '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments/' + id + '/edit',
            type: 'get',
            success: function(treatment)
            {
                openTreatmentEditModal(treatment);
            }
        });
    }


    // open treatment form for edit
    function openTreatmentEditModal(treatment){
        // @tbe
        // console.log(treatment);
        
        $("#treatment-edit-procedure_id").val(treatment.procedure.id);
        $("#treatment-edit-procedure").val(treatment.procedure.term_name);
        
        $("#treatment-edit-executed_at").val(treatment.executed_at);
        $("#treatment-edit-recall_at").val(treatment.recall_at);
        $("#treatment-edit-drug_batch").val(treatment.drug_batch);
        $("#treatment-edit-drug_batch_expires_at").val(treatment.drug_batch_expires_at);
        $("#treatment-edit-notes").val(treatment.notes);
        $('#treatment-edit-print_notes').prop("checked", !! + treatment.print_notes);

        $('#treatment-edit-created_at').html(treatment.created_at);
        $('#treatment-edit-updated_at').html(treatment.updated_at);

        // Set action and method
        if(treatment.id > 0)
        {
            $('#treatment-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments/' + treatment.id);
            $('#treatment-edit-modal-form input[name="_method"]').val('PUT');
            $('#treatment-edit-delete-button').attr('disabled', false);
            $('#treatment-edit-delete-button').val(treatment.id);
            $('#treatment-edit-print-button').attr('disabled', false);
            $('#treatment-edit-print-button').val(treatment.id);
        }else{
            $('#treatment-edit-modal-form').attr('action', '/clinics/{{$clinic->id}}/pets/{{$pet->id}}/treatments');
            $('#treatment-edit-modal-form input[name="_method"]').val('POST');
            $('#treatment-edit-delete-button').attr('disabled', true);
            $('#treatment-edit-print-button').attr('disabled', true);
        }

        $('#treatment-edit-modal').modal('show');
    }

    // href=""
</script>

@endpush