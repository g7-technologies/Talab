@extends('layouts.master')
@section('content')

<!-- main_area -->
<main>
    <!-- my_account_page -->
    <div class="my_account_wrapper pt-60">
        <div class="container">
            <div class="row g-5">

                @include('includes.client_sidebar')

                <div class="col-lg-9 col-md-8">
                    <div class="right_content_main_wrapper">
                        <!-- content_head -->
                        <div class="right_content_head">
                            <div class="stor_title_area d-flex justify-content-between mb-25">
                                <h1>Settings</h1>
                            </div>
                        </div>
                        <!-- content_head -->
                        <div class="row mt-65">
                            @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                            @endif
                            @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                            @endif
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
        $("#Settings").addClass("active");
    });
</script>
@endpush