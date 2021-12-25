@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-5">Laravel Calendar CRUD Events Example</h2>
    <div id='fullCalendar'></div>
</div>



@endsection

@push('scripts')

<!-- bootbox -->
<script type="text/javascript" src="{{url('/lib/bootbox-v5.4.0/bootbox.min.js')}}"></script>
<!-- moment -->
<script type="text/javascript" src="{{url('/lib/moment-v2.27.0/moment-with-locales.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
                    color: 'yellow',
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
            select: function (selectionInfo ) {
                console.log('select');

                var event_title = prompt('Event Name:');
                if (event_title) {                    
                    $.ajax({
                        url: '{{ route('clinics.calendars.manage', $clinic) }}',
                        data: {
                            title: event_title,
                            start: moment(selectionInfo.start).format('YYYY-MM-DD HH:mm:ss'),
                            end: moment(selectionInfo.end).format('YYYY-MM-DD HH:mm:ss'),
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
                        displaySuccessMessage("Event saved.");
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
                            displaySuccessMessage("Event saved.");
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