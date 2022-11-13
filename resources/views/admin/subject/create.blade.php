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
        <form method="post" action="{{route('admin.subject.store')}}">
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
                            <label for="name">Tên phòng</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên phòng" value="{{old('name')}}">
                        </div>

                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info  ">Thêm phòng</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">

                    <div class="form-group">
                        <label for="price">Giá chương trình</label>
                        <input type="text" id="price" class="form-control" name="price" placeholder="Nhập giá" value="{{old('price')}}">
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection
<!-- end row-->

@push('js')



@endpush

<!-- end row-->

<!-- End Content -->
