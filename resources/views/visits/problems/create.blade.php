<div class="modal modal-xl	fade" id="newProblemModal" tabindex="-1" aria-labelledby="newProblemModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            <form method="POST" action="{{ route('clinics.owners.pets.problems.store', [$clinic, $owner, $pet]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newProblemModalLabel">{{ __('translate.problem_new') }}</h1>
                    <div class="d-flex align-items-center">
                        <div class="colors">
                            <ul>
                                @foreach (App\Models\Problem::colors as $color_name => $color)
                                    <li>
                                        <label>
                                            <input type="radio" name="color" value="{{ $color }}">
                                            <span class="swatch" style="background-color:{{ $color }}"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">

                            <select class="form-select" id="problem-select2" name="diagnosis_id">
                                @foreach ($diagnoses as $problem)
                                    <option value="{{ $problem->id }}"
                                        {{ $problem->already_used == 1 ? ' disabled' : '' }} required>
                                        {{ $problem->term_name }}
                                        {{ $problem->already_used == 1 ? ' [' . __('translate.already_used') . ']' : '' }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <fieldset>
                                <legend>{{ __('translate.pet') }}</legend>
                                <div>
                                    {{ __('translate.name') }}: {{ $pet->name }}<br>
                                    {{ __('translate.species') }}: {{ $pet->species->familiar_name }}<br>
                                    {{ __('translate.date_of_birth') }}:
                                    {{ $pet->date_of_birth->format(auth()->user()->locale->date_short_format) }}<br>
                                    {{ __('translate.age') }}: {{ $pet->age->years }} {{ __('translate.years') }},
                                    {{ $pet->age->months }} {{ __('translate.months') }}, {{ $pet->age->days }}
                                    {{ __('translate.days') }}<br>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>{{ __('translate.problem_status') }}</legend>
                                <div>
                                    @foreach (App\Models\Problem::statuses as $status_id => $status_name)
                                        <div class="form-check">
                                            <label for="problem-edit-status_id_{{ $status_id }}">
                                                <input name="status_id" type="radio"
                                                    id="problem-edit-status_id_{{ $status_id }}"
                                                    value="{{ $status_id }}" required>
                                                <img
                                                    src="{{ url('/images/icons/problem_status_' . $status_id . '.png') }}">
                                                {{ __('translate.' . $status_name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>{{ __('translate.problem_key_problem') }}</legend>
                                <div>
                                    <div class="form-check">
                                        <input name="key_problem" type="checkbox" id="problem-edit-key_problem"
                                            value="1">
                                        <label for="problem-edit-key_problem"><img
                                                title="{{ __('translate.problem_key_problem') }}"
                                                src="{{ url('/images/icons/problem_key_problem.png') }}">
                                            {{ __('translate.problem_key_problem') }}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-9">
                            <div class="form-floating mb-3">
                                <input id="active_from" type="date"
                                    class="form-control @error('active_from') is-invalid @enderror" name="active_from"
                                    value="{{ old('active_from') }}" placeholder="{{ __('translate.active_from') }}"
                                    required>
                                <label for="active_from">{{ __('translate.active_from') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="{{ __('translate.description') }}" id="description" style="height: 100px" required>{{ old('description') }}</textarea>
                                <label for="description">{{ __('translate.description') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes"
                                    placeholder="{{ __('translate.note') }}" id="notes" style="height: 100px">{{ old('notes') }}</textarea>
                                <label for="notes">{{ __('translate.notes') }}</label>
                            </div>
                        </div>
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
        /*
        function formatOption(option) {
            console.log(option);
            if (!option.id) {
                return option.text;
            }
            

            console.log(option.element.className.toLowerCase());

            if (option.element.className.toLowerCase() == 'used') 
            {
                var optionWithImage = $('<span>' + option.text + '<img src="{{ url('/images/icons/problem_status_3.png') }}" /></span>');
            }
            else
            {
                var optionWithImage = $('<span>' + option.text + '<img src="{{ url('/images/icons/problem_status_2.png') }}" /></span>');
            }

            return optionWithImage;
        }
        */




        $('#problem-select2').select2({
            dropdownParent: $('#newProblemModal'),
            width: '100%',
            /*
            templateSelection: formatOption,
            templateResult: formatOption,
            */
        });
    });
</script>
