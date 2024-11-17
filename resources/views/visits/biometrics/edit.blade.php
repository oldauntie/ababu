<div class="modal modal-xl fade" id="biometric-edit-modal-{{ $biometric->id }}" tabindex="-1" 
    aria-labelledby="biometric-edit-modal-label-{{ $biometric->id }}" aria-hidden="true">
    
    <div class="modal-dialog">
        
        <div class="modal-content">
            {{-- header --}}
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    {{ __('translate.biometric') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- body --}}
            <form method="POST"
                action="{{ route('clinics.owners.pets.biometrics.update', [$clinic, $owner, $pet, $biometric]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="number" step=".01" min="0" id="biometric-edit-heigth-{{ $biometric->id }}" name="heigth" value="{{ $biometric->heigth }}" class="form-control @error('heigth') is-invalid @enderror"
                            placeholder="{{ __('translate.heigth') }}" required>
                        <label for="biometric-edit-heigth-{{ $biometric->id }}">{{ __('translate.heigth') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" step=".01" id="biometric-edit-length-{{ $biometric->id }}" name="length" value="{{ $biometric->length }}" class="form-control @error('length') is-invalid @enderror"
                            placeholder="{{ __('translate.length') }}" required>
                        <label for="biometric-edit-length-{{ $biometric->id }}">{{ __('translate.length') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" step=".01" id="biometric-edit-weigth-{{ $biometric->id }}" name="weigth" value="{{ $biometric->weigth }}" class="form-control @error('weigth') is-invalid @enderror"
                            placeholder="{{ __('translate.weigth') }}" required>
                        <label for="biometric-edit-weigth-{{ $biometric->id }}">{{ __('translate.weigth') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" step=".01" id="biometric-edit-temperature" name="temperature" value="{{ $biometric->temperature }}" class="form-control @error('temperature') is-invalid @enderror"
                            placeholder="{{ __('translate.temperature') }}" required>
                        <label for="biometric-edit-temperature-{{ $biometric->id }}">{{ __('translate.temperature') }}</label>
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
