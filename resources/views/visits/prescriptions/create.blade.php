<div class="modal modal-xl fade" id="newPrescriptionModal" tabindex="-1" aria-labelledby="newPrescriptionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newPrescriptionModalLabel">{{ __('translate.prescription_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('clinics.owners.pets.notes.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="medicine_id" name="medicine_id" aria-label="medicine_id"
                            aria-describedby="basic-addon">
                            <option selected value> -- {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="medicine_id2" class="js-data-example-ajax"></select>
                    </div>


                    {{-- 
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('subjective') is-invalid @enderror" name="subjective"
                            placeholder="{{ __('translate.subjective_analysis') }}" id="subjective" style="height: 100px" required>{{ old('subjective') }}</textarea>
                        <label for="subjective">{{ __('translate.subjective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                            placeholder="{{ __('translate.objective') }}" id="objective" style="height: 100px" required>{{ old('objective') }}</textarea>
                        <label for="objective">{{ __('translate.objective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                            placeholder="{{ __('translate.assessment') }}" id="assessment" style="height: 100px" required>{{ old('assessment') }}</textarea>
                        <label for="assessment">{{ __('translate.assessment') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                            placeholder="{{ __('translate.plan') }}" id="plan" style="height: 100px" required>{{ old('plam') }}</textarea>
                        <label for="plan">{{ __('translate.plan') }}</label>
                    </div>
                    --}}


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
        $('#medicine_id2').select2({
            dropdownParent: $('#newProblemModal'),
            ajax: {
                url: '{{ route('clinics.medicines.search', ['clinic' => $clinic]) }}',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                }
            }
        });


        $('#problem-select2').select2({
            dropdownParent: $('#newProblemModal'),
            width: '100%',
            /*
            templateSelection: formatOption,
            templateResult: formatOption,
            */
        });
    });
</script>
