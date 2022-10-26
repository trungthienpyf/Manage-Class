@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->
@push('css')
    <link href="{{asset('css/styleProgress.css')}}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')

    <div class="col-12">
        <div class="progress-container">
            <div class="progress" id="progress"></div>
            <div class="circle1 active1">1</div>
            <div class="circle1">2</div>
            <div class="circle1">3</div>
            <div class="circle1">4</div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{route('payment')}}"  class="needs-validation" novalidate>
                    @csrf
                    <div class="row form-validation">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Nhập họ tên</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                       placeholder="First name">
                            </div>

                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                           placeholder="Username" aria-describedby="inputGroupPrepend"
                                           required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="validationCustom02">Mã SV/CMND /CCCD</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                       placeholder="Last name">

                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom03">Nhập điện thoại</label>
                                <input type="text" class="form-control" id="validationCustom03"
                                       placeholder="City" required>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row payment d-none"  style="height: 210px">
                        <div class="col-6 ">

                            <div class="form-group mb-3">
{{--                                <form action="{{route('payment')}}" method="post">--}}
{{--                                    <button class="btn btn-primary" type="submit">QR MOMO</button>--}}
{{--                                </form>--}}


                            </div>



                        </div>


                    </div>

                        <button class="btn" id="prev" disabled>Prev</button>
                        <button class="btn" id="next" type="submit">Next</button>


                </form>

            </div>
        </div>


    </div>
@endsection
<!-- end row-->
@push('js')

    <script>

        $(".needs-validation").submit(function (event) {

          //  $('.form-validation').hide()
        //    $('.payment').removeClass('d-none')
        });
        $('#prev').click(function () {
            $('.form-validation').show()
            $('.payment').addClass('d-none')
        })
    </script>
    <script>
        const progress = document.querySelector("#progress");
        const prev = document.querySelector("#prev");
        const next = document.querySelector("#next");
        const circles = document.querySelectorAll(".circle1");

        const update = () => {
            circles.forEach((circle, i) => {
                i < currActive
                    ? circle.classList.add("active1")
                    : circle.classList.remove("active1");
            });

            const actives = document.querySelectorAll(".active1");
            const width = ((actives.length - 1) / (circles.length - 1)) * 100;
            progress.style.width = `${width}%`;

            if (currActive === 1) {
                prev.disabled = true;
            } else if (currActive === circles.length) {
                next.disabled = true;
            } else {
                prev.disabled = false;
                next.disabled = false;
            }
        };

        let currActive = 1;

        next.addEventListener("click", () => {
            currActive++;

            if (currActive > circles.length) {
                currActive = circles.length;
            }
            update();
        });
        prev.addEventListener("click", () => {
            currActive--;

            if (currActive < 1) {
                currActive = 1;
            }
            update();
        });

    </script>
@endpush
<!-- end row-->

<!-- End Content -->
