<!-- Modal -->
<div class="modal fade" id="invite-modal" tabindex="-1" aria-labelledby="invite-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="invite-modal-label">{{ __('translate.invite') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('clinics.send', $clinic) }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-floating mb-3">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $clinic->email }}" maxlength="255"
                            placeholder="{{ __('translate.email') }}">
                        <label for="email">{{ __('translate.email') }}</label>
                        <small>{{ __('help.clinic_invite') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">{{ __('translate.invite') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
