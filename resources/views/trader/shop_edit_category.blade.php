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
                                <h1>Update Category</h1>

                            </div>
                        </div>
                        <!-- content_head -->

                        <!-- my_account_content_wrapper -->
                        <div class="my_account_content_wrap my_account_page_content mt-55">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
                            <div class="form_shipping_wrapper">
                                <div class="form_wrap d-flex justify-content-between flex-wrap">

                                    <form  method='post' action="{{url('/shop_update_category')}}">
                                    @csrf
                                        <input type="hidden" name="category_id" value="{{$category->id}}">
                                        <div class="single_myaccount_form my_account_category position-relative">
                                            <input type="name" required name="name" value="{{$category->name}}">
                                            <label for="">Name</label>
                                        </div>

                                        <div class="add_btn_area_trader text-end">
                                            <button class="btn add_product_bnt" type="submit">Update Category</button>
                                        </div>

                                    </form>

                                </div>
                            </div>


                        </div>
                        <!-- my_account_content_wrapper -->

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