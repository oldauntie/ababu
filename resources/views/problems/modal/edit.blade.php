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
                                    @foreach ($problem->statuses as $status_id => $status_name)
                                    <div class="form-check">
                                        <input name="status_id" type="radio" id="{{ $status_name }}" checked>
                                        <label for="{{ $status_name }}"><img
                                                title="{{ __('translate.' . $problem->statuses[$problem->status_id]) }}"
                                                src="{{url('/images/icons/problem_status_' . $status_id . '.png')}}">
                                            {{ __('translate.' . $status_name) }}</label>
                                    </div>
                                    @endforeach

                                </div>

                            </fieldset>

                            <fieldset>
                                <legend>{{ __('translate.problem_key_problem') }}</legend>
                                <div>
                                    <div class="form-check">
                                        <input name="key_ptoblem" type="checkbox" id="key_problem" checked>
                                        <label for="key_problem"><img title="{{ __('translate.problem_key_problem') }}"
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
                                <input id="problem-edit-id" type="text" name="id" value="">

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
                                            class="form-control form-control-sm w-25" name="at_age" value="" readonly>
                                        <input id="problem-edit-at_age" type="text"
                                            class="form-control form-control-sm w-75" name="at_age" value="" readonly>
                                    </div>
                                </div>



                            </div>
                            <fieldset>
                                <legend>{{__('translate.microchip')}}</legend>

                            </fieldset>


                            <fieldset>
                                <legend>{{__('translate.tatuatge')}}</legend>

                            </fieldset>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.save')}}</button>
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-dismiss="modal">{{__('translate.close')}}</button>
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

</script>

@endpush