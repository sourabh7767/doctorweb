$(document).ready(function () {
    $("#submitPrescription").click(function () {
        var formData = $("#addPrescriptionForm").serialize();
        $.ajax({
            type: "POST",  
            url: "/user/add/prescription",  
            data: formData,
            success: function (response) {
                swal({
                    icon:"success",
                    text: "Prescription added successfully!",
                    timer: 1500, 
                    buttons:false,
                  }).then(function() {
                    window.location.href = '/user/home';
                  });
            },
            error: function (xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                
                if (response.errors) {  
                    var className = "prescription";
                        $.each(response.errors, function (key, value) {
                            console.log('#' + key + '-error')
                            console.log('.error-message[data-form="' + className + '"]',"=====================>");
                            $('.message[data-form="' + className + '"]').html('');
                           $('#' + className + '-' + key + '-error').html('<span style="color:red;font-weight:20px;">' + value[0] + '</span>');
                        });
                    }else{
                        swal({
                            icon:"error",
                            text: "Something went Wrong!",
                            timer: 1500, 
                            buttons:false,
                          }).then(function() {
                            window.location.href = '/user/home';
                          });
                    }
            }
        });
        });
});


// start center card functionality

$(document).ready(function () {
    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val();
        if (searchTerm.trim() === '') {
            $('#searchResults').html('');
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/user/get/prescription/list',
            data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
                searchTerm: searchTerm,
            },
            success: function (data) {
                $('#searchResults').html(data);
            }
        });
    });
});


$('.crossValue').on('click', function() {
    // Add your delete logic here
  var cardArea = $(this).closest('.cardArea');
  var prescriptionId = cardArea.find('.cardBody').data('id');
      swal({
          icon:"error",
          text: "Are you sure to delete!",
  buttons: {
      cancel: true,
      confirm: true,
  },
  }).then(function(result) {
      // alert(result)
      if (result === true) {
          $.ajax({
              type: 'post',
              url: '/user/get/card/', // Update with your actual route
              data: {
                  '_token': $('meta[name="csrf-token"]').attr('content'),
                  'card_id': prescriptionId
              },
              success: function (data) {
                  // Assuming your server returns a success message
                  swal(data.message, {
                  buttons: false,
                  timer: 1500,
                  });
                  cardArea.remove(); // Remove the card from the DOM
              },
              error: function (error) {
                  console.error('Error deleting prescription:', error);
                  // Handle error if needed
              }
          });
      }
  });
  });
  $('.cardArea').on('click', function() {
      var cardBody = $(this).closest('.cardBody');
      var from_diagn = $('.from_diagn').text();
      var from_objective = $('.from_objective').text();
      var from_recomend = $('.from_recomend').text();
      $('#to_diagn').val(from_diagn);
      $('#to_objective').val(from_objective);
      $('#to_recomend').val(from_recomend);

  });

function copyToClipboard(element) {
    var copyText = $(element).val();
    navigator.clipboard.writeText(copyText)
    swal("Copied", {
        buttons: false,
        timer: 800,
        });
}
$(document).ready(function() {
    $('.secondryBtn').on('click', function() {
        var targetID = $(this).data('target-id');
        copyToClipboard('#' + targetID);
    });
});

// end center card functionality