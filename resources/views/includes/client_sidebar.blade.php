<div class="col-lg-3 col-md-4">
    <div class="my_acc_sidebar">

        <!-- my_account_sidebar -->
        <div class="account_info_head d-flex align-items-center">
            <div class="acc_profile">
                <img src="{{asset('public/customer_images/'.Auth::guard('customer')->user()->image)}}" alt="">
            </div>
            <div class="my_acc_name">
                <h6>{{Auth::guard('customer')->user()->first_name}} {{Auth::guard('customer')->user()->last_name}}</h6>
                <span>{{Auth::guard('customer')->user()->email}}</span>
            </div>
        </div>
        <!-- my_account_sidebar -->
        <div class="my_account_nav_link_wrapper mt-55 mb-55" id="customer_sidebar">
          <ul>
              <li><a class="" href="{{url('/my_account_customer')}}" id="MyAccount">
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

              <li><a class="" href="{{url('/customer_addresses')}}" id="CustomerAddresses">
                 <div class="profile_icon_area">
                  <svg id="Iconly_Light_Discovery" data-name="Iconly/Light/Discovery" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <g id="Discovery" transform="translate(2 2)">
                        <path id="Path_33947" d="M0,6.682,1.593,1.593,6.682,0,5.089,5.089Z" transform="translate(6.27 6.27)" fill="none" stroke="#222831" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
                        <circle id="Ellipse_738" cx="9.611" cy="9.611" r="9.611" transform="translate(0 0)" fill="none" stroke="#222831" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
                      </g>
                    </svg>
                 </div>
                  <span>Shipping Addresses</span>
              </a></li>

              <li><a href="{{url('/customer_orders')}}" id="CustomerOrders">
                 <div class="profile_icon_area"> <img src="{{asset('public/assets/client/img/icons/my_order.svg')}}" alt="icon"></div>
                  <span>My Orders</span>
              </a></li>

              <li><a href="{{url('/customer_wishlist')}}" id="Wishlist">
                  <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/heart.svg')}}" alt="icon"></div>
                  <span>Wishlist</span>
              </a></li>

              <li><a href="{{url('/complains_and_suggestions')}}" id="ContactUs">
                  <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/contact_us.svg')}}" alt="icon"></div>
                  <span>Contact Us</span>
              </a></li>

              <!-- <li><a href="{{url('/customer_notifications')}}">
                  <div class="profile_icon_area"> <span class="notifi_count">4</span><img src="{{asset('public/assets/client/img/icons/notifications.svg')}}" alt="icon"></div>
                  <span>Notifications</span>
              </a></li> -->

              <!--<li><a href="{{url('/customer_settings')}}" id="Settings">-->
              <!--    <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/notifications.svg')}}" alt="icon"></div>-->
              <!--    <span>Settings</span>-->
              <!--</a></li>-->

              <li class="sign_out"><a href="{{url('/logout_customer')}}">
                  <div class="profile_icon_area"><img src="{{asset('public/assets/client/img/icons/logut.svg')}}" alt="icon"></div>
                  <span>Sign Out</span>
              </a></li>
          </ul>
        </div> 
  </div>
</div>
