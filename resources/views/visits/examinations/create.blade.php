<div class="modal modal-xl fade" id="examinations-create-modal" tabindex="-1" aria-labelledby="examinations-create-modal-label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="examinations-create-modal-label">{{ __('translate.examination_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                if="examinations-create-form"
                action="{{ route('clinics.owners.pets.examinations.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="examinations-create-diagnostic_test_id" name="diagnostic_test_id" aria-label="" required></select>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select id="examinations-create-problem_id" name="problem_id" class="form-control" aria-label="">
                            <option value>{{ __('translate.problem_indipendent') }}</option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-create-is_pathologic" name="is_pathologic" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-create-is_pathologic">{{ __('translate.is_pathologic') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="examinations-create-examination_date" name="examination_date"
                            value="{{ date('Y-m-d\TH:i') }}"
                            class="form-control @error('examination_date') is-invalid @enderror"
                            placeholder = "{{ __('translate.examination_date') }}" aria-label="" required>
                        <label for="examinations-create-examination_date">{{ __('translate.examination_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="examinations-create-result" name="result" value="{{ old('result') }}"
                            class="form-control @error('result') is-invalid @enderror"
                            placeholder = "{{ __('translate.result') }}" aria-label="">
                        <label for="examinations-create-result">{{ __('translate.result') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="examinations-create-medical_report" name="medical_report" class="form-control @error('medical_report') is-invalid @enderror"
                            placeholder="{{ __('translate.medical_report') }}" style="height: 100px">{{ old('medical_report') }}</textarea>
                        <label for="examinations-create-medical_report">{{ __('translate.medical_report') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="examinations-create-notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}" style="height: 100px">{{ old('notes') }}</textarea>
                        <label for="examinations-create-notes">{{ __('translate.notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-create-print_notes" name="print_notes" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-create-print_notes">{{ __('translate.print_notes') }}</label>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" id="examinations-create-in_evidence" name="in_evidence" class="form-check-input" role="switch">
                        <label class="form-check-label" for="examinations-create-in_evidence">{{ __('translate.in_evidence') }}</label>
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
        $("#examinations-create-problem_id").select2({
            dropdownParent: $('#examinations-create-modal'),
            width: '100%',
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            width: '100%',
        });


        $('#examinations-create-diagnostic_test_id').select2({
            dropdownParent: $('#examinations-create-modal'),
            width: '100%',
            ajax: {
                url: '{{ route('clinics.diagnostic_tests.search', ['clinic' => $clinic]) }}',
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
