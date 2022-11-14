<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="index.html" class="topnav-logo">
                    <span class="topnav-logo-lg">
                        <img src="{{asset('img/logo.png')}}" alt="" width="70px">
                    </span>
            <span class="topnav-logo-sm">
                        <img src="assets/images/logo_sm.png" alt="" height="16">
                    </span>
        </a>

        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop"
                   href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img
                                    src="https://w7.pngwing.com/pngs/906/222/png-transparent-computer-icons-user-profile-avatar-french-people-computer-network-heroes-black.png"
                                    alt="user-image" class="rounded-circle">
                            </span>
                    <span>
                                <span class="account-user-name">{{auth()->user()->name}}</span>


                            @if(is_null(auth()->user()->level))
                            <span class="account-position">Học sinh</span>

                            @else
                                @if(auth()->user()->level == 0)
                                    <span class="account-position">Admin</span>
                                @elseif(auth()->user()->level == 1)
                                    <span class="account-position">Giáo viên</span>
                                @endif
                            @endif
                    </span>

                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                    aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Xin chào !</h6>
                    </div>




                    <!-- item-->

                    <a href="{{route('logout')}}" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>

    </div>
</div>
