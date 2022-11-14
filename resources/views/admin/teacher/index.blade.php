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

                    <a href="{{route('admin.teacher.create')}}" class="btn btn-info buttons-print text-white"
                       type="button"><span>Thêm thành viên</span></a>
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

                <th>Tên giáo viên</th>
                <th>Số điện thoại</th>
                <th>Chức vụ</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teachers as $teacher)
                <tr>

                    <td>{{$teacher->name}}</td>
                    <td>{{$teacher->phone}}</td>
                    <td>{{$teacher->level ? $teacher->level ==2 ? 'Giáo vụ' : 'Giáo viên' :'Học sinh'}}</td>
                    @if($teacher->level == 2)
                        <td>

                        </td>
                    @else
                        <td class="d-flex">


                            <form action="#" class="pr-2">


                            <button class="btn btn-primary btn-sm"><i class="mdi mdi-square-edit-outline"></i></button>
                            </form>

                            <form action="{{route('admin.teacher.destroy',$teacher)}}" method="post">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class=" mdi mdi-delete-alert"></i></button>
                            </form>
                        </td>
                    @endif
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
