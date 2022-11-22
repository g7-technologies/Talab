<div class="topbar">
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
            
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ti-bell noti-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge unread_notifications">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">
                   
                    <h6 class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                        Notifications <span class="badge badge-light badge-pill unread_notifications"></span>
                    </h6> 
                    <div class="slimscroll notification-list admin_notification">
                        
                    </div>   
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('public/assets/images/users/Sample_User_Icon.png') }}" alt="profile-user" class="rounded-circle" /> 
                    <span class="ml-1 nav-user-name hidden-sm">{{ Auth::guard('admin')->user()->name}}<i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!--<a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a>-->
                    <!--<a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>-->
                    <!--<div class="dropdown-divider"></div>-->
                    <a class="dropdown-item" href="{{ url('/logout') }}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
            <!--<li class="mr-2">-->
            <!--    <a href="#" class="nav-link" data-toggle="modal" data-animation="fade" data-target=".modal-rightbar">-->
            <!--        <i data-feather="align-right" class="align-self-center"></i>-->
            <!--    </a>                  -->
            <!--</li>-->
        </ul>

        <ul class="list-unstyled topbar-nav mb-0">  
            <li>
                <a href="{{url('/dashboard')}}">
                    <span class="responsive-logo">
                        <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm align-self-center" height="34">
                    </span>
                </a>                        
            </li>
            <li>
                <button class="button-menu-mobile nav-link">
                    <i data-feather="menu" class="align-self-center"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>