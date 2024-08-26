<div class="modal modal-xl fade" id="edit-prescription-modal" tabindex="-1" aria-labelledby="edit-prescription-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-prescription-modal-label">{{ __('translate.prescription_edit') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                action="{{ route('clinics.owners.pets.prescriptions.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="medicine_id" id="edit-prescription-medicine_id" name="medicine_id"
                            value="{{ old('medicine_id') }}"
                            class="form-control @error('medicine_id') is-invalid @enderror"
                            placeholder = "{{ __('translate.medicine_id') }}" aria-label="" readonly disabled>
                        <label for="edit-prescription-medicine_id">{{ __('translate.medicine') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="edit-prescription-problem_id" name="problem_id" class="form-control" aria-label=""
                            required>
                            <option value="0"> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="edit-prescription-prescription_date" name="prescription_date"
                            value="{{ date('Y-m-d') }}"
                            class="form-control @error('prescription_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.prescription_date') }}" aria-label="" required>
                        <label for="edit-prescription-prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="edit-prescription-quantity" name="quantity"
                            value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror"
                            placeholder = "{{ __('translate.quantity') }}" aria-label="" required>
                        <label for="edit-prescription-quantity">{{ __('translate.quantity') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="edit-prescription-dosage" name="dosage" value="{{ old('dosage') }}"
                            class="form-control @error('dosage') is-invalid @enderror"
                            placeholder = "{{ __('translate.dosage') }}" maxlength="50" aria-label="" required>
                        <label for="edit-prescription-dosage">{{ __('translate.dosage') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="edit-prescription-duration" name="duration"
                            value="{{ old('duration') }}" class="form-control @error('duration') is-invalid @enderror"
                            placeholder = "{{ __('translate.duration') }}" maxlength="50" aria-label="" required>
                        <label for="edit-prescription-duration">{{ __('translate.duration') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="edit-prescription-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="edit-prescription-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="edit-prescription-print_notes" name="print_notes"
                            class="form-check-input" role="switch">
                        <label class="form-check-label"
                            for="edit-prescription-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="edit-prescription-in_evidence" name="in_evidence"
                            class="form-check-input" role="switch">
                        <label class="form-check-label"
                            for="edit-prescription-in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $('#edit-prescription-modal').on('show.bs.modal', function(e) {
            let btn = $(e
                .relatedTarget
            ); // e.related here is the element that opened the modal, specifically the row button
            let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
            console.log('raised show.bs.modal event from button with data-id=' + id);

            $.ajax({
                url: "/clinics/{{ $clinic->id }}/prescriptions/" + id + "/get",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(prescription) {                    
                    console.log(prescription);
                    console.log(prescription.prescription_date.substring(0,10));
                    
                    $('#edit-prescription-medicine_id').val(prescription.medicine.name); // this input is disabled

                    $('#edit-prescription-problem_id').val(prescription.problem_id); // Select the option with the problem_id value
                    $('#edit-prescription-problem_id').trigger('change'); // Notify any JS components that the value changed
                    
                    $('#edit-prescription-prescription_date').val(prescription.prescription_date.substring(0,10));
                    $('#edit-prescription-quantity').val(prescription.quantity);
                    $('#edit-prescription-dosage').val(prescription.dosage);
                    $('#edit-prescription-duration').val(prescription.duration);
                    $('#edit-prescription-notes').val(prescription.notes);
                    
                    $('#edit-prescription-print_notes').prop('checked', prescription.print_notes);
                    $('#edit-prescription-in_evidence').prop('checked', prescription.in_evidence);
                }
            });
        });

        // transform standard select input into select2
        $("#edit-prescription-problem_id").select2({
            dropdownParent: $('#edit-prescription-modal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem') }}",
            tokenSeparators: [','],
            width: '100%',
        });



    });
</script>
