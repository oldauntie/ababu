<div class="modal modal-xl fade" id="newPrescriptionModal" tabindex="-1" aria-labelledby="newPrescriptionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newPrescriptionModalLabel">{{ __('translate.prescription_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                action="{{ route('clinics.owners.pets.prescriptions.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="problem" name="problem" class="form-control" aria-label="problem"
                            aria-describedby="basic-addon" required>
                            <option value="0"> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="medicine_id" name="medicine_id" class="" required></select>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="prescription_date" type="date" name="prescription_date"
                            value="{{ date('Y-m-d') }}"
                            class="form-control @error('prescription_date') is-invalid @enderror"
                            placeholder = '{{ __('translate.prescription_date') }}' required>
                        <label for="prescription_date">{{ __('translate.prescription_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="quantity" type="number" name="quantity" value="{{ old('quantity') }}"
                            class="form-control @error('quantity') is-invalid @enderror"
                            placeholder = '{{ __('translate.quantity') }}' required>
                        <label for="quantity">{{ __('translate.quantity') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="dosage" type="text" name="dosage" value="{{ old('dosage') }}"
                            class="form-control @error('dosage') is-invalid @enderror"
                            placeholder = '{{ __('translate.dosage') }}' maxlength="255" required>
                        <label for="dosage">{{ __('translate.dosage') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="duration" type="text" name="duration" value="{{ old('duration') }}"
                            class="form-control @error('duration') is-invalid @enderror"
                            placeholder = '{{ __('translate.duration') }}' maxlength="255" required>
                        <label for="duration">{{ __('translate.duration') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input id="print_notes" type="checkbox" name="print_notes" class="form-check-input" role="switch">
                        <label class="form-check-label" for="print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input id="in_evidence" type="checkbox" name="in_evidence" class="form-check-input" role="switch">
                        <label class="form-check-label" for="in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $("#problem").select2({
            // dropDownParent: $('#newPrescriptionModal3')
            dropdownParent: $('#newPrescriptionModal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem_filter_by') }}",
            tokenSeparators: [','],
            width: '100%',
        });


        $('#medicine_id').select2({
            dropdownParent: $('#newPrescriptionModal'),
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
