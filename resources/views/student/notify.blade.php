<?php   \Carbon\Carbon::setLocale('vi')?>
@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    @foreach($posts as $post)
        <div class="card m-3">
            <div class="card-body pb-1">
                <div class="media">
                    <div class="media-body">

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
