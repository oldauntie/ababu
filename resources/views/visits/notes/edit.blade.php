<div class="modal modal-xl fade" id="note-edit-modal-{{ $note->id }}" tabindex="-1"
    aria-labelledby="note-edit-modal-label-{{ $note->id }}" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            {{-- header --}}
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ __('translate.note') }}:
                    {{ $note->id }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- body --}}
            <form method="POST"
                action="{{ route('clinics.owners.pets.notes.update', [$clinic, $owner, $pet, $note]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="problem_id" name="problem_id" aria-label="problem_id"
                            aria-describedby="basic-addon">
                            <option {{ is_null($note->problem_id) ? 'selected' : '' }} value> --
                                {{ __('translate.problem_indipendent') }} -- </option>
                            @foreach ($pet->problems as $problem)
                                <option value="{{ $problem->id }}"
                                    {{ $note->problem_id == $problem->id ? 'selected' : '' }}>
                                    {{ $problem->diagnosis->term_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('subjective') is-invalid @enderror" name="subjective"
                            placeholder="{{ __('translate.subjective_analysis') }}" id="subjective" style="height: 100px" required>{{ $note->subjective }}</textarea>
                        <label for="subjective">{{ __('translate.subjective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                            placeholder="{{ __('translate.objective') }}" id="objective" style="height: 100px" required>{{ $note->objective }}</textarea>
                        <label for="objective">{{ __('translate.objective_analysis') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                            placeholder="{{ __('translate.assessment') }}" id="assessment" style="height: 100px" required>{{ $note->assessment }}</textarea>
                        <label for="assessment">{{ __('translate.assessment') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                            placeholder="{{ __('translate.plan') }}" id="plan" style="height: 100px" required>{{ $note->plan }}</textarea>
                        <label for="plan">{{ __('translate.plan') }}</label>
                    </div>
                </div>

                {{-- footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">{{ __('translate.close') }}</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('translate.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
