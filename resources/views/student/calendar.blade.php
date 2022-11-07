@extends('layout.master')
@push('css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet'/>
@endpush

@section('breadcrum')
    {{ Breadcrumbs::render('calendarStudent') }}
@endsection


@section('content')
    <style>
        #calendar {
            position: relative;
        }

        .colorFill {
            position: absolute;
            top:200px;

            left: 40px;
          display: flex;
            width: 100%;
            height: 100%;

        }
        .colorFill2 {

            position: absolute;
            top:230px;
            left: 40px;
            display: flex;
            width: 100%;
            height: 100%;

        }
        .colorFill3 {

            position: absolute;
            top:260px;
            left: 40px;
            display: flex;
            width: 100%;
            height: 100%;

        }
        .colorBlue {
            margin-top: 5px;
            margin-right: 15px;
            background-color: #3788d8;

            height: 12px;
            width: 12px;
            left: 0px;
            top: 0px;
            border-width: 0px;

            border-radius: 12px;
        }
        .colorRed {
            margin-top: 5px;
            margin-right: 15px;
            background-color: red;

            height: 12px;
            width: 12px;
            left: 0px;
            top: 0px;
            border-width: 0px;

            border-radius: 12px;
        }
        .colorGreen {
            margin-top: 5px;
            margin-right: 15px;
            background-color: green;

            height: 12px;
            width: 12px;
            left: 0px;
            top: 0px;
            border-width: 0px;

            border-radius: 12px;
        }
    </style>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="colorFill3">
                        <span class="colorBlue">
                        </span>
                        <span> Lịch</span>
                    </div>
                    <div class="colorFill">
                        <span class="colorRed">
                        </span>
                        <span> Vắng học</span>
                    </div>
                    <div class="colorFill2">
                        <span class="colorGreen">
                        </span>
                        <span> Đi học</span>
                    </div>
                    <div id='calendar' style="width: 1100px; margin: 40px auto;">

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/vi.js'></script>
    <script>
        $.ajax({
            url: '{{route('getSchedule')}}',
            type: 'get',
            data: {id: '{{Auth()->guard('student')->user()->id}}'},
            success: function (response) {
                console.log(response)


                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                        center: 'title',
                        left: 'today prev,next',
                        defaultView: 'timeGridWeek',
                    },
                    editable: true,
                    selectable: true,
                    events: response,

                });

                calendar.setOption('locale', 'vi');

                calendar.render();
            }
        })


    </script>
@endpush
