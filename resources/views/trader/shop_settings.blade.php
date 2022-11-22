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
                                <h1>Settings</h1>
                            </div>
                        </div>
                        <!-- content_head -->
                        <div class="row mt-65">
                            @if(session('error_msg'))
                               <p class="alert alert-danger">{{session('error_msg')}}</p> 
                              @endif
                              @if(session('success_msg'))
                               <p class="alert alert-success">{{session('success_msg')}}</p> 
                              @endif
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
            </div>

        </div>
    </div>
    <!-- my_account_page_end -->
</main>
<!-- main_area -->


@endsection
@push('scripts')
<script>
    $(function() {
        $("#Settings").addClass("active");
    });
</script>
@endpush