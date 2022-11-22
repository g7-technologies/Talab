<div class="leftbar-tab-menu">
    <div class="main-icon-menu" style="overflow-y:auto;overflow-x:hidden;">
        <!--<a href="{{ url('/dashboard') }}" class="logo logo-metrica d-block text-center">-->
        <!--    <span>-->
        <!--        <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">-->
        <!--    </span>-->
        <!--</a>-->
            <a href="#Dashboard" class="nav-link">
                <i data-feather="monitor" class="align-self-center menu-icon icon-dual"></i>
            </a>

            <a href="#Shops" class="nav-link" >
                <i class="fas fa-store-alt align-self-center menu-icon icon-dual"></i>
            </a>
            
            <a href="#Clients" class="nav-link">
                <i data-feather="user" class="align-self-center menu-icon icon-dual"></i>
            </a>
            
            <a href="#Orders" class="nav-link">
                <i data-feather="shopping-cart" class="align-self-center menu-icon icon-dual"></i>
            </a>
            
             <a href="#Categories" class="nav-link">
                <i data-feather="layers" class="align-self-center menu-icon icon-dual"></i>
            </a>

            <a href="#Products" class="nav-link">
                <i data-feather="package" class="align-self-center menu-icon icon-dual"></i>             
            </a>

            <a href="#Promotions" class="nav-link">
                <i data-feather="tag" class="align-self-center menu-icon icon-dual"></i>
            </a>

             <a href="#Banner" class="nav-link">
                <i data-feather="message-circle" class="align-self-center menu-icon icon-dual"></i>
            </a>

            <a href="#Settings" class="nav-link">
                <i data-feather="settings" class="align-self-center menu-icon icon-dual"></i>
            </a>

        </nav>
    </div>

    <div class="main-menu-inner">
        
        <div class="topbar-left">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span>
                    <img src="{{ asset('public/assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark" style="height:40px !important;">
                    <img src="{{ asset('public/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light" style="height:40px !important;">
                </span>
            </a>
        </div>
        
        <div class="menu-body slimscroll">                    
            <div id="Dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Dashboard</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                </ul>
            </div>

            <div id="Shops" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Shops</h6>
                </div>
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/add_new_shop') }}">Add New Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/shop_joining_request') }}">Joining Requests</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/shop_invitation_link') }}">Invitation Link</a></li>  
                    <li class="nav-item"><a class="nav-link" href="{{ url('/deactive_shops') }}">Deactive Shops</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_shops') }}">Active Shops</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_shop_requests') }}">Product Increment Requests</a></li>
                </ul>
            </div>

            <div id="Promotions" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Promotions</h6>
                </div>
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/create_promotion') }}">Create Promotions</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/promotions') }}">Active Promotions</a></li>
                </ul>
            </div>

            <div id="Clients" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Clients</h6>
                </div>
                <ul class="nav metismenu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_clients') }}">All Clients</a></li>
                </ul>
            </div>
            
            <div id="Orders" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Orders</h6>      
                </div>
                <ul class="nav metismenu">                                
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_orders') }}">All Orders</a></li>
                </ul>
            </div>

            <div id="Products" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Products</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_products') }}">Active Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/deactive_products') }}">Deactive Products</a></li>
                </ul>
            </div>
            <div id="Complains" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Complains</h6>     
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_complains') }}">Complains</a></li>
                </ul>
            </div>
            <div id="Categories" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Categories</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_categories') }}">All Categories</a></li>
                    
                </ul>
            </div>
            <div id="Banner" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Banner</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/upload_banners') }}">Upload Banners</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/view_all_banners') }}">All Banners</a></li>
                    
                </ul>
            </div>
            <div id="Settings" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Settings</h6>     
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('update_vat') }}">Update VAT</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('update_profit') }}">Update Profit %</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('update_shipping_cost') }}">Update Shipping Cost</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin_change_password') }}">Change Password</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>