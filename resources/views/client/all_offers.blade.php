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

    <!-- store_slider_wrapper -->
    <div class="store_slider_wrapper pt-55 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="stor_title_area d-flex justify-content-between mb-55 ">
                        <h1>All Offers</h1>
                    </div>
                </div>
            </div>
            @if(count($shops) == 0)
            <div class="col-lg-12 alert alert-danger">
                <p class="text-center">No Offers Found</p>
            </div>
            @endif
            <div class="product_store_grid">

   				@foreach($shops as $shop)
				<div class="single_stor_item">
					<a href="{{url('/store_products/'.$shop->id)}}" style="width:100%;">
						<div class="stor_logo_area position-relative">
							@if($shop->shop_open == 1)
							<span class="bagde open">open</span>
							@else
							<span class="bagde badge_close">close</span>
							@endif
							<img src="{{asset('/public/shop_logo/'.$shop->logo)}}" alt="shop_logo" />
						</div>
						<a href="{{url('/store_products/'.$shop->id)}}" >
						<div class="store_info text-center">
							<a href="{{url('/store_products/'.$shop->id)}}">{{$shop->name}}
							<p>Minimum delivery : SAR {{$shop->minimum_cost_to_delivery}}</p></a>
						</div>
						</a>
					</a>
				</div>
				@endforeach	

            </div>

        </div>
    </div>
    <!-- store_slider_wrapper -->

</main>

@endsection