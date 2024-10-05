<?php \Carbon\Carbon::setLocale('vi') ?>
@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')
    <div class="tab-content">
        <form action="{{route('teacher.quizz.store')}}" method="post">
            @csrf
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    <p style="color: red" class="m-3">{{ $error }}</p>
                @endforeach

            @endif

            <div class="tab-pane show active mb-2" id="newpost">
                <textarea rows="1" class="form-control border-0 resize-none" name="title"
                          placeholder="Tiêu đề...">{{old('title')}}</textarea>

            </div>

            <div class="card">
                <div class="tab-pane show active p-1">
                    <h4 class="p-1">
                        Câu 1
                    </h4>
                    <div class="border rounded">
                        <input type="hidden" name="class_id" value="{{$id}}">
                    <textarea rows="3" class="form-control border-0 resize-none bo" name="content_quizz[1]"
                              placeholder="Nội dung....">{{old('content')}}</textarea>
                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">


                        </div>

                    </div>
                    <h4 class="p-1">
                        Đáp án
                    </h4>
                    <div class="row">
                        <input type="hidden"  value="" name="correct_option[1]" id="correct_1">
                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">
                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án A.." name="A[1]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(1,'A')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>
                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">

                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án B.." name="B[1]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(1,'B')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>
                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">


                            <div class="input-group">
                                <input type="text" class="form-control"  placeholder="Đáp án C.." name="C[1]">
                                <div class="input-group-append" style="cursor:pointer" onclick="answer(1,'C')">
                                    <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                                </div>
                            </div>

                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">


                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Đáp án D.." name="D[1]">
                                <div class="input-group-append" style="cursor:pointer" onclick="answer(1,'D')">
                                    <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="btn btn-sm btn-light " id="addNewQuestion">
                <i class="uil uil-message mr-1"></i>
                Thêm câu hỏi
            </div>
            <div class="tab-pane show active pt-4">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="uil uil-message mr-1"></i>
                    Tạo bài tập
                </button>
            </div>

        </form>
    </div>
@endsection
<!-- end row-->
@push('js')
    <script  type="text/javascript">
        let i=1
        function answer(id,answer){
            console.log(id,answer)
            $("#correct_"+id).val($('input[name="'+answer+'['+id+']"]').val())
            $('input[name="'+'A['+id+']"]').css('border','1px solid #dee2e6')
            $('input[name="'+'B['+id+']"]').css('border','1px solid #dee2e6')
            $('input[name="'+'C['+id+']"]').css('border','1px solid #dee2e6')
            $('input[name="'+'D['+id+']"]').css('border','1px solid #dee2e6')

            $('input[name="'+answer+'['+id+']"]').css('border','1px solid #42d29d')


        }

        $("#addNewQuestion").click(function () {
                i++
            $(this).before(`<div class="card">
                <div class="tab-pane show active p-1">
                    <h4 class="p-1">
                        Câu ${i}
                    </h4>
                    <div class="border rounded">

                    <textarea rows="3" class="form-control border-0 resize-none bo" name="content_quizz[${i}]"
                              placeholder="Nội dung....">{{old('content')}}</textarea>
                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">


                        </div>

                    </div>
                    <h4 class="p-1">
                        Đáp án
                    </h4>
                    <div class="row">
                        <input type="hidden"  value="" name="correct_option[${i}]" id="correct_${i}">
                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">

                           <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án A.." name="A[${i}]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(${i},'A')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>
                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">


                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án B.." name="B[${i}]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(${i},'B')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>

                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">


                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án C.." name="C[${i}]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(${i},'C')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>

                        </div>

                        <div class="col-6 tab-pane show active  pl-3  pr-3 p-2">


                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Đáp án D.." name="D[${i}]">
                            <div class="input-group-append" style="cursor:pointer" onclick="answer(${i},'D')">
                                <span class="input-group-text"><i class="dripicons-checkmark"></i></span>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>`)
        })
    </script>
@endpush
<!-- end row-->

<!-- End Content -->
