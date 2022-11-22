(function ($) {
"use strict";
$(window).bind("resize", function () {
    //get window width
        var widths = $(this).width();
        if(widths <= 1225) {
            $('.row').removeClass('g-5');
        }
}).trigger('resize');

// Script for OffCanvas Menu Activation
$('.bar').on('click', function () {
	$('.offcanvas-wrapper').addClass('active');
})

$('.cross').on('click', function () {
	$('.offcanvas-wrapper, .offcanvas-overlay').removeClass('active');
})



// user_login
$('.user_icon').click(function(event) {
    $('.user_login_btn_area, .overlay, .user_area').addClass('active');
});

$('.overlay').click(function(event) {
    $('.user_login_btn_area, .overlay, .user_login_btn_area, .user_area').removeClass('active');
});

// add_cart_js
$('.cart_item_btn').click(function(event) {
    $('.add_cart_items, .overlay').addClass('active');
});
$('.overlay').click(function(event) {
    $('.add_cart_items, .overlay').removeClass('active');
});




$(".folter_head").click(function(event) {
    $(".folter_head, .filter_collaps").toggleClass('active');
});



// owlCarousel
$('.banner_slider_active').owlCarousel({
    loop:true,
    margin:0,
	items:1,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    nav:true,
	dots:false
});

// product_store
$('.product_stor_slide_active').owlCarousel({
    loop:true,
    margin:0,
	items:5,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:2
        },
        480:{
            items:3
        },
        767:{
            items:3
        },
        992:{
            items:4
        },
        1200:{
            items:5
        }
    }
});
// owlCarousel
$('.category_list_active').owlCarousel({
    loop:true,
    margin:0,
	items:1,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    nav:false,
	dots:false,
    autoWidth:true
});


// owlCarousel
$('.related_product_active').owlCarousel({
    loop:true,
    margin:0,
	items:5,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:1
        },
        580:{
            items:2
        },
        767:{
            items:3
        },
        992:{
            items:3
        },
        1200:{
            items:4
        },
        1500:{
            items:5
        }
    }
});


// owlCarousel
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
	items:1,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:1
        },
        767:{
            items:3
        },
        992:{
            items:5
        }
    }
});




$('.slider_big_tthumb').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    prevArrow: '<button type="button" class="slick-prev">prev</button>',
    nextArrow: '<button type="button" class="slick-next">next</button>',
    fade: true,
    asNavFor: '.product_slider_nav',
    responsive: [{
        breakpoint: 1200,
        settings: {
        }
    },
    {
        breakpoint: 992,
        settings: {
        }
    },
    {
        breakpoint: 767,
        settings: {
            arrows: false,
            fade: false,
            dots: true
        }
        
    }
    
]
});

  $('.product_slider_nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider_big_tthumb',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: false,
    vertical: true,
    prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-angle-up"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="fal fa-angle-down"></i></button>',
    centerPadding: '0px',
    responsive: [{
        breakpoint: 1200,
        settings: {
            slidesToShow: 4,
        }
    },
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 4,
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 4,
            vertical: false
        }
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 3,
            vertical: false,
            dots:false
        }
    }
]
});





















})(jQuery);