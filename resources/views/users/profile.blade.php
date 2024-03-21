<style>
    /* Selects any required <input> */
    /* @todo: da usare */
    input:required {
        border: 1px solid orange;
    }
</style>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('help.profile_update') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach


                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('translate.name') }}"
                                value="{{ Auth::user()->name }}" maxlength="255" required>
                            <label for="name">{{ __('translate.name') }}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="registration" class="form-control" id="registration" placeholder="{{ __('translate.registration') }}"
                                value="{{ Auth::user()->registration }}" maxlength="255">
                            <label for="registration">{{ __('translate.registration') }}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{ __('translate.phone') }}"
                                value="{{ Auth::user()->phone }}" maxlength="64">
                            <label for="phone">{{ __('translate.phone') }}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="{{ __('translate.mobile') }}"
                                value="{{ Auth::user()->mobile }}" maxlength="64">
                            <label for="mobile">{{ __('translate.mobile') }}</label>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{__('translate.update')}}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection