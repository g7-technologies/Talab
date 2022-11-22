<div class="col-lg-3 col-md-4">
    <div class="my_acc_sidebar">

          <!-- my_account_sidebar -->
          <div class="account_info_head d-flex align-items-center">
            <div class="acc_profile">
                <img src="{{asset('public/shop_logo/'.Auth::guard('shop')->user()->logo)}}" alt="shop_logo">
            </div>
            <div class="my_acc_name">
                <h6>{{Auth::guard('shop')->user()->name}}</h6>
                <span>{{Auth::guard('shop')->user()->email}}</span>
            </div>
        </div>
        <!-- my_account_sidebar -->

        <div class="my_account_nav_link_wrapper mt-55 mb-55" id="shop_sidebar">
            <ul>
              <li><a class="" id="Dashboard" href="{{url('/shop_dashboard')}}">
                    <div class="profile_icon_area"><svg xmlns="http://www.w3.org/2000/svg" width="19.667" height="24.333" viewBox="0 0 19.667 24.333">
                        <g id="Iconly_Bold_Profile" data-name="Iconly/Bold/Profile" transform="translate(-4.167 -1.833)">
                          <g id="Profile" transform="translate(4.667 2.333)">
                            <path id="Profile-2" data-name="Profile" d="M0,19.338c0-3.175,4.3-3.968,9.333-3.968,5.062,0,9.333.822,9.333,4s-4.3,3.968-9.333,3.968C4.272,23.333,0,22.511,0,19.338ZM3.157,6.173a6.176,6.176,0,1,1,6.176,6.174A6.153,6.153,0,0,1,3.157,6.173Z" transform="translate(0 0)" fill="#f7f7fa" stroke="#000" stroke-width="1"/>
                          </g>
                        </g>
                      </svg>
                      </div>
                    <span>Dashboard</span>
                </a></li>
                <li><a class="" href="{{url('/shop_account')}}" id="MyAccount">
                    <div class="profile_icon_area"><svg xmlns="http://www.w3.org/2000/svg" width="19.667" height="24.333" viewBox="0 0 19.667 24.333">
                        <g id="Iconly_Bold_Profile" data-name="Iconly/Bold/Profile" transform="translate(-4.167 -1.833)">
                          <g id="Profile" transform="translate(4.667 2.333)">
                            <path id="Profile-2" data-name="Profile" d="M0,19.338c0-3.175,4.3-3.968,9.333-3.968,5.062,0,9.333.822,9.333,4s-4.3,3.968-9.333,3.968C4.272,23.333,0,22.511,0,19.338ZM3.157,6.173a6.176,6.176,0,1,1,6.176,6.174A6.153,6.153,0,0,1,3.157,6.173Z" transform="translate(0 0)" fill="#f7f7fa" stroke="#000" stroke-width="1"/>
                          </g>
                        </g>
                      </svg>
                      </div>
                    <span>My Account</span>
                </a></li>

                <li><a class="" href="{{url('/shop_categories')}}" id="MyCategories">
                   <div class="profile_icon_area">
                    <img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt="icon">
                   </div>
                    <span>My Categories</span>
                </a></li>

                <li><a class="" href="{{url('/shop_products')}}" id="MyProducts">
                   <div class="profile_icon_area">
                    <img src="{{asset('public/assets/trader/img/icons/my_product.svg')}}" alt="icon">
                   </div>
                    <span>My Products</span>
                </a></li>

                <li><a href="{{url('/shop_orders')}}" id="Orders">
                   <div class="profile_icon_area"> <img src="{{asset('public/assets/trader/img/icons/my_order.svg')}}" alt="icon"></div>
                    <span>Orders</span>
                </a></li>

                <!-- <li><a href="{{url('/shop_notifications')}}">
                    <div class="profile_icon_area"> <span class="notifi_count">4</span><img src="{{asset('public/assets/trader/img/icons/notifications.svg')}}" alt="icon"></div>
                    <span>Notifications</span>
                </a></li> -->

                <li><a href="{{url('/shop_contact_us')}}" id="ContactUs">
                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/contact_us.svg')}}" alt="icon"></div>
                    <span>Contact Us</span>
                </a></li>

                <!-- <li><a href="{{url('/shop_balance')}}" >
                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/balance.svg')}}" alt="icon"></div>
                    <span>Balance</span>
                </a></li> -->

                <!--<li><a href="{{url('/shop_settings')}}" id="Settings">-->
                <!--    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/balance.svg')}}" alt="icon"></div>-->
                <!--    <span>Settings</span>-->
                <!--</a></li>-->

                <li class="sign_out"><a href="{{url('/logout_trader')}}">
                    <div class="profile_icon_area"><img src="{{asset('public/assets/trader/img/icons/logut.svg')}}" alt="icon"></div>
                    <span>Sign Out</span>
                </a></li>
            </ul>
        </div> 
    </div>
</div>