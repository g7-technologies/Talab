@extends('layouts.master')
@section('content')

<main>
    <!-- nav_area -->
    <section class="nav_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_bottom_nav_area">
                        <ul class="d-flex align-items-center">
                            <li><a href="{{url('/all_stores')}}">All Stores</a></li>
                            <li><a href="{{url('/all_offers')}}">Offers</a></li>
                            <li><a href="{{url('/albalad_stores')}}">ALBalad Stores</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- nav_area_end -->


    <!-- my_account_page -->
    <div class="my_account_wrapper pt-60">
        <div class="container">
            <div class="row g-5">

                @include('includes.client_sidebar')

                <div class="col-lg-9 col-md-8">
                    <div class="right_content_main_wrapper">
                        <!-- content_head -->
                        <div class="right_content_head">
                            <div class="stor_title_area d-flex justify-content-between mb-25">
                                <h1>Notifications</h1>
                            </div>
                        </div>
                        <!-- content_head -->
                        @if(false)
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

                            </div>
                        </div>
                        <!-- notification_content_wrapper_ewnd -->
                        @else
                        <div class="empty_content_wrapper mt-70 text-center">
                            <img src="{{asset('public/assets/client/img/my_account/notification.svg')}}" alt="">
                            <div class="empty_content_text pt-25">
                                <p>No Notifications at the moment</p>
                                <a class="btn" href="{{url('/')}}">Home</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- my_account_page_end -->
</main>

@endsection