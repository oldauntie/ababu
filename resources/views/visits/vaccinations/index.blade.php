<div class="row">
    <div class="col">
        <dif class="row">
            <div class="col-12">
                <a class="btn btn-sm btn-outline-success float-end" href="#" role="button" data-bs-toggle="modal"
                    data-bs-target="#vaccinations-create-modal">
                    {{ __('translate.new') }}
                </a>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('translate.vaccine') }}</th>
                            <th>{{ __('translate.batch') }}</th>
                            <th>{{ __('translate.vaccination_date') }}</th>
                            <th>{{ __('translate.booster_date') }}</th>
                            <th>{{ __('translate.created_at') }}</th>
                            <th>{{ __('translate.updated_at') }}</th>
                            <th>{{ __('translate.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pet->vaccinations as $vaccination)
                            <tr>
                                <td>{{ $vaccination->vaccine }}</td>
                                <td>{{ $vaccination->batch }}</td>
                                <td>{{ $vaccination->vaccination_date }}</td>
                                <td>{{ $vaccination->booster_date }}</td>
                                <td>{{ $vaccination->created_at }}</td>
                                <td>{{ $vaccination->updated_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="#" role="button"
                                        data-bs-toggle="modal" data-bs-target="#vaccination-edit-modal-{{ $vaccination->id }}">
                                        {{ __('translate.edit') }}
                                    </a>
                                    {{-- 
                                    <a href="{{ route('clinics.owners.pets.vaccinations.show', [$clinic, $owner, $pet, $note]) }}"
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
