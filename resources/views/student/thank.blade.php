@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="col-12">
      {{$msg}}

    </div>

@endsection
<!-- end row-->
@push('js')


@endpush
<!-- end row-->

<!-- End Content -->
