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
                            <div class="stor_title_area d-flex justify-content-between mb-25 align-items-center">
                                <h1>Shipping Addresses</h1>
                                <a class="btn create_new_address" href="{{url('/create_new_address')}}">Create a new address</a>
                            </div>
                        </div>
                        <!-- content_head -->

                        @if(count($addresses) > 0)
                        <!-- my_account_content_wrapper -->
                        <div class="my_account_content_wrap mt-55">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            <div class="my_acc_address">
                                <div class="address_content_wrapper ">
                                	@foreach($addresses as $data)
                                    <!-- single_address_area -->
                                    <div class="single_address">
                                        <div class="radio_common address_redio radio_style2">
                                            <li>
                                                @if($data->id == Auth::guard('customer')->user()->default_address)
                                                <input type="checkbox" name="{{$data->city}}" id="redio_two" value="{{$data->id}}" checked disabled>
                                                <label for="redio_one"><span></span>{{$data->city}}</label>
                                                @else
                                                <form method="post" action="{{url('/mark_as_default')}}" id="form_{{$data->id}}">
                                                    @csrf
                                                    <input type="hidden" value="{{$data->id}}" name="id">
                                                    <input type="checkbox" name="{{$data->city}}" id="redio_two" value="{{$data->id}}" onclick="document.getElementById('form_{{$data->id}}').submit();">
                                                    <label for="redio_one"><span></span>{{$data->city}}</label>
                                                </form>
                                                @endif
                                            </li>
                                        </div>
                                        
                                        <div class="address_list">
                                            <ul>
                                                <li>{{$data->city}}</li>
                                                <li>{{$data->address}}</li>
                                                <li>{{$data->shipping_note}}</li>
                                                <li>
                                                    <a href="{{url('/delete_address/'.$data->id)}}">Delete</a>
                                                    &nbsp;&nbsp;
                                                    @if(Auth::guard('customer')->user()->default_address == $data->id)
                                                    <span class="alert alert-success p-0">Default address</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
    
                                    </div>
                                    <!-- single_address_area -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="empty_content_wrapper mt-70 text-center">
                            <img src="{{asset('public/assets/client/img/my_account/Address-cuate.svg')}}" alt="no_address">
                            <div class="empty_content_text pt-25">
                                <span>There is no shipping addresses</span>
                            </div>
                        </div>
                        @endif
                        <!-- my_account_content_wrapper -->
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
        $("#CustomerAddresses").addClass("active");
    });
</script>
@endpush