@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="col-12">
        <form method="post" action="{{route('payment')}}" class="needs-validation" novalidate>
            @csrf
            <div class="row form-validation">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Nhập họ tên</label>
                        <input type="text" class="form-control" id="validationCustom01"
                               placeholder="Họ tên" required
                               @if(Auth::check())
                                   value="{{Auth::user()->name}}"
                            @endif
                        >
                        <div class="invalid-feedback">
                            Vui lòng nhập họ tên
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="validationCustomUsername">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomUsername"
                                   placeholder="Email" aria-describedby="inputGroupPrepend"
                                   required
                                   @if(Auth::check())
                                       value="{{Auth::user()->email}}"
                                @endif
                            >
                            <div class="invalid-feedback">
                                Vui lòng nhập email
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{$progress->subject->price}}" name="price">
                    <input type="hidden" value="{{$progress->id}}" name="id_class">
                    <div class="form-group mb-3">
                        <label for="validationCustom02">Mã SV/CMND /CCCD</label>
                        <input type="text" class="form-control" id="validationCustom02"
                               placeholder="SV/CMND /CCCD" required
                               @if(Auth::check())
                                   value="{{Auth::user()->id}}"
                            @endif
                        >
                        <div class="invalid-feedback">
                            Vui lòng nhập Mã SV/CMND /CCCD
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationCustom03">Nhập điện thoại</label>
                        <input type="text" class="form-control" id="validationCustom03"
                               placeholder="SDT"
                               required
                               @if(Auth::check())
                                   value="{{Auth::user()->phone}}"
                            @endif
                        >
                        <div class="invalid-feedback">
                            Vui lòng nhập số điện thoại
                        </div>
                    </div>
                    <h6 class="font-15 mt-3">Thanh toán</h6>
                    <div class="form-group mb-3">
                        <div class="mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="validationCustom05" name="customRadio1"
                                       class="custom-control-input" required>
                                <label class="custom-control-label" for="validationCustom05">MOMO QR</label>
                                <div class="invalid-feedback">
                                    Vui lòng chọn phương thức thanh toán
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="card d-block">
                        <img class="card-img-top" src="{{asset('img/project-1.jpg')}}" alt="project image cap">
                        <div class="card-body">
                            <!-- project title-->
                            <h4 class="mt-0">
                                <a href="apps-projects-details.html" class="text-title">Chương
                                    trình {{$progress->subject->name}}</a>
                            </h4>
                            <p class="text-muted font-17 mb-3">Chương trình tích hợp nhiều level để học viên chọn học</a>
                            </p>
                            <!-- project detail-->
                            <p class="mb-1">
                                Học phí:   <span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                                                <b>21</b>
                                            </span>
                                <span class="text-nowrap mb-2 d-inline-block">
                                             Thời lượng học:   <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                                <b>741</b>
                                            </span>
                            </p>

                        </div> <!-- end card-body-->

                    </div> <!-- end card-->
                </div>
                <button class="btn btn-primary" type="submit">Thanh toán</button>
            </div>

        </form>

    </div>

@endsection
<!-- end row-->
@push('js')


@endpush
<!-- end row-->

<!-- End Content -->
