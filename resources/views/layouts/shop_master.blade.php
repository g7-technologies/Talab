<!DOCTYPE html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Talab</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="manifest" href="site.webmanifest"> -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/talab_new_logo.png') }}">

        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/fontawesome.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/slick.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/default.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/responsive.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/progress-bar.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/jquery.nice-number.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/trader/css/input.css')}}">

        @stack('css')


    </head>

    <body>

        <div class="overlay"></div>
        @include('includes.shop_topbar')

        @yield('content')

        @include('includes.footer')

        <script src="{{ asset('public/assets/trader/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/slick.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/jquery.sticky.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/main.js')}}"></script>

        <script src="{{asset('public/assets/trader/js/jquery.nice-select.min.js')}}"></script>

        <script src="{{ asset('public/assets/trader/js/jquery.nice-number.min.js')}}"></script>
        <script src="{{ asset('public/assets/trader/js/progress-bar.js')}}"></script>


        <script>
            $("header").sticky({topSpacing:0});
            $(".progress-bar").ProgressBar();

            $('select').niceSelect();

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
                if (window.File && window.FileList && window.FileReader) {
                    var filesInput = document.getElementById("files");
                    filesInput.addEventListener("change", function(event) {
                    var files = event.target.files;
                    var output = document.getElementById("result");
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
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
                        picReader.readAsDataURL(file);
                    }
                    });
                } 
                else {
                    console.log("Your browser does not support File API");
                }
            }
        </script>
        
        @stack('scripts')
        
    </body>
</html>