<div class="row">
    <div class="col">
        <dif class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('translate.subjective') }}</th>
                            <th>{{ __('translate.objective') }}</th>
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
                                <td><a href="#" class="btn btn-sm btn-outline-success">{{ __('translate.visit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </dif>   
    </div>
</div>