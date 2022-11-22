@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/assets/trader/css/nice-select.css')}}">
@endpush
@section('content')

<main>
    <!-- privacy policy -->
    <div class="privacy_wrapper pt-60 pb-60">
        <div class="container">
            <div class="row">
                <a href="{{ url('/') }}" style="text-decoration: none !important;"><i class="fa fa-arrow-left" style="color:#222831 !important;"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy_inner_wrapper">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="faq_content_wrapper">

									 <div class="popup_header text-center">
					                    <h3>Complains And Suggestions</h3>
					                    <p>We'd love to hear from you. Your valueable comments means alot to us.</p>
					                </div>
					                <div class="popup_form_area position-relative">
					                	@if(session('error_msg'))
	                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
	                                    @endif
	                                    @if(session('success_msg'))
	                                     <p class="alert alert-success">{{session('success_msg')}}</p> 
	                                    @endif
					                    <form action="{{url('/send_mail')}}" method="post">
					                        @csrf
					                        
					                        <div class="single_input position-relative">
					                            <input type="name" required name="name">
					                            <label for="">Name</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="email" required name="email">
					                            <label for="">Email</label>
					                        </div>
					                        <div class="single_input position-relative">
					                            <input type="text" required name="title">
					                            <label for="">Title</label>
					                        </div>
					                        <div class="single_myaccount_textarea position-relative">
					                            <textarea required name="message" style="width:100% !important;margin-bottom:-3%"></textarea>
					                            <label for="">Message</label>
					                        </div>
					                        
					                        <div class="single_myaccount_form  my_account  select_option_input position-relative" style="width: 100% !important; margin-bottom:15%;">
	                                            <select name="msg_type" required>
	                                                <option value="Suggestion">Suggestion</option>
	                                                <option value="Complain">Complain</option>
	                                              </select>
	                                            <label for="">Message Type</label>
	                                        </div>

					                        <div class="popup_btn mt-4" style="margin-top:40px !important;">
					                            <button type="submit">Send</button>
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
@endpush