<form method="GET" action="{{ route('clinics.enroll') }}">
    @csrf
    <div class="form-group">

        <div class="row">
            <div class="col-8">
                <input type="text" name="token" id="token" value="{{ old('token') }}"
                    class="form-control form-control-lg" placeholder="{{ __('help.clinic_token_example') }}" required
                    maxlength="17" minlength="17" />
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-secondary btn-lg">{{ __('translate.join') }}</button>
            </div>
        </div>
        <div class="row">
            <small id="help_clinic_join" class="form-text text-muted">{{ __('help.clinic_join') }}
                {{ __('help.clinic_token_example') }}</small>
        </div>
    </div>
</form>
