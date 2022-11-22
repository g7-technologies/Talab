<header>
    <div class="header_area">
        <div class="container">
            <div class="header_wrapper d-flex justify-content-between align-items-center">
                <div class="logo_area">
                    <a href="{{url('/')}}"><img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/></a>
                </div>

                <div class="header_right d-flex align-items-center">

                     <div class="mobo_search d-md-none d-lg-none">
                        <form action="">
                            <input type="search">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                        
                    <div class="header_search position-relative">
                        <form action="{{url('/search_shop')}}" method="post">
                            @csrf
                            <input type="search" placeholder="Search" name="search">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>

                    <div class="my_cart_area">
                        <div class="cart_btn_header position-relative">
                            <div id="cart_number"></div>
                            <button type="button" class="cart_item_btn"><img src="{{asset('public/assets/client/img/header/Buy.svg')}}" alt="cart"><span>My cart</span></button>
                        </div>
                        <div class="add_cart_items">
                            <div class="cart_items_wrapper" id="cart_items">

                                <div class="single_cart_item d-flex">
                                    <p>No Items in cart</p>    
                                </div>

                            </div>

                            <div class="cart_total_cotnent text-center">
                                <div id="cart_total"></div>
                                <div class="cart_btn_area d-flex justify-content-between">
                                    <a href="{{url('/cart')}}" class="btn_l boderd_btn">View Cart</a>
                                    <a href="{{url('/checkout')}}" class="btn_l filled_btn">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user_area position-relative">
                        <span class="user_icon" id="profileImage">
                            <img class="icon_thumb" src="{{asset('public/assets/client/img/header/Profile.svg')}}" alt="">
                        </span>

                        @if(Auth::guard('customer')->check())
                        <div class="user_login_menu my_account_nav_link_wrapper">
                            <div class="user_name_menu d-flex align-items-center">
                                <div class="user_menu_img">
                                    <img src="{{asset('public/customer_images/'.Auth::guard('customer')->user()->image)}}" alt="icon">
                                </div>
                                <div class="user_info_menu">
                                    <h4>
                                        {{Auth::guard('customer')->user()->first_name}}
                                        {{Auth::guard('customer')->user()->last_name}}
                                    </h4>
                                    <span id="firstName" style="display:none;">{{Auth::guard('customer')->user()->first_name}}</span>
                                    <span id="lastName" style="display:none;">{{Auth::guard('customer')->user()->last_name}}</span>
                                    <span>{{Auth::guard('customer')->user()->email}}</span>
                                </div>
                            </div>
                            <ul>
                                <li><a href="{{url('/my_account_customer')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/user.svg')}}" alt="icon"></div>
                                    <span>My Account</span>
                                </a></li>

                                <li><a class="" href="{{url('/customer_addresses')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/client/img/icons/Discovery.svg')}}" alt="icon"></div>
                                    <span>Shipping Addresses</span>
                                </a></li>

                                <li><a href="{{url('/customer_orders')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/client/img/icons/my_order.svg')}}" alt="icon"></div>
                                    <span>My Orders</span>
                                </a></li>

                                <li><a href="{{url('/customer_wishlist')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/heart.svg')}}" alt="icon"></div>
                                    <span>Wishlist</span>
                                </a></li>

                                <li><a href="{{url('/complains_and_suggestions')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/contact_us.svg')}}" alt="icon"></div>
                                    <span>Contact Us</span>
                                </a></li>

                                <li><a href="#" onclick="changeLanguageByButtonClickEnglish();">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/en.svg')}}" alt="icon"></div>
                                    <span>English</span>
                                </a></li>

                                <li><a href="#" onclick="changeLanguageByButtonClickArabic();">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/ar.svg')}}" alt="icon"></div>
                                    <span>Arabic</span>
                                </a></li>

                                <li class="sign_out"><a href="{{url('/logout_customer')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/logut.svg')}}" alt="icon"></div>
                                    <span>Sign Out</span>
                                </a></li>
                            </ul>
                        </div>
                        @elseif(Auth::guard('shop')->check())
                        <div class="user_login_menu my_account_nav_link_wrapper">
                            <div class="user_name_menu d-flex align-items-center">
                                <div class="user_menu_img">
                                    <img src="{{asset('public/shop_logo/'.Auth::guard('shop')->user()->logo)}}" alt="icon">
                                </div>
                                <div class="user_info_menu">
                                    <h4>{{Auth::guard('shop')->user()->name}}</h4>
                                    <span>{{Auth::guard('shop')->user()->email}}</span>
                                </div>
                            </div>
                            <ul>
                                <li><a href="{{url('/shop_dashboard')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/user.svg')}}" alt="icon"></div>
                                    <span>Dashboard</span>
                                </a></li>

                                <li><a href="{{url('/shop_account')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/user.svg')}}" alt="icon"></div>
                                    <span>My Account</span>
                                </a></li>

                                <li><a href="{{url('/shop_categories')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt=""></div>
                                    <span>My Categories</span>
                                </a></li>

                                <li><a class="" href="{{url('/shop_products')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt="icon"></div>
                                    <span>My Products</span>
                                </a></li>

                                <li><a href="{{url('/shop_orders')}}">
                                   <div class="profile_icon_area"> <img src="{{asset('public/assets/client/img/icons/my_order.svg')}}" alt="icon"></div>
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
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/contact_us.svg')}}" alt="icon"></div>
                                    <span>Contact Us</span>
                                </a></li>

                                <!-- <li><a href="{{url('/shop_balance')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/balance.svg')}}" alt="icon"></div>
                                    <span>Balance</span>
                                </a></li> -->

                                <li class="sign_out"><a href="{{url('/logout_trader')}}">
                                    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/logut.svg')}}" alt="icon"></div>
                                    <span>Sign Out</span>
                                </a></li>
                            </ul>
                        </div>
                        @else
                        <div class="user_login_btn_area">
                            <a type="button"  data-bs-toggle="modal" data-bs-target="#LoginModal" class="btn_l filled_btn" href="">login</a>
                            <a class="btn_l boderd_btn" data-bs-toggle="modal" data-bs-target="#SignupModal" class="btn_l filled_btn" href="">Signup</a> 
                        </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</header>

@push('scripts')
<script>
    $(document).ready(function(){
        var check = "{{Auth::guard('customer')->check()}}";
        if(check)
        {
            var firstName = $('#firstName').text();
            var lastName = $('#lastName').text();
            var intials = $('#firstName').text().charAt(0) + $('#lastName').text().charAt(0);
            var profileImage = $('#profileImage').text(intials);
        }
        
    });

</script>
@endpush