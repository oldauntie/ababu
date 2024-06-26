<div class="modal modal-xl	fade" id="newProblemModal" tabindex="-1" aria-labelledby="newProblemModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            {{-- 
            <form method="POST" id="problem-edit-modal-form" action="" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                --}}

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newProblemModalLabel">{{ __('translate.problem') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-12">

                        <select class="form-select" id="problem-select2" name="problem">
                            @foreach ($diagnoses as $problem)
                                <option value="{{ $problem->id }}">{{ $problem->term_name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <fieldset>
                            <legend>{{__('translate.pet') }}</legend>
                            <div>
                                {{ __('translate.name') }}: {{ $pet->name }}<br>
                                {{ __('translate.species') }}: {{ $pet->species->familiar_name }}<br>
                                {{ __('translate.date_of_birth') }}:
                                {{ $pet->date_of_birth->format( auth()->user()->locale->date_short_format ) }}<br>
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
                                            id="problem-edit-status_id_{{ $status_id }}" value="{{$status_id}}">
                                        <img src="{{url('/images/icons/problem_status_' . $status_id . '.png')}}">
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
                                            src="{{url('/images/icons/problem_key_problem.png')}}">
                                        {{ __('translate.problem_key_problem') }}</label>
                                </div>
                            </div>
                        </fieldset>

                        
                    </div>
                    <div class="col-8">

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary"
                    data-bs-dismiss="modal">{{ __('translate.close') }}</button>
                <button type="button" class="btn btn-sm btn-outline-primary">{{ __('translate.save') }}</button>

            </div>

            {{-- 
            </form>
            --}}

        </div>
    </div>
</div>

<script type="module">
    $(function() {
        $('#problem-select2').select2({
            dropdownParent: $('#newProblemModal'),
            width: '100%',
        });
    });
</script>
