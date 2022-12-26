<style>
    .vertical-scroll {
        height: 150px;
        overflow-y: scroll;
    }

    td {
        border: 1px #DDD solid;
        padding: 5px;
        cursor: pointer;
    }

    .selected {
        background-color: lightseagreen;
        color: #FFF;
    }


    #problems tr>*:nth-child(1) {
        display: none;
    }

    #problems td {
        border-left: none;
        border-right: none;
    }
</style>
<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <label for="note_text" class="col-form-label">{{__('translate.problem')}}</label>
                <select id="diagnosis_id" name="diagnosis_id"></select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="problems" border="0" style="width:100%">
            <tbody>
                <tr class="selected">
                    <td>0</td>
                    <td><img title="{{ __('translate.problem_indipendent') }}"
                        src="{{url('/images/icons/link_break.png')}}"></td>
                    <td>0</td>
                    <td>{{ __('translate.problem_indipendent') }}</td>
                    <td><img title="{{ __('translate.problem_indipendent') }}"
                        src="{{url('/images/icons/problem_indipendent.png')}}"></td>
                </tr>

                @foreach ($problems as $problem)
                <tr>
                    <td>{{ $problem->id }}</td>
                    <td><img title="{{ __('translate.' . $problem->getStatusDescription($problem->status_id)) }}"
                            src="{{url('/images/icons/problem_status_' . $problem->status_id . '.png')}}"></td>
                    <td>{{ $problem->diagnosis_id }}</td>
                    <td>{{ $problem->diagnosis->term_name }}</td>
                    <td>
                        @if( $problem->key_problem == true )
                        <img title="{{ __('translate.problem_key_problem') }}"
                            src="{{url('/images/icons/problem_key_problem.png')}}">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('problems.partials.edit')
@include('problems.partials.js')

@push('scripts')
@endpush