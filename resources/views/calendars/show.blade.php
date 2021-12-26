@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{__('translate.calendar')}}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12">
                            <div id='fullCalendar'></div>
                        </div>
                    </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection



@push('scripts')

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox/5.4.0/bootbox.min.js')}}"></script>
<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment/2.27.0/moment-with-locales.js')}}"></script>

<!-- fullcalendar -->
<link rel="stylesheet" href="{{ url('lib/fullcalendar/5.10.1/lib/main.min.css') }}">
<script src="{{ url('lib/fullcalendar/5.10.1/lib/main.min.js') }}"></script>
<script src="{{ url('lib/fullcalendar/5.10.1/lib/locales-all.min.js') }}"></script>

<!-- toastr -->
<link href="{{ url('lib/toastr.js/2.1.4/toastr.min.css') }}" rel="stylesheet"/>
<script src="{{ url('lib/toastr.js/2.1.4/toastr.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var endpoint = "{{ url('/') }}";

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
            initialView: "dayGridMonth",
            // initialDate: "2021-11-07",
            editable: true,
            selectable: true,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            select: function (arg) {
                var event_title = prompt('Event Name:');
                if (event_title) {                    
                    $.ajax({
                        url: '{{ route('clinics.calendars.manage', $clinic) }}',
                        data: {
                            title: event_title,
                            start: moment(arg.start).format('YYYY-MM-DD HH:mm:ss'),
                            end: moment(arg.end).format('YYYY-MM-DD HH:mm:ss'),
                            type: 'create'
                        },
                        type: "POST",
                        error: function (data) {
                            console.error("create " +  data );
                            displayErrorMessage("Cannot create Event.");
                        },
                        success: function (data) {
                            // @todo: translate
                            displaySuccessMessage("Event created.");
                            //refresh calendar
                            calendar.refetchEvents();
                        }
                    });
                }
            },
            eventDrop: function (arg) {
                $.ajax({
                    url: '{{ route('clinics.calendars.manage', $clinic) }}',
                    data: {
                        id: arg.event.id,
                        start: moment(arg.event.start).format('YYYY-MM-DD HH:mm:ss'),
                        end: moment(arg.event.end).format('YYYY-MM-DD HH:mm:ss'),
                        type: 'edit'
                    },
                    type: "POST",
                    error: function (data) {
                        console.error("edit " +  data );
                        displayErrorMessage("Cannot edit Event.");
                    },
                    success: function (data) {
                        // @todo: translate
                        displaySuccessMessage("Event saved.");
                        //refresh calendar
                        calendar.refetchEvents();
                    }
                });
            },
            eventResize: function (arg) {
                $.ajax({
                    url: '{{ route('clinics.calendars.manage', $clinic) }}',
                    data: {
                        id: arg.event.id,
                        start: moment(arg.event.start).format('YYYY-MM-DD HH:mm:ss'),
                        end: moment(arg.event.end).format('YYYY-MM-DD HH:mm:ss'),
                        type: 'edit'
                    },
                    type: "POST",
                    error: function (data) {
                        console.error("edit " +  data );
                        displayErrorMessage("Cannot edit Event.");
                    },
                    success: function (data) {
                        // @todo: translate
                        displaySuccessMessage("Event updated.");
                        //refresh calendar
                        calendar.refetchEvents();
                    }
                });
            },
            eventClick: function (arg) {
                var confirmDelete = confirm("Do you Really want to delete event " + arg.event.title + "?");
                
                if (confirmDelete) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('clinics.calendars.manage', $clinic) }}',
                        data: {
                            id: arg.event.id,
                            type: 'delete'
                        },success: function (response) {
                            // @todo: translate
                            displaySuccessMessage("Event deleted.");
                            //refresh calendar
                            calendar.refetchEvents();
                        }
                    });
                }
            },
        });

        calendar.render();
    });

    function displaySuccessMessage(message) {
        toastr.success(message, 'Event');
    }

    function displayErrorMessage(message) {
        toastr.error(message, 'Event');   
    }

</script>
@endpush