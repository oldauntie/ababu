<div class="modal modal-xl	fade" id="notes-create-modal" tabindex="-1" aria-labelledby="notes-create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="notes-create-modal-label">{{ __('translate.note_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                id="prescription-create-form" 
                action="{{ route('clinics.owners.pets.notes.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="notes-create-problem_id" name="problem_id" class="form-control" aria-label="problem_id" aria-describedby="basic-addon">
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}">
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="notes-create-subjective" name="subjective"
                            placeholder="{{ __('translate.subjective_analysis') }}" class="form-control @error('subjective') is-invalid @enderror" style="height: 100px" required>{{ old('subjective') }}</textarea>
                        <label for="notes-create-subjective">{{ __('translate.subjective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="notes-create-objective" class="form-control @error('objective') is-invalid @enderror" name="objective"
                            placeholder="{{ __('translate.objective') }}" style="height: 100px" required>{{ old('objective') }}</textarea>
                        <label for="notes-create-objective">{{ __('translate.objective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                            placeholder="{{ __('translate.assessment') }}" id="notes-create-assessment" style="height: 100px" required>{{ old('assessment') }}</textarea>
                        <label for="notes-create-assessment">{{ __('translate.assessment') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                            placeholder="{{ __('translate.plan') }}" id="notes-create-plan" style="height: 100px" required>{{ old('plam') }}</textarea>
                        <label for="notes-create-plan">{{ __('translate.plan') }}</label>
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
        $("#notes-create-problem_id").select2({
            dropdownParent: $('#notes-create-modal'),
            width: '100%',
            placeholder: "{{ __('translate.problem_indipendent') }}",
            allowClear: true,
            width: '100%',
        });
    });
</script>