@extends('layouts.shop_master')
@section('content')
<main>
   <div class="my_account_wrapper pt-60">
      <div class="container">
         <div class="row g-5">
            @include('includes.shop_sidebar')
            <div class="col-lg-9 col-md-8">
               <div class="right_content_main_wrapper">
                  <!-- content_head -->
                  <div class="right_content_head">
                     <div class="stor_title_area d-flex justify-content-between mb-55">
                        <h1>Orders</h1>
                     </div>
                  </div>
                  <!-- content_head -->
                  <!-- order_cotnent_wrapper   -->
                  <div class="order_cotennt_wrapper">
                     @if(session('error_msg'))
                       <p class="alert alert-danger">{{session('error_msg')}}</p> 
                      @endif
                      @if(session('success_msg'))
                       <p class="alert alert-success">{{session('success_msg')}}</p> 
                      @endif
                     <div class="order_tab_nav mb-40">
                        <nav>
                           <div class="nav" id="nav-tab" role="tablist">
                              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">In-Completed Orders</button>
                              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Completed Orders</button>
                           </div>
                        </nav>
                     </div>
                     <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <?php $incompl = 0; ?>
                           @foreach($result as $data)
                           @if($data['status'] != 4)
                           <?php $incompl = $incompl+1; ?>
                           <!-- order_single_wrapper -->
                           <div class="order_single_wrapper">
                              <div class="order_single_item_page d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExampletow_{{$data['id']}}" aria-expanded="false" aria-controls="collapseExampletow_{{$data['id']}}">
                                 <div class="order_content_left">
                                    <h4>Order Num : #{{$data['order_id']}} 
                                       @if($data['status'] == 0)
                                       <span class="badge_order in_review">Pending</span>
                                       @elseif($data['status'] == 1)
                                       <span class="badge_order shipped">Approved</span>
                                       @elseif($data['status'] == 2)
                                       <span class="badge_order cancelled">Cancelled</span>
                                       @elseif($data['status'] == 3)
                                       <span class="badge_order shipped">Shipped</span>
                                       @endif
                                    </h4>
                                    <p>Date : {{$data['created_at']}}</p>
                                    <h5>Amount :- <b>SAR {{$data['grand_total']}}</b></h5>
                                 </div>
                                 <div class="order_content_right d-flex align-items-center">
                                    <div class="single_order_img">
                                       <img src="{{asset('public/product_images/'.$data['order_details'][0]->products->image)}}" alt="">
                                    </div>
                                    @if(count($data['order_details']) > 1)
                                    <div class="single_order_img position-relative">
                                       <img src="{{asset('public/product_images/'.$data['order_details'][1]->products->image)}}" alt="">
                                       <div class="more_orders">
                                          +{{count($data['order_details'])-1}}
                                       </div>
                                    </div>
                                    @endif
                                 </div>
                              </div>

                              @if($data['status'] != 2)
                              <div class="order_collaps_items collapse" id="collapseExampletow_{{$data['id']}}">
                                 @if($data['status'] == 0)
                                 <div class="order_cancel_btn_area text-end">
                                    <a href="{{url('/shop_cancel_order/'.$data['id'])}}" class="order_cancel_btn">Cancel Order</a>
                                    <a href="{{url('/accept_order/'.$data['id'])}}" class="order_accept_btn">Accept Order</a>
                                 </div>
                                 @elseif($data['status'] == 1)
                                 <div class="order_cancel_btn_area text-end">
                                    @if(Auth::guard('shop')->user()->delivery == 0)
                                    <a href="{{url('/ship_order/'.$data['id'])}}" class="order_accept_btn">Ship Order</a>
                                    @endif
                                 </div>
                                 @elseif($data['status'] == 3)
                                 @if(Auth::guard('shop')->user()->delivery == 0)
                                 <div class="order_cancel_btn_area text-end">
                                    <a href="{{url('/mark_as_delivered/'.$data['id'])}}" class="order_accept_btn">Mark as Delivered</a>
                                 </div>
                                 @endif
                                 @endif
                                 <!-- delivery_information -->
                                 <div class="delivery_info d-flex align-items-center mt-40">
                                    <div class="single_deliver_info d-flex align-items-center">
                                       <div class="deliver_icons">
                                          <img src="{{asset('public/assets/trader/img/icons/map_marker.svg')}}" alt="">
                                       </div>
                                       <div class="delivery_text">
                                          <p>Location : </p>
                                          <h4>{{$data['city']}}, {{$data['address']}}</h4>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- delivery_information -->
                                 <!-- order_tracker_timeLine -->
                                 <div class="order_timeline_track d-flex justify-content-between mt-50">
                                    @if($data['status'] == 0)
                                    <div class="single_order_track progress_track">
                                       <div class="track_circle"></div>
                                       <p>Pending</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Approved</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Shipped</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Delivered</p>
                                    </div>
                                    @elseif($data['status'] == 1)
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Pending</p>
                                    </div>
                                    <div class="single_order_track progress_track">
                                       <div class="track_circle"></div>
                                       <p>Approved</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Shipped</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Delivered</p>
                                    </div>
                                    @elseif($data['status'] == 3)
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Pending</p>
                                    </div>
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Approved</p>
                                    </div>
                                    <div class="single_order_track progress_track">
                                       <div class="track_circle"></div>
                                       <p>Shipped</p>
                                    </div>
                                    <div class="single_order_track">
                                       <div class="track_circle"></div>
                                       <p>Delivered</p>
                                    </div>
                                    @endif
                                 </div>
                                 <!-- order_tracker_timeLine_end -->
                                 <!-- total_order_list -->
                                 @if(count($data['order_details']) > 1)
                                 <!-- total_order_list -->
                                 <div class="order_total_list_wrapper d-flex mt-50">
                                   <!-- single_order_list  -->
                                   @foreach($data['order_details'] as $order_details)
                                   <div class="single_order_listed">
                                       <div class="order_thumb">
                                           <img src="{{asset('public/product_images/'.$order_details->products->image)}}" alt="product_image">
                                       </div>
                                       <div class="order_list_text">
                                            @if($order_details->discount_percentage == 0)
                                            <p>SAR {{$order_details->price}}</p>
                                            @else
                                            <p>SAR {{($order_details->price*$order_details->discount_percentage)/100}}</p>
                                            @endif
                                       </div>
                                    </div>
                                    @endforeach
                                    <!-- single_order_list  -->
                                 </div>
                                 <!-- total_order_list_end -->
                                 @endif
                                 <!-- total_order_list_end -->
                              </div>
                              @endif
                           </div>
                           <!-- order_single_wrapper -->
                           @endif
                           @endforeach
                           @if($incompl == 0)
                           <div class="empty_content_wrapper mt-70 text-center">
                              <img src="{{asset('public/assets/client/img/my_account/order.svg')}}" alt="empty_img">
                              <div class="empty_content_text pt-25">
                                  <p>You haven't received any orders yet</p>
                              </div>
                           </div>
                           @endif
                           
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <?php $compl = 0; ?>
                           @foreach($result as $data)
                           @if($data['status'] == 4)
                           <?php $compl = $compl+1; ?>
                           <!-- order_single_wrapper -->
                           <div class="order_single_wrapper">
                              <div class="order_single_item_page d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExampletow_{{$data['id']}}" aria-expanded="false" aria-controls="collapseExampletow_{{$data['id']}}">
                                 <div class="order_content_left">
                                    <h4>Order Num : #{{$data['order_id']}} 
                                       <span class="badge_order shipped">Delivered</span>
                                    </h4>
                                    <p>Date : {{$data['created_at']}}</p>
                                    <h5>Amount :- <b>SAR {{$data['grand_total']}}</b></h5>
                                 </div>
                                 <div class="order_content_right d-flex align-items-center">
                                    <div class="single_order_img">
                                       <img src="{{asset('public/product_images/'.$data['order_details'][0]->products->image)}}" alt="">
                                    </div>
                                    @if(count($data['order_details']) > 1)
                                    <div class="single_order_img position-relative">
                                       <img src="{{asset('public/product_images/'.$data['order_details'][1]->products->image)}}" alt="">
                                       <div class="more_orders">
                                          +{{count($data['order_details'])-1}}
                                       </div>
                                    </div>
                                    @endif
                                 </div>
                              </div>

                              <div class="order_collaps_items collapse" id="collapseExampletow_{{$data['id']}}">
                                 <!-- delivery_information -->
                                 <div class="delivery_info d-flex align-items-center mt-40">
                                    <div class="single_deliver_info d-flex align-items-center">
                                       <div class="deliver_icons">
                                          <img src="{{asset('public/assets/trader/img/icons/map_marker.svg')}}" alt="">
                                       </div>
                                       <div class="delivery_text">
                                          <p>Location : </p>
                                          <h4>{{$data['city']}}, {{$data['address']}}</h4>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- delivery_information -->
                                 <!-- order_tracker_timeLine -->
                                 <div class="order_timeline_track d-flex justify-content-between mt-50">
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Pending</p>
                                    </div>
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Approved</p>
                                    </div>
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Shipped</p>
                                    </div>
                                    <div class="single_order_track active">
                                       <div class="track_circle"></div>
                                       <p>Delivered</p>
                                    </div>
                                 </div>
                                 <!-- order_tracker_timeLine_end -->
                                 <!-- total_order_list -->
                                 @if(count($data['order_details']) > 1)
                                 <!-- total_order_list -->
                                 <div class="order_total_list_wrapper d-flex mt-50">
                                   <!-- single_order_list  -->
                                   @foreach($data['order_details'] as $order_details)
                                   <div class="single_order_listed">
                                       <div class="order_thumb">
                                           <img src="{{asset('public/product_images/'.$order_details->products->image)}}" alt="product_image">
                                       </div>
                                       <div class="order_list_text">
                                            @if($order_details->discount_percentage == 0)
                                            <p>SAR {{$order_details->price}}</p>
                                            @else
                                            <p>SAR {{($order_details->price*$order_details->discount_percentage)/100}}</p>
                                            @endif
                                       </div>
                                    </div>
                                    @endforeach
                                    <!-- single_order_list  -->
                                 </div>
                                 <!-- total_order_list_end -->
                                 @endif
                                 <!-- total_order_list_end -->
                              </div>
                           </div>
                           <!-- order_single_wrapper -->
                           @endif
                           @endforeach
                           @if($compl == 0)
                           <div class="empty_content_wrapper mt-70 text-center">
                              <img src="{{asset('public/assets/client/img/my_account/order.svg')}}" alt="empty_img">
                              <div class="empty_content_text pt-25">
                                  <p>You haven't delivered any orders yet</p>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  <!-- order_cotnent_wrapper  end -->
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
        $("#Orders").addClass("active");
    });
</script>
@endpush