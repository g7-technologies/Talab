<footer>
    <div class="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 border_after col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="{{url('/')}}"><img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/></a>
                            <p class="mt-4">We are a platform that offers various options for your needs at the cheapest price in less than 24 hours delivery.</p>
                            <div id="google_translate_element" style="display:none"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 border_after col-md-6 col-sm-6">
                    <div class="footer_widget footer_menu">
                        <h4>Let's help you.</h4>
                        <ul>
                            <li><a href="{{url('/privacy_policy')}}">Privacy Policy</a></li>
                            <li><a href="{{url('/faqs')}}">FAQ</a></li>
                            <li><a href="{{url('/complains_and_suggestions')}}">Complaints and suggestions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 border_after col-md-6  col-sm-6">
                    <div class="footer_widget footer_menu">
                        <h4>Parents</h4>
                        <ul >
                            <li><a href="{{url('/')}} " class="a">Stores</a></li>
                            <li><a href="{{url('/signup_seller')}}">Join with us</a></li>
                            @if(Auth::guard('shop')->check())
                            <li><a href="{{url('/shop_dashboard')}}">My Account</a></li>
                            @else
                            <li><a href="{{url('/login_as_seller')}}">Login as Seller</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 border_after col-md-6 col-sm-6">
                    <div class="footer_widget footer_address">
                        <div class="footer_add">
                            <ul>
                                <li><a href="tel:+966 57 242 0366"><span><img src="{{asset('public/assets/client/img/footer/mobo.svg')}}" width=21px; alt="number"></span>+966 57 242 0366</a></li>
                                <li><a href="mailto:info@talab-sa.com"><span><img src="{{asset('public/assets/client/img/footer/mail.svg')}}"   width=26px alt="email"></span>info@talab-sa.com</a></li>
                                <li><a href=""><span> <img src="{{asset('public/assets/client/img/footer/world.svg')}}" width=26px alt="address"></span>Saudi Arabia</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_social">
                            <a href="https://instagram.com/talb.sa?igshid=l5ei2rpaim1g" target="blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/talab_sa?s=21" target="blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/talab.sa.7" target="blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://api.whatsapp.com/send?phone=966596415620" style="background:#25D366;" target="blank"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://maroof.sa/182914" target="blank"><img src="{{asset('public/assets/images/maroof.png')}}" width="50px"></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_copy text-center">
        Copyright @ Talab Company
    </div>
</footer>

<!-- popup_login -->
<div class="modal fade custom_popup_one" id="LoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="custom_popup"  style="background-image: url('{{asset('public/assets/client/img/petern.svg')}}');">
                <div class="close" data-bs-dismiss="modal" aria-label="Close">&times;</div>
                <div class="popup_header">
                    <img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/>
                    <p>Hey there! Welcome back.</p>
                </div>
                <div class="popup_form_area position-relative">
                    @if(session('login_error_msg'))
                     <p class="alert alert-danger" id="modalAlertDiv">{{session('login_error_msg')}}</p> 
                    @endif
                    <form action="{{url('/login_customer')}}" method="post">
                        @csrf
                        <div class="single_input position-relative">
                            <input type="email" required name="email" value="{{ old('email') }}">
                            <label for="">Email</label>
                        </div>
                        <div class="single_input position-relative">
                            <input type="password" required name="password" value="{{ old('password') }}">
                            <label for="">Password</label>
                            <!-- <span class="icon_area"><img src="assets/img/icons/eye.svg" alt=""></span> -->
                        </div>

                        <div class="popup_btn">
                            <button type="submit">Login</button>
                        </div>
                        <div class="forget_pass_area text-center">
                            <a data-bs-toggle="modal" data-bs-target="#ForgotModal" href="" data-bs-dismiss="modal">Forgot password?</a>
                        </div>
                    </form>
                    
                </div>
                <div class="abs_content_popup">
                    <a data-bs-toggle="modal" data-bs-target="#SignupModal" href="" data-bs-dismiss="modal">Don't have an account? Click here to sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popup_login end -->


<!-- popup_signup -->
<div class="modal fade custom_popup_two" id="SignupModal" tabindex="-1" aria-labelledby="exampleModalthree" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="custom_popup" style="background-image: url('{{asset('public/assets/client/img/petern.svg')}}');">
                <div class="close" data-bs-dismiss="modal" aria-label="Close">&times;</div>
                <div class="popup_header">
                    <img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/>
                    <!--<p>Forget your password? No problem.</p>-->
                </div>
                <div class="popup_form_area position-relative">
                    @if(session('signup_error_msg'))
                     <p class="alert alert-danger" id="modalAlertDiv">{{session('signup_error_msg')}}</p> 
                    @endif
                    @if(session('signup_success_msg'))
                     <p class="alert alert-success" id="modalAlertDiv">{{session('signup_success_msg')}}</p> 
                    @endif
                    <form action="{{url('/signup_customer')}}" method="post">
                    @csrf
                        <div class="input_form_diver d-flex align-items-center justify-content-between">
                            
                            <div class="single_input single_dive_input position-relative">
                                <input type="name" required name="first_name" value="{{ old('first_name') }}">
                                <label for="">First Name</label>
                            </div>
                            <div class="single_input single_dive_input position-relative">
                                <input type="text" required name="last_name" value="{{ old('last_name') }}">
                                <label for="">Last Name</label>
                            </div>

                        </div>

                        <div class="single_input position-relative">
                            <input type="tel" required name="number" placeholder="              05xxxxxxxx" value="{{ old('number') }}">
                            <label for="">Phone </label>
                        </div>

                        <div class="single_input position-relative">
                            <input type="email" required name="email" value="{{ old('email') }}">
                            <label for="">Email</label>
                        </div>


                        <div class="single_input position-relative">
                            <input type="password" required name="password" id="password" value="{{ old('password') }}">
                            <label for="">Password</label>
                        </div>

                        <div class="single_input position-relative">
                            <input type="password" required name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}">
                            <label for="">Confirm Password</label>
                        </div>
                        
                        <span class="text-muted">* password must be 6 Digits Alphanumeric</span>

                        <div class="popup_btn mt-4">
                            <button type="submit">Signup</button>
                        </div>
                        
                    </form>
                    
                </div>
                <div class="abs_content_popup abs_content_center">
                    <a data-bs-toggle="modal" data-bs-target="#LoginModal" href="" data-bs-dismiss="modal">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popup_signup end -->


<!-- ForgotModal -->
<div class="modal fade custom_popup_two" id="ForgotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="custom_popup" style="background-image: url('{{asset('public/assets/client/img/petern.svg')}}');">
                <div class="close" data-bs-dismiss="modal" aria-label="Close">&times;</div>
                <div class="popup_header">
                    <img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/>
                    <p>Forget your password? No problem.</p>
                </div>
                <div class="popup_form_area position-relative">
                    @if(session('forgot_error_msg'))
                     <p class="alert alert-danger" id="modalAlertDiv">{{session('forgot_error_msg')}}</p> 
                    @endif
                    @if(session('forgot_success_msg'))
                     <p class="alert alert-success" id="modalAlertDiv">{{session('forgot_success_msg')}}</p> 
                    @endif
                    <form action="{{url('/submit_client_forgot_password')}}" method="post">
                        @csrf
                        <div class="single_input position-relative">
                            <input type="email" required name="email" id="email" value="{{ old('email') }}">
                            <label for="">Email</label>
                        </div>
                        

                        <div class="popup_btn">
                            <button type="submit">Recover</button>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- OrderModal -->
<div class="modal fade custom_popup_two" id="OrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="custom_popup" style="background-image: url('{{asset('public/assets/client/img/petern.svg')}}');">
                <div class="close" data-bs-dismiss="modal" aria-label="Close">&times;</div>
                <div class="popup_header">
                    <img src="{{asset('public/assets/images/talab_new_logo.png')}}" height="30px"/>
                </div>
                <div class="popup_form_area position-relative">
                    @if(session('success_msg_order_confirmed'))
                     <p class="alert alert-success">{{session('success_msg_order_confirmed')}}</br>
                    Thank You For Shopping</p> 
                    @endif
                    <div class="popup_btn">
                        <button type="submit" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function() {
        
        var success_msg_order_confirmed = '{{Session::has('success_msg_order_confirmed')}}';
        if(success_msg_order_confirmed){
            $('#OrderModal').modal('show');
        }
        
        var login_exist_error = '{{Session::has('login_error_msg')}}';
        if(login_exist_error){
            $('#LoginModal').modal('show');
        }

        var signup_exist_error = '{{Session::has('signup_error_msg')}}';
        var signup_exist_success = '{{Session::has('signup_success_msg')}}';
        if(signup_exist_error || signup_exist_success){
            $('#SignupModal').modal('show');
        }

        var forgot_exist_error = '{{Session::has('forgot_error_msg')}}';
        var forgot_exist_success = '{{Session::has('forgot_success_msg')}}';
        if(forgot_exist_error || forgot_exist_success){
            $('#ForgotModal').modal('show');
        }
        $('#modalAlertDiv').delay(3000).slideUp(1200);
    });
</script>

<!-- <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages : 'ar,en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 -->


<script type="text/javascript">

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: "en"}, 'google_translate_element');
}

function changeLanguageByButtonClickArabic() {
  var language = 'ar';
  var selectField = document.querySelector("#google_translate_element select");
  for(var i=0; i < selectField.children.length; i++){
    var option = selectField.children[i];
    if(option.value==language){
       selectField.selectedIndex = i;
       selectField.dispatchEvent(new Event('change'));
       break;
    }
  }
}
function changeLanguageByButtonClickEnglish() {
  var language = 'en';
  var selectField = document.querySelector("#google_translate_element select");
  for(var i=0; i < selectField.children.length; i++){
    var option = selectField.children[i];
    if(option.value==language){
       selectField.selectedIndex = i;
       selectField.dispatchEvent(new Event('change'));
       break;
    }
  }
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


@endpush