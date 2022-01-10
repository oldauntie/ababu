@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translate.clinic_join') }}</div>

                <div class="card-body">
                    <div class="col-7 offset-md-2">
                        @include('clinics.partials.join')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection