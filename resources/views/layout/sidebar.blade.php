<div class="left-side-menu left-side-menu-detached mm-active">

    <div class="leftbar-user">
        <a href="#">
            <img src="{{asset('img/logo.png')}}" alt="user-image" height="75">

        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="metismenu side-nav mm-show">

        <li class="side-nav-title side-nav-item">Navigation</li>


        @if(is_null(auth()->user()->level))

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Trang chủ </span>
                </a>

            </li>
            <li class="side-nav-item">
                <a href="{{route('student')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Chương trình học </span>
                </a>

            </li>
            <li class="side-nav-item">
                <a href="{{route('viewCalendar')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> Thời khóa biểu </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('classStudent')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> Lớp học </span>
                </a>
            </li>
        @else
            @if(auth()->user()->level == 2)
                <li class="side-nav-item">
                    <a href="{{route('admin')}}" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Trang chủ </span>
                    </a>

                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.class.index')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Quản lý Lớp </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{route('admin.teacher.index')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Quản lý Giáo viên </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{route('admin.room.index')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Quản lý Phòng </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.subject.index')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Quản lý Chương trình
                        </span>
                    </a>
                </li>



            @elseif(auth()->user()->level == 1)
                <li class="side-nav-item">
                    <a href="{{route('teacher')}}" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Trang chủ </span>
                    </a>

                </li>
                <li class="side-nav-item">
                    <a href="{{route('teacher.classTeacher')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Lớp dạy </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('teacher.schedule')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Lịch dạy </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('teacher.attendance')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Điểm danh </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('teacher.register.index')}}" class="side-nav-link">
                        <i class="uil-calender"></i>
                        <span> Đăng ký lịch dạy </span>
                    </a>
                </li>
            @endif
        @endif


    </ul>

    <div class="clearfix"></div>


</div>
