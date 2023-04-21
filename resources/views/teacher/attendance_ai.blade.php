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

                            <video id="video" autoplay  width="640" height="480"></video>
                            <canvas id="canvas"   width="640" height="480"></canvas>

                        <button class="btn btn-primary" type="submit">Đăng tải</button>
                    </div>
                    <div class="col-6">
                        <div class="card d-block">

                            <div id="layout">
                                <div class="marked mb-2">

                                </div>
                                <button class="button center ">Sẳn sàng</button>
                            </div>


                        </div> <!-- end card-->
                    </div>

                </div>
            </form>
        </div>
    </div>


@endsection
@push('js')
    <script async  type="text/javascript">
    let list=null;


        $.ajax({
            url: "{{route('getListStudentByIdClass')}}",
            type: "GET",
            data: {
                id: {{ $class_id }},

            },
            success: function (response) {

                list = response
                console.log(list)
            }
        });

        var video = document.getElementById('video');
        var canvasDraw = document.getElementById('canvas');
        var context = canvasDraw.getContext('2d');

        // Khởi tạo bộ phát hiện khuôn mặt
        var tracker = new tracking.ObjectTracker('face');
        tracker.setInitialScale(4);
        tracker.setStepSize(2);
        tracker.setEdgesDensity(0.1);

        // Thêm bộ phát hiện khuôn mặt vào hình ảnh video
        tracking.track('#video', tracker, { camera: true });

        // Được gọi mỗi khi bộ phát hiện khuôn mặt tìm thấy khuôn mặt mới
        tracker.on('track', function(event) {
            context.clearRect(0, 0, canvasDraw.width, canvasDraw.height);


            event.data.forEach(function(rect) {
                context.strokeStyle = '#a64ceb';
                context.strokeRect(rect.x, rect.y, rect.width, rect.height);
                context.font = '20px Helvetica';
                context.fillStyle = "#fff";
                context.fillText('Loading...', rect.x + rect.width + 6, rect.y + 70);
            });
        });
        var socket = io.connect('http://localhost:8001');
        function onOpenCvReady(){
            var video = document.getElementById('video');
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {

                    video.srcObject = stream;
                    video.play();

                    // Khởi tạo OpenCV.js VideoCapture với kích thước khung hình tương tự với video
                    var cap = new cv.VideoCapture(video);

                    // Gửi dữ liệu realtime lên server
                    // Kết nối tới Flask-SocketIO
                    setInterval(function() {

                        // Lấy một khung hình từ VideoCapture

                        var frame = new cv.Mat(video.videoHeight, video.videoWidth, cv.CV_8UC4);

                        cap.read(frame);

                        // Chuyển đổi Mat sang dạng base64-encoded JPEG image
                        var canvas = document.createElement('canvas');
                        cv.imshow(canvas, frame); // Hiển thị Mat lên canvas
                        var imageData = canvas.toDataURL('image/jpeg', 0.5);

                        socket.emit('stream', { data: imageData }); // Gửi dữ liệu lên server

                        // Giải phóng bộ nhớ của Mat
                        frame.delete();
                    }, 1000); // Thực hiện gửi dữ liệu 30 lần mỗi giây
                })
                .catch(function(err) {
                    console.log(err);
                });

        }
    let counter=0;
    let flag=0;
        socket.on('response',async function(c) {
            console.log(c)
            try{
                console.log( "Counter: "+ counter)
                let result=parseInt(c);

                let student= list?.find(x=>x.id== result)

                if(result !="Unknown" && result != null &&  student !=null ){
                    if(counter==0) counter=1;


                    //  list.find(x=>x.id== result)


                    // setTimeout(function (){
                    //
                    //    $(".marked").append(`<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/768px-Flat_tick_icon.svg.png"  width="100px"/> `)
                    // }, 3000)


                }else{
                    counter=0;
                    $(".marked").html("")
                    $(".button.center").html(`Sẳn sàng`).css("background-color","#b586d9")
                }
                if(counter!=0){

                    if(counter==1){
                        let date= '{{$date}}'

                         checkAttendance({{$class_id}},date,student.id).then(function(data) {
                             console.log("data la data:",data)
                             if(data.length===0){
                                 $.ajax({
                                     url: "{{route('AttendanceStudentAi')}}",
                                     type: "GET",
                                     data: {
                                         id: {{ $class_id }},
                                         date:'{{$date}}',
                                         student_id:student.id,

                                     },
                                     success: function (response) {


                                         console.log(response)
                                     }
                                 });
                             }else{

                                 $(".button.center").html(`Đã được điểm danh`).css("background-color","#e56f6f")
                                 counter=0
                                 flag=1
                             }
                         }).catch(function(error) {
                             console.log(error); // Log lỗi nếu có
                         });;

                    }
                    if(flag!=1){
                        if( counter >10 && counter<20){
                            $(".marked").html(`<img id="img_tick" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/768px-Flat_tick_icon.svg.png"  width="100px"/> `)
                            $(".button.center").html(`Điểm danh thành công`)
                        }
                        if(counter<=10){
                            $(".marked").html("")
                            $(".button.center").html(`Phải mày không`)

                        }

                        if(counter>=20){
                            counter=0;
                            flag=0;
                            $(".marked").html("")
                            $(".button.center").html(`Sẳn sàng`).css("background-color","##b586d9")
                        }
                        counter++;
                    }

                }

            } catch (e) {
                console.log(e);
            }

        });
        function checkAttendance(id,date,student_id){
            return new Promise(function(resolve, reject) {
            $.ajax({
                url: "{{route('AttendanceAi')}}",
                type: "GET",
                data: {

                    id: id ,
                    date:date ,
                    student_id: student_id,
                    attendance_id: {{$attendance_id}}
                },
                success: function (response) {

                    resolve(response)
                },
                error: function() {
                    reject("Error getting data"); // Báo lỗi nếu có lỗi xảy ra
                }
            });
            });
          //  return result;
        }
    // async function marked() {
    //
    //     const delay = ms =>{
    //
    //         return new Promise(res => {
    //
    //             return setTimeout(res, ms)} );
    //     }
    //     await delay(3000);
    //     counter=0;
    //
    //
    // }
    </script>
    <script async src="{{asset('opencv.js')}}" onload="onOpenCvReady()" type="text/javascript"></script>
@endpush
