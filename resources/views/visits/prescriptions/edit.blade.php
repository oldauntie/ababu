<div class="modal modal-xl fade" id="prescriptions-edit-modal" tabindex="-1" aria-labelledby="prescriptions-edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="prescriptions-edit-modal-label">{{ __('translate.prescription_edit') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                id="prescriptions-edit-form"
                action=""
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="medicine_id" id="prescriptions-edit-medicine_id" name="medicine_id"
                            value="{{ old('medicine_id') }}"
                            class="form-control @error('medicine_id') is-invalid @enderror"
                            placeholder = "{{ __('translate.medicine_id') }}" aria-label="" readonly disabled>
                        <label for="prescriptions-edit-medicine_id">{{ __('translate.medicine') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="prescriptions-edit-problem_id" name="problem_id" class="form-control" aria-label="">
                            {{--
                            <option value=""> -- {{ __('translate.problem_indipendent') }} -- </option>
                            --}}
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="prescriptions-edit-prescription_date" name="prescription_date"
                            value="{{ date('Y-m-d') }}"
                            class="form-control @error('prescription_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.prescription_date') }}" aria-label="" required>
                        <label for="prescriptions-edit-prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="prescriptions-edit-quantity" name="quantity"
                            value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror"
                            placeholder = "{{ __('translate.quantity') }}" aria-label="" required>
                        <label for="prescriptions-edit-quantity">{{ __('translate.quantity') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="prescriptions-edit-dosage" name="dosage" value="{{ old('dosage') }}"
                            class="form-control @error('dosage') is-invalid @enderror"
                            placeholder = "{{ __('translate.dosage') }}" maxlength="50" aria-label="" required>
                        <label for="prescriptions-edit-dosage">{{ __('translate.dosage') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="prescriptions-edit-duration" name="duration"
                            value="{{ old('duration') }}" class="form-control @error('duration') is-invalid @enderror"
                            placeholder = "{{ __('translate.duration') }}" maxlength="50" aria-label="" required>
                        <label for="prescriptions-edit-duration">{{ __('translate.duration') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="prescriptions-edit-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="prescriptions-edit-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="prescriptions-edit-print_notes" name="print_notes"
                            class="form-check-input" role="switch">
                        <label class="form-check-label"
                            for="prescriptions-edit-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="prescriptions-edit-in_evidence" name="in_evidence"
                            class="form-check-input" role="switch">
                        <label class="form-check-label"
                            for="prescriptions-edit-in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $('#prescriptions-edit-modal').on('show.bs.modal', function(e) {
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
                    let url = '/clinics/{{ $clinic->id }}/owners/{{ $owner->id }}/pets/{{ $pet->id}}/prescriptions/' + prescription.id;
                    console.log(url);
                    $('#prescriptions-edit-form').attr('action', url);
                    $('#prescriptions-edit-medicine_id').val(prescription.medicine.name); // this input is disabled

                    $('#prescriptions-edit-problem_id').val(prescription.problem_id); // Select the option with the problem_id value
                    $('#prescriptions-edit-problem_id').trigger('change'); // Notify any JS components that the value changed
                    
                    $('#prescriptions-edit-prescription_date').val(prescription.prescription_date.substring(0,10));
                    $('#prescriptions-edit-quantity').val(prescription.quantity);
                    $('#prescriptions-edit-dosage').val(prescription.dosage);
                    $('#prescriptions-edit-duration').val(prescription.duration);
                    $('#prescriptions-edit-notes').val(prescription.notes);
                    
                    $('#prescriptions-edit-print_notes').prop('checked', prescription.print_notes);
                    $('#prescriptions-edit-in_evidence').prop('checked', prescription.in_evidence);
                }
            });
        });

        // transform standard select input into select2
        $("#prescriptions-edit-problem_id").select2({
            dropdownParent: $('#prescriptions-edit-modal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            tokenSeparators: [','],
            width: '100%',
        });



    });
</script>
