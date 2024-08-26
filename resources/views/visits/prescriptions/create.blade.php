<div class="modal modal-xl fade" id="create-prescription-modal" tabindex="-1" aria-labelledby="create-prescription-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create-prescription-modal-label">{{ __('translate.prescription_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                action="{{ route('clinics.owners.pets.prescriptions.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="create-prescription-medicine_id" name="medicine_id" aria-label="" required></select>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select id="create-prescription-problem_id" name="problem_id" class="form-control" aria-label="" required>
                            <option value> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="create-prescription-prescription_date" name="prescription_date"
                            value="{{ date('Y-m-d') }}"
                            class="form-control @error('prescription_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.prescription_date') }}" aria-label="" required>
                        <label for="create-prescription-prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="create-prescription-quantity" name="quantity" value="{{ old('quantity') }}"
                            class="form-control @error('quantity') is-invalid @enderror"
                            placeholder = "{{ __('translate.quantity') }}" aria-label="" required>
                        <label for="create-prescription-quantity">{{ __('translate.quantity') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="create-prescription-dosage" name="dosage" value="{{ old('dosage') }}"
                            class="form-control @error('dosage') is-invalid @enderror"
                            placeholder = "{{ __('translate.dosage') }}" aria-label="" maxlength="50" required>
                        <label for="create-prescription-dosage">{{ __('translate.dosage') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="create-prescription-duration" name="duration" value="{{ old('duration') }}"
                            class="form-control @error('duration') is-invalid @enderror"
                            placeholder = "{{ __('translate.duration') }}" aria-label="" maxlength="50" required>
                        <label for="create-prescription-duration">{{ __('translate.duration') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="create-prescription-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="create-prescription-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="create-prescription-print_notes" name="print_notes" class="form-check-input" role="switch">
                        <label class="form-check-label" for="create-prescription-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="create-prescription-in_evidence" name="in_evidence" class="form-check-input" role="switch">
                        <label class="form-check-label" for="create-prescription-in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $("#create-prescription-problem_id").select2({
            dropdownParent: $('#create-prescription-modal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem_filter_by') }}",
            tokenSeparators: [','],
            width: '100%',
        });


        $('#create-prescription-medicine_id').select2({
            dropdownParent: $('#create-prescription-modal'),
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
