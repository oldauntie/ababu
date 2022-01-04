@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $clinic->name }}
                    @if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
                    <button class="btn btn-sm btn-primary open_modal_edit">{{__('translate.edit')}}</button>
                    <button class="btn btn-sm btn-secondary open_modal_invite">{{__('translate.invite')}}</button>
                    <button class="btn btn-sm btn-danger open_modal_delete">{{__('translate.delete')}}</button>
                    @endif
                    <br>
                    <small>{{$clinic->description}}</small>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- row -->
                    <div class="row">
                        <div class="col col-md-6">
                            <div id='fullCalendar'></div>
                        </div>

                        <div class="col col-md-6">
                            <h5>{{ __('translate.recent_visit_by_user') }}</h5>
                            <table class="table" border="0" width="100%">
                                <tr>
                                    <th>{{ __('translate.owner') }}</th>
                                    <th>{{ __('translate.pet') }}</th>
                                    <th>{{ __('translate.date') }}</th>
                                    <th></th>
                                </tr>
                                @foreach ($lastVisitByUser as $item)
                                <tr>
                                    <td>{{ collect($item->first()->variables["owner"])->get('lastname') . ', ' .
                                        collect($item->first()->variables["owner"])->get('firstname') }}</td>
                                    <td>{{ collect($item->first()->variables["pet"])->get('name') }}</td>
                                    <td>{{$item->first()->created_at}}</td>
                                    <td><a href="{{ $item->first()->request_uri }}"><button type="button"
                                                class="btn btn-sm btn-dark float-left">visit</button></a></td>
                                </tr>
                                @endforeach
                            </table>

                            <h5>{{ __('translate.recent_visit_by_clinic') }}</h5>
                            <table class="table" border="0" width="100%">
                                <tr>
                                    <th>{{ __('translate.owner') }}</th>
                                    <th>{{ __('translate.pet') }}</th>
                                    <th>{{ __('translate.date') }}</th>
                                    <th></th>
                                </tr>
                                @foreach ($lastVisitByClinic as $item)
                                <tr>
                                    <td>{{ collect($item->first()->variables["owner"])->get('lastname') . ', ' .
                                        collect($item->first()->variables["owner"])->get('firstname') }}</td>
                                    <td>{{ collect($item->first()->variables["pet"])->get('name') }}</td>
                                    <td>{{$item->first()->created_at}}</td>
                                    <td><a href="{{ $item->first()->request_uri }}"><button type="button"
                                                class="btn btn-sm btn-dark float-left">visit</button></a></td>
                                </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>



                    <!-- row -->
                    <div class="row">
                        <div class="col col-md-6">
                            <h5>{{ __('translate.links') }}</h5>
                            <ul>
                                <li><a href="{{route('clinics.pets.index', $clinic)}}">{{__('translate.pets')}}</a></li>
                                <li><a href="#">{{__('translate.visits')}}</a></li>
                                <li><a href="{{route('clinics.owners.index', $clinic)}}">{{__('translate.owners')}}</a>
                                </li>
                                <li><a
                                        href="{{route('clinics.calendars.show', $clinic)}}">{{__('translate.calendar')}}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col col-md-6">
                            @canany(['root', 'admin'], $clinic)
                            <h5>{{ __('translate.admin') }}</h5>
                            <ul>
                                <li><a href="{{route('clinics.users.list', $clinic)}}">{{__('translate.users')}}</a>
                                </li>
                                <li><a
                                        href="{{route('clinics.species.index', $clinic)}}">{{__('translate.species')}}</a>
                                </li>
                            </ul>
                            @endcanany
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
@include('clinics.partials.edit')
@include('clinics.partials.invite')
@include('clinics.partials.confirm-delete')
@endif

@endsection

@push('scripts')
@if( Auth::user()->hasRoleByClinicId('admin', $clinic->id) )
<script type="text/javascript">
    $(document).on('click','.open_modal_edit',function(){
        $('#edit-modal').modal('show');
    });

    $(document).on('click','.open_modal_invite',function(){
        $('#invite-modal').modal('show');
    });

    $(document).on('click','.open_modal_delete',function(){
        $('#confirm-delete-modal').modal('show');
    });
</script>
@endif



<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox/5.4.0/bootbox.min.js')}}"></script>
<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment/2.27.0/moment-with-locales.js')}}"></script>

<!-- fullcalendar -->
<link rel="stylesheet" href="{{ url('lib/fullcalendar/5.10.1/lib/main.min.css') }}">
<script src="{{ url('lib/fullcalendar/5.10.1/lib/main.min.js') }}"></script>
<script src="{{ url('lib/fullcalendar/5.10.1/lib/locales-all.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById("fullCalendar");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            eventSources: [
                {
                    url: '{{ route('clinics.calendars.events', $clinic) }}',
                    color: '',
                    textColor: 'black'
                }
            ],
            initialView: "listWeek",
            editable: false,
            selectable: false,
            headerToolbar: {
                // left: "prev,next",
                // center: "title",
                right: "listWeek,timeGridDay"
            },
        });

        calendar.render();
    });


</script>
@endpush