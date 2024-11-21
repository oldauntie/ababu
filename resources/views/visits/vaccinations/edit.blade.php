<div class="modal modal-xl fade" id="vaccination-edit-modal-{{ $vaccination->id }}" tabindex="-1" aria-labelledby="vaccinations-edit-modal-label-{{ $vaccination->id }}" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            {{-- header --}}
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    {{ __('translate.vaccination_new') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- body --}}
            <form method="POST"
                action="{{ route('clinics.owners.pets.vaccinations.update', [$clinic, $owner, $pet, $vaccination]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-edit-vaccine-{{ $vaccination->id }}" name="vaccine" value="{{ $vaccination->vaccine }}" class="form-control @error('vaccine') is-invalid @enderror"
                            placeholder="{{ __('translate.vaccine') }}" required>
                        <label for="vaccinations-edit-vaccine-{{ $vaccination->id }}">{{ __('translate.vaccine') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-edit-batch-{{ $vaccination->id }}" name="batch" value="{{ $vaccination->batch }}" class="form-control @error('batch') is-invalid @enderror"
                            placeholder="{{ __('translate.batch') }}" maxlength="50" required>
                        <label for="vaccinations-edit-batch-{{ $vaccination->id }}">{{ __('translate.batch') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="vaccinations-edit-vaccination_date-{{ $vaccination->id }}" name="vaccination_date" value="{{ $vaccination->vaccination_date }}" class="form-control @error('vaccination_date') is-invalid @enderror"
                            placeholder="{{ __('translate.vaccination_date') }}" required>
                        <label for="vaccinations-edit-vaccination_date-{{ $vaccination->id }}">{{ __('translate.vaccination_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="vaccinations-edit-booster_date-{{ $vaccination->id }}" name="booster_date" value="{{ $vaccination->booster_date }}" class="form-control @error('booster_date') is-invalid @enderror"
                            placeholder="{{ __('translate.booster_date') }}">
                        <label for="vaccinations-edit-booster_date-{{ $vaccination->id }}">{{ __('translate.booster_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="vaccinations-edit-production_date-{{ $vaccination->id }}" name="production_date" value="{{ $vaccination->production_date }}" class="form-control @error('production_date') is-invalid @enderror"
                            placeholder="{{ __('translate.production_date') }}">
                        <label for="vaccinations-edit-production_date-{{ $vaccination->id }}">{{ __('translate.production_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="vaccinations-edit-expiration_date-{{ $vaccination->id }}" name="expiration_date" value="{{ $vaccination->expiration_date }}" class="form-control @error('expiration_date') is-invalid @enderror"
                            placeholder="{{ __('translate.expiration_date') }}">
                        <label for="vaccinations-edit-expiration_date-{{ $vaccination->id }}">{{ __('translate.expiration_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-edit-adverse_reactions-{{ $vaccination->id }}" name="adverse_reactions" value="{{ $vaccination->adverse_reactions }}" class="form-control @error('adverse_reactions') is-invalid @enderror"
                            placeholder="{{ __('translate.adverse_reactions') }}">
                        <label for="vaccinations-edit-adverse_reactions-{{ $vaccination->id }}">{{ __('translate.adverse_reactions') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-edit-notes-{{ $vaccination->id }}" name="notes" value="{{ $vaccination->notes }}" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}">
                        <label for="vaccinations-edit-notes-{{ $vaccination->id }}">{{ __('translate.notes') }}</label>
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
