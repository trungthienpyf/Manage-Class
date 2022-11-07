@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')
    @foreach($classes as $class)

        <div class="col-md-6 col-xl-3">
            <!-- project card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{asset('img/project-1.jpg')}}" alt="project image cap">
                <div class="card-body ">

                    <!-- project title-->
                    <h4 class="mt-0">
                        <a href="apps-projects-details.html" class="text-title">Chương
                            trình {{$class->subject->name}}</a>
                    </h4>
                    <p class="text-muted font-17 mb-3">Chương trình tích hợp nhiều level để học viên chọn học</a>
                    </p>
                    <!-- project detail-->
                    <p class="mb-1">
                        Học phí: <span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                <i class="mdi mdi-cash-plus text-muted"></i>
                                                <b>{{number_format($class->subject->price, 0, '', ',') }}VNĐ</b>
                                            </span>
                        <span class="text-nowrap mb-2 d-inline-block">
                                             Thời lượng học:   <i class="mdi mdi-clock-check-outline text-muted"></i>
                                                <b>{{  \App\Enums\TimeLineEnum::getTimeToView($class->time_line)}} Tuần</b>
                                            </span><span class="text-nowrap mb-2 d-inline-block">
                                             Thời gian học:  <b>  {{$class->name_weekday}} - Buổi {{$class->name_shift}}</b>
                                            </span><span class="text-nowrap mb-2 d-inline-block">
                                             Ngày khai giảng:  <b>  {{$class->time_start_expected}} </b>
                                            </span>
                    </p>

                    <div class=" d-flex justify-content-end">
                        <a href="{{route('progress',$class)}}">
                            <button class="btn btn-primary">Đăng ký</button>
                        </a>
                    </div>
                </div> <!-- end card-body-->

            </div> <!-- end card-->
        </div> <!-- end col -->

        <!-- end col -->
        <!-- end col -->
        <!-- end col -->
    @endforeach
@endsection
<!-- end row-->


<!-- end row-->

<!-- End Content -->
