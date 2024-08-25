<div class="row">
    <div class="col">
        <dif class="row">
            <div class="col-12">
                <a class="btn btn-sm btn-outline-success float-end" href="#" role="button" data-bs-toggle="modal"
                    data-bs-target="#createNoteModal">
                    {{ __('translate.new') }}
                </a>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('translate.subjective_analysis') }}</th>
                            <th>{{ __('translate.objective_analysis') }}</th>
                            <th>{{ __('translate.assessment') }}</th>
                            <th>{{ __('translate.plan') }}</th>
                            <th>{{ __('translate.created_at') }}</th>
                            <th>{{ __('translate.updated_at') }}</th>
                            <th>{{ __('translate.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pet->notes as $note)
                            <tr>
                                <td>{{ $note->subjective }}</td>
                                <td>{{ $note->objective }}</td>
                                <td>{{ $note->assessment }}</td>
                                <td>{{ $note->plan }}</td>
                                <td>{{ $note->created_at }}</td>
                                <td>{{ $note->updated_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="#" role="button"
                                        data-bs-toggle="modal" data-bs-target="#edit-note-modal-{{ $note->id }}">
                                        {{ __('translate.edit') }}
                                    </a>
                                    <a href="{{ route('clinics.owners.pets.notes.show', [$clinic, $owner, $pet, $note]) }}"
                                        class="btn btn-sm btn-outline-info">{{ __('translate.view') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </dif>
    </div>
</div>
