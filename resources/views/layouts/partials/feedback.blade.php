<!-- Attachment Modal -->
<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.feedback')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="feedback-modal-form" action="">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group row">

                        <!-- column 1 -->
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-12">
                                    <label for="feedback-text" class="text-md-right">{{__('translate.text')}}</label>
                                    <div class="input-group">
                                        <textarea name="feedback" id="feedback-text" rows="2" style="min-width: 100%"
                                            class="form-control form-control-sml">{{ old('feedback') }}</textarea>

                                        <small class="form-text text-muted">{{__('help.feedback')}}</small>
                                        @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-5">
                            <button type="submit" class="btn btn-primary btn-sm">{{__('translate.send')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        // print action
        $('#feedback-print-button').click(function(e){
        })
    });
</script>
@endpush