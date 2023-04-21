@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classStudent') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="card">

        <div class="card-body">
            <h4 class="mt-0">
                <p class="text-title">Đăng tải ảnh cho việc điểm danh </p>
            </h4>
            <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row form-validation">
                <div class="col-6">
                    <p class="text-muted font-17 mb-3">Lưu ý vì đây là hình ảnh để sử dụng để điểm danh vui lòng bạn nghiêm túc đăng tải hình ảnh có khuôn mặt của bạn, chọn lựa ảnh chất lượng cao nhất có thể, ánh sáng phù hợp và đặc biệt khuôn mặt là trọng tâm </a>
                    </p>


                </div>

            </div>

            <div class="row form-validation">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="validationCustom01">Chọn hình ảnh</label>
                    <input type="file" name="image" class="form-control previewImage"/>
                    </div>





                    <button class="btn btn-primary" type="submit">Đăng tải</button>
                </div>
                <div class="col-6">
                    <div class="card d-block">

                        @if(!empty($student->img))

                            <img class="card-img-top showImage" src="{{asset( 'img/'.$student->img)}}"  alt="project image cap" />


                        @else
                            <img class="card-img-top showImage" src="{{asset( 'img/project-1.jpg')}}"  alt="project image cap"/>

                        @endif


                    </div> <!-- end card-->
                </div>

            </div>
            </form>
        </div>
    </div>


@endsection
@push('js')
    <script>

        $(".previewImage").change( function () {


            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function() {

                var img =   $(".showImage").attr('src', reader.result);
                $('.showImage').empty().append(img);
            }
            reader.readAsDataURL(file);

        })


    </script>
@endpush
