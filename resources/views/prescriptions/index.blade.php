<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <label for="note_text" class="col-form-label">{{__('translate.prescription')}}</label>
                <select id="medicine_id" name="medicine_id"></select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 vertical-scroll">
        <table id="prescriptions" class="display" style="width:100%">
            <thead style="display: none">
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>{{__('translate.created_at')}}</th>
                    <th>{{__('translate.name')}}</th>
                    <th>{{__('translate.quantity')}}</th>
                    <th>{{__('translate.dosage')}}</th>
                    <th>{{__('translate.in_evidence')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@include('prescriptions.partials.delete')
@include('prescriptions.partials.edit')
@include('prescriptions.partials.js')

@push('scripts')
@endpush