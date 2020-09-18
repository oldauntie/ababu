<!-- Attachment Modal -->
<div class="modal fade" id="problem-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.problem')}} {{__('translate.edit')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="problem-edit-modal-form" action="" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">
                        <div class="col-md-4">
                            <fieldset>
                                <legend>{{ __('translate.problem_status') }}</legend>
                                <div>
                                    @foreach (App\Problem::statuses as $status_id => $status_name)
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


                        </div>

                        <!-- column 2 -->
                        <div class="col-md-8">
                            <div class="row justify-content-center">
                                <!-- Active From -->
                                <div class="col-3">
                                    <label for="problem-edit-active_from"
                                        class="text-md-right">{{__('translate.active_from')}}*</label>
                                    <input id="problem-edit-active_from" type="text"
                                        class="form-control form-control-sm @error('active_from') is-invalid @enderror"
                                        name="active_from" value="" autocomplete="active_from" required autofocus>
                                </div>
                                <!-- At Age -->
                                <div class="col-2">
                                    <label for="problem-edit-at_age"
                                        class="text-md-right">{{__('translate.at_age')}}</label>
                                    <input id="problem-edit-at_age" type="text" class="form-control form-control-sm"
                                        name="at_age" value="" readonly>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <label for="problem-edit-diagnosis_id"
                                            class="text-md-right">{{__('translate.problem')}}</label>
                                    </div>
                                    <div class="row form-inline">
                                        <input id="problem-edit-diagnosis_id" type="text"
                                            class="form-control form-control-sm w-25" name="diagnosis_id" value=""
                                            readonly>
                                        <input id="problem-edit-diagnosis_term_name" type="text"
                                            class="form-control form-control-sm w-75" name="diagnosis_term_name"
                                            value="" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- clinical data -->
                            <fieldset>
                                <legend>{{__('translate.clinical_data')}}</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="problem-edit-diagnosis_id"
                                            class="text-md-right">{{__('translate.subjective_analysis')}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="problem-edit-subjective_analysis" name="subjective_analysis"
                                            rows="3" style="min-width: 100%"
                                            class="form-contro form-control-sml">{{ old('subjective_analysis') }}</textarea>

                                        <small
                                            class="form-text text-muted">{{__('help.problem_subjective_analysis')}}</small>
                                        @error('subjective_analysis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="problem-edit-diagnosis_id"
                                            class="text-md-right">{{__('translate.objective_analysis')}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="problem-edit-objective_analysis" name="objective_analysis"
                                            rows="3" style="min-width: 100%"
                                            class="form-contro form-control-sml">{{ old('objective_analysis') }}</textarea>

                                        <small
                                            class="form-text text-muted">{{__('help.problem_objective_analysis')}}</small>
                                        @error('objective_analysis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="problem-edit-diagnosis_id"
                                            class="text-md-right">{{__('translate.notes')}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="problem-edit-notes" name="notes" rows="3" style="min-width: 100%"
                                            class="form-contro form-control-sml">{{ old('notes') }}</textarea>

                                        <small class="form-text text-muted">{{__('help.problem_notes')}}</small>
                                        @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </fieldset>



                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.save')}}</button>
                            <button type="button" class="btn btn-danger btn-sm">{{__('translate.delete')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{__('translate.close')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <div class="row" style="width: 95%">
                    <div class="col-2">{{ __('translate.created_at') }}</div>
                    <div class="col-2" id="problem-edit-created_at">00:00:00</div>
                    <div class="col-2">{{ __('translate.updated_at') }}</div>
                    <div class="col-2" id="problem-edit-updated_at">00:00:00</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){

        var active_from = $('#problem-edit-active_from').datepicker({
            // format: "dd/mm/yyyy",
            language: "{{ auth()->user()->locale->id}}",
            todayHighlight: true,
            autoclose: true,
            maxDate: "+100Y"
        }).on('show', function(e) {
            
        }).on('hide', function(e) {
            setAtAge();
        });

    });

    function setAtAge()
    {
        // active_from
        var a = moment().locale('{{auth()->user()->locale->short_code}}');
        
        // date of birth
        var b = moment().locale('{{auth()->user()->locale->short_code}}');

        if( $('#problem-edit-active_from').val() != ''){
            a = moment($('#problem-edit-active_from').val(), a.localeData().longDateFormat('L'));
        }

        b = moment('{{$pet->date_of_birth->format( auth()->user()->locale->date_short_format )}}', b.localeData().longDateFormat('L'));

        var years = a.diff(b, 'year');
        $('#problem-edit-at_age').val(years);
    }
</script>

@endpush