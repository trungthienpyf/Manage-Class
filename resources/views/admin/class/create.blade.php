@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


@push('css')


    <!-- end row -->

    <style>
        .datepicker {
            z-index: 9999 !important;
        }
    </style>

@endpush
<!-- end row -->

@section('content')


            <div class="col-12">
                <form method="post" action="{{route('admin.class.store')}}">
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
                                    <label for="teacher">Giáo viên</label>
                                    <select class="form-control select2" id="teacher" name="teacher_id" data-toggle="select2">
                                        <option value=""></option>

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
                                            <i class="uil uil-angle-down font-18"></i>Giáo viên <span class="text-muted">(10)</span>
                                        </h5>
                                    </a>

                                    <div class="collapse show" id="todayTasks">
                                        <div class="card mb-0">
                                            <div class="card-body">

                                                <div class="row justify-content-sm-between">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="task1">
                                                            <label class="custom-control-label" for="task1">
                                                                Draft the new contract document for sales team
                                                            </label>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <img
                                                                    src="https://w7.pngwing.com/pngs/906/222/png-transparent-computer-icons-user-profile-avatar-french-people-computer-network-heroes-black.png"
                                                                    alt="image" class="avatar-xs rounded-circle mr-1" data-toggle="tooltip"
                                                                    data-placement="bottom"
                                                                >
                                                            </div>
                                                            <div>
                                                                <ul class="list-inline font-13 text-left">
                                                                    <li class="list-inline-item">
                                                                        <i class="uil uil-phone font-16 mr-1"></i> Today 10am
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
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

            let timeLine = $('#timeLine');
            let timeChange
            let time_start = $('#time_start').val()
            let numberweek = 0
            timeLine.change(function () {
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

                $.ajax({
                    url: '{{ route('getTeachers') }}',
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
            });


            // 3024000000
            $('#time_start').change(function () {

                $("#time_end").val(new Date(+new Date($(this).val()) + numberweek).toISOString().split('T')[0]);
            })


            $("#shift").change(function () {
                let idShift = $(this).find(":selected").val()

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


        });
    </script>

    <!-- end row -->


    <!-- Datatable Init js -->


@endpush

<!-- end row-->

<!-- End Content -->
