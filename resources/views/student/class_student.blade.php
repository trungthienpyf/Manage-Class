@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classStudent') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="card">

        <div class="card-body">

            @foreach($schedules as $schedule)
                <div class="row justify-content-sm-between ">
                    <div class="col-sm-6 mb-2 mb-sm-0">
                        <div class="custom-control ">


                            # {{$schedule->id}} - Lớp {{$schedule->subject->name}}  <span class="ml-5">  {{$schedule->countStatus($schedule->attendances)}}</span>

                        </div> <!-- end checkbox -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-between">
                            <div>
                                Ngày khai giảng {{$schedule->time_start_expected}}
                            </div>
                            <div>
                                <ul class="list-inline font-13 text-right">
                                    <li class="list-inline-item">

                                        {{  $dateCloset[$schedule->id] ? 'Ngày dạy tiếp theo: '. $dateCloset[$schedule->id] : 'Lịch học đã kết thúc'  }}  <i class="uil uil-schedule font-16 mr-1"></i>
                                    </li>

                                </ul>
                            </div>
                        </div> <!-- end .d-flex-->
                    </div> <!-- end col -->
                </div>
            @endforeach
        </div>
    </div>


@endsection
@push('js')

@endpush
