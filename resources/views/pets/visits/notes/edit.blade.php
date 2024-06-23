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
                            {{ session()->flash('set_active_tab','notes')}}
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">{{ __('translate.back') }}</a>
                            <a class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#note_delete_confirmation">{{ __('translate.delete') }}</a>
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

                        <form method="POST"
                            action="{{ route('clinics.owners.pets.notes.update', [$clinic, $owner, $pet, $note]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('subjective') is-invalid @enderror" name="subjective"
                                    placeholder="{{ __('translate.subjective_analysis') }}" id="subjective" style="height: 100px" required>{{ $note->subjective }}</textarea>
                                <label for="subjective">{{ __('translate.subjective_analysis') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                                    placeholder="{{ __('translate.objective') }}" id="objective" style="height: 100px" required>{{ $note->objective }}</textarea>
                                <label for="objective">{{ __('translate.objective_analysis') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('assessment') is-invalid @enderror" name="assessment"
                                    placeholder="{{ __('translate.assessment') }}" id="assessment" style="height: 100px" required>{{ $note->assessment }}</textarea>
                                <label for="assessment">{{ __('translate.assessment') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('plan') is-invalid @enderror" name="plan"
                                    placeholder="{{ __('translate.plan') }}" id="plan" style="height: 100px" required>{{ $note->plan }}</textarea>
                                <label for="plan">{{ __('translate.plan') }}</label>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col text-center">
                                    <button type="submit"
                                        class="btn btn-outline-primary btn-sm">{{ __('translate.save') }}</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.partials.delete', [
        'id' => 'note_delete_confirmation',
        'action' => route('clinics.owners.pets.notes.destroy', [$clinic, $owner, $pet, $note]),
        'title' => __('message.are_you_sure'),
        'body' => __('message.confirm_record_deletion'),
    ])

@endsection
