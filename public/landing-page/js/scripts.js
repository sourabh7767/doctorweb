$(window).on('load', function () {
	$('#loader').fadeOut(800);
});
// $(document).ready(function(){
// 	$(".secondryOutline").click(function(){
// 	  $(this).addClass("active");
// 	});
//   });
$(document).ready(function(){
	$(".cardBody").click(function(){
	  $(this).closest('.cardArea').toggleClass('active');
	});
  });
$('modal').modal({
    backdrop: 'static',
    keyboard: false  // to prevent closing with Esc button (if you want this too)
});
$(document).ready(function() {
	$('.btnText').on('click', function() {
	  // Toggle the 'active' class on the parent button
	  $(this).closest('.secondryOutline').toggleClass('active');
	});

	$('.crossValue').on('click', function() {
	  // Add your delete logic here
	  alert("Are you sure you want to remove?");
	});
  });
  $(document).ready(function() {
	$('.cardItemValue span').on('click', function() {
		(this).toggleClass('active')
	});
  });

  $(document).ready(function() {
    // Get the values of the tags input
    var tagValues = $("#tagsInput").tagsinput('items');
    
    // Output the values to the console (you can replace this with your desired action)
    console.log("Tag values:", tagValues);
  });
  function previewImage(input) {
    var preview = document.getElementById('preview');
    var file = input.files[0];

    if (file) {
      preview.src = URL.createObjectURL(file);
    } else {
      preview.src = "";
    }
  }