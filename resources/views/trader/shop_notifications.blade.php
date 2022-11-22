@extends('layouts.shop_master')
@section('content')

<!-- main_area -->
<main>
    <!-- my_account_page -->
    <div class="my_account_wrapper pt-60">
        <div class="container">
            <div class="row g-5">

                @include('includes.shop_sidebar')

                <div class="col-lg-9 col-md-8">
                    <div class="right_content_main_wrapper">
                        <!-- content_head -->
                        <div class="right_content_head">
                            <div class="stor_title_area d-flex justify-content-between mb-25">
                                <h1>Notifications</h1>
                            </div>
                        </div>
                        <!-- content_head -->

                        <!-- notification_content_wrapper -->
                        <div class="notification_content_wrapper">


                            <div class="notification_wrap">

                                <!-- single_notification -->
                                <div class="single_notification  d-flex align-items-center">
                                    <div class="notifications_thumb">
                                        <img src="assets/img/my_account/talab.svg" alt="">
                                    </div>

                                    <div class="notification_content d-flex justify-content-between align-items-center">
                                        <p>Your Order #5425478 had cancelled</p>
                                        <span class="notification_time">Today</span>
                                    </div>

                                </div>
                                <!-- single_notification -->

                                <!-- single_notification -->
                                <div class="single_notification  d-flex align-items-center">
                                    <div class="notifications_thumb">
                                        <img src="assets/img/my_account/talab.svg" alt="">
                                    </div>

                                    <div class="notification_content d-flex justify-content-between align-items-center">
                                        <p>Your Order #5425478 had Arrived on your door</p>
                                        <span class="notification_time">Yesterday</span>
                                    </div>

                                </div>
                                <!-- single_notification -->

                                <!-- single_notification -->
                                <div class="single_notification  d-flex align-items-center">
                                    <div class="notifications_thumb">
                                        <img src="assets/img/my_account/talab.svg" alt="">
                                    </div>

                                    <div class="notification_content d-flex justify-content-between align-items-center">
                                        <p>You have a free shipping on your first order</p>
                                        <span class="notification_time">14 day ago</span>
                                    </div>

                                </div>
                                <!-- single_notification -->

                                <!-- single_notification -->
                                <div class="single_notification  d-flex align-items-center">
                                    <div class="notifications_thumb">
                                        <img src="assets/img/my_account/talab.svg" alt="">
                                    </div>

                                    <div class="notification_content d-flex justify-content-between align-items-center">
                                        <p>You have 10% Off on your first order</p>
                                        <span class="notification_time">Month Ago</span>
                                    </div>

                                </div>
                                <!-- single_notification -->


                            </div>


                        </div>
                        <!-- notification_content_wrapper_ewnd -->


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- my_account_page_end -->
</main>
<!-- main_area -->

@endsection