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
                                <h1>Update Product</h1>

                            </div>
                        </div>
                        <!-- content_head -->

                        <!-- my_account_content_wrapper -->
                        <div class="my_account_content_wrap my_account_page_content mt-55">
                            
                            <div class="form_shipping_wrapper">
                                <div class="form_wrap d-flex justify-content-between flex-wrap">

                                    <form  method='post' action="{{url('/shop_update_product')}}" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="add_product_thumb_img d-flex justify-content-between">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="img" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{asset('public/product_images/'.$product->image)}}');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="name" required name="name" value="{{$product->name}}">
                                            <label for="">Name</label>
                                        </div>

                                        <div class="single_myaccount_form my_account select_option_input position-relative">
                                            <select name="category_id" required>
                                                <option data-display="Select Category">Select Category</option>
                                                @foreach($categories as $data)
                                                    @if($product->category_id == $data->id)
                                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                                    @else
                                                    <option value="{{$data->id}}" selected>{{$data->name}}</option>
                                                    @endif
                                                @endforeach
                                              </select>
                                            <label for="">Category</label>
                                        </div>

                                        <div class="single_myaccount_form my_account position-relative mt-100">
                                            <input type="number" min="0.01" max="1000000" step="0.01" required name="price" value="{{$product->price}}">
                                            <label for="">Price</label>
                                        </div>

                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="number" min="0" max="100" step="0.01" name="discount_percentage" value="{{$product->discount_percentage}}">
                                            <label for="">Discount % (optional)</label>
                                        </div>

                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="number" min="1" max="1000000" step="1" required name="stock" value="{{$product->stock}}">
                                            <label for="">Stock Quantity</label>
                                        </div>

                                        <div class="single_myaccount_form my_account position-relative">
                                            <input type="number" min="1" max="1000000" step="1" required name="minimum_quantity" value="{{$product->minimum_quantity}}">
                                            <label for="">Minimum Quantity</label>
                                        </div>

                                        <div class="single_myaccount_textarea my_account position-relative mt-30">
                                            <textarea cols="45" rows="10" required name="description">{{$product->description}}</textarea>
                                            <label for="">Description</label>
                                        </div>
                                        <div class="single_myaccount_textarea my_account position-relative mt-30">
                                            @foreach($product_images as $imges)
                                            <div style="margin-bottom:10px;">
                                                <img src="{{asset('public/product_images/'.$imges->image)}}" width="120px" height="80px" style="border-radius:10px; margin-bottom:0px;"/>
                                                </br><a href="{{url('/delete_image/'.$imges->id)}}" style="background:red; padding:5px;color:white; font-size:10px;border-radius:5px;margin-left:40px;">Delete</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="add_product_thumb_img justify-content-between" style="border:2px solid #222831;border-radius:20px; width:200%; margin-bottom:30px;">
                                            <label style="margin-top:10px;padding-left:20px;">Upload Additional Images for Product</label></br>
                                            <output id='result' />
                                            <label for='files'><img src="{{asset('public/assets/trader/img/up_images.svg')}}" alt=""></label>
                                            <input id='files' type='file' multiple name="multiple_img[]"/>
                                        </div>

                                        <div class="add_btn_area_trader ">
                                            <button class="btn add_product_bnt" type="submit">Update Product</button>
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
        $("#MyProducts").addClass("active");
    });
</script>
@endpush