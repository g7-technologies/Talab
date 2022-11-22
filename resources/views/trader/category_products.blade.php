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
                            <div class="stor_title_area d-flex justify-content-between mb-25 align-items-center">
                                <h1>Products Under {{$category->name}} </h1>
                                <a class="btn add_product_bnt" href="{{url('/create_new_product')}}">Add Product</a>

                            </div>
                        </div>
                        <!-- content_head -->

                        <div class="my_prodcuts_content_wrapper_desh">

                            <div class="single_store_products_grid">

                                @foreach($category->products as $data)
                                <div class="single_store_product position-relative">
                                    <a href="{{url('/edit_product/'.$data->id)}}" class="edit_single_product"><img src="{{asset('public/assets/trader/img/icons/theme_edit.svg')}}" alt=""></a>

                                    @if($data->status == 0 && $data->is_deleted == 0)
                                    <a href="{{url('/activate_product/'.$data->id)}}" class="edit_single_product mt-4 ml-4"><img src="{{asset('public/assets/trader/img/icons/check_squire.svg')}}" alt="activate_product"></a>
                                    @elseif($data->status == 1 && $data->is_deleted == 0)
                                    <a href="{{url('/delete_product/'.$data->id)}}" class="edit_single_product mt-4 ml-4"><img src="{{asset('public/assets/trader/img/delete.png')}}" alt="delete_product"></a>
                                    @endif

                                    <div class="product_thuumb">
                                        <img src="{{asset('/public/product_images/'.$data->image)}}" alt="">
                                    </div>
                                    <div class="products_info">
                                        <a href="">{{$data->name}}</a>
                                        <p>{{$data->description}}</p>

                                        @if($data->stock == 0)
                                        <span class="stock_products_red">
                                            {{$data->stock}} Items in Stock
                                        </span>
                                        @elseif($data->stock > 0 && $data->stock < $data->minimum_quantity)
                                        <span class="stock_products">
                                            {{$data->stock}} Items in Stock
                                        </span>
                                        @else
                                        <span class="stock_products_green">
                                            {{$data->stock}} Items in Stock
                                        </span>
                                        @endif
                                        @if($data->discount_percentage != 0.00)
                                        <h5 class="">SAR {{($data->price*$data->discount_percentage)/100}}</h5>
                                        <span class="mb-2"><del>SAR {{$data->price}}</del></span></br>
                                        @else
                                        <h5 class="mb-2">SAR {{$data->price}}</h5>
                                        @endif
                                        @if($data->status == 0 && $data->is_deleted == 1)
                                        <span class="alert-danger p-1">Deleted By Admin</span>
                                        @elseif($data->status == 0 && $data->is_deleted == 0)
                                        <span class="alert-warning p-1">Deactivated</span>
                                        @elseif($data->status == 1 && $data->is_deleted == 0)
                                        <span class="alert-success p-1">Active</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach

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


@endsection
@push('scripts')
<script>
    $(function() {
        $("#MyCategories").addClass("active");
    });
</script>
@endpush