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
            initialView: "dayGridMonth",
            initialDate: "2021-11-07",
            editable: true,
            selectable: true,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            select: function (selectionInfo ) {
                // console.log(selectionInfo);

                var event_title = prompt('Event Name:');
                if (event_title) {
                    // var event_start = $.calendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                    // var event_end = $.calendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                
                    console.log(selectionInfo.start);
                    var event_start = FullCalendar.formatDate(selectionInfo.start, 
                        { // will produce something like "Tuesday, September 18, 2018"
                            month: '2-digit',
                            year: 'numeric',
                            day: '2-digit',
                        }
                    );
                    
                    console.log(event_start);
                    
                    
                    $.ajax({
                        url: endpoint + "/manage-events",
                        data: {
                            event_title: event_title,
                            event_start: selectionInfo.startStr,
                            event_end: selectionInfo.endStr,
                            type: 'create'
                        },
                        type: "POST",
                        error: function (data) {
                            console.error("create " +  data );
                        },
                        success: function (data) {
                            displayMessage("Event created.");

                            /*
                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: event_title,
                                start: event_start,
                                end: event_end,
                                allDay: allDay
                            }, true);
                            calendar.fullCalendar('unselect');
                            */
                        }
                    });
                }
            },
            eventDrop: function (event, delta) {
                var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: endpoint + '/manage-events',
                    data: {
                        title: event.event_title,
                        start: event_start,
                        end: event_end,
                        id: event.id,
                        type: 'edit'
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Event updated");
                    }
                });
            },
            eventClick: function (event) {
                alert(event);
                var removeEvent = confirm("Really?");
                if (removeEvent) {
                    $.ajax({
                        type: "POST",
                        url: endpoint + '/manage-events',
                        data: {
                            id: event.id,
                            type: 'delete'
                        },success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage("Event deleted");
                        }
                    });
                }
            },/*
            events: [
                {
                    title: "All Day Event",
                    start: "2021-11-01"
                },
                {
                    title: "Long Event",
                    start: "2021-11-07",
                    end: "2021-11-10"
                },
                {
                    groupId: "999",
                    title: "Repeating Event",
                    start: "2021-11-09T16:00:00"
                },
                {
                    groupId: "999",
                    title: "Repeating Event",
                    start: "2021-11-16T16:00:00"
                },
                {
                    title: "Conference",
                    start: "2021-11-11",
                    end: "2021-11-13"
                },
                {
                    title: "Meeting",
                    start: "2021-11-12T10:30:00",
                    end: "2021-11-12T12:30:00"
                },
                {
                    title: "Lunch",
                    start: "2021-11-12T12:00:00"
                },
                {
                    title: "Meeting",
                    start: "2021-11-12T14:30:00"
                },
                {
                    title: "Birthday Party",
                    start: "2021-11-13T07:00:00"
                },
                {
                    title: "Click for Google",
                    url: "http://google.com/",
                    start: "2021-11-28"
                }
            ]
            */
        });

        calendar.render();


    });

    function displayMessage(message) {
        toastr.success(message, 'Event');            
    }


</script>
@endpush