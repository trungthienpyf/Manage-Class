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

                    <a href="{{route('teacher.register.create')}}" class="btn btn-info buttons-print text-white"
                       type="button"><span>Tạo đăng ký</span></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right">






                </div>
            </div>
        </div>
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
                <th>Ngày đăng ký</th>
                <th>Ca đăng ký</th>
                <th>Môn đăng ký</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $each)
                <tr>
                    <td>{{$each->id}}</td>
                    <td>{{\App\Enums\WeekdaysClassEnum::getNameEnum($each->weekdays) }}</td>
                    <td>{{\App\Enums\ShiftClassEnum::getShift($each->shift) }}</td>
                    <td>{{$each->subject->name}}</td>
                    <td>{{$each->status == 1 ? 'Đã duyệt': 'Chưa duyệt'}}</td>
                    <td>

                        {{--     <a href="{{route('admin.class.edit', $class->id)}}" class="btn btn-primary btn-sm">Sửa</a>
                                   <a href="{{route('admin.class.delete', $class->id)}}" class="btn btn-danger btn-sm">Xóa</a> --}}

                        {{--                  <button type="button" class="btn btn-success mb-2 mr-1"></i></button>--}}
                        @if(empty($each->classSchedule_id))

                            <form action="{{route('teacher.register.destroy',$each)}}" class="m-0 p-0" method="post">
                                @method('DELETE')
                                @csrf

                                <button  class="btn btn-danger btn-sm"><i class=" mdi mdi-delete-alert"></i></button>
                            </form>
                            @endif
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


@endpush

<!-- end row-->

<!-- End Content -->
