<?php   \Carbon\Carbon::setLocale('vi')?>
@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')
    <div class="tab-content">
        <form action="{{route('admin.post')}}" method="post">
            @csrf
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    <p style="color: red" class="m-3">{{ $error }}</p>
                @endforeach

            @endif
            <div class="tab-pane show active  pl-3  pr-3" id="newpost">


                <textarea rows="1" class="form-control border-0 resize-none" name="title"
                          placeholder="Tiêu đề...">{{old('title')}}</textarea>

            </div>
            <div class="tab-pane show active p-3">

                <div class="border rounded">

                    <textarea rows="6" class="form-control border-0 resize-none" name="content"
                              placeholder="Nội dung....">{{old('content')}}</textarea>
                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                        <div class="form-group " style="flex-basis:10% ">

                            <select name="level" class="form-control select2 " data-toggle="select2">
                                <option value="1"> Mọi người</option>
                                <option value="2">Giáo viên</option>
                                <option value="3">Học sinh</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success"><i class="uil uil-message mr-1"></i>Đăng
                        </button>
                    </div>

                </div>

            </div>
        </form>
    </div>
    @foreach($posts as $post)
        <div class="card m-3">
            <div class="card-body pb-1">
                <div class="media">
                    <div class="media-body">
                        <div class="dropdown float-right text-muted">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="{{route('admin.post.destroy',$post)}}" class="m-0 p-0" method="post">
                                    @method('DELETE')
                                    @csrf

                                <button href="javascript:void(0);" class="dropdown-item">Xóa</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="m-0">{{$post->title}}</h4>
                        <p class="text-muted">
                            <small>{{$post->created_at->diffForHumans()}}
                                <span class="mx-1">⚬</span>
                                <span>Mọi người</span>
                            </small>
                        </p>
                    </div>
                </div>

                <hr class="m-0">

                <div class="font-16 text-center text-dark my-3">
                   {!!nl2br($post->content)!!}
                </div>

                <hr class="m-0">


            </div> <!-- end card-body -->
        </div>
    @endforeach
@endsection
<!-- end row-->


<!-- end row-->

<!-- End Content -->
