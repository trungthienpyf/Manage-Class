@extends('layout.master')
@push('css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet' />
@endpush

@section('breadcrum')
    {{ Breadcrumbs::render('calendarTeacher') }}
@endsection


@section('content')


    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div id='calendar' style="width: 1100px; margin: 40px auto;">

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/vi.js'></script>
    <script>
        const id= {{Auth()->user()->id}};

        $.ajax({
            url: '{{route('getScheduleTeacher')}}',
            type: 'get',
            data: {id: id},
            success: function (response) {
                console.log(response);

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    initialView: 'timeGridWeek',

                    headerToolbar: {
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                        center: 'title',
                        left:'today prev,next',
                        defaultView: 'timeGridWeek',
                    },
                    editable: true,
                    selectable: true,
                    events:response
                });

                calendar.setOption('locale', 'vi');

                calendar.render();
            }
        })




    </script>
@endpush
