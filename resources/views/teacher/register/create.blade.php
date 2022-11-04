@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classCreate') }}
@endsection
<!-- end page title -->


@push('css')

    <!-- end row -->

@endpush
<!-- end row -->

@section('content')

    <div class="col-12">
        <form method="post" action="{{route('teacher.register.store')}}">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    @csrf
                    <div class="col-xl-12" data-select2-id="6">
                        <div class="form-group">
                            <label for="weekdays">Chọn ca</label>
                            <select class="form-control select2" id="weekdays" name="weekdays" data-toggle="select2">

                                @foreach($weekdays as $key => $weekday)
                                    <option value="{{$weekday}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group " >
                            <label for="shift">Chọn ca</label>
                            <select class="form-control select2" id="shift" name="shift" data-toggle="select2">
                                @foreach($shifts as $key => $shift)
                                    <option value="{{$shift}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info  ">Đăng ký</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">


                    <div class="form-group">
                        <label for="subject">Môn</label>
                        <select class="form-control select2" id="subject" name="subject" data-toggle="select2">
                            @foreach($subjects as $key => $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
            </div>
        </form>
    </div>

@endsection
<!-- end row-->

@push('js')
    <script>



    </script>


@endpush

<!-- end row-->

<!-- End Content -->
