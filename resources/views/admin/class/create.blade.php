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
            @csrf

            <div class="col-xl-6" data-select2-id="6">
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
                    <select class="form-control select2" id="shift"  name="shift"  data-toggle="select2">

                        @foreach($shifts as $key => $shift)
                            <option value="{{$shift}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="weekdays">Ngày học</label>
                    <select class="form-control select2" id="weekdays"  name="weekdays" data-toggle="select2">
                        @foreach($weekdays as $key=> $weekday)
                            <option value="{{$weekday}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Date View -->
                <div class="form-group">
                    <label for="timeLine">Số tuần học</label>
                    <select class="form-control select2" id="timeLine" name="time_line" data-toggle="select2">

                        @foreach($timeLines as $key=> $timeLine)
                            <option value="{{$timeLine}}">{{$key}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label>Ngày dự kiến khai giảng</label>
                    <input  name="time_start" type="date" class="form-control" id="time_start" min="{{date('Y-m-d',strtotime("+3 weeks"))}}" value="{{date('Y-m-d',strtotime("+3 weeks"))}}">
                </div>
                <!-- Date View -->
                <div class="form-group">
                    <label>Ngày dự kiến kết thúc</label>
                    <input type="date"  name="time_end" class="form-control"  id="time_end" readonly    >
                </div>

                <div class="form-group">
                    <label for="teacher">Giáo viên</label>
                    <select class="form-control select2" id="teacher" name="teacher_id"   data-toggle="select2">
                        <option value=""></option>

                    </select>
                </div>

                <div class="form-group mb-0 justify-content-end row">
                    <div class="col-9">
                        <button type="submit" class="btn btn-info  ">Tạo lớp</button>
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

      let time_start =$('#time_start').val()

        var fortnightAway = new Date(+new Date(time_start) + 12096e5).toISOString().split('T')[0];

        console.log(fortnightAway)

        $('#time_start').change(function () {
            $("#time_end").val(new Date(+new Date($(this).val()) + 12096e5).toISOString().split('T')[0]);
        })
        $("#time_end").val(fortnightAway);

        $("#shift").change(function () {
           let idShift=  $(this).find(":selected").val()

            $.ajax({
                url: '{{ route('getWeekdays') }}',
                type: 'post',
                data:  {id: idShift},
                success: function (response) {
                    console.log(response)
                    $('#weekdays').empty()
                    $.each(response, function(key, value) {
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
