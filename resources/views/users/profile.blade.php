<style>
/* Selects any required <input> */
/* @todo: da usare */
input:required {
  border: 1px dashed red;
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
  
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('translate.name')}} *</label>
  
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{Auth::user()->name}}" class="form-control" name="name" autocomplete="name" maxlength="255" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registration" class="col-md-4 col-form-label text-md-right">{{__('translate.registration')}}</label>
  
                            <div class="col-md-6">
                                <input id="registration" type="text" value="{{Auth::user()->registration}}" class="form-control" name="registration" autocomplete="registration" maxlength="255">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{__('translate.phone')}}</label>
  
                            <div class="col-md-6">
                                <input id="phone" type="text" value="{{Auth::user()->phone}}" class="form-control" name="phone" autocomplete="phone" maxlength="64">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{__('translate.mobile')}}</label>
  
                            <div class="col-md-6">
                                <input id="mobile" type="text" value="{{Auth::user()->mobile}}" class="form-control" name="mobile" autocomplete="mobile" maxlength="64">
                            </div>
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