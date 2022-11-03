@component('mail::message')
    # Đăng ký lớp học thành công
    Cảm ơn bạn đăng ký lớp học {{ $details['name'] }} - Ca {{ $details['shift'] }} vào thời gian {{ $details['time_start'] }} với giá tiền {{  $details['price'] }}đ
    Hãy để ý email nếu như lớp học đó được dời ngày khai giảng sẽ có thông báo!
    Chúc bạn học tập tốt!
    Cảm ơn,
    {{ config('app.name') }}
@endcomponent
