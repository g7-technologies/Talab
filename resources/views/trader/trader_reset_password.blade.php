@extends('layouts.master')
@section('content')

<!-- main_area -->
<main>
    <!-- privacy policy -->
    <div class="privacy_wrapper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy_inner_wrapper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="faq_content_wrapper">
									 <div class="popup_header text-center">
					                    <h3>Reset Password</h3>
					                </div>
					                <div class="popup_form_area position-relative">
					                    <form action="{{url('/submit_trader_reset_password')}}" method="post">
					                        @csrf
					                        <input type="hidden" name="token" value="{{$token}}">
					                        <div class="single_input position-relative">
					                            <input type="password" required name="password">
					                            <label for="">Password</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="password" required name="confirm_password">
					                            <label for="">Confirm Password</label>
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