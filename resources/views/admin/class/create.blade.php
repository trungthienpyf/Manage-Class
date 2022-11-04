@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classCreate') }}
@endsection
<!-- end page title -->


@push('css')


    <!-- end row -->


@endpush
<!-- end row -->

@section('content')


    <div class="col-12">
        <form method="post" action="{{route('admin.class.store')}}">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">

                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach

                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    @csrf
                    <div class="col-xl-12" data-select2-id="6">
                        <div class="form-group">
                            <label for="subject">Môn học</label>
                            <select class="form-control select2" id="subject" name="subject_id" data-toggle="select2">

                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="target">Số lượng chỉ tiêu</label>
                            <input type="text" id="target" class="form-control" placeholder="15">
                        </div>
                        <div class="form-group">
                            <label for="shift">Chọn ca</label>
                            <select class="form-control select2" id="shift" name="shift" data-toggle="select2">

                                @foreach($shifts as $key => $shift)
                                    <option value="{{$shift}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weekdays">Ngày học</label>
                            <select class="form-control select2" id="weekdays" name="weekdays" data-toggle="select2">
                                @foreach($weekdays as $key=> $weekday)
                                    <option value="{{$weekday}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Date View -->
                        <div class="form-group">
                            <label for="timeLine">Số tuần học</label>
                            <select class="form-control select2" id="timeLine" name="time_line" data-toggle="select2">
                                <option value=""></option>
                                @foreach($timeLines as $key=> $timeLine)
                                    <option value="{{$timeLine}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-none">
                            <label>Ngày dự kiến khai giảng</label>
                            <input type="date" id="time_start" class="form-control" name="time_start"
                                   min="{{date('Y-m-d',strtotime("+3 weeks"))}}"
                                   value="{{date('Y-m-d',strtotime("+3 weeks"))}}">
                        </div>
                        <!-- Date View -->
                        <div class="form-group d-none">
                            <label>Ngày dự kiến kết thúc</label>
                            <input type="date" class="form-control" name="time_end" id="time_end" readonly>
                        </div>

                        <div class="form-group d-none">
                            <label for="room">Phòng</label>
                            <select class="form-control select2" id="room" name="room_id" data-toggle="select2">
                            </select>

                        </div>
                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info  ">Tạo lớp</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">

                    <div class="mt-2">
                        <a class="text-dark" data-toggle="collapse" href="#todayTasks" aria-expanded="false"
                           aria-controls="todayTasks">
                            <h5 class="m-0 pb-2">
                                <i class="uil uil-angle-down font-18"></i>
                                Giáo viên
                                <span class="text-muted" id="count_teachers">

                                </span>
                            </h5>
                        </a>

                        <div class="collapse show" id="todayTasks">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div id="teachers" class="row justify-content-sm-between">

                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card -->
                        </div> <!-- end .collapse-->

                    </div>


                </div>
            </div>
        </form>
    </div>

@endsection
<!-- end row-->

@push('js')

    <script>
        $(document).ready(function () {

            function loadRoom(shift, weekdays, time_start, time_end) {

                $.ajax({
                    url: "{{route('getRooms')}}",
                    type: "POST",
                    data: {
                        shift: shift,
                        weekdays: weekdays,
                        time_start: time_start,
                        time_end: time_end,
                    },
                    success: function (response) {

                        $('#room').parent().removeClass('d-none');
                        $('#room').empty()
                        response.forEach(function (value) {
                            $('#room').append(`<option value="${value.id}"> ${value.name} </option>`)
                        });

                    }
                });
            }

            function loadTeacher(shift, weekdays, time_start, time_end,subject) {

                $.ajax({
                    url: "{{route('getTeachers')}}",
                    type: "POST",
                    data: {
                        shift: shift,
                        weekdays: weekdays,
                        time_start: time_start,
                        time_end: time_end,
                        subject: subject,
                    },
                    success: function (response) {
                        console.log(response)
                        response[0].forEach(function(item,i){
                            if(response[1].includes(item.id)){
                                response[0].splice(i, 1);
                                response[0].unshift(item);
                            }
                        });
                        console.log(response[0])
                        $('#teachers').empty()
                        $('#count_teachers').empty()

                        $('#count_teachers').append(`(${response[0].length})`)

                        response[0].forEach(function (value) {
                            $('#teachers').append(`<div class="col-sm-6 mb-2 mb-sm-0">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="teacher_id" class="custom-control-input" id="${value.id}" value="${value.id}">
                                                <label class="custom-control-label" for="${value.id}" >
                                                   ${value.name} ${response[1].includes(value.id) ? '(Đăng ký dạy)' : ''}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <img
                                                        src="https://w7.pngwing.com/pngs/906/222/png-transparent-computer-icons-user-profile-avatar-french-people-computer-network-heroes-black.png"
                                                        alt="image" class="avatar-xs rounded-circle mr-1"
                                                        data-toggle="tooltip"
                                                        data-placement="bottom"
                                                    >
                                                </div>
                                                <div>
                                                    <ul class="list-inline font-13 text-left">
                                                        <li class="list-inline-item">
                                                            <i class="uil uil-phone font-16 mr-1"></i> ${value.phone}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> <!-- end .d-flex-->
                                        </div>`)
                        });

                    }
                });
            }

            let timeLine = $('#timeLine');
            let timeChange
            let time_start = $('#time_start').val()
            let weekdays = $(this).find(":selected").val()

            $('#weekdays').change(function () {
                weekdays = $(this).find(":selected").val()
                loadRoom(idShift, weekdays, time_start, timeChange)
                loadTeacher(idShift, weekdays, time_start, timeChange)
            })

            let numberweek = 0
            timeLine.change(function () {
                let subject = $('#subject').find(":selected").val()
                if($(this).val() == ""){
                    console.log(1)
                    $('#time_start').parent().addClass('d-none');
                    $('#time_end').parent().addClass('d-none');
                    $('#room').parent().addClass('d-none');
                    $('#teachers').empty()
                    $('#count_teachers').empty()
                }else{
                $('#time_start').parent().removeClass('d-none');
                $('#time_end').parent().removeClass('d-none');

                if (timeLine.val() == 1) {
                    numberweek = 1209600000
                    timeChange = new Date(+new Date(time_start) + numberweek).toISOString().split('T')[0]
                    $('#time_end').val(timeChange);
                } else if (timeLine.val() == 2) {
                    numberweek = 3024000000

                    timeChange = new Date(+new Date(time_start) + numberweek).toISOString().split('T')[0]
                    $('#time_end').val(timeChange);
                } else {
                    numberweek = 4233600000
                    timeChange = new Date(+new Date(time_start) + numberweek).toISOString().split('T')[0]
                    $('#time_end').val(timeChange);
                }
                loadRoom(idShift, weekdays, time_start, timeChange)
                loadTeacher(idShift, weekdays, time_start, timeChange,subject)
                }

            });

            $('#time_start').change(function () {
                let subject = $('#subject').find(":selected").val()
                time_start = $(this).val()
                $("#time_end").val(new Date(+new Date($(this).val()) + numberweek).toISOString().split('T')[0]);
                console.log($("#time_end").val())
                loadRoom(idShift, weekdays, time_start, $("#time_end").val())
                loadTeacher(idShift, weekdays, time_start, $("#time_end").val(),subject)
            })

            let idShift = 1
            $("#shift").change(function () {
                let subject = $('#subject').find(":selected").val()
                console.log(subject)
                idShift = $(this).find(":selected").val()
                loadRoom(idShift, weekdays, time_start, timeChange)
                loadTeacher(idShift, weekdays, time_start, timeChange,subject)
                $.ajax({
                    url: '{{ route('getWeekdays') }}',
                    type: 'post',
                    data: {id: idShift},
                    success: function (response) {
                        console.log(response)
                        $('#weekdays').empty()
                        $.each(response, function (key, value) {
                            $('#weekdays').append(`<option value="${value}"> ${key} </option>`)
                        });

                    }
                })
            })
            $("#subject").change(function () {
                let subject = $('#subject').find(":selected").val()
                loadTeacher(idShift, weekdays, time_start, timeChange,subject)
            })

        });
    </script>

    <!-- end row -->


    <!-- Datatable Init js -->


@endpush

<!-- end row-->

<!-- End Content -->
