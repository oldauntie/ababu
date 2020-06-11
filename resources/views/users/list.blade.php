@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('translate.Clinic') }}: 
                    {{ $clinic->name }} >> 
                    {{__('translate.Users')}}
                </div>

                <div class="card-body">
                    <table id="users" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>role</th>
                                <th>email</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinic->users as $user)
                            
                            {{ var_dump( $user->hasRoleByClinicId('admin', $clinic->id) ) }} 
                            
                            
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{ implode(', ', $user->roles()->where('clinic_id', $clinic->id)->get()->pluck('name')->toArray()) }}</td>
                                <td>{{$user->email}}</td>
                                <td style="width: 180px">
                                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                                    <a href="#" class="btn btn-sm btn-primary">{{__('translate.roles')}}</a>
                                    <a href="#" onclick="return confirm('{{__('message.are_you_sure')}}')" class="btn btn-sm btn-danger">{{__('translate.delete')}}</a>
                                    @endif
                                    <a href="#" class="btn btn-sm btn-secondary">{{__('translate.view')}}</a>

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

