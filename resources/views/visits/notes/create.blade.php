<div class="modal modal-xl	fade" id="create-note-modal" tabindex="-1" aria-labelledby="create-note-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create-note-modal-label">{{ __('translate.note_new') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('clinics.owners.pets.notes.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select id="create-note-problem_id" name="problem_id" class="form-control" aria-label="problem_id"
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
                        <textarea id="create-note-subjective" name="subjective"
                            placeholder="{{ __('translate.subjective_analysis') }}" class="form-control @error('subjective') is-invalid @enderror" style="height: 100px" required>{{ old('subjective') }}</textarea>
                        <label for="create-note-subjective">{{ __('translate.subjective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea id="create-note-objective" class="form-control @error('objective') is-invalid @enderror" name="objective"
                            placeholder="{{ __('translate.objective') }}" style="height: 100px" required>{{ old('objective') }}</textarea>
                        <label for="create-note-objective">{{ __('translate.objective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                            placeholder="{{ __('translate.assessment') }}" id="create-note-assessment" style="height: 100px" required>{{ old('assessment') }}</textarea>
                        <label for="create-note-assessment">{{ __('translate.assessment') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                            placeholder="{{ __('translate.plan') }}" id="create-note-plan" style="height: 100px" required>{{ old('plam') }}</textarea>
                        <label for="create-note-plan">{{ __('translate.plan') }}</label>
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
        $("#create-note-problem_id").select2({
            dropdownParent: $('#createNoteModal'),
            width: '100%',
            tags: true,
            placeholder: "{{ __('translate.problem_filter_by') }}",
            tokenSeparators: [','],
            width: '100%',
        });
    });
</script>