@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('translate.note_create') }}
                        </div>
                        <div class="float-end">
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('clinics.owners.pets.notes.store', [$clinic, $owner, $pet]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('subjective') is-invalid @enderror" name="subjective"
                                    placeholder="{{ __('translate.subjective_analysis') }}" id="subjective" style="height: 100px" required></textarea>
                                <label for="subjective">{{ __('translate.subjective_analysis') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                                    placeholder="{{ __('translate.objective') }}" id="objective" style="height: 100px" required></textarea>
                                <label for="objective">{{ __('translate.objective_analysis') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                                    placeholder="{{ __('translate.assessment') }}" id="assessment" style="height: 100px" required></textarea>
                                <label for="assessment">{{ __('translate.assessment') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                                    placeholder="{{ __('translate.plan') }}" id="plan" style="height: 100px" required></textarea>
                                <label for="plan">{{ __('translate.plan') }}</label>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col text-center">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg">{{ __('translate.save') }}</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
