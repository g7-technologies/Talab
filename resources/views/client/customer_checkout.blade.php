@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/assets/trader/css/nice-select.css')}}">
@endpush
@section('content')

<main>
    <div class="shopping_cart_page_wrapper pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="stor_title_area mb-30 d-flex">
                        <a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a>
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>

            @if(count($cart_data) != 0)
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="shopping_cart_items_wrapper">
                        <h5>Shipping Information</h5>
                        @if(session('error_msg'))
                            <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                        @if(session('success_msg'))
                            <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        <form method="post" action="{{url('/create_order')}}" id="create_order">
                        @csrf
                            <div class="my_account_content_wrap my_account_page_content mt-55">
                                
                                <div class="form_shipping_wrapper">
                                    <div class="form_wrap d-flex justify-content-between flex-wrap">

                                        <div class="single_myaccount_form  my_account  select_option_input position-relative" style="width: 100% !important;">
                                            <select name="shop_type" required disabled>
                                                <option value="">Cash On Delivery</option>
                                                <option value="Cash On Delivery">Cash On Delivery</option>
                                              </select>
                                            <label for="">Payment Method</label>
                                        </div>
                                        
                                        @if(Auth::guard('customer')->check())
                                            @if(count($addresses) !=0 )
                                            <div class="single_myaccount_form position-relative" style="margin-top:-2%;">
                                                <select name="customer_address" id="customer_address" onchange="getAddress()" class="customer_addresses_select">
                                                    <option value="">Select Address</option>
                                                    @foreach($addresses as $data)
                                                        @if(Auth::guard('customer')->user()->default_address == $data->id)
                                                        <option value="{{$data}}" selected>{{$data->address}}</option>
                                                        @else
                                                        <option value="{{$data}}">{{$data->address}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                            <a href="{{url('/create_new_address')}}" style="margin-top:-20px;color:#000 !important;font-size:12px;margin-left:20px;"><i class="fa fa-plus" style="margin-right:5px;"></i>Add New Address</a>
                                            <input type="hidden" name="city" id="city_txt" value="">
                                            <input name="address" id="address_txt" type="hidden" value="">
                                            <input name="shipping_note" id="shipping_note_txt" type="hidden" value="">
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sh_cart_sidebar">
                        <div class="sh_cart_widget checkout_widget">
                            <div class="amount_list">
                                <h4>Order Summary</h4>
                                <ul>
                                    @foreach($cart_data as $data)
                                    <li class="d-flex justify-content-between align-items-center mt-10">
                                        <img src="{{asset('public/product_images/'.$data['item_image'])}}" alt="" class="user_icon">
                                        <div class="shopping_cart_content">
                                            <a href="">{{$data['item_name']}}</a>
                                            <div class="shopping_cart_count d-flex justify-content-between align-items-center">
                                                <div class="sh_cart_price">
                                                    @if($data['item_discount_percentage'] == 0)
                                                    <h3>SAR {{$data['item_price']+(($data['item_price']*($data['item_profit']))/100)}} <b>x</b> {{$data['item_quantity']}}</h3>
                                                    @else
                                                    <h3>SAR {{((($data['item_price']*(100-$data['item_discount_percentage']))/100)+(($data['item_price']*($data['item_profit']))/100))}} <b>x</b> {{$data['item_quantity']}}</h3>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </li>

                                    @endforeach
                                    <hr>
                                    <li class="d-flex justify-content-between align-items-center"><span>Item(s)</span> <span>SAR {{$total}}</span></li>
                                    @if($totalcoupon == 0)
                                    <li class="d-flex justify-content-between align-items-center"><span>Shipping</span> <span>SAR {{$accessory->shipping}}</span></li>
                                    @else
                                    @if($coupon_data[0]['promotion_type'] == 1)
                                    <li class="d-flex justify-content-between align-items-center"><span>Shipping</span> <span>SAR {{$accessory->shipping}}</span></li>
                                    @else
                                    <li class="d-flex justify-content-between align-items-center"><span>Shipping</span> <span>SAR {{(($accessory->shipping)*((100-$coupon_data[0]['discount'])/100))}}</span></li>
                                    @endif
                                    @endif
                                    @if($totalcoupon == 0)
                                    <li class="d-flex justify-content-between align-items-center"><span>Discount</span> <span>SAR 0</span></li>
                                    @else
                                    @if($coupon_data[0]['promotion_type'] == 1)
                                    <li class="d-flex justify-content-between align-items-center"><span>Discount</span> <span>SAR {{(($total)*($coupon_data[0]['discount']/100))}}</span></li>
                                    @else
                                    <li class="d-flex justify-content-between align-items-center"><span>Discount (Shipping)</span> <span>SAR {{(($accessory->shipping)*($coupon_data[0]['discount']/100))}}</span></li>
                                    @endif
                                    @endif
                                    <hr>
                                    @if($totalcoupon == 0)
                                    <li class="d-flex justify-content-between align-items-center"><span>Grand Total</span> <span>SAR {{$total+$accessory->shipping}}</span></li>
                                    @else
                                    @if($coupon_data[0]['promotion_type'] == 1)
                                    <li class="d-flex justify-content-between align-items-center"><span>Grand Total</span> <span>SAR {{$total-(($total)*($coupon_data[0]['discount']/100))+$accessory->shipping}}</span></li>
                                    @else
                                    <li class="d-flex justify-content-between align-items-center"><span>Grand Total</span> <span>SAR {{$total+(($accessory->shipping)*((100-$coupon_data[0]['discount'])/100))}}</span></li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                            <div class="sh_total_area">
                                
                                @if(Auth::guard('customer')->check())
                                    @if(count($cart_data) != 0)
                                    @if($totalcoupon == 0)
                                    <button class="checkout_btn" onclick="document.getElementById('create_order').submit();">Place Order (SAR {{$total+$accessory->shipping}})</button>
                                    @else
                                    @if($coupon_data[0]['promotion_type'] == 1)
                                    <button class="checkout_btn" onclick="document.getElementById('create_order').submit();">Place Order (SAR {{$total-(($total)*($coupon_data[0]['discount']/100))+$accessory->shipping}})</button>
                                    @else
                                    <button class="checkout_btn" onclick="document.getElementById('create_order').submit();">Place Order (SAR {{$total+(($accessory->shipping)*((100-$coupon_data[0]['discount'])/100))}})</button>
                                    @endif
                                    @endif
                                    @endif
                                @else
                                    @if(count($cart_data) != 0)
                                    @if($totalcoupon == 0)
                                    <button class="checkout_btn"  data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Place Order (SAR {{$total+$accessory->shipping}})</button>
                                    @else
                                    @if($coupon_data[0]['promotion_type'] == 1)
                                    <button class="checkout_btn"  data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Place Order (SAR {{$total-(($total)*($coupon_data[0]['discount']/100))+$accessory->shipping}})</button>
                                    @else
                                    <button class="checkout_btn"  data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Place Order (SAR {{$total+(($accessory->shipping)*((100-$coupon_data[0]['discount'])/100))}})</button>
                                    @endif
                                    @endif
                                    @endif
                                @endif
                            </div>
                            <div class="sh_cart_widget coupon_code_widget">
                                @if($totalcoupon == 0)
                                <div class="add_cupon">
                                    ADD COUPON
                                </div>
                                <div class="cupon_input">
                                    <form method="post" action="{{url('/apply_coupon')}}">
                                        @csrf
                                        <input type="text" placeholder="Enter Coupon Code" name="coupon_code">
                                        <button type="submit" class="applay">Apply</button>
                                    </form>
                                </div>
                                @else
                                <div class="add_cupon">
                                    REMOVE COUPON
                                </div>
                                <div class="sh_total_area">
                                    <ul>
                                        <li class="d-flex justify-content-between align-items-center"><span>{{$coupon_data[0]['code']}}</span> <span>@if($coupon_data[0]['promotion_type'] == 1) Discount Coupon @else Delivery Coupon @endif</span><a style="color:#ff0000; font-size:12px;" href="{{url('/remove_coupon')}}">Remove</a></li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @else
            <div class="empty_content_wrapper mt-70 text-center mb-30">
                <img src="{{asset('public/assets/client/img/my_account/order.svg')}}" alt="no_product">
                <div class="empty_content_text pt-25">
                    <span>Cart is empty</span>
                </div>
            </div>
            @endif

        </div>
    </div>
</main>

@push('scripts')
<script src="{{asset('public/assets/trader/js/jquery.nice-select.min.js')}}"></script>
<script>
    $('select').niceSelect();

    $(document).ready(function() {
        getAddress();  
    });
    
    function getAddress()
    {
        var value = $(".selected");
        if(value[1].dataset.value == '')
        {
            $("#address_txt").val('');
            $("#city_txt").val('');
            $("#shipping_note_txt").val('');
        }
        else
        {
            var data = JSON.parse(value[1].dataset.value);
            $("#address_txt").val(data.address);
            $("#city_txt").val(data.city);
            $("#shipping_note_txt").val(data.shipping_note);
        }
    }

</script>
@endpush

@endsection