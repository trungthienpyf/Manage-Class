@component('mail::message')
    # Thông báo dời ngày khai giảng lớp học
    Lớp học  {{ $details['name'] }} có thời gian {{ $details['old_time_start'] }} - Ca {{ $details['shift'] }} sẽ dời ngày khai giảng vào thời gian <b>{{ $details['time_start'] }}</b> - Ca {{ $details['shift'] }}
    Chúc bạn học tập tốt!
    Cảm ơn,
    {{ config('app.name') }}
@endcomponent
