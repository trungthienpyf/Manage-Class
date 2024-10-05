@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classTeacher') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="card">
        <div class="col-sm-4 col-md-12 pb-2 float-right">
            <div class="dt-buttons btn-group float-right">

                <a href="{{route('teacher.quizz.create',$lessture_id)}}" class="btn btn-info buttons-print text-white m-2"
                   type="button"><span>Thêm bài tập</span></a>
            </div>
        </div>
        <div class="card-body">


        @if($lesstures->count()>0 )
          @foreach($lesstures as $lessture)
                <a href="{{route('teacher.quizz.edit',$lessture->id)}}">
            <div class="row justify-content-sm-between hoverChangeColor" >

                <div class="col-sm-6 mb-2 mb-sm-0">
                    <div class="custom-control custom-checkbox" style="margin-top: 15px;">
                        <input type="checkbox" class="custom-control-input" id="task1">

                        {{$lessture->name}}
                    </div> <!-- end checkbox -->
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between">
                        <div>

                        </div>
                        <div>
                            <ul class="list-inline font-13 text-right" style="margin-top: 15px;">

                                <li class="list-inline-item ml-2">
                                    <button class="btn btn-outline-success p-1">Edit</button>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end .d-flex-->
                </div> <!-- end col -->
            </div>
            </a>
            @endforeach

            @else
            <div> Hiện chưa có bài tập nào</div>
            @endif
        </div>
    </div>

@endsection
@push('js')

@endpush
