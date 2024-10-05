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
    <div>
        <div class="row"><video id="video" autoplay></video></div>
        <div class="row "><button id="capture-btn" class="mx-auto mt-3 btn-outline-primary">Chụp nhanh</button></div>
    </div>


@endsection
@push('js')
<script>
    const video = document.getElementById('video');
    const captureBtn = document.getElementById('capture-btn');
    let photoCount = 0;

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(error => {
            console.error('Error accessing the camera: ', error);
        });


    captureBtn.addEventListener('click', () => {
        $.ajax({
            url: '{{ route("camera.upload") }}',
            type: 'get',
            success: function (response) {
                console.log(response)
                console.log('Image uploaded successfully');

            }
        })
        captureMultipleImages(10);
    });
    function captureMultipleImages(count) {
        if (count > 0) {
            captureImage();
            setTimeout(() => {
                captureMultipleImages(count - 1);
            }, 1000);
        } else {
            stopCamera();
        }
    }

    function captureImage() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;


        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const image = canvas.toDataURL('image/jpeg');


        $.ajax({
            url: '{{ route("camera.upload") }}',
            type: 'post',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {image: encodeURIComponent(image),  _token: "{{ csrf_token() }}"},
            success: function (response) {
                console.log(response)
                console.log('Image uploaded successfully');

            }
        })


        console.log(1);
    }

    function stopCamera() {
        const stream = video.srcObject;
        const tracks = stream.getTracks();

        tracks.forEach(track => {
            track.stop();
        });

        video.srcObject = null;
        captureBtn.disabled = true;
    }
</script>

@endpush
