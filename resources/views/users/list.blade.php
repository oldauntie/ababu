@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('translate.clinic') }}: 
                    {{ $clinic->name }}
                </div>

                <div class="card-body">
                    <table id="users" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>role</th>
                                <th>email</th>
                                <th width="100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinic->users as $user)                            
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{ implode(', ', $user->roles()->where('clinic_id', $clinic->id)->get()->pluck('name')->toArray()) }}</td>
                                <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                <td style="width: 180px">
                                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                                    <a href="{{ route('clinics.users.edit', [$clinic, $user]) }}" class="btn btn-sm btn-primary">{{__('translate.edit')}}</a>
                                    <a href="#" onclick="return confirm('{{__('message.are_you_sure')}}')" class="btn btn-sm btn-danger">{{__('translate.delete')}}</a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

