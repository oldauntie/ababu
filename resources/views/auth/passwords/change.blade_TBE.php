@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">

                    <!--- here form begins -->
                    {{Form::open(array('url' => '/account/change-password'))}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">

                        <div class="row">
                            <div class="col">
                                <label for="password" class="control-label">Current Password</label>
                            </div>
                            <div class="col">
                                {{Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password'))}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="new-password" class="control-label">New Password</label>
                            </div>
                            <div class="col">
                                {{Form::password('new-password', array('id' => 'new-password', 'class' => 'form-control', 'placeholder' => 'New Password'))}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="new-password-confirmation" class="control-label">Re-enter
                                    Password</label>
                            </div>
                            <div class="col">
                                {{Form::password('new-password-confirmation', array('id' => 'new-password-confirmation', 'class' => 'form-control', 'placeholder' => 'Confirm Password'))}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Change Password</button>
                    </div>
                    {{Form::close()}}





                    <!--- here form begins -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection