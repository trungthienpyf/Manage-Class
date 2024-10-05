@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classTeacher') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="card">

        <div class="card-body">
            <div class="row">


            @foreach($schedules as $schedule)

                <div class="col-md-6 col-xl-3">
                    <!-- project card -->
                    <div class="card d-block">
                        <img class="card-img-top" src="{{asset('img/project-1.jpg')}}" alt="project image cap">
                        <div class="card-body ">

                            <!-- project title-->
                            <h4 class="mt-0">
                                <a  class="text-title">  # {{$schedule->id}} - Lớp {{$schedule->subject->name}}</a>
                            </h4>
                            {{--                    <p class="text-muted font-17 mb-3">Chương trình tích hợp nhiều level để học viên chọn học</a>--}}
                            </p>
                            <!-- project detail-->
                            <p class="mb-1">
                                Ngày khai giảng: <span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                {{$schedule->time_start_real}}
                                            </span>

                                <span class="text-nowrap mb-2 d-inline-block">
                           <b class="font-16"> {!! $dateCloset[$schedule->id] ? 'Ngày dạy tiếp theo:<br> '. $dateCloset[$schedule->id] : 'Lịch dạy đã kết thúc <br><span style="color:white">0</span>' !!}</b>
                        </span>

                            </p>

                            <div class=" d-flex justify-content-end">
                                <a href="{{route('teacher.quizz.indexByClass',$schedule->id)}}">
                                    <button class="btn btn-primary">Quản lý bài tập</button>
                                </a>
                            </div>
                        </div> <!-- end card-body-->

                    </div> <!-- end card-->
                </div> <!-- end col -->

                <!-- end col -->
                <!-- end col -->
                <!-- end col -->
            @endforeach
            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush
