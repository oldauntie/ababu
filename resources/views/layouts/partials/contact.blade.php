<!-- Attachment Modal -->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title">{{__('translate.contact')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" name="contact-modal-form" id="contact-modal-form" action="javascript:void(0)">
                    @csrf
                    <div class="form-group row">

                        <!-- column 1 -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    From: <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="contact-type" class="text-md-right">{{__('translate.type')}}</label>
                                    <div class="input-group">
                                        <select name="contact-type" id="contact-type" class="form-control">
                                            <option value="bug">{{ __('translate.bug') }}</option>
                                            <option value="comment">{{ __('translate.comment') }}</option>
                                            <option value="feature">{{ __('translate.feature') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="contact-description"
                                        class="text-md-right">{{__('translate.contact')}}</label>
                                    <div class="input-group">
                                        <textarea name="contact-description" id="contact-description" rows="2"
                                            style="min-width: 100%" class="form-control form-control-sml"
                                            required>{{ old('contact-description') }}</textarea>
                                        <small class="form-text text-muted">{{__('help.contact_description')}}</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-5">
                            <button type="submit" id="contact-submit"
                                class="btn btn-primary btn-sm">{{__('translate.send')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->

<script type="text/javascript">
    $('#contact-modal-form').on('submit',function(e){
        e.preventDefault();

        let type = $('#contact-type').val();
        let description = $('#contact-description').val();

        $.ajax({
            url: "/contacts/store",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                type:type,
                description:description,
            },
            success:function(response){
                console.log(response);
                $('#contact-submit').removeClass('btn-success btn-primary btn-danger');
                $('#contact-submit').addClass('btn-success');
                // $('#contact-submit').prop('disabled', false);
                $('#contact-submit').text('{{ __('translate.sent') }}');
            },
            beforeSend: function(){
                $('#contact-submit').removeClass('btn-success btn-primary btn-danger');
                $('#contact-submit').text('sending...');
                $('#contact-submit').prop('disabled', true);
            },
            complete: function(){
                // $email.removeClass('show_loading_in_right')
            },
            error: function(){
                $('#contact-submit').removeClass('btn-success btn-primary btn-danger');
                $('#contact-submit').addClass('btn-danger');
                $('#contact-submit').text('error');
            }
        });
    });

    $('#contact-modal').on('hidden.bs.modal', function (e) {
        $('#contact-submit').removeClass('btn-success btn-primary btn-danger');
        $('#contact-submit').addClass('btn-primary');
        $('#contact-submit').prop('disabled', false);
        $('#contact-submit').text('{{ __('translate.send') }}');
        $('#contact-modal-form').trigger("reset");
    })
</script>