<div class="row">
    <div class="col">
        <dif class="row">
            <div class="col-12">
                <a class="btn btn-sm btn-outline-success float-end" href="#" role="button" data-bs-toggle="modal"
                    data-bs-target="#biometrics-create-modal">
                    {{ __('translate.new') }}
                </a>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('translate.heigth') }}</th>
                            <th>{{ __('translate.length') }}</th>
                            <th>{{ __('translate.weigth') }}</th>
                            <th>{{ __('translate.temperature') }}</th>
                            <th>{{ __('translate.created_at') }}</th>
                            <th>{{ __('translate.updated_at') }}</th>
                            <th>{{ __('translate.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pet->biometrics as $biometric)
                            <tr>
                                <td>{{ $biometric->heigth }}</td>
                                <td>{{ $biometric->length }}</td>
                                <td>{{ $biometric->weigth }}</td>
                                <td>{{ $biometric->temperature }}</td>
                                <td>{{ $biometric->created_at }}</td>
                                <td>{{ $biometric->updated_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="#" role="button"
                                        data-bs-toggle="modal" data-bs-target="#biometric-edit-modal-{{ $biometric->id }}">
                                        {{ __('translate.edit') }}
                                    </a>
                                    {{-- 
                                    <a href="{{ route('clinics.owners.pets.biometrics.show', [$clinic, $owner, $pet, $note]) }}"
                                        class="btn btn-sm btn-outline-info">{{ __('translate.view') }}</a>
                                    --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </dif>
    </div>
</div>
