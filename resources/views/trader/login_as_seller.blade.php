@extends('layouts.master')
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
                                    <!-- <div class="faq_title text-center mb-30" dir="rtl">
                                        <h3>Login As Seller</h3>
                                    </div>
 									-->
									 <div class="popup_header text-center">
					                    <img src="{{asset('public/assets/images/logo-sm.png')}}" height="30px"/>
					                    <p class="mt-2">Hey there! Welcome back.</p>
					                </div>
					                <div class="popup_form_area position-relative">
					                	@if(session('error_msg'))
	                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
	                                    @endif
					                    <form action="{{url('/login_trader')}}" method="post">
					                        @csrf
					                        <div class="single_input position-relative">
					                            <input type="email" required name="email" value="{{ old('email') }}">
					                            <label for="">Email</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="password" required name="password" value="{{ old('password') }}">
					                            <label for="">Password</label>
					                        </div>

					                        <div class="popup_btn">
					                            <button type="submit">Login</button>
					                        </div>
					                        <div class="forget_pass_area text-center">
					                            <a href="{{url('/trader_forgot_password')}}">Forgot Password?</a></br>
					                            <a href="{{url('/signup_seller')}}">Don't have an account? Click here to sign up</a>
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