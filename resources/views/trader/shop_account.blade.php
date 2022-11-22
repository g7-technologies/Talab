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
                            <div class="stor_title_area d-flex justify-content-between mb-25 align-items-center">
                                <h1>My Account</h1>
                                <div class="title_area_btns d-flex" id="update_profile" style="display: none !important;">
                                    <button type="button" class="btn edit_btn" onclick="document.getElementById('form-id').submit();">Save</button>
                                    <button class="btn edit_btn cancel_btn" onclick="cancel_edit_profile()">Cancel</button>
                                </div>
                                <button type="button" class="btn edit_btn" onclick="edit_profile()" id="edit_btn" style=""><span><img src="{{asset('public/assets/trader/img/icons/Edit.svg')}}" alt=""></span> Edit</button>
                            </div>
                        </div>
                        <!-- content_head -->


                        <!-- my_account_content_wrapper -->
                        <div class="my_account_content_wrap my_account_page_content mt-55 ">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            <div class="form_shipping_wrapper">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <div class="add_product_thumb_img d-flex justify-content-between">
                                                <div class="switch_btn_area">
                                                    <ul class="switch_common text d_inline">
                                                        <li class="yesNo">
                                                            <form method="post" action="{{url('/open_close_shop')}}" id="formName">
                                                                @csrf
                                                                @if(Auth()->guard('shop')->user()->shop_open == 1)
                                                                <input class="switch" id="switch25" type="checkbox" checked name="switch" onchange="document.getElementById('formName').submit()" value="1">
                                                                @else
                                                                <input class="switch" id="switch25" type="checkbox" name="switch" onchange="document.getElementById('formName').submit()" value="1">
                                                                @endif
                                                                <label for="switch25"><span class="icon d_block"></span></label>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="form-id" method="post" action="{{url('/shop_edit_profile')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="add_product_thumb_img d-flex justify-content-between">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="img" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{asset('public/shop_logo/'.Auth::guard('shop')->user()->logo)}}');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="name" value="{{Auth::guard('shop')->user()->name}}">
                                            <label for="">Store's Name</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="registration_no" value="{{Auth::guard('shop')->user()->registration_no}}">
                                            <label for="">Registration Number</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="trader_name" value="{{Auth::guard('shop')->user()->trader_name}}">
                                            <label for="">Trader Name</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="email" value="{{Auth::guard('shop')->user()->email}}">
                                            <label for="">Email</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="number"value="{{Auth::guard('shop')->user()->number}}">
                                            <label for="">Number</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="city"value="{{Auth::guard('shop')->user()->city}}">
                                            <label for="">City</label>
                                        </div>

                                        <div class="single_myaccount_form_sm position-relative" style="border:2px solid #222831; border-radius: 20px; margin-bottom:20px;">
                                            <label for="" style="margin-left: 23px;">Always Open (24/7)</label></br>
                                            @if(Auth::guard('shop')->user()->always_open == 1)
                                            <input class="" type="checkbox" name="always_open" value="1" checked>
                                            @else
                                            <input class="" type="checkbox" name="always_open" value="1">
                                            @endif
                                        </div>

                                        <div class="single_myaccount_form_sm position-relative" style="border:2px solid #222831; border-radius: 20px; margin-bottom:20px;">
                                            <label for="" style="margin-left: 23px;">ALBalad Store</label></br>
                                            @if(Auth::guard('shop')->user()->albalad == 1)
                                            <input class="" type="checkbox" name="albalad" value="1" checked>
                                            @else
                                            <input class="" type="checkbox" name="albalad" value="1">
                                            @endif
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="iban" value="{{Auth::guard('shop')->user()->iban}}">
                                            <label for="">IBAN</label>
                                        </div>

                                        <div class="single_myaccount_form position-relative">
                                            <input type="text" required name="minimum_cost_to_delivery" value="{{Auth::guard('shop')->user()->minimum_cost_to_delivery}}">
                                            <label for="">Minimum Cost To Delivery</label>
                                        </div>

                                        <div class="single_myaccount_form select_option_input position-relative mb-10">
                                            <select required name="delivery" class=" mb-4">
                                                @if(Auth::guard('shop')->user()->delivery == 1)
                                                <option value="1" selected>Delivery On Talab</option>
                                                <option value="0">Delivery On Us</option>
                                                @else
                                                <option value="1">Delivery On Talab</option>
                                                <option value="0" selected>Delivery On Us</option>
                                                @endif
                                              </select>
                                            <label for="">Delivery</label>
                                        </div>

                                    </form>
                                    <div class="accordion-item">
                                <h2 class="accordion-header" id="change_password_heading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#change_password_collapse" aria-expanded="false" aria-controls="change_password_collapse">Change Password</button>
                                </h2>
                                <div id="change_password_collapse" class="accordion-collapse collapse p-4" aria-labelledby="change_password_heading" data-bs-parent="#accordionFlushExample">

                                    <div class="popup_form_area position-relative">
                                        <form action="{{url('/shop_change_password')}}" method="post">
                                            @csrf
                                            <div class="single_input position-relative">
                                                <input type="password" required name="old_password">
                                                <label for="">Old Password</label>
                                            </div>

                                            <div class="single_input position-relative">
                                                <input type="password" required name="new_password">
                                                <label for="">New Password</label>
                                            </div>

                                            <div class="single_input position-relative">
                                                <input type="password" required name="confirm_password">
                                                <label for="">Confirm Password</label>
                                            </div>


                                            <div class="popup_btn">
                                                <button type="submit">Change Password</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="display_product_increment_heading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#display_product_increment_collapse" aria-expanded="false" aria-controls="display_product_increment_collapse">Request Product Display Increment</button>
                                </h2>
                                <div id="display_product_increment_collapse" class="accordion-collapse collapse p-4" aria-labelledby="display_product_increment_heading" data-bs-parent="#accordionFlushExample">

                                    <div class="popup_form_area position-relative">
                                        <form action="{{url('/request_product_display')}}" method="post">
                                            @csrf
                                            <div class="single_myaccount_form select_option_input position-relative mb-10">
                                                <select required name="no_of_product" class=" mb-4">
                                                    @if(Auth::guard('shop')->user()->no_of_product == 100)
                                                    <option value="" selected>100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                    @elseif(Auth::guard('shop')->user()->no_of_product == 200)
                                                    <option value="" selected>200</option>
                                                    <option value="100">100</option>
                                                    <option value="300">300</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                    @elseif(Auth::guard('shop')->user()->no_of_product == 300)
                                                    <option value="" selected>300</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                    @elseif(Auth::guard('shop')->user()->no_of_product == 500)
                                                    <option value="" selected>500</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="1000">1000</option>
                                                    @elseif(Auth::guard('shop')->user()->no_of_product == 1000)
                                                    <option value="" selected>1000</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="500">500</option>
                                                    @endif
                                                  </select>
                                                <label for="no_of_product">no_of_product</label>
                                            </div>

                                            <div class="popup_btn">
                                                <button type="submit">Send Request</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                                </div>
                            </div>


                        </div>
                        <!-- my_account_content_wrapper -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- my_account_page_end -->
</main>
<!-- main_area -->

@push('scripts')
<script>
    $(function() {
        $("#MyAccount").addClass("active");
    });
</script>
<script>
    function edit_profile()
    {
        $("#edit_btn").attr("style", "display:none !important")
        $("#update_profile").attr("style", "display:block")
    }

    function cancel_edit_profile()
    {
        $("#update_profile").attr("style", "display:none !important")
        $("#edit_btn").attr("style", "display:block")
    }
</script>
@endpush
@endsection