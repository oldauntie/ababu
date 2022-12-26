<!-- Attachment Modal -->
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="invite-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="confirm-delete-modal-form" method="POST" action="#">
                @csrf
                @method('DELETE')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-modal-label">
                        {{__('translate.owner')}} {{__('translate.delete')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="attachment-body-content">
                    <div>
                    {{ __('message.are_you_sure') }}
                    </div>

                    <small> {{__('help.owner_delete')}} </small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{__('translate.delete')}}</button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('translate.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Attachment Modal -->