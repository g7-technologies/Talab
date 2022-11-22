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
                            <li><a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a></li>
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

    <!-- store_details_header_area -->
    <div class="store_details_header mt-55 mb-45">
        <div class="container">
            <div class="store_head d-flex justify-content-between align-items-center">
                <div class="st_head_left d-flex align-items-center">
                    <div class="store_logo_area">
                        <img src="{{asset('/public/shop_logo/'.$shop->logo)}}" alt="shop_logo">
                    </div>
                    <div class="store_name_area">
                        <h3>{{$shop->name}}</h3>
                        <p><span><img src="assets/img/icons/Iconly-Light-Location.svg" alt=""></span>{{$shop->city}}</p>
                    </div>
                </div>

                <div class="store_head_right">
                    <div class="store_items d-flex align-items-center justify-content-end">
                        <span>({{$total_items}} items)</span>
                        @if($shop->shop_open == 0)
                        <button class="btn_open">Open</button>
                        @else
                        <button class="btn_close">close</button>
                        @endif
                    </div>
                    <h6>Minimum delivery : SAR {{$shop->minimum_cost_to_delivery}}</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- store_details_header_area -->

    <!-- store_Product_main_wrapper -->
    <div class="store_products_main_wrapper pb-30">
        <div class="container">

            <!-- .store_products -->
            <div class="row pt-100">
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar_area">
                        <button class="filter_btn" data-bs-toggle="collapse" data-bs-target="#filterbtncollaps" aria-expanded="false" aria-controls="filterbtncollaps"><span><img src="{{asset('public/assets/client/img/icons/filter-variant.svg')}}" alt=""></span>Filter</button>

                        <div class="filter_items_wrapper collapse" id="filterbtncollaps">

                            <form action="{{url('store_products/'.$shop->id.'/filter')}}" method="post">
                                @csrf
                                <div class="single_filter">
                                    <div class="folter_head position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#check_box_three" aria-expanded="false" aria-controls="check_box_three">
                                        <h4>Categories</h4>
                                    </div>

                                    <div class="filter_collaps collapse" id="check_box_three">
                                        <ul class="checkbox_common checkbox_style2">
                                            @foreach($filter_categories as $category)
                                            <li>
                                                <input type="checkbox" name="filter_list[]" id="{{$category->id}}" value="{{$category->id}}">
                                                <label for="{{$category->id}}"><span></span>{{$category->name}}</label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="single_filter">
                                    <div class="folter_head position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#check_box_one" aria-expanded="false" aria-controls="check_box_one">
                                        <h4>More Filters</h4>
                                    </div>

                                    <div class="filter_collaps collapse" id="check_box_one">
                                        <ul class="checkbox_common checkbox_style2">
                                            
                                            <li>
                                                <input type="checkbox" name="recent" id="recent" onclick="precent()">
                                                <label for="recent"><span></span>Recently Added</label>
                                            </li>
                    
                                            <li>
                                                <input type="checkbox" name="low" id="low" onclick="pricinglow()">
                                                <label for="low"><span></span>Price: Low → High</label>
                                            </li>

                                            <li>
                                                <input type="checkbox" name="high" id="high" onclick="pricinghigh()">
                                                <label for="high"><span></span>Price: High → Low</label>
                                            </li>


                                        </ul>
                                    </div>
                                </div>

                                <button class="btn" style="width: 100%;" type="submit">Apply Filters</button>
                            </form>
                            

                        </div>

                    </div>
                </div>

                <div class="col-lg-9 col-md-8">
                    <div class="single_store_products_grid">
                    	@foreach($products as $product)
                            @if($product->status == 1 && $product->is_deleted == 0)
                            <div class="single_store_product">
                                <a href="{{url('/product_details/'.$product->id)}}">
                                    <a href="{{url('/product_details/'.$product->id)}}">
                                    <div class="product_thuumb">
                                        <a href="{{url('/product_details/'.$product->id)}}">
                                        <img src="{{asset('/public/product_images/'.$product->image)}}" alt="product_image">
                                        </a>
                                    </div>
                                    </a>
                                    <a href="{{url('/product_details/'.$product->id)}}">
                                    <div class="products_info mt-4">
                                        <a href="{{url('/product_details/'.$product->id)}}">{{$product->name}}
                                        @if($product->discount_percentage != 0.00)
                                        <h5>SAR {{(($product->price*(100-$product->discount_percentage))/100)+(($product->price*$shop->profit)/100)}}</h5>
                                        @else
                                        <h5>SAR {{$product->price+(($product->price*$shop->profit)/100)}}</h5>
                                        @endif
                                        <p>{{$product->description}}</p>
                                        </a>
                                    </div>
                                    </a>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function pricinglow()
    {
        var low = document.getElementById("low");
        
        if(low.checked == true)
        {
            document.getElementById("high").checked = false;
            document.getElementById("recent").checked = false;
        }
    }

    function pricinghigh()
    {
        var high = document.getElementById("high");
        
        if(high.checked == true)
        {
            document.getElementById("low").checked = false;
            document.getElementById("recent").checked = false;
        }
    }

    function precent()
    {
        var recent = document.getElementById("recent");
        
        if(recent.checked == true)
        {
            document.getElementById("low").checked = false;
            document.getElementById("high").checked = false;
        }
    }

</script>
@endsection