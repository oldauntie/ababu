<form method="POST" action="{{ route('clinics.owners.pets.biometrics.update', [$clinic, $owner, $pet]) }}"
    enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}

    

    <div class="form-floating mb-3">
        <input id="heigth" type="number"
        value="{{ $pet->biometrics->heigth ?? '' }}" maxlength="255"
            class="form-control @error('heigth') is-invalid @enderror" name="heigth"
            placeholder="{{ __('translate.heigth') }}">
        <label for="heigth">{{ __('translate.heigth') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="length" type="number"
        value="{{ $pet->biometrics->length ?? '' }}" maxlength="255"
            class="form-control @error('length') is-invalid @enderror" name="length"
            placeholder="{{ __('translate.length') }}">
        <label for="length">{{ __('translate.length') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="weigth" type="number"
        value="{{ $pet->biometrics->weigth ?? '' }}" maxlength="255"
            class="form-control @error('weigth') is-invalid @enderror" name="weigth"
            placeholder="{{ __('translate.weigth') }}">
        <label for="weigth">{{ __('translate.weigth') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="temperature" type="number"
        value="{{ $pet->biometrics->temperature ?? '' }}" maxlength="255"
            class="form-control @error('temperature') is-invalid @enderror" name="temperature"
            placeholder="{{ __('translate.temperature') }}">
        <label for="temperature">{{ __('translate.temperature') }}</label>
    </div>







    <div class="form-group row mb-0">
        <div class="col text-end">
            <small>
                {{ __('translate.updated_at') }} {{ $pet->biometrics->updated_at ?? '[' . __('translate.new') . ']' }}
            </small>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col text-center">
            <button type="submit" class="btn btn-sm btn-outline-success">{{ __('translate.save') }}</button>
        </div>
    </div>

</form>
