<header>
    <div class="header_area">
        <div class="container">
            <div class="header_wrapper d-flex justify-content-between align-items-center">
                <div class="logo_area">
                    <a href="{{url('/shop_dashboard')}}"><img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/></a>
                </div>

                <div class="header_right d-flex align-items-center">
                   
                    <div class="user_area position-relative">
                        <span class="user_icon">
                            <img src="{{asset('public/shop_logo/'.Auth::guard('shop')->user()->logo)}}" alt="icon">
                        </span>

                        <div class="user_login_menu my_account_nav_link_wrapper">
                            <div class="user_name_menu d-flex align-items-center">
                                <div class="user_menu_img">
                                    <img src="{{asset('public/shop_logo/'.Auth::guard('shop')->user()->logo)}}" alt="shop_logo">
                                </div>
                                <div class="user_info_menu">
                                    <h4>{{Auth::guard('shop')->user()->name}}</h4>
                                    <span>{{Auth::guard('shop')->user()->email}}</span>
                                </div>
                            </div>
                            <ul>
                                <li><a href="{{url('/shop_dashboard')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/user.svg')}}" alt=""></div>
                                    <span>Dashboard</span>
                                </a></li>

                                <li><a href="{{url('/shop_account')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/user.svg')}}" alt=""></div>
                                    <span>My Account</span>
                                </a></li>

                                <li><a href="{{url('/shop_categories')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt=""></div>
                                    <span>My Categories</span>
                                </a></li>

                                <li><a class="" href="{{url('/shop_products')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt="icons"></div>
                                    <span>My Products</span>
                                </a></li>

                                <li><a href="{{url('/shop_orders')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/trader/img/icons/my_order.svg')}}" alt="icons"></div>
                                    <span>Orders</span>
                                </a></li>

                                
                                <li><a href="#" onclick="changeLanguageByButtonClickEnglish();">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/en.svg')}}" alt="icon"></div>
                                    <span>English</span>
                                </a></li>

                                <li><a href="#" onclick="changeLanguageByButtonClickArabic();">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/ar.svg')}}" alt="icon"></div>
                                    <span>Arabic</span>
                                </a></li>

                                <li><a href="{{url('/shop_contact_us')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/contact_us.svg')}}" alt="icons"></div>
                                    <span>Contact Us</span>
                                </a></li>

                                <li class="sign_out"><a href="{{url('/logout_trader')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/logut.svg')}}" alt="icons"></div>
                                    <span>Sign Out</span>
                                </a></li>
                            </ul>
                        </div>
                    </div><!-- user_area -->
                </div>
            </div>
        </div>
    </div>
</header>