@extends('layouts.master')
@section('content')

<!-- main_area -->
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
                        <form action="{{url('/customer_edit_profile')}}" method="post" enctype="multipart/form-data">
                        	@csrf
	                        <div class="right_content_head">
	                            <div class="stor_title_area d-flex justify-content-between mb-25 align-items-center">
	                                <h1>My Account</h1>
	                                <div class="title_area_btns d-flex" id="update_profile" style="display: none !important;">
	                                    <button type="submit" class="btn edit_btn">Save</button>
	                                    <button class="btn edit_btn cancel_btn" onclick="cancel_edit_profile()">Cancel</button>
	                                </div>
	                                <button class="btn edit_btn" onclick="edit_profile()" id="edit_btn" style=""><span><img src="{{asset('public/assets/client/img/icons/Edit.svg')}}" alt=""></span>Edit</button>
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

                                    <div class="add_product_thumb_img d-flex justify-content-between">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="img" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('{{asset('public/customer_images/'.Auth::guard('customer')->user()->image)}}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

	                                <div class="form_wrap d-flex justify-content-between flex-wrap">

	                                    <div class="single_myaccount_form position-relative">
	                                        <input type="text" value="{{Auth::guard('customer')->user()->first_name}}" required name="first_name">
	                                        <label for="">First Name</label>
	                                    </div>

	                                    <div class="single_myaccount_form position-relative">
	                                        <input type="text" value="{{Auth::guard('customer')->user()->last_name}}" required name="last_name">
	                                        <label for="">Last Name</label>
	                                    </div>

	                                    <div class="single_myaccount_form position-relative">
	                                        <input type="text" value="{{Auth::guard('customer')->user()->email}}" required name="email">
	                                        <label for="">Email</label>
	                                    </div>

	                                    <div class="single_myaccount_form position-relative">
	                                        <input type="text" value="{{Auth::guard('customer')->user()->number}}" required name="number">
	                                        <label for="">Phone No.</label>
	                                    </div>
</form>
	                                </div>
	                                <div class="accordion-item">
                                <h2 class="accordion-header" id="change_password_heading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#change_password_collapse" aria-expanded="false" aria-controls="change_password_collapse">Change Password</button>
                                </h2>
                                <div id="change_password_collapse" class="accordion-collapse collapse p-4" aria-labelledby="change_password_heading" data-bs-parent="#accordionFlushExample">

                                    <div class="popup_form_area position-relative">
                                        <form action="{{url('/customer_change_password')}}" method="post">
                                            @csrf
                                            <div class="single_input position-relative">
                                                <input type="password" required name="old_password">
                                                <label for="">Old Password</label>
                                            </div>

                                            <div class="single_input position-relative">
                                                <input type="password" required name="new_password">
                                                <label for="">New Password</label>
                                            </div>

                                            <div class="single_input position-relative">
                                                <input type="password" required name="confirm_password">
                                                <label for="">Confirm Password</label>
                                            </div>


                                            <div class="popup_btn">
                                                <button type="submit">Change Password</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
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
	function edit_profile()
	{
		$("#edit_btn").attr("style", "display:none !important")
		$("#update_profile").attr("style", "display:block")
	}

	function cancel_edit_profile()
	{
		$("#update_profile").attr("style", "display:none !important")
		$("#edit_btn").attr("style", "display:block")
	}
</script>

<script>
    $("#MyAccount").addClass("active");

    $("#imageUpload").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.onload = function() {
    //Check File API support
        if (window.File && window.FileList && window.FileReader) {
            var filesInput = document.getElementById("files");
            filesInput.addEventListener("change", function(event) {
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                //Only pics
                if (!file.type.match('image'))
                continue;
                var picReader = new FileReader();
                picReader.addEventListener("load", function(event) {
                var picFile = event.target;
                var div = document.createElement("div");
                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    "title='" + picFile.name + "'/>";
                output.insertBefore(div, null);
                });
                //Read the image
                picReader.readAsDataURL(file);
            }
            });
        } 
        else {
            console.log("Your browser does not support File API");
        }
    }
</script>
@endpush