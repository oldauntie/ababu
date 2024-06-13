<form method="POST" action="{{ route('clinics.owners.pets.medical-histories.update', [$clinic, $owner, $pet]) }}"
    enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}

    {{--
    <div class="form-floating mb-3">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $pet->name }}" maxlength="100" required placeholder="{{ __('translate.name') }}">
        <label for="name">{{ __('translate.name') }}</label>
    </div>
    --}}


    <div class="form-floating mb-3">
        <select class="form-select" name="reproductive_status" id="reproductive_status"
            aria-label="{{ __('translate.reproductive_status') }}">
            @foreach (\App\Models\MedicalHistory::REPRODUCTIVE_STATUSES as $reproductive_status)
                <option value="{{ $reproductive_status }}"
                    {{ $reproductive_status == $pet->medical_history->reproductive_status ? 'selected' : null }}>
                    {{ $reproductive_status }}</option>
            @endforeach
        </select>
        <label for="reproductive_status">{{ __('translate.reproductive_status') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="life_style" id="life_style" aria-label="{{ __('translate.life_style') }}">
            @foreach (\App\Models\MedicalHistory::LIFE_STYLES as $life_style)
                <option value="{{ $life_style }}"
                    {{ $life_style == $pet->medical_history->life_style ? 'selected' : null }}>
                    {{ $life_style }}</option>
            @endforeach
        </select>
        <label for="life_style">{{ __('translate.life_style') }}</label>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="has-pets-in-house"
            name="has_pets_in_house"{{ $pet->medical_history->has_pets_in_house ? ' checked' : '' }}>
        <label class="form-check-label" for="has-pets-in-house">{{ __('translate.pet_hx_has_pets_in_house') }}</label>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="has-children-in-house"
            name="has_children_in_house"{{ $pet->medical_history->has_children_in_house ? ' checked' : '' }}>
        <label class="form-check-label"
            for="has-children-in-house">{{ __('translate.pet_hx_has_children_in_house') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="food" id="food" aria-label="{{ __('translate.pet_hx_food') }}">
            @foreach (\App\Models\MedicalHistory::FOODS as $food)
                <option value="{{ $food }}" {{ $food == $pet->medical_history->food ? 'selected' : null }}>
                    {{ $food }}</option>
            @endforeach
        </select>
        <label for="life_style">{{ __('translate.food') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="food_consumption" id="food_consumption"
            aria-label="{{ __('translate.food_consumption') }}">
            @foreach (\App\Models\MedicalHistory::FOOD_CONSUMPTIONS as $food_consumption)
                <option value="{{ $food_consumption }}"
                    {{ $food_consumption == $pet->medical_history->food_consumption ? 'selected' : null }}>
                    {{ $food_consumption }}</option>
            @endforeach
        </select>
        <label for="food_consumption">{{ __('translate.food_consumption') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="water_consumption" id="water_consumption"
            aria-label="{{ __('translate.water_consumption') }}">
            @foreach (\App\Models\MedicalHistory::WATER_CONSUMPTIONS as $water_consumption)
                <option value="{{ $water_consumption }}"
                    {{ $water_consumption == $pet->medical_history->water_consumption ? 'selected' : null }}>
                    {{ $water_consumption }}</option>
            @endforeach
        </select>
        <label for="water_consumption">{{ __('translate.water_consumption') }}</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control @error('previous_diseases') is-invalid @enderror" name="previous_diseases"
            placeholder="{{ __('translate.previous_diseases') }}" id="previous-diseases" style="height: 100px">{{ $pet->medical_history->previous_diseases }}</textarea>
        <label for="previous-diseases">{{ __('translate.previous_diseases') }}</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control @error('previous_surgery') is-invalid @enderror" name="previous_surgery"
            placeholder="{{ __('translate.previous_surgery') }}" id="previous_surgery" style="height: 100px">{{ $pet->medical_history->previous_surgery }}</textarea>
        <label for="previous_surgery">{{ __('translate.previous_surgery') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="previous_veterinary" type="text"
            class="form-control @error('previous_veterinary') is-invalid @enderror" name="previous_veterinary"
            value="{{ $pet->medical_history->previous_veterinary }}" maxlength="255"
            placeholder="{{ __('translate.previous_veterinary') }}">
        <label for="previous_veterinary">{{ __('translate.previous_veterinary') }}</label>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.flea_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-yes"
                value="1"{{ $pet->medical_history->flea_preventive == 1 ? ' checked' : '' }}>
            <label class="form-check-label" for="flea-preventive-yes">{{ __('translate.yes') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-no"
                value="0"{{ $pet->medical_history->flea_preventive == 0 ? ' checked' : '' }}>
            <label class="form-check-label" for="flea-preventive-no">{{ __('translate.no') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-na"
                value=""{{ isset($pet->medical_history->flea_preventive) == false ? ' checked' : '' }}>
            <label class="form-check-label" for="flea-preventive-na">{{ __('translate.not_applicable') }}</label>
        </div>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.tick_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-yes"
                value="1"{{ $pet->medical_history->tick_preventive == 1 ? ' checked' : '' }}>
            <label class="form-check-label" for="tick-preventive-yes">{{ __('translate.yes') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-no"
                value="0"{{ $pet->medical_history->tick_preventive == 0 ? ' checked' : '' }}>
            <label class="form-check-label" for="tick-preventive-no">{{ __('translate.no') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-na"
                value=""{{ isset($pet->medical_history->tick_preventive) == false ? ' checked' : '' }}>
            <label class="form-check-label" for="tick-preventive-na">{{ __('translate.not_applicable') }}</label>
        </div>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.heartworm_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-yes"
                value="1"{{ $pet->medical_history->heartworm_preventive === 1 ? ' checked' : '' }}>
            <label class="form-check-label" for="heartworm-preventive-yes">{{ __('translate.yes') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-no"
                value="0"{{ $pet->medical_history->heartworm_preventive == 0 ? ' checked' : '' }}>
            <label class="form-check-label" for="heartworm-preventive-no">{{ __('translate.no') }}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-na"
                value=""{{ isset($pet->medical_history->heartworm_preventive) == false ? ' checked' : '' }}>
            <label class="form-check-label"
                for="heartworm-preventive-na">{{ __('translate.not_applicable') }}</label>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col text-center">
            <button type="submit" class="btn btn-outline-success btn-lg">{{ __('translate.save') }}</button>
        </div>
    </div>

</form>
