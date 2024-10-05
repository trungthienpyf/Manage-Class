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
            @if($lesstures->count()>0 )
                @foreach($lesstures as $lessture)
                    <a href="{{route('quizz.detail',$lessture->id)}}">
                        <div class="row justify-content-sm-between hoverChangeColor" >

                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <div class="custom-control custom-checkbox" style="margin-top: 15px;">
                                    <label>
                                        @if(!empty($lessture->attempts[0]))
                                                <i class="mdi  mdi-check-circle" style="color: #09a59a"></i>

                                            @else
                                            <i class="mdi  mdi-circle-outline" style="color: #09a59a"></i>
                                            @endif
                                    </label>
                                    {{$lessture->name}}    {{ !empty($lessture->attempts[0]) ? "- ". $lessture->attempts[0]['total_score']. "%" : ''}}
                                </div> <!-- end checkbox -->
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-between">
                                    <div>

                                    </div>
                                    <div>
                                        <ul class="list-inline font-13 text-right" style="margin-top: 10px;">

                                            <li class="list-inline-item ml-2">
                                                <button class="btn btn-outline-success p-1">Start</button>
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
