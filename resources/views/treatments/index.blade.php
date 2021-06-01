<div class="row">
    <div class="col-12">
        <!-- owner -->
        <div class="row">
            <div class="col-md-12">
                <label for="note_text" class="col-form-label">{{__('translate.procedure')}}</label>
                <input type="image" name="" src="{{url('/images/icons/printer.png')}}" border="0" alt="" style="" />
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

@include('treatments.partial.delete')
@include('treatments.modal.edit')

@push('scripts')
@endpush