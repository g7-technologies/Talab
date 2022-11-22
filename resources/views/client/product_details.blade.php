@extends('layouts.master')
@section('content')

<!-- main  -->
<main>
    <!-- nav_area -->
    <section class="nav_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_bottom_nav_area">
                        <ul class="d-flex align-items-center">
                            <li><a href="{{ url('/store_products/'.$shop->id) }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a></li>
                            <li><a href="{{url('/all_stores')}}">All Stores</a></li>
                            <li><a href="{{url('/all_offers')}}">Offers</a></li>
                            <li><a href="{{url('/albalad_stores')}}">ALBalad Stores</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--single_product_area -->
    <div class="single_product_header pt-60 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_thumb d-flex">
                        <div class="product_slider_nav">
                            <div class="single_slider_nav">
                                <img src="{{asset('public/product_images/'.$product->image)}}" alt="" width="120">
                            </div>
                            @if($product_images)
                            @foreach($product_images as $images)
                            <div class="single_slider_nav">
                                <img src="{{asset('public/product_images/'.$images->image)}}" alt="" width="120">
                            </div>
                            @endforeach
                            @endif
                        </div>
                        
                        <div class="slider_big_tthumb">
                            <div class="single_big_thimb position-relative">
                                <img src="{{asset('public/product_images/'.$product->image)}}" alt="" width="570" height="450">
                            </div>
                            @if($product_images)
                            @foreach($product_images as $images)
                            <div class="single_big_thimb position-relative">
                                <img src="{{asset('public/product_images/'.$images->image)}}" alt="" width="500">
                            </div>
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_information">
                        <div class="product_title">
                            <h3>{{$product->name}}</h3>
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="product_pricing_area">
                        	@if($product->discount_percentage != 0)
                            <div class="product_price">
                                <h3>SAR {{(($product->price*(100-$product->discount_percentage))/100)+(($product->price*$shop->profit)/100)}}</h3> <span><del>SAR {{$product->price+(($product->price*$shop->profit)/100)}}</del></span>
                            </div>
                            @else
                            <div class="product_price">
                                <h3>SAR {{$product->price+(($product->price*$shop->profit)/100)}}</h3>
                            </div>
                            @endif

                            <div class="product_count_area d-flex align-items-center justify-content-between">
                                <form method="post" action="{{url('/add_to_cart')}}" id="form-id">
                                @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="product_counter">
                                        <input type="number" max="{{$product->stock}}" step="1" min="1" name="quantity">
                                    </div>
                                </form>
                                
                                <div class="button_area">
                                	@if($product->stock != 0)
                                    <button class="add_btn" onclick="document.getElementById('form-id').submit();">Add to cart</button>
                                    @else
                                    <button class="add_btn" disabled>Out Of Stock</button>
                                    @endif
                                    @if(Auth::guard('customer')->check())
                                        @if($favourite)
                                        <a href="{{url('/unlike_product/'.$product->id)}}">
                                        <button class="add_wish"><img src="{{asset('public/assets/client/img/heart-filled.svg')}}" alt="favourite"></button></a>
                                        @else
                                        <a href="{{url('/like_product/'.$product->id)}}">
                                        <button class="add_wish"><img src="{{asset('public/assets/client/img/heart.svg')}}" alt="favourite"></button></a>
                                        @endif
                                    @else
                                    <button class="add_wish" data-bs-toggle="modal" data-bs-target="#LoginModal"><img src="{{asset('public/assets/client/img/heart.svg')}}" alt="favourite"></button>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="seller_details_area"> 
                                <h3>Seller</h3>
                                <div class="seller_details d-flex align-items-center">
                                    <div class="seller_logo">
                                        <img src="{{asset('public/shop_logo/'.$shop->logo)}}" alt="shop_logo">
                                    </div>
                                    <div class="seller_inf">
                                        <h5><a href="{{url('/store_products/'.$shop->id)}}">{{$shop->name}}</a></h5>
                                        <p><span><img src="{{asset('public/assets/client/img/icons/Iconly-Light-Location.svg')}}" alt=""></span>{{$shop->city}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- product_discription -->
            <div class="row product_desc_main_wrapper pt-100">
                <div class="col-lg-11">
                    <div class="product_descriptions_wrapper">
                        <div class="product_desc">
                            <h3>Description</h3>
                            <p>{{$product->description}}</p>
                        </div>

                        <div class="gen_info">
                            <h6>general information</h6>
                            <ul>
                                <li>Stock Quantity : {{$product->stock}}</li>
                                <li>Category : {{$category->name}}</li>
                                <li>Discount : {{$product->discount_percentage}}%</li>
                                <li>Product condition : New</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single_product_area -->

    <!-- relatade_items -->
    <div class="relatade_items pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="stor_title_area mb-45">
                        <h1>Related Items</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related_product_active owl-carousel">

                    	@foreach($category->products as $similar_products)
                    	@if($similar_products->id != $product->id)
                    	@if($similar_products->status == 1 && $similar_products->is_deleted == 0)
                            <div class="single_store_product">
                                <a href="{{url('/product_details/'.$similar_products->id)}}">
                                    <a href="{{url('/product_details/'.$similar_products->id)}}">
                                    <div class="product_thuumb">
                                        <a href="{{url('/product_details/'.$similar_products->id)}}">
                                        <img src="{{asset('/public/product_images/'.$similar_products->image)}}" alt="product_image">
                                        </a>
                                    </div>
                                    </a>
                                    <a href="{{url('/product_details/'.$similar_products->id)}}">
                                    <div class="products_info mt-4">
                                        <a href="{{url('/product_details/'.$similar_products->id)}}">{{$similar_products->name}}
                                        <!--@if($similar_products->discount_percentage != 0.00)-->
                                        <!--<h5>SAR {{($similar_products->price*$similar_products->discount_percentage)/100}}</h5>-->
                                        <!--@else-->
                                        <!--<h5>SAR {{$similar_products->price}}</h5>-->
                                        <!--@endif-->
                                        <p>{{$similar_products->description}}</p>
                                        </a>
                                    </div>
                                    </a>
                                </a>
                            </div>
                        @endif
                        @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- relatade_items_end -->
</main>
<!-- main end -->


@endsection