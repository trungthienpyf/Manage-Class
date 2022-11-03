@component('mail::message')
    # Thông báo dời ngày khai giảng lớp học
    Lớp học  {{ $details['name'] }} có thời gian {{ $details['old_time_start'] }} sẽ dời ngày khai giảng vào thời gian {{ $details['time_start'] }}
    Chúc bạn học tập tốt!
    Cảm ơn,
    {{ config('app.name') }}
@endcomponent
