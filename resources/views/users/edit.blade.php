@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('translate.user')}}: {{$user->name}} [{{ __('translate.edit') }}]</div>

                <div class="card-body">
                    <form action="{{ route('clinics.users.update', [$clinic, $user]) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}

                        
                        <div class="form-group row">
                            <label for="roles" class="col-md-2 col-form-label text-md-right">{{ __('translate.roles') }}</label>
                            
                            <div class="col-md-6">
                                @foreach ($roles as $role)
                                    <div class="form-check">
                                    <input type="radio" name="roles[]" @if(auth()->user()->id == $user->id) onclick="return false;" @endif value="{{$role->id}}" 
                                    @if($user->roles()->where('clinic_id', $clinic->id)->get()->pluck('id')->contains($role->id)) checked @endif>
                                    <label>{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
