@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')
    <div class="col-12">


        <form  method="post" id="form">
            @csrf
            <table class="table table-centered mb-0">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Tên
                    </th>
                    <th>
                        Tình trạng
                    </th>
                </tr>


                </thead>
                <tbody>


                @foreach($students as $student)

                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->name}}</td>
                        <td>
                            <div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked id="{{$student->id}}" name="status[{{$student->id}}]"
                                           value="1" class="custom-control-input on-school">
                                    <label class="custom-control-label " for="{{$student->id}}">Đi học</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="{{$student->id+1}}" name="status[{{$student->id}}]"
                                           value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="{{$student->id+1}}">Nghĩ học</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="{{$student->id+2}}" name="status[{{$student->id}}]"
                                           value="3" class="custom-control-input">
                                    <label class="custom-control-label" for="{{$student->id+2}}">Nghĩ có phép</label>
                                </div>
                            </div>

                            {{--                        <input type="radio"  id="{{$student->id}}" value="1" name="status[{{$student->id}}]"--}}
                            {{--                               class="custom-control-input on-school">--}}
                            {{--                        <label class="custom-control-label" for="{{$student->id}}">Đi học</label>--}}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <button  class="btn btn-primary">Điểm danh</button>
        </form>
    </div>



@endsection
@push('js')
    <script>

        $("#form").submit(function (e) {
            e.preventDefault()
            var data = {};
            $.each($('input[name^="status\\["]').serializeArray(), function() {
                let a=this.name
                a=a.split('[', 2)[1].slice(0, -1)
                data[a] =  this.value ;
            });

            $.ajax({
                url: "{{route('teacher.attendance')}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: data
                },
                success: function (response) {
                    console.log(response);
                }


            });

        })


    </script>
@endpush
