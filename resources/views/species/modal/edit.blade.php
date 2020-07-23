<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form method="POST" id="modal-edit-form" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modal-label">{{__('translate.species')}} {{__('translate.edit')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="attachment-body-content">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="card text-white bg-dark mb-0">
                        <div class="card-header">
                            <h2 class="m-0">{{__('translate.edit')}}</h2>
                        </div>
                        <div class="card-body">
                            <!-- complete_name -->
                            <div class="form-group">
                                <label class="col-form-label"
                                    for="modal-complete_name">{{__('translate.complete_name')}}</label>
                                <input type="text" name="complete_name" class="form-control" id="modal-complete_name"
                                    readonly>
                            </div>
                            <!-- /familiar_name -->
                            <!-- familiar_name -->
                            <div class="form-group">
                                <label class="col-form-label"
                                    for="modal-familiar_name">{{__('translate.familiar_name')}}</label>
                                <input type="text" name="familiar_name" class="form-control" id="modal-familiar_name" maxlength="255"
                                    required autofocus>
                            </div>
                            <!-- /familiar_name -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('translate.done')}}</button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('translate.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Attachment Modal -->