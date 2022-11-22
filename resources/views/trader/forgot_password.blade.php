@extends('layouts.master')
@section('content')

<!-- main_area -->
<main>
    <!-- privacy policy -->
    <div class="privacy_wrapper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <a href="{{ url('/login_as_seller') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;margin-right:20px;"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy_inner_wrapper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="faq_content_wrapper">
									 <div class="popup_header text-center">
					                    <h3>Forgot Password</h3>
					                </div>
					                <div class="popup_form_area position-relative">
					                	@if(session('error_msg'))
			                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
			                            @endif
			                            @if(session('success_msg'))
			                             <p class="alert alert-success">{{session('success_msg')}}</p> 
			                            @endif
					                    <form action="{{url('/submit_trader_forgot_password')}}" method="post">
					                        @csrf
					                        <div class="single_input position-relative">
					                            <input type="email" required name="email" value="{{ old('email') }}">
					                            <label for="">Email</label>
					                        </div>

					                        <div class="popup_btn">
					                            <button type="submit">Reset</button>
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