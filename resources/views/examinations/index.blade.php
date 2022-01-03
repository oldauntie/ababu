
<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <label for="note_text" class="col-form-label">{{__('translate.examination')}}</label>
                <select id="diagnostic_test_id" name="diagnostic_test_id"></select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="examinations" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.created_at')}}</th>
                    <th>{{__('translate.name')}}</th>
                    <th>{{__('translate.in_evidence')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@include('examinations.partials.delete')
@include('examinations.partials.edit')
@include('examinations.partials.js')

@push('scripts')
@endpush