@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/assets/trader/css/nice-select.css')}}">
@endpush
@section('content')

<!-- main_area -->
<main>
    <!-- privacy policy -->
    <div class="privacy_wrapper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy_inner_wrapper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="faq_content_wrapper">
									 <div class="popup_header text-center">
					                    <img src="{{asset('public/assets/images/logo-sm.png')}}" height="30px"/>
					                    <p class="mt-2">Hey there! Welcome.</p>
					                </div>
					                <div class="popup_form_area position-relative">
					                	@if(session('error_msg'))
	                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
	                                    @endif
	                                    @if(session('success_msg'))
	                                     <p class="alert alert-success">{{session('success_msg')}}</p> 
	                                    @endif
					                    <form action="{{url('/register_trader')}}" method="post" enctype="multipart/form-data">
					                        @csrf
		    	                            <div class="add_product_thumb_img d-flex justify-content-between">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="imageUpload" name="img" />
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="imagePreview" style="background-image: url('{{asset('public/assets/trader/img/up_images.svg')}}');">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

					                        <div class="single_input position-relative">
					                            <input type="name" required name="name" value="{{ old('name') }}" placeholder="                                           Enter Shop Name">
					                            <label for="">Shop Name</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="text" required name="registration_no" value="{{ old('registration_no') }}"placeholder="                                           Enter Registartion Number">
					                            <label for="">Registration No</label>
					                        </div>
					                        <div class="single_myaccount_form  my_account  select_option_input position-relative" style="width: 100% !important; margin-bottom:14%;margin-top:-2%;">
	                                            <select name="shop_type" required>
	                                                <option value="">Select Shop Type</option>
	                                                <option value="1">Albalad</option>
	                                                <option value="0">Other</option>
	                                              </select>
	                                            <label for="">Shop Type</label>
	                                        </div>
					                        <div class="single_input position-relative">
					                            <input type="name" required name="trader_name" value="{{ old('trader_name') }}"placeholder="                                           Enter Trader Name">
					                            <label for="">Trader Name</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="email" required name="email" value="{{ old('email') }}"placeholder="                                           Enter Email">
					                            <label for="">Email</label>
					                        </div>
			                                            <span class="text-muted mb-2">* Password must be 6 Digits Alphanumeric</span>
					                        <div class="single_input position-relative">
					                            <input type="password" required name="password" value="{{ old('password') }}"placeholder="                                           Enter Password">
					                            <label for="">Password</label>
					                        </div>

					                        <div class="single_input position-relative">
					                            <input type="tel" required name="number"placeholder="                                           05xxxxxxxx"  value="{{ old('number') }}">
					                            <label for="">Number</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="text" required name="city" value="{{ old('city') }}"placeholder="                                           Enter City Name">
					                            <label for="">City</label>
					                        </div>
					                        <div class="single_myaccount_form  my_account  select_option_input position-relative" style="width: 100% !important; margin-bottom:14%;margin-top:-2%;">
	                                            <select name="no_of_product" required>
	                                                <option value="">No of Products to Display</option>
	                                                <option value="100">100</option>
	                                                <option value="200">200</option>
	                                                <option value="300">300</option>
	                                                <option value="500">500</option>
	                                                <option value="1000">1000</option>
	                                              </select>
	                                            <label for="no_of_product">No of Products to Display</label>
	                                        </div>
					                        <div class="single_input position-relative">
					                            <input type="text" required name="iban" value="{{ old('iban') }}"placeholder="                                           Enter IBAN">
					                            <label for="">IBAN</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="text" required name="minimum_cost_to_delivery" value="{{ old('minimum_cost_to_delivery') }}"placeholder="                                           Enter Minimum Cost To Delivery">
					                            <label for="">Minimum Cost To Delivery</label>
					                        </div>
					                        <div class="single_myaccount_form_sm position-relative" style="border:2px solid #222831; border-radius:20px;">
	                                            <label for=""  style="margin: 0px 0px 20px 20px">Always Open (24/7)</label><br>
	                                            <input class="ml-4"  type="checkbox" name="always_open" value="1" checked  style="margin-left:20px;">
	                                        </div>
					
	                                        <div class="single_myaccount_form  my_account  select_option_input position-relative" style="width: 100% !important;">
	                                            <select name="delivery" required>
	                                                <option value="1">Delivery On Talab</option>
	                                                <option value="0">Delivery On Us</option>
	                                              </select>
	                                            <label for="">Delivery</label>
	                                        </div>
					                        <div class="popup_btn">
					                            <button type="submit" style="margin-top:25px;">Sign Up</button>
					                        </div>
					                        <div class="forget_pass_area text-center">
					                            <a href="{{url('/login_as_seller')}}">Already have an account? Login</a>
					                        </div>
					                    </form>
					                    
					                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- privacy policy -->
</main>
<!-- main_area -->

@endsection
@push('scripts')

<script src="{{asset('public/assets/trader/js/jquery.nice-select.min.js')}}"></script>
<script>
    $('select').niceSelect();	
</script>
<script>
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