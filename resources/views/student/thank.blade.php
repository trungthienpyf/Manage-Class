@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('thank') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="col-12">

        <div class="text-center">
            <h3 href="">
                    {{$msg}}
                </h3>
        </div>
        <div class="text-center">
            <a href="{{route('classStudent')}}"><button class="btn btn-primary">
                    Xem lớp học của bạn
                </button></a>
        </div>
    </div>

@endsection
<!-- end row-->
@push('js')


@endpush
<!-- end row-->

<!-- End Content -->
