$(document).ready(function () {


    // Scroll Events
    $(window).scroll(function () {

        var wScroll = $(this).scrollTop();

        // Activate menu
        // if (wScroll > 20) {
        // 	$('#main-nav').addClass('active');
        // 	$('#slide_out_menu').addClass('scrolled');
        // }
        // else {
        // 	$('#main-nav').removeClass('active');
        // 	$('#slide_out_menu').removeClass('scrolled');
        // };


        //Scroll Effects

    });


    // Navigation
    $('#navigation').on('click', function (e) {
        e.preventDefault();
        $(this).addClass('open');
        $('#slide_out_menu').toggleClass('open');

        if ($('#slide_out_menu').hasClass('open')) {
            $('.menu-close').on('click', function (e) {
                e.preventDefault();
                $('#slide_out_menu').removeClass('open');
            })
        }
    });


    // Price Table
    var individual_price_table = $('#price_tables').find('.individual');
    var company_price_table = $('#price_tables').find('.company');


    $('.switch-toggles').find('.individual').addClass('active');
    $('#price_tables').find('.individual').addClass('active');

    $('.switch-toggles').find('.individual').on('click', function () {
        $(this).addClass('active');
        $(this).closest('.switch-toggles').removeClass('active');
        $(this).siblings().removeClass('active');
        individual_price_table.addClass('active');
        company_price_table.removeClass('active');
    });

    $('.switch-toggles').find('.company').on('click', function () {
        $(this).addClass('active');
        $(this).closest('.switch-toggles').addClass('active');
        $(this).siblings().removeClass('active');
        company_price_table.addClass('active');
        individual_price_table.removeClass('active');
    });


    // Wow Animations
    wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
        }
    )
    wow.init();


    // Menu For Xs Mobile Screens
    if ($(window).height() < 450) {
        $('#slide_out_menu').addClass('xs-screen');
    }

    $(window).on('resize', function () {
        if ($(window).height() < 450) {
            $('#slide_out_menu').addClass('xs-screen');
        } else {
            $('#slide_out_menu').removeClass('xs-screen');
        }
    });


    // Magnific Popup
    $(".lightbox").magnificPopup();
    if ($(window).width() <= 800) {
        $('.multiple-items').slick({
            infinite: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: true,
        });
    } else {
        $('.multiple-items').slick({
            infinite: true,
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: true,
        });
    }

    $(window).on('resize', function () {

        /* If we are above mobile breakpoint unslick the slider */
        if ($(window).width() <= 800) {
            $('.multiple-items').slick('unslick');
            $('.multiple-items').slick({
                infinite: true,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true,
                autoplay: true,
            });
        }

    })

    $(document).on('click','#box_1_',function () {
        $('#myfond_gris').fadeIn(300);
        var iddiv = $(this).attr("iddiv");
        $('#' + iddiv).fadeIn(300);
        $('#myfond_gris').attr('opendiv', iddiv);
        return false;
    });

    $(document).on('click',function (target) {
        $(target).find('')
        var iddiv = $("#myfond_gris").attr('opendiv');
        $('#myfond_gris').fadeOut(300);
        $('#' + iddiv).fadeOut(300);
    });
    $('.inline').modaal({
        content_source: '#inline'
    });
    $('.inline_signup').modaal({
        content_source: '#inline_signup'
    });
    $(document).on('click','a[data-target="#member_dialog"]',function () {
        $('#modaal-close').trigger('click');
    });
    $(document).on('click','button[data-target="#largesizemodal"]',function () {
        $('#modaal-close').trigger('click');
    });

});
