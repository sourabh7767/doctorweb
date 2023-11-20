$(window).on('load', function () {
	$('#loader').fadeOut(800);
});

$(document).ready(function(){
	$(".secondryOutline").click(function(){
	  $(this).addClass("active");
	});
  });
  $(document).ready(function(){
	$(".cardArea").click(function(){
	  $(this).addClass("active");
	});
  });
$('modal').modal({
    backdrop: 'static',
    keyboard: false  // to prevent closing with Esc button (if you want this too)
})