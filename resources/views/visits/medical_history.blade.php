<form method="POST" action="{{ route('clinics.owners.pets.update', [$clinic, $owner, $pet]) }}"
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
            @foreach (\App\Models\Pet::REPRODUCTIVE_STATUSES as $reproductive_status)
                <option value="{{ $reproductive_status }}"
                    {{ $reproductive_status == $pet->reproductive_status ? 'selected' : null }}>
                    {{ $reproductive_status }}</option>
            @endforeach
        </select>
        <label for="reproductive_status">{{ __('translate.reproductive_status') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="life_style" id="life_style" aria-label="{{ __('translate.life_style') }}">
            @foreach (\App\Models\Pet::LIFE_STYLES as $life_style)
                <option value="{{ $life_style }}" {{ $life_style == $pet->life_style ? 'selected' : null }}>
                    {{ $life_style }}</option>
            @endforeach
        </select>
        <label for="life_style">{{ __('translate.life_style') }}</label>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="other-pets-in-house" name="pets_in_house"{{ $pet->pets_in_house ? ' checked' : ''}}>
        <label class="form-check-label" for="other-pets-in-house">{{ __('translate.pet_hx_pets_in_house') }}</label>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="children-in-house" name="children_in_house"{{ $pet->children_in_house ? ' checked' : ''}}>
        <label class="form-check-label" for="children-in-house">{{ __('translate.pet_hx_children_in_house') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="food" id="food" aria-label="{{ __('translate.pet_hx_food') }}">
            @foreach (\App\Models\Pet::FOODS as $food)
                <option value="{{ $food }}" {{ $food == $pet->food ? 'selected' : null }}>
                    {{ $food }}</option>
            @endforeach
        </select>
        <label for="life_style">{{ __('translate.food') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="previous-diseases" type="text"
            class="form-control @error('previous_diseases') is-invalid @enderror" name="previous_diseases"
            value="{{ $pet->previous_diseases }}" maxlength="100"
            placeholder="{{ __('translate.previous_diseases') }}">
        <label for="previous-diseases">{{ __('translate.pet_hx_previous_diseases') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="surgery" type="text" class="form-control @error('surgery') is-invalid @enderror" name="surgery"
            value="{{ $pet->surgery }}" maxlength="100" placeholder="{{ __('translate.pet_hx_surgery') }}">
        <label for="surgery">{{ __('translate.surgery') }}</label>
    </div>


    <div class="form-group row mb-0">
        <div class="col text-center">
            <button type="submit" class="btn btn-outline-success btn-lg">{{ __('translate.save') }}</button>
        </div>
    </div>



</form>
