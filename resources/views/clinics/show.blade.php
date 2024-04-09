@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <b>{{ strtoupper(__('translate.clinic')) }}: </b>{{ $clinic->name }}
                            <br>
                            <small>{{ $clinic->description }}</small>
                        </div>
                        <div class="float-end">
                            @if (Auth::user()->hasRoleByClinicId('admin', $clinic->id))
                                <a href="{{ route('clinics.edit', [$clinic->id]) }}"
                                    class="btn btn-sm btn-outline-primary">{{ __('translate.edit') }}</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#invite-modal">{{ __('translate.invite') }}</button>
                                <button
                                    class="btn btn-sm btn-outline-danger open_modal_delete">{{ __('translate.delete') }}</button>
                            @endif
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

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <caption>{{ __('translate.owners_list') }}</caption>
                                    <thead class="table-light">
                                        <tr>
                                            <th>{{ __('translate.firstname') }}</th>
                                            <th>{{ __('translate.lastname') }}</th>
                                            <th>{{ __('translate.phone') }} #1</th>
                                            <th>{{ __('translate.phone') }} #2</th>
                                            <th>{{ __('translate.email') }}</th>
                                            <th>{{ __('translate.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clinic->owners as $owner)
                                            <tr>
                                                <td>{{ $owner->firstname }}</td>
                                                <td>{{ $owner->lastname }}</td>
                                                <td>{{ $owner->phone_primary }}</td>
                                                <td>{{ $owner->phone_secondary }}</td>
                                                <td>{{ $owner->email }}</td>
                                                <td><a href="{{ route('clinics.owners.show', [$clinic->id, $owner->id]) }}"
                                                        class="btn btn-sm btn-outline-primary">{{ __('translate.select') }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('clinics.owners.create', [$clinic->id]) }}" class="btn btn-sm btn-outline-success">{{ __('translate.add') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRoleByClinicId('admin', $clinic->id))
        @include('clinics.partials.invite')
    @endif

@endsection
