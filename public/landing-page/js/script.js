
$(document).ready(function(){
    $('.nav-link').on('click', function(){
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
    });
});

$(document).ready(function() {
    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();

        $('section').each(function() {
            var currLink = $('a[href="#' + $(this).attr('id') + '"]');
            var sectionTop = $(this).offset().top - 60; // Header height ka adjustment
            var sectionBottom = sectionTop + $(this).outerHeight();

            if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                $('header ul li').removeClass('active');
                $('header ul li a').removeClass('active');
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
//  $(document).ready(function() {
//     $('.navbar-nav li').click(function() {
//        $('li').removeClass("active");
//        $(this).addClass("active");
//     });
//  });
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
$(window).scroll( function(){

$('.chart').each( function(i){
    var bottom_of_object = $(this).offset().top + $(this).outerHeight();
    var bottom_of_window = $(window).scrollTop() + $(window).height();
    if( bottom_of_window > bottom_of_object ){
        $('.chart').easyPieChart({
        scaleColor:false,
        trackColor:'#ebedee',
        barColor: function(percent) {
            var ctx = this.renderer.getCtx();
            var canvas = this.renderer.getCanvas();
            var gradient = ctx.createLinearGradient(0,0,canvas.width,0);
                gradient.addColorStop(0, "#6442c7");
                gradient.addColorStop(1, "#bea7ff");
            return gradient;
        },
        lineWidth:6,
        lineCap: false,
        rotate:180,
        size:180,
        animate:1000
        });
    }
}); 
});


$('.js-play').magnificPopup({
type: 'iframe',
removalDelay: 300,
mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
zoom: {
    enabled: true,
    duration: 300 // don't foget to change the duration also in CSS
}
});
