@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.password_change') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach

                        <div class="form-group row">
                            <label for="password-current" class="col-md-4 col-form-label text-md-right">{{ __('translate.password_current') }}</label>

                            <div class="col-md-6">
                                <input id="password-current" type="password" class="form-control" name="password_current"
                                    autocomplete="password-current">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_new" class="col-md-4 col-form-label text-md-right">{{ __('translate.password_new') }}</label>

                            <div class="col-md-6">
                                <input id="password_new" type="password" class="form-control" name="password_new"
                                    autocomplete="password-new">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirm_new" class="col-md-4 col-form-label text-md-right">{{ __('translate.password_confirm_new') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirm_new" type="password" class="form-control"
                                    name="password_confirm_new" autocomplete="password_confirm_new">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('translate.password_update') }}
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