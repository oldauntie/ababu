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
        <input class="form-check-input" type="checkbox" role="switch" id="has-pets-in-house"
            name="has_pets_in_house"{{ $pet->has_pets_in_house ? ' checked' : '' }}>
        <label class="form-check-label" for="has-pets-in-house">{{ __('translate.pet_hx_has_pets_in_house') }}</label>
    </div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="has-children-in-house"
            name="has_children_in_house"{{ $pet->has_children_in_house ? ' checked' : '' }}>
        <label class="form-check-label"
            for="has-children-in-house">{{ __('translate.pet_hx_has_children_in_house') }}</label>
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
        <select class="form-select" name="food_consumption" id="food_consumption" aria-label="{{ __('translate.pet_hx_food_consumption') }}">
            @foreach (\App\Models\Pet::FOOD_CONSUMPTIONS as $food_consumption)
                <option value="{{ $food_consumption }}" {{ $food_consumption == $pet->food_consumption ? 'selected' : null }}>
                    {{ $food_consumption }}</option>
            @endforeach
        </select>
        <label for="food_consumption">{{ __('translate.pet_hx_food_consumption') }}</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="water_consumption" id="water_consumption" aria-label="{{ __('translate.pet_hx_water_consumption') }}">
            @foreach (\App\Models\Pet::WATER_CONSUMPTIONS as $water_consumption)
                <option value="{{ $water_consumption }}" {{ $water_consumption == $pet->water_consumption ? 'selected' : null }}>
                    {{ $water_consumption }}</option>
            @endforeach
        </select>
        <label for="water_consumption">{{ __('translate.pet_hx_water_consumption') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="previous-diseases" type="text"
            class="form-control @error('previous_diseases') is-invalid @enderror" name="previous_diseases"
            value="{{ $pet->previous_diseases }}" maxlength="100"
            placeholder="{{ __('translate.previous_diseases') }}">
        <label for="previous-diseases">{{ __('translate.pet_hx_previous_diseases') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="previous_surgery" type="text" class="form-control @error('previous_surgery') is-invalid @enderror"
            name="previous_surgery" value="{{ $pet->previous_surgery }}" maxlength="100"
            placeholder="{{ __('translate.pet_hx_previous_surgery') }}">
        <label for="previous_surgery">{{ __('translate.pet_hx_previous_surgery') }}</label>
    </div>

    <div class="form-floating mb-3">
        <input id="previous_veterinary" type="text"
            class="form-control @error('previous_veterinary') is-invalid @enderror" name="previous_veterinary"
            value="{{ $pet->previous_veterinary }}" maxlength="255"
            placeholder="{{ __('translate.pet_hx_previous_veterinary') }}">
        <label for="previous_veterinary">{{ __('translate.pet_hx_previous_veterinary') }}</label>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.pet_hx_flea_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-yes" value="1"{{ $pet->flea_preventive == 1 ? ' checked' : ''}}>
            <label class="form-check-label" for="flea-preventive-yes">{{ __('translate.yes') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-no" value="0"{{ $pet->flea_preventive == 0 ? ' checked' : ''}}>
            <label class="form-check-label" for="flea-preventive-no">{{ __('translate.no') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="flea_preventive" id="flea-preventive-na" value=""{{ isset($pet->flea_preventive) == false ? ' checked' : ''}}>
            <label class="form-check-label" for="flea-preventive-na">{{ __('translate.not_applicable') }}</label>
          </div>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.pet_hx_tick_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-yes" value="1"{{ $pet->tick_preventive == 1 ? ' checked' : ''}}>
            <label class="form-check-label" for="tick-preventive-yes">{{ __('translate.yes') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-no" value="0"{{ $pet->tick_preventive == 0 ? ' checked' : ''}}>
            <label class="form-check-label" for="tick-preventive-no">{{ __('translate.no') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tick_preventive" id="tick-preventive-na" value=""{{ isset($pet->tick_preventive) == false ? ' checked' : ''}}>
            <label class="form-check-label" for="tick-preventive-na">{{ __('translate.not_applicable') }}</label>
          </div>
    </div>


    <div class="form-group m-3">
        <div>{{ __('translate.pet_hx_heartworm_preventive') }}</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-yes" value="1"{{ $pet->heartworm_preventive === 1 ? ' checked' : ''}}>
            <label class="form-check-label" for="heartworm-preventive-yes">{{ __('translate.yes') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-no" value="0"{{ $pet->heartworm_preventive == 0 ? ' checked' : ''}}>
            <label class="form-check-label" for="heartworm-preventive-no">{{ __('translate.no') }}</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="heartworm_preventive" id="heartworm-preventive-na" value=""{{ isset($pet->heartworm_preventive) == false ? ' checked' : ''}}>
            <label class="form-check-label" for="heartworm-preventive-na">{{ __('translate.not_applicable') }}</label>
          </div>
    </div>









    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comments</label>
    </div>






    <div class="form-group row mb-0">
        <div class="col text-center">
            <button type="submit" class="btn btn-outline-success btn-lg">{{ __('translate.save') }}</button>
        </div>
    </div>



</form>
