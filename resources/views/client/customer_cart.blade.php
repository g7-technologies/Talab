@extends('layouts.master')
@section('content')

<main>
    <div class="shopping_cart_page_wrapper pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="stor_title_area mb-30 d-flex">
                        <a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a>
                        <h1>Shopping Cart ({{count($cart_data)}})</h1>
                    </div>
                    @if(count($cart_data) != 0)
                        <a href="{{url('/empty_cart')}}" class="update_cart_quantity text-center">clear cart</a>
                    @endif
                </div>
            </div>

            @if(count($cart_data) != 0)
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="shopping_cart_items_wrapper">

                        @foreach($cart_data as $data)
                        <div class="single_shopping_cart_item d-flex mb-30">
                            <div class="shopping_cart_product_thumb position-relative">
                                <img src="{{asset('public/product_images/'.$data['item_image'])}}" alt="" style="margin-bottom:15px;">
                                <a href="{{url('/remove_product_from_cart/'.$data['item_id'])}}" class="delete_btn">Delete</a>
                            </div>
                            <div class="shopping_cart_content">
                                <a href="">{{$data['item_name']}}</a>
                                <p>{{$data['item_desc']}}</p>
                                <div class="shopping_cart_count d-flex justify-content-between align-items-center">
                                    <div class="sh_cart_price">
                                        @if($data['item_discount_percentage'] == 0)
                                        <h3>SAR {{$data['item_price']+($data['item_price']*(($data['item_profit'])/100))}}</h3>
                                        @else
                                        <h3>SAR {{($data['item_price']*(((100-$data['item_discount_percentage']))/100)+($data['item_price']*(($data['item_profit'])/100)))}}</h3>
                                        <span><del>SAR {{$data['item_price']+($data['item_price']*(($data['item_profit'])/100))}}</del></span>
                                        @endif
                                    </div>

                                    <div class="sh_cart_count">
                                        <form method="post" action="{{url('/update_cart_product_quantity')}}" id="form_{{$data['item_id']}}">
                                        @csrf
                                            <input type="hidden" name="product_id" value="{{$data['item_id']}}">
                                            <input type="number" value="{{$data['item_quantity']}}" max="{{$data['item_stock']}}" min="1" name="product_quantity">
                                        </form>
                                        <a class="update_cart_quantity text-center mt-2" onclick="document.getElementById('form_{{$data['item_id']}}').submit();">update</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- single_shopping_cart_item -->
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sh_cart_sidebar">
                        <div class="sh_cart_widget checkout_widget">
                            <div class="amount_list">
                                <ul>
                                    <li class="d-flex justify-content-between align-items-center"><span>Item(s)</span> <span>SAR {{$total}}</span></li>
                                    <li class="d-flex justify-content-between align-items-center"><span>Shipping</span> <span>SAR {{$accessory->shipping}}</span></li>
                                </ul>
                            </div>
                            <div class="sh_total_area">
                                <h4>Grand Total: SAR {{$total+$accessory->shipping}}</h4>
                                @if(count($cart_data) != 0)
                                <a href="{{url('/checkout')}}">
                                    <button type="button" class="checkout_btn">PROCEED TO CHECKOUT</button>
                                </a>
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

@endsection