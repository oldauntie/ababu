<div class="modal modal-xl fade" id="examinations-edit-modal" tabindex="-1" aria-labelledby="examinations-edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="examinations-edit-modal-label">{{ __('translate.examination_edit') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                if="examinations-edit-form"
                action=""
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" id="examinations-edit-diagnostic_test" name=""
                            value=""
                            class="form-control"
                            placeholder = "{{ __('translate.diagnostic_test') }}" aria-label="" readonly disabled>
                        <label for="examinations-edit-diagnostic_test">{{ __('translate.diagnostic_test') }}</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select id="examinations-edit-problem_id" name="problem_id" class="form-control" aria-label="">
                            <option value>{{ __('translate.problem_indipendent') }}</option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-edit-is_pathologic" name="is_pathologic" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-edit-is_pathologic">{{ __('translate.is_pathologic') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="examinations-edit-examination_date" name="examination_date"
                            value="{{ date('Y-m-d\TH:i') }}"
                            class="form-control @error('examination_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.examination_date') }}" aria-label="" required>
                        <label for="examinations-edit-examination_date">{{ __('translate.examination_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="examinations-edit-result" name="result" value="{{ old('result') }}"
                            class="form-control @error('result') is-invalid @enderror"
                            placeholder = "{{ __('translate.result') }}" aria-label="">
                        <label for="examinations-edit-result">{{ __('translate.result') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="examinations-edit-medical_report" name="medical_report" class="form-control @error('medical_report') is-invalid @enderror"
                            placeholder="{{ __('translate.medical_report') }}" style="height: 100px">{{ old('medical_report') }}</textarea>
                        <label for="examinations-edit-medical_report">{{ __('translate.medical_report') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="examinations-edit-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="examinations-edit-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-edit-print_notes" name="print_notes" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-edit-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-edit-in_evidence" name="in_evidence" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-edit-in_evidence">{{ __('translate.in_evidence') }}</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">{{ __('translate.close') }}</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('translate.save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script type="module">
    $(function() {
        $('#examinations-edit-modal').on('show.bs.modal', function(e) {
            let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
            let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
            console.log('raised show.bs.modal event from button with data-id=' + id);

            $.ajax({
                url: "/clinics/{{ $clinic->id }}/examinations/" + id + "/get",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(examination) {                    
                    console.log(examination);
                    console.log(examination.examination_date.substring(0,10));
                    let url = '/clinics/{{ $clinic->id }}/owners/{{ $owner->id }}/pets/{{ $pet->id}}/examinations/' + examination.id;
                    console.log(url);
                    // $('#examinations-edit-form').attr('action', url);
                    $('#examinations-edit-diagnostic_test').val(examination.diagnostic_test.term_name); // this input is disabled

                    /*
                    $('#examinations-edit-problem_id').val(prescription.problem_id); // Select the option with the problem_id value
                    $('#examinations-edit-problem_id').trigger('change'); // Notify any JS components that the value changed
                    
                    $('#examinations-edit-prescription_date').val(prescription.prescription_date.substring(0,10));
                    $('#examinations-edit-quantity').val(prescription.quantity);
                    $('#examinations-edit-dosage').val(prescription.dosage);
                    $('#examinations-edit-duration').val(prescription.duration);
                    $('#examinations-edit-notes').val(prescription.notes);
                    
                    $('#examinations-edit-print_notes').prop('checked', prescription.print_notes);
                    $('#examinations-edit-in_evidence').prop('checked', prescription.in_evidence);
                    */
                }
            });
        });

        // transform standard select input into select2
        $("#examinations-edit-problem_id").select2({
            dropdownParent: $('#examinations-edit-modal'),
            width: '100%',
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            width: '100%',
        });
    });
</script>
