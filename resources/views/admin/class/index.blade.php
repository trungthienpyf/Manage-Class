@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classAdmin') }}
@endsection
<!-- end page title -->


@push('css')

    <!-- end row -->

    <link href="{{asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>

@endpush
<!-- end row -->

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-4 col-md-6 pb-2">
                <div class="dt-buttons btn-group">

                    <a href="{{route('admin.class.create')}}" class="btn btn-info buttons-print text-white"
                       type="button"><span>Thêm lớp</span></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right">

                    <form action="{{route('admin.importCsv')}}" class="d-none" id="formCsv" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input id="csv" name="csv" type="file" class="d-none" accept=".xlsx, .xls, .csv, .ods"/>
                    </form>

                    <label for="csv" class="btn btn-light mb-2 mr-1">Import</label>


                </div>
            </div>
        </div>
        <form action="{{route('admin.class.index')}}" id="search">
        <div class="row">



            <div class="col-sm-2 pb-2">

                <select name="teacher" id="teacherSearch" class="form-control select2" data-toggle="select2">
                    <option value="">Giảng viên</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}" {{ request()->teacher==$teacher->id ? 'selected':''}}>{{$teacher->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                    <select name="time" id="timeSearch" class="form-control select2" data-toggle="select2">
                        <option value=""> Thời gian</option>
                        <option value="1" {{ request()->time===1? 'selected':''}}>Chưa khai giảng</option>
                        <option value="2" {{ request()->time==2 ? 'selected':''}}>Đang diễn ra</option>
                        <option value="3" {{ request()->time==3? 'selected':''}}>Đã hoàn thành</option>
                    </select>

            </div>

        </div>
        </form>
        <div class="row">
            <div class="col-12">
                @if(session()->has('message'))
                    <p style="color: #8123b1">{{ session()->get('message') }} </p>
                @endif
            </div>
        </div>
        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên lớp</th>
                <th>Tên môn</th>
                <th>Ca</th>
                <th>Buổi học</th>
                <th>Số lượng</th>
                <th class="d-none">Số lượng</th>
                <th>Ngày mở lớp dự kiến</th>
                <th>Giảng viên</th>
                <th>Phòng</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classes as $class)

                <tr>
                    <td>{{$class->id}}</td>
                    <td>{{$class->name_schedule}}</td>
                    <td>{{$class->subject->name}}</td>
                    <td data-value="{{$class->shift}}">{{$class->name_shift}}</td>
                    <td data-value="{{$class->weekdays}}">{{$class->name_weekday}}</td>
                    <td>{{$class->student_count}}</td>
                    <td data-value="{{$class->time_start}}">{{$class->time_start_expected}}</td>
                    <td data-value="{{$class->time_end}}" class="d-none">{{$class->time_start_expected}}</td>
                    @if(!empty($class->teacher))
                        <td>{{  $class->teacher->name}} </td>
                    @else
                        <td id="nameTeacher{{$class->id}}">
                            <button onclick="loadTeacher({{$class->id}})" id="loadTeacher{{$class->id}}" type="button"
                                    class="btn btn-info" data-toggle="modal"
                                    data-target="#bs-example-modal-lg{{$class->id}}">Thêm Giảng viên
                            </button>
                            <div class="modal fade" id="bs-example-modal-lg{{$class->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Giảng viên</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                                                    onclick="hideModal({{$class->id}})">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <form action="" id="myForm">
                                                        <div id="teachers{{$class->id}}"
                                                             class="row justify-content-sm-between">
                                                        </div>
                                                    </form>
                                                </div> <!-- end card-body-->
                                            </div> <!-- end card -->
                                        </div>
                                        <div class="modal-footer">
                                            <button onclick="hideModal({{$class->id}})" type="button"
                                                    class="btn btn-light" data-dismiss="modal">Đóng
                                            </button>
                                            <button onclick="buttonUpdate({{$class->id}})"
                                                    id="buttonUpdate{{$class->id}}" type="button"
                                                    class="btn btn-primary"
                                                    data-dismiss="modal"
                                            >Cập nhật giảng viên
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    @endif

                    @if(!empty($class->room))
                        <td>{{  $class->room->name}} </td>
                    @else
                        <td>
                            <button class="btn btn-primary">Thêm Phòng</button>
                        </td>
                    @endif
                    <td class="d-flex">


                        <form  method="post">
                            @method('put')
                            @csrf
                            <button  class="btn btn-primary btn-sm">
                                <i class=" mdi mdi-square-edit-outline"></i>
                            </button>
                        </form>

                            <form action="{{route('admin.class.destroy',$class->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button  class="btn btn-danger btn-sm">
                                    <i class=" mdi mdi-delete-alert"></i>
                                </button>
                            </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
<!-- end row-->

@push('js')

    <!-- end row -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo.datatable-init.js')}}"></script>

    <!-- Datatable Init js -->
    <script>
            $("#teacherSearch").change(function () {

                $("#search").submit();
            });
            $("#timeSearch").change(function () {

                $("#search").submit();
            });
        function hideModal(id) {
            console.log(id)
            $("#teachers" + id).empty();
        }

        $("#csv").change(function () {
            $("#formCsv").submit();

        })

        function buttonUpdate(id) {
            console.log(id, $("#myForm input[name=teacher_id]:checked").val())
            $.ajax({
                url: "{{route('updateTeacher')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "class_id": id,
                    "teacher_id": $("#myForm input[name=teacher_id]:checked").val()
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {

                        $("#loadTeacher" + id).remove();
                        $("#nameTeacher" + id).append($("#myForm input[name=teacher_id]:checked").parent().find('label').text());
                    }
                    $('#bs-example-modal-lg' + id).remove();
                    $.toast({
                        heading: 'Success',
                        text: 'Cập nhật giáo viên thành công',
                        icon: 'success',
                        position: 'top-right',
                    })
                }
            });
        }

        function loadTeacher(id) {

            let shift = $('#loadTeacher' + id).parent().parent().find('td').eq(3).attr('data-value')
            let weekdays = $('#loadTeacher' + id).parent().parent().find('td').eq(4).attr('data-value')
            let time_start = $('#loadTeacher' + id).parent().parent().find('td').eq(6).attr('data-value')
            let time_end = $('#loadTeacher' + id).parent().parent().find('td').eq(7).attr('data-value')
            $('#bs-example-modal-lg' + id).modal({
                backdrop: 'static',
                keyboard: false
            })
            $.ajax({
                url: "{{route('getTeachers')}}",
                type: "Post",
                data: {
                    shift: shift,
                    weekdays: weekdays,
                    time_start: time_start,
                    time_end: time_end,
                },
                success: function (data) {
                    data[0].forEach(function(item,i){
                        if(data[1].includes(item.id)){
                            data[0].splice(i, 1);
                            data[0].unshift(item);
                        }
                    });
                    $('#teachers' + id).empty()
                    data[0].forEach(function (value) {
                        $('#teachers' + id).append(`   <div class="col-sm-6 mb-2 mb-sm-0">
                                            <div class="custom-control custom-radio">

                                                <input type="radio" name="teacher_id" class="custom-control-input"  id="${value.id}" value="${value.id}">
                                                <label class="custom-control-label" for="${value.id}" >
                                                   ${value.name} ${data[1].includes(value.id) ? '(Đăng ký dạy)' : ''}
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
                        $("input:radio[name=teacher_id]:first").attr('checked', true);
                    });

                }
            })

        }
    </script>

@endpush

<!-- end row-->

<!-- End Content -->
