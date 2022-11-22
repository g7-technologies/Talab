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
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                        <!-- content_head -->
                        <div class="row mt-65">

                        	<div class="col-md-3 mb-30">
                        		<div class="card pt-50 pb-50 figures-trader">
                        			<div class="logo_area text-center"><a href="{{url('/shop_orders')}}">
                                    @if(count($result) !=0)
                                    <?php $incompl = 0; ?>
                                    @foreach($result as $data)
                                    @if($data['status'] != 4 && $data['status'] != 2)
                                    <?php $incompl = $incompl+1; ?>
                                    @endif
                                    @endforeach
                                    <?php echo $incompl; ?>
                                    @else
                                    <?php echo '0'; ?>
                                    @endif          
                                    </a></div>
                        			<div class="logo_area text-center mt-4"><a href="{{url('/shop_orders')}}">Pending </br>Orders</a></div>
                        		</div>
                        	</div>

                        	<div class="col-md-3 mb-30">
                        		<div class="card pt-50 pb-50 figures-trader">
                        			<div class="logo_area text-center"><a href="{{url('/shop_orders')}}">
                                    @if(count($result) !=0)
                                    <?php $compl = 0; ?>
                                    @foreach($result as $data)
                                    @if($data['status'] == 4)
                                    <?php $compl = $compl+1; ?>
                                    @endif
                                    @endforeach
                                    <?php echo $compl; ?>
                                    @else
                                    <?php echo '0'; ?>
                                    @endif         
                                    </as></div>
                        			<div class="logo_area text-center mt-4"><a href="{{url('/shop_orders')}}">Completed </br>Orders</a></div>
                        		</div>
                        	</div>

                        	<div class="col-md-3 mb-30">
                        		<div class="card pt-50 pb-50 figures-trader">
                        			<div class="logo_area text-center"><a href="{{url('/out_of_stock_products')}}">
                                    <?php $count_out_of_stock = 0; ?>
                                    @foreach($categories as $cat)
                                    @foreach($cat->products as $data)
                                    @if($data->status == 1 && $data->is_deleted == 0)
                                    @if($data->stock < $data->minimum_quantity)
                                    <?php $count_out_of_stock++; ?>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                    <?php echo $count_out_of_stock; ?>
                                    </a></div>
                        			<div class="logo_area text-center mt-4"><a href="{{url('/out_of_stock_products')}}">Out Of Stock </br>Products</a></div>
                        		</div>
                        	</div>

                        	<div class="col-md-3 mb-30">
                        		<div class="card pt-50 pb-50 figures-trader">
                        			<div class="logo_area text-center"><a  href="{{url('/shop_products')}}">
                                    <?php $count_products = 0; ?>
                                    @foreach($categories as $cat)
                                    @foreach($cat->products as $data)
                                    @if($data->status == 1 && $data->is_deleted == 0)
                                    <?php $count_products++; ?>
                                    @endif
                                    @endforeach
                                    @endforeach
                                    <?php echo $count_products; ?>
                                    </a></div>
                        			<div class="logo_area text-center mt-4"><a href="{{url('/shop_products')}}">Total </br>Products</a></div>
                        		</div>
                        	</div>

                            <div class="col-md-6 mt-1">
                                <div class="card pt-50 pb-50 figures-trader">
                                    <div class="logo_area text-center"><a href="{{url('/shop_categories')}}">{{count(Auth::guard('shop')->user()->category)}}</a></div>
                                    <div class="logo_area text-center mt-4"><a href="{{url('/shop_categories')}}">Total Categories</a></div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-1">
                                <div class="card pt-50 pb-50 figures-trader">
                                    <div class="logo_area text-center"><a href="{{url('/create_new_product')}}">{{Auth::guard('shop')->user()->no_of_product}}</a></div>
                                    <div class="logo_area text-center mt-4"><a href="{{url('/create_new_product')}}">Products Allowed to Sell</a></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-4 mb-4">
                                <div class="card pt-50 pb-50 figures-trader">
                                    <div class="logo_area text-center"><h2></h2></div>
                                    <div class="logo_area text-center mt-4"><a href="{{url('/create_new_product')}}">You can Still Post <?php echo (Auth::guard('shop')->user()->no_of_product-$count_products); ?> products</a></div>
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

@push('scripts')
<script>
    $(function() {
        $("#Dashboard").addClass("active");
    });
</script>
@endpush
@endsection