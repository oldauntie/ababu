<div class="modal modal-xl fade" id="biometrics-create-modal" tabindex="-1" aria-labelledby="biometrics-create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="biometrics-create-modal-label">{{ __('translate.biometric_create') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST"
                id="biometrics-create-form" 
                action="{{ route('clinics.owners.pets.biometrics.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="number" id="biometrics-create-heigth" name="heigth" value="{{ old('heigth') }}" class="form-control @error('heigth') is-invalid @enderror"
                            placeholder="{{ __('translate.heigth') }}" required>
                        <label for="biometrics-create-heigth">{{ __('translate.heigth') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="biometrics-create-length" name="length" value="{{ old('length') }}" class="form-control @error('length') is-invalid @enderror"
                            placeholder="{{ __('translate.length') }}" required>
                        <label for="biometrics-create-length">{{ __('translate.length') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="biometrics-create-weight" name="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror"
                            placeholder="{{ __('translate.weight') }}" required>
                        <label for="biometrics-create-weight">{{ __('translate.weight') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" id="biometrics-create-temperature" name="temperature" value="{{ old('temperature') }}" class="form-control @error('temperature') is-invalid @enderror"
                            placeholder="{{ __('translate.temperature') }}" required>
                        <label for="biometrics-create-temperature">{{ __('translate.temperature') }}</label>
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
