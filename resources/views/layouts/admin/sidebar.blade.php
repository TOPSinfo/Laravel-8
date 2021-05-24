<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">{{auth()->user()->name}}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>{{__('admin.label.my_account')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>{{__('admin.label.setting')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>{{__('admin.label.lock_screen')}}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>{{__('admin.label.log_out')}}</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">
                @can('list-dashboard')
                <li>
                    <a href="javascript:void(0);">
                        <i class="icon-moon icon-dashboard"></i>
                        <span class="nav-name"> {{__('admin.label.dashboard')}} </span>
                    </a>
                </li>
                @endcan
                @can('list-module')
                <li>
                    <a href="{{route('module.index')}}">
                        <i class="icon-moon icon-om"></i>
                        <span class="nav-name"> {{__('admin.label.module')}} {{__('admin.label.management')}} </span>
                    </a>
                </li>
                @endcan
                @can('list-role')
                <li>
                    <a href="{{route('role.index')}}">
                        <i class="icon-moon icon-om"></i>
                        <span class="nav-name"> {{__('admin.label.role')}} {{__('admin.label.management')}} </span>
                    </a>
                </li>
                @endcan

                @can('list-permission')
                <li>
                    <a href="{{route('permission.index')}}">
                        <i class="icon-moon icon-om"></i>
                        <span class="nav-name"> {{__('admin.label.permission')}} {{__('admin.label.management')}}</span>
                    </a>
                </li>
                @endcan

                @can('list-user')
                <li>
                    <a href="{{route('user.index')}}">
                        <i class="icon-moon icon-om"></i>
                        <span class="nav-name"> {{__('admin.label.user')}} {{__('admin.label.management')}}</span>
                    </a>
                </li>
                @endcan

                @can('list-cms')
                    <li>
                        <a href="{{route('cms.index')}}">
                            <i class="icon-moon icon-om"></i>
                            <span class="nav-name"> {{__('admin.label.cms')}} {{__('admin.label.management')}}</span>
                        </a>
                    </li>
                @endcan

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
