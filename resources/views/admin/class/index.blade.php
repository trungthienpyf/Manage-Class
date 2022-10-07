@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
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
                    <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0"
                            aria-controls="datatable-buttons" type="button"><span>Copy</span></button>
                    <a href="{{route('admin.class.create')}}" class="btn btn-info buttons-print text-white" type="button"><span>Tạo lớp</span></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right">
                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                    <button type="button" class="btn btn-light mb-2">Export</button>
                </div>
            </div>
        </div>
        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
            <tr>
                <th>Tên lớp</th>
                <th>Tên môn</th>
                <th>Ca</th>
                <th>Buổi học</th>
                <th>Số lượng sinh viên</th>
                <th>Ngày khai giảng dự kiến</th>
                <th>Giảng viên</th>
                <th>Hành động</th>
            </tr>
            </thead>


            <tbody>
            @foreach($classes as $class)
                <tr>
                    <td>{{$class->name_schedule}}</td>
                    <td>{{$class->subject->name}}</td>
                    <td>{{$class->name_shift}}</td>
                    <td>{{$class->name_weekday}}</td>
                    <td>{{$class->student_count}}</td>
                    <td>{{$class->start_date}}</td>
                    <td>{{$class->teacher->name}}</td>
                    <td>
                        {{--     <a href="{{route('admin.class.edit', $class->id)}}" class="btn btn-primary btn-sm">Sửa</a>
                                   <a href="{{route('admin.class.delete', $class->id)}}" class="btn btn-danger btn-sm">Xóa</a> --}}
                        <a href="" class="btn btn-primary btn-sm"><i class="mdi mdi-square-edit-outline"></i></a>
                        {{--                  <button type="button" class="btn btn-success mb-2 mr-1"></i></button>--}}
                        <a href="" class="btn btn-danger btn-sm"><i class=" mdi mdi-delete-alert"></i></a>
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


@endpush

<!-- end row-->

<!-- End Content -->
