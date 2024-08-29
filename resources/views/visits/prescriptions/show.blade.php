@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.prescription_show') }}
                            <br>
                            <small>
                                small
                            </small>
                        </div>
                        <div class="float-end">
                            {{ session()->flash('set_active_tab', 'notes') }}
                            <a href="{{ url()->previous() }}"
                                class="btn btn-sm btn-outline-secondary">{{ __('translate.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        body

                    </div>
                    <div class="card-footer">
                        <small>
                            {{ __('translate.created_at') }}: {{ $prescription->created_at }}
                            {{ __('translate.updated_at') }}: {{ $prescription->updated_at }} {{ __('translate.by') }}
                            {{ $prescription->user->name }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
