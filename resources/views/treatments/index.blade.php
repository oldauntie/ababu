<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <select id="procedure_id" name="procedure_id"></select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="treatments" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.created_at')}}</th>
                    <th>{{__('translate.name')}}</th>
                    <th>{{__('translate.recall_at')}}</th>
                    <th>{{__('translate.notes')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@include('treatments.partials.delete')
@include('treatments.partials.edit')
@include('treatments.partials.js')

@push('scripts')
@endpush