@extends('layouts.master')
@section('content')
<main>
    <section class="banner_slider_active owl-carousel">
      @if(count($banners) == 0)
      <div class="single_banner_item">
      <img src="{{asset('public/assets/client/img/banner/banner.png')}}" alt="">
    </div>
    @else
    @foreach($banners as $banner)
    <div class="single_banner_item">
      <img src="{{asset('public/banner_images/'.$banner->name)}}" alt="banner_talab">
    </div>
    @endforeach
    @endif
  </section>

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

  <div class="store_slider_wrapper pt-55 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="stor_title_area d-flex justify-content-between mb-25">
            <h1>All Stores</h1>
            <a href="{{url('/all_stores')}}">See all</a>
          </div>
        </div>
      </div>
      @if(count($shops) == 0)
      <div class="col-lg-12 alert alert-danger">
        <p class="text-center">No Stores Found</p>
      </div>
      @endif
      <div class="product_stor_slide_active owl-carousel">
      
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

  <div class="store_slider_wrapper pt-50 pb-40">
    <div class="container">
      
      <div class="row">
        <div class="col-lg-12">
          <div class="stor_title_area d-flex justify-content-between mb-25">
            <h1>All Offers</h1>
            <a href="{{url('/all_offers')}}">See all</a>
          </div>
        </div>
      </div>
      @if(count($shops) == 0)
      <div class="col-lg-12 alert alert-danger">
        <p class="text-center">No Offers Found</p>
      </div>
      @endif
      <div class="product_stor_slide_active ml-5 owl-carousel">
      
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

  <div class="store_slider_wrapper pt-55 pb-80">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="stor_title_area d-flex justify-content-between mb-25">
            <h1>ALBalad Stores</h1>
            <a href="{{url('/albalad_stores')}}">See all</a>
          </div>
        </div>
      </div>
      @if(count($albalad_shops) == 0)
      <div class="col-lg-12 alert alert-danger">
        <p class="text-center">No ALBalad Stores Found</p>
      </div>
      @endif
      <div class="product_stor_slide_active owl-carousel">
      
        @foreach($albalad_shops as $shop)
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
</main>
@endsection