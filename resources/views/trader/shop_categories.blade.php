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
                                <h1>My Categories</h1>
                                <a class="btn add_product_bnt" href="{{url('/create_new_category')}}">Add Category</a>

                            </div>
                        </div>
                        <!-- content_head -->

                        <div class="my_prodcuts_content_wrapper_desh">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            <div class="single_store_products_grid">

                                @foreach($categories as $data)
                                <div class="single_store_product position-relative">
                                    <a href="{{url('/shop_edit_category/'.$data->id)}}" class="edit_single_product"><img src="{{asset('public/assets/trader/img/icons/theme_edit.svg')}}" alt=""></a>

                                    @if($data->status == 0 && $data->is_deleted == 0)
                                    <a href="{{url('/activate_category/'.$data->id)}}" class="edit_single_product mt-4 ml-3"><img src="{{asset('public/assets/trader/img/icons/check_squire.svg')}}" alt="activate_category"></a>
                                    @else
                                    <a href="{{url('/delete_category/'.$data->id)}}" class="edit_single_product mt-4 ml-3"><img src="{{asset('public/assets/trader/img/delete.png')}}" alt="delete_category"></a>
                                    @endif

                                    <a href="{{url('/category_products/'.$data->id)}}" class="edit_single_product ml-4" style="margin-top:20%;"><img src="{{asset('public/assets/trader/img/icons/info.jpg')}}" alt="" height="25px"></a>

                                    <div class="products_info">
                                        <a href="">{{$data->name}}</a>
                                        <p>{{count($data->products)}} products</p>

                                        @if($data->status == 0 && $data->is_deleted == 1)
                                        <span class="alert-danger p-1">Deleted By Admin</span>
                                        @elseif($data->status == 0 && $data->is_deleted == 0 && $data->verified == 1)
                                        <span class="alert-warning p-1">Deactivated</span>
                                        @elseif($data->status == 1 && $data->is_deleted == 0 && $data->verified == 1)
                                        <span class="alert-success p-1">Active</span>
                                        @elseif($data->status == 1 && $data->is_deleted == 0 && $data->verified == 0)
                                        <span class="alert-warning p-1">Verfication Pending</span>
                                        @elseif($data->status == 0 && $data->is_deleted == 0 && $data->verified == 0)
                                        <span class="alert-warning p-1">Deactivated</span>
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

@push('scripts')
<script>
    $(function() {
        $("#MyCategories").addClass("active");
    });
</script>
@endpush
@endsection