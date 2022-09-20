<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet' />

</head>
<body>
<div id='calendar' style="max-width: 1050px;  margin: 40px auto;">
</div>
</body>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/vi.js'></script>
<script>
    {{--$.ajax({--}}
    {{--    url: '{{route('api.getSchedule')}}',--}}
    {{--    type: 'get',--}}
    {{--    data: {id: '{{$id}}'},--}}
    {{--    success: function (response) {--}}

    {{--    }--}}
    {{--})--}}

    var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'timeGridWeek',
            headerToolbar: {
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: 'title',
                left:'today prev,next',
                defaultView: 'timeGridWeek',
            },

            events: [
                { // this object will be "parsed" into an Event Object
                    title: 'Hoc tieng anh', // a property!
                    start: "2022-09-20T06:56:09.000000Z", // a property!
                    end: "2022-09-20T09:56:09.000000Z" // a property! ** see important note below about 'end' **
                }
            ]
        });

        calendar.setOption('locale', 'vi');

        calendar.render();


</script>
</html>
