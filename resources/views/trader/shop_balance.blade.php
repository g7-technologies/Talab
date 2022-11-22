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
                            <div class="stor_title_area d-flex justify-content-between">
                                <h1>Balance</h1>
                            </div>
                        </div>
                        <!-- content_head -->

                        <div class="my_account_content_wrap pt-55">

                            <div class="balance_wrapper net_balance text-center">
                                <h2>1052.50 USD</h2>
                                <p>Your Balance</p>
                            </div>

                            <div class="balance_wrapper d-flex justify-content-between align-items-center">
                                <div class="left_content_balance">
                                    <h4>Egg Cooker - Artisan - Refrigerator</h4>
                                    <p>Order #252145254</p>
                                </div>
                                <span>+78.35 SAR</span>
                            </div>

                            <div class="balance_wrapper d-flex justify-content-between align-items-center">
                                <div class="left_content_balance">
                                    <h4>Withdrawal</h4>
                                    <p>Card ******87</p>
                                </div>
                                <span>-853.63 SAR</span>
                            </div>

                            <div class="balance_wrapper d-flex justify-content-between align-items-center">
                                <div class="left_content_balance">
                                    <h4>Egg Cooker - Artisan - Refrigerator</h4>
                                    <p>Order #252145254</p>
                                </div>
                                <span>+78.35 SAR</span>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- my_account_page_end -->
</main>
<!-- main_area -->

@endsection