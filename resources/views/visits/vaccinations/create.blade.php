<div class="modal modal-xl fade" id="vaccinations-create-modal" tabindex="-1" aria-labelledby="vaccinations-create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="vaccinations-create-modal-label">{{ __('translate.vaccination_create') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                id="vaccinations-create-form" 
                action="{{ route('clinics.owners.pets.vaccinations.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-create-vaccine" name="vaccine" value="{{ old('vaccine') }}" class="form-control @error('vaccine') is-invalid @enderror"
                            placeholder="{{ __('translate.vaccine') }}" required>
                        <label for="vaccinations-create-vaccine">{{ __('translate.vaccine') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-create-batch" name="batch" value="{{ old('batch') }}" class="form-control @error('batch') is-invalid @enderror"
                            placeholder="{{ __('translate.batch') }}" maxlength="50" required>
                        <label for="vaccinations-create-batch">{{ __('translate.batch') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="vaccinations-create-vaccination_date" name="vaccination_date" value="{{ old('vaccination_date') }}" class="form-control @error('vaccination_date') is-invalid @enderror"
                            placeholder="{{ __('translate.vaccination_date') }}" required>
                        <label for="vaccinations-create-vaccination_date">{{ __('translate.vaccination_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" id="vaccinations-create-booster_date" name="booster_date" value="{{ old('booster_date') }}" class="form-control @error('booster_date') is-invalid @enderror"
                            placeholder="{{ __('translate.booster_date') }}">
                        <label for="vaccinations-create-booster_date">{{ __('translate.booster_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="vaccinations-create-production_date" name="production_date" value="{{ old('production_date') }}" class="form-control @error('production_date') is-invalid @enderror"
                            placeholder="{{ __('translate.production_date') }}">
                        <label for="vaccinations-create-production_date">{{ __('translate.production_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" id="vaccinations-create-expiration_date" name="expiration_date" value="{{ old('expiration_date') }}" class="form-control @error('expiration_date') is-invalid @enderror"
                            placeholder="{{ __('translate.expiration_date') }}">
                        <label for="vaccinations-create-expiration_date">{{ __('translate.expiration_date') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-create-adverse_reactions" name="adverse_reactions" value="{{ old('adverse_reactions') }}" class="form-control @error('adverse_reactions') is-invalid @enderror"
                            placeholder="{{ __('translate.adverse_reactions') }}">
                        <label for="vaccinations-create-adverse_reactions">{{ __('translate.adverse_reactions') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="vaccinations-create-notes" name="notes" value="{{ old('notes') }}" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('translate.notes') }}">
                        <label for="vaccinations-create-notes">{{ __('translate.notes') }}</label>
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
