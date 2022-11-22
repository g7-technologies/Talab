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

        <link rel="stylesheet" href="{{ asset('public/assets/client/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/fontawesome.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/slick.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/default.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/responsive.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/progress-bar.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/jquery.nice-number.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/assets/client/css/input.css')}}">
        @stack('css')
    </head>

    <body style="top:0px !important;">

        <div class="overlay"></div>
        @include('includes.client_topbar')

        @yield('content')

        @include('includes.footer')

        <script src="{{ asset('public/assets/client/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/slick.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/jquery.sticky.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/main.js')}}"></script>

        <!-- <script src="{{asset('public/assets/trader/js/jquery.nice-select.min.js')}}"></script> -->
        
        <script src="{{ asset('public/assets/client/js/jquery.nice-number.min.js')}}"></script>
        <script src="{{ asset('public/assets/client/js/progress-bar.js')}}"></script>


        <script>
            $("header").sticky({topSpacing:0});
            $('input[type="number"]').niceNumber();
            $(".progress-bar").ProgressBar();
            // $('select').niceSelect();

            $(window).bind("resize", function () {
                //get window width
                    var widths = $(this).width();
                    if(widths <= 1050) {
                        $('.row').removeClass('g-5');
                    }
            }).trigger('resize');
            $(document).ready(function () {
                cartload();
            });
            function cartload()
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{url("/load_cart_data")}}',
                    method: "GET",
                    success: function (response) {                        
                        
                        var total = 0;

                        if(response.totalcart > 0)
                        {
                            $('#cart_number').html('');
                            $('#cart_number').append($('<span class="cart_items_header">'+response.totalcart+'</span>'));
                        }

                        $('#cart_items').html('');

                        for(var i=0;i<response.cart_items.length;i++)
                        {
                            if(response.cart_items[i].item_discount_percentage == 0)
                            {
                                var talab_profit = response.cart_items[i].item_price*(response.cart_items[i].item_profit/100);
                                var item_price_with_profit = parseFloat(response.cart_items[i].item_price) + parseFloat(talab_profit);
                                var item_total_quantity = response.cart_items[i].item_quantity;
                                
                                total = parseFloat(total) + (parseFloat(item_price_with_profit) * parseFloat(item_total_quantity));
                            }
                            else
                            {
                                var disc_price = response.cart_items[i].item_price*((100-response.cart_items[i].item_discount_percentage)/100);
                                var talab_profit = response.cart_items[i].item_price*((response.cart_items[i].item_profit)/100);
                                var item_total_quantity = response.cart_items[i].item_quantity;
                                
                                total = parseFloat(total) + (parseFloat(item_total_quantity) * (parseFloat(disc_price)+parseFloat(talab_profit)));
                            }

                            var asset = "{{asset('public/product_images/')}}"+'/'+response.cart_items[i].item_image;
                            var link = "{{url('/product_details/')}}"+'/'+response.cart_items[i].item_id;
                            
                            $('#cart_items').append($('<div class="single_cart_item d-flex"><div class="cart_thumb"><img src="'+asset+'" alt="product_img"></div><div class="cart_item_content"><a href="'+link+'">'+response.cart_items[i].item_name+'</a><p>'+response.cart_items[i].item_desc+'</p><span>QTY:'+response.cart_items[i].item_quantity+'</span></div></div>'));   
                        }

                        $('#cart_total').html('');
                        $('#cart_total').append($('<h4>Total: SAR '+total+'</h4>'));
                    }
                });
            }
        </script>
        
        @stack('scripts')
        
    </body>
</html>