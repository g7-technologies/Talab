<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Talab | Admin Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Online Shopping Store" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('public/assets/images/talab_new_logo.png') }}">

        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <div class="container">
            <div class="row vh-100 ">
                <div class="col-12 align-self-center">
                    <div class="auth-page">
                        <div class="card auth-card shadow-lg">
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="text-center">
                                        <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset('public/assets/images/logo-sm.png') }}" height="55" alt="logo" class="auth-logo"></a>
                                    </div>
                                    
                                    <div class="text-center auth-logo-text">
                                        <h4 class="mt-0 mb-3 mt-5">Reset Password</h4>
                                        <p class="text-muted mb-0">Enter your Email and instructions will be sent to you!</p>  
                                    </div>
                                    
                                    @if(session('error_msg'))
                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
                                    @endif
                                    @if(session('success_msg'))
                                     <p class="alert alert-success">{{session('success_msg')}}</p> 
                                    @endif
                                    
                                    <form class="form-horizontal auth-form my-4" action="{{url('/submit_admin_forgot_password')}}" method="post">
                                    @csrf
                                        <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-mail"></i> 
                                                </span>                                                                                                              
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                                            </div>                                    
                                        </div>
                                        
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Reset <i class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="m-3 text-center text-muted">
                                    <p class="">Remember It ? <a href="{{ url('/login') }}" class="text-primary ml-2">Sign in here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/app.js') }}"></script>
        
    </body>

</html>