$(document).ready(function() {
    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();

        $('section').each(function() {
            var currLink = $('a[href="#' + $(this).attr('id') + '"]');
            var sectionTop = $(this).offset().top - 60; // Header height ka adjustment
            var sectionBottom = sectionTop + $(this).outerHeight();

            if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                $('header ul li').removeClass('active');
                currLink.parent().addClass('active');
            }
        });
    });
});
// Sticky Navbar
$(window).scroll(function() {
    var sticky = $('.sticky'),
       scroll = $(window).scrollTop();
    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
 });
 /*---Pass-active class on Menus-js---*/
 $(document).ready(function() {
    $('.navbar-nav li').click(function() {
       $('li').removeClass("active");
       $(this).addClass("active");
    });
 });
$('.brandOwl-carousel-js').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            center:true
        },
        600:{
            items:3,
            center:true
        },
        1000:{
            items:5,
        }
    }
})
$('.client-carousel-js').owlCarousel({
    loop:true,
    nav: false,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:1,
        },
        1000:{
            items:1,
        }
    }
})
$('.planCard').on('click', function() {
    $('.planCard').removeClass('active');
    $(this).addClass('active')
  });
AOS.init();