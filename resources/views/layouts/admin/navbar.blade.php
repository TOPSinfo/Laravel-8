<!-- Topbar Start -->

<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown">
                <a class="nav-link waves-effect waves-light" href="#">
                    <i class="fe-bell noti-icon"></i>
                </a>
            </li>
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(auth()->user()->avatar != '')
                    <img src="{{asset('storage/uploads').'/'.auth()->user()->avatar}}" alt="user-image" class="rounded-circle">
                    @else
                    <img src="{{asset('assets/images/default-user.png')}}" alt="user-image" class="rounded-circle">
                    @endif
                    <span class="pro-user-name ml-1">
                        {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                    <!-- item-->
                    <a href="{{route('profile.index')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    <a href="{{route('change.password')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Change Password</span>
                    </a>
                    <!-- item-->
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.php" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                </span>
                <span class="logo-lg" style="margin: 10px 10px 0px 0px;padding: 0px;line-height: 0px;">
                    <img src="{{asset('assets/images/logo-light.svg')}}" alt="" height="55" width="150">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
