@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.note_details') }}
                            <br>
                            <small>
                                {{ __('translate.updated_at')}}: {{ $note->updated_at }}
                                {{ __('translate.created_at')}}: {{ $note->created_at }} {{ __('translate.by') }} {{ $note->user->name}} 
                            </small>
                        </div>
                        <div class="float-end">
                            {{ session()->flash('set_active_tab','notes')}}
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">{{ __('translate.back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-floating mb-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('translate.subjective_analysis') }}
                                </div>

                                <div class="card-body">
                                    {{ $note->subjective }}
                                </div>
                            </div>
                        </div>


                        <div class="form-floating mb-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('translate.objective_analysis') }}
                                </div>

                                <div class="card-body">
                                    {{ $note->objective }}
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('translate.assessment') }}
                                </div>

                                <div class="card-body">
                                    {{ $note->assessment }}
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ __('translate.plan') }}
                                </div>

                                <div class="card-body">
                                    {{ $note->plan }}
                                </div>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
