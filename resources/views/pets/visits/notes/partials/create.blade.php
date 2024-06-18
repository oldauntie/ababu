<form action="" method="POST">
    @csrf
    
    <div class="form-floating mb-3">
        <textarea class="form-control @error('subjeecive') is-invalid @enderror" name="subjeecive"
            placeholder="{{ __('translate.subjeecive') }}" id="subjeecive" style="height: 100px">
        </textarea>
        <label for="subjeecive">{{ __('translate.subjeecive') }}</label>
    </div>
</form>
