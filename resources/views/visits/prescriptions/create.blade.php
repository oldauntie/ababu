<div class="modal modal-xl fade" id="prescription-create-modal" tabindex="-1" aria-labelledby="prescription-create-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="prescription-create-modal-label">{{ __('translate.prescription_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                if="prescription-create-form"
                action="{{ route('clinics.owners.pets.prescriptions.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="prescription-create-medicine_id" name="medicine_id" aria-label="" required></select>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select id="prescription-create-problem_id" name="problem_id" class="form-control" aria-label="" required>
                            <option value> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="prescription-create-prescription_date" name="prescription_date"
                            value="{{ date('Y-m-d') }}"
                            class="form-control @error('prescription_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.prescription_date') }}" aria-label="" required>
                        <label for="prescription-create-prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="prescription-create-quantity" name="quantity" value="{{ old('quantity') }}"
                            class="form-control @error('quantity') is-invalid @enderror"
                            placeholder = "{{ __('translate.quantity') }}" aria-label="" required>
                        <label for="prescription-create-quantity">{{ __('translate.quantity') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="prescription-create-dosage" name="dosage" value="{{ old('dosage') }}"
                            class="form-control @error('dosage') is-invalid @enderror"
                            placeholder = "{{ __('translate.dosage') }}" aria-label="" maxlength="50" required>
                        <label for="prescription-create-dosage">{{ __('translate.dosage') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="prescription-create-duration" name="duration" value="{{ old('duration') }}"
                            class="form-control @error('duration') is-invalid @enderror"
                            placeholder = "{{ __('translate.duration') }}" aria-label="" maxlength="50" required>
                        <label for="prescription-create-duration">{{ __('translate.duration') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="prescription-create-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="prescription-create-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="prescription-create-print_notes" name="print_notes" class="form-check-input" role="switch">
                        <label class="form-check-label" for="prescription-create-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="prescription-create-in_evidence" name="in_evidence" class="form-check-input" role="switch">
                        <label class="form-check-label" for="prescription-create-in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $("#prescription-create-problem_id").select2({
            dropdownParent: $('#prescription-create-modal'),
            width: '100%',
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            width: '100%',
        });


        $('#prescription-create-medicine_id').select2({
            dropdownParent: $('#prescription-create-modal'),
            width: '100%',
            ajax: {
                url: '{{ route('clinics.medicines.search', ['clinic' => $clinic]) }}',
                type: "GET",
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
            }
        });
    });
</script>
