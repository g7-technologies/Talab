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
                                <h1>Wishlist</h1>
                            </div>
                        </div>
                        <!-- content_head -->
                        @if(count($wishlist) > 0)
                        <div class="wishlist_items">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            <div class="shopping_cart_items_wrapper">
                            	@foreach($wishlist as $data)
                                <!-- single_shopping_cart_item -->
                                <div class="single_shopping_cart_item d-flex">
                                    <div class="shopping_cart_product_thumb position-relative">
                                        <img src="{{asset('/public/product_images/'.$data->products->image)}}" alt="">
                                        <a href="{{url('/remove_from_wishlist/'.$data->id)}}" class="delete_btn mt-4">Remove</a>
                                    </div>
                                    <div class="shopping_cart_content d-flex justify-content-between">
                                        <div class="left_wishlist_content">
                                            <a href="{{url('/product_details/'.$data->products->id)}}">{{$data->products->name}}</a>
                                            <p>{{$data->products->description}}</p>
                                            <div class="sh_cart_price">
                                                @if($data->products->discount_percentage != 0.00)
                                                <h3>SAR {{($data->products->price*$data->products->discount_percentage)/100}}</h3>
                                                <span><del>SAR {{$data->products->price}}</del></span>
                                                @else
                                                <h3>SAR {{$data->products->price}}</h3>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="wishlist_add_cart_btn_area">
                                            <form method="post" action="{{url('/add_to_cart')}}" id="form-id">
                                            @csrf
                                                <input type="hidden" name="product_id" value="{{$data->products->id}}">
                                                <div class="product_counter">
                                                    <input type="number" max="{{$data->products->stock}}" step="1" min="1" name="quantity">
                                                </div>
                                            </form>
                                            @if($data->products->stock != 0)
                                            <button class="btn" onclick="document.getElementById('form-id').submit();">Add to cart</button>
                                            @else
                                            <button class="btn" disabled>Out Of Stock</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- single_shopping_cart_item -->
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="empty_content_wrapper mt-70 text-center">
                            <img src="{{asset('public/assets/client/img/my_account/Unicorn.svg')}}" alt="no_wishlist">
                            <div class="empty_content_text pt-25">
                                <p>There is no products in wishlist</p>
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
@push('scripts')
<script>
    $(function() {
        $("#Wishlist").addClass("active");
    });
</script>
@endpush