@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('attendance') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')
    @foreach($schedules as $schedule)
        <div class="card">

            <div class="card-body">

                <div class="col-12">
                    <form method="post" id="form{{$schedule->id}}">
                        @csrf
                        <div class="mt-2">
                            <a class="text-dark" data-toggle="collapse" onclick="pushID({{$schedule->id}})"
                               href="#todayTasks{{$schedule->id}}"
                               aria-expanded="true"
                               aria-controls="todayTasks">
                                <div class="m-0 pb-2">
                                    <i class="uil uil-angle-down font-18"></i>{{$schedule->subject->name}} <span
                                        class="text-muted"> Chưa điểm danh</span>
                                </div>
                            </a>
                            <div class="collapse " id="todayTasks{{$schedule->id}}">
                                <div class="spinner-border d-flex my-5 mx-auto"></div>
                                <div class="card mb-0">

                                    <div class="card-body{{$schedule->id}} d-none">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group d-none mt-2 ml-2">
                                                    <label for="date">Buổi</label>
                                                    <select class="form-control select2" id="date{{$schedule->id}}"
                                                            onChange="dateChange({{$schedule->id}})" name="date"
                                                            data-toggle="select2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$schedule->id}}" name="class_id">
                                        <div id="spinner{{$schedule->id}}"
                                             class="spinner-border d-flex my-5 mx-auto "></div>
                                        <table id="table{{$schedule->id}}" class="table table-centered mb-0">
                                            <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Tên
                                                </th>
                                                <th>
                                                    Tình trạng
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="body{{$schedule->id}}">
                                            </tbody>
                                        </table>
                                        <button type="submit" id="buttonAttendance{{$schedule->id}}"
                                                onClick="submitForm({{$schedule->id}})"
                                                class="btn btn-primary">Điểm danh
                                        </button>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end .collapse-->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

@endsection
@push('js')
    <script>

        function updateSchedule(date, id) {

            $.ajax({
                url: "{{route('teacher.getAttendanceClass')}}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    classSchedule_id: id,
                    date: date,
                },
                success: function (response) {
                    $(".spinner-border").hide();
                    $(".spinner-border").removeClass('d-flex');
                    $(".card-body" + id).removeClass('d-none');
                    if (response[1].length != 0) {
                        $("#buttonAttendance"+id).text("Cập nhật điểm danh");
                    } else {
                        $("#buttonAttendance"+id).text("Điểm danh");
                    }

                    $('#body' + id).empty()
                    response[0][0].students.forEach(function (student) {

                        $('#body' + id).append(` <tr>
                                                    <td>${student.id}</td>
                                                    <td>${student.name}</td>
                                                    <td>
                                                        <div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" checked id="${student.id}"
                                                                       name="status[${student.id}]"
                                                                        ${response[1][`${student.id}`] == 1 ? "checked" : ""}
                                                                       value="1" class="custom-control-input on-school">
                                                                <label class="custom-control-label "
                                                                       for="${student.id}">Đi
                                                                    học</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="${student.id} a"
                                                                       name="status[${student.id}]"
                                                        ${response[1][`${student.id}`] == 2 ? "checked" : ""}
                                                                       value="2" class="custom-control-input">
                                                                <label class="custom-control-label"
                                                                       for="${student.id} a">Nghĩ học</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="${student.id} b"
                                                                       name="status[${student.id}]"
                                                                    ${response[1][`${student.id}`] == 3 ? "checked" : ""}
                                                                       value="3" class="custom-control-input">
                                                                <label class="custom-control-label"
                                                                       for="${student.id} b">Nghĩ có phép</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>`)
                    })
                }
            });

        }

        function dateChange(id) {
            let date = $('#date' + id).val();

            updateSchedule(date, id)

        }

        function pushID(id) {
                console.log(id)
            $("#date" + id).click(function (e) {
                e.stopPropagation()
            })
            $.ajax({
                url: "{{route('getDateAttendance')}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (response) {
                    console.log(response)
                    let date = response[Object.keys(response)[Object.keys(response).length - 1]]

                    updateSchedule(date, id)
                    $('#date' + id).parent().removeClass('d-none');
                    $('#date' + id).empty()

                    let arrCheck = []
                    response[1].forEach(function (f) {

                        arrCheck.push(f.date.split(' ')[0])

                    })

                    $.each(response[0], function (key, value) {
                        let exists = arrCheck.includes(value)


                        $('#date' + id).append(`<option selected id="optionSelected${value+id}" value="${value}"> Buổi ${key} - ${value}
                                                    <span style="color: red"> ${exists ? "" : "Chưa điểm danh"} </span>
                        </option>`)
                    });
                }


            });

        }
        function submitForm(id, event) {
            let date = $('#date' + id).val()
            $("#form" + id).submit(function (e) {
                e.preventDefault()
                e.stopImmediatePropagation()
                console.log(id)
                let data = {};
                $.each($(`#form${id} input[name^="status\\["]`).serializeArray(), function () {
                    let a = this.name
                    a = a.split('[', 2)[1].slice(0, -1)
                    data[a] = this.value;
                });

                $.ajax({
                    url: "{{route('teacher.attendanceStudent')}}",
                    type: "POST",

                    data: {
                        _token: "{{ csrf_token() }}",
                        status: data,
                        date: $('#date' + id).val(),
                        class_id: $(`#form${id} input[name="class_id"]`).val(),
                    },
                    success: function (response) {
                        $.toast({
                            heading: 'Success',
                            text: 'Điểm danh thành công',
                            icon: 'success',
                            position: 'top-right',
                        })
                        $("#buttonAttendance"+id).text("Cập nhật điểm danh");
                        let valueAttr = $("#optionSelected" + date+id).text();
                        let str= valueAttr.split('C')
                    $(`span[title="${valueAttr}"]`).text(str[0])
                    }


                });

            });


        }


    </script>
@endpush
