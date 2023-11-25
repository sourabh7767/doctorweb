var site_url = window.location.protocol + '//' + window.location.host;

$(document).ready(function () {
    $("#submitPrescription").click(function () {
        var formData = $("#addPrescriptionForm").serialize();
        $.ajax({
            type: "POST",  
            url: site_url + "/user/add/prescription",  
            data: formData,
            success: function (response) {
                $('#createTemp').hide()
                Swal.fire({
                    icon: "success",
                    title: "Done",
                    text: "Prescription added successfully!",
                    //footer: '<a href="#">Doctor minisquaretechnologies</a>'
                  }).then(function() {
                    window.location.href = '/user/home';
                  });
            },
            error: function (xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                
                if (response.errors) {  
                    $.each(response.errors, function (field, errors) {
                        if (errors.length > 0) {
                            firstError = errors[0];
                            return false; 
                        }
                    });
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: firstError,
                    });
                    }else{
                        Swal.fire({
                            icon: "question",
                            title: "Oops...",
                            text: "Something went Wrong!",
                            footer: '<a href="#">Why do I have this issue?</a>'
                          }).then(function() {
                            window.location.href = '/user/home';
                          });
                    }
            }
        });
        });


// start center card functionality

    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val();
        if (searchTerm.trim() === '') {
            $('#searchResults').html('');
            return;
        }
        $.ajax({
            type: 'POST',
            url: site_url + '/user/get/prescription/list',
            data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
                searchTerm: searchTerm,
            },
            success: function (data) {
                $('#searchResults').html(data);
            },
            
        });
    });

$(document).on('click', '.crossValue' ,function (e) {
//$('.crossValue').on('click', function() {
    // Add your delete logic here
  var cardArea = $(this).closest('.cardArea');
  var prescriptionId = cardArea.find('.cardBody').data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    url: site_url + '/user/delete/card', // Update with your actual route
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'card_id': prescriptionId
                    },
                    success: function (data) {
                        // Assuming your server returns a success message
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success"
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
  $(document).on('click', '.cardArea' ,function (e) {
    $(".cardArea").removeClass("active");
    $(this).toggleClass('active');
  //$('.cardArea').on('click', function() {
    var cardBody = $(this).find('.cardBody');

    var from_diagn = cardBody.find('.from_diagn').text().trim();
    var from_objective = cardBody.find('.from_objective').text().trim();
    var from_recomend = cardBody.find('.from_recomend').text().trim();
    //   var cardBody = $(this).closest('.cardBody');
    //   var from_diagn = $(this).closest('.from_diagn').text();
    //   var from_objective = $('.from_objective').text();
    //   var from_recomend = $('.from_recomend').text();
      $('#to_diagn').val(from_diagn);
      $('#to_objective').val(from_objective);
      $('#to_recomend').val(from_recomend);

  });

function copyToClipboard(element) {
    var copyText = $(element).val();
    navigator.clipboard.writeText(copyText)
        Swal.fire({
            icon: "success",
            title: "Done",
            timer: 1000,
            text: "Copied!",
          });
}
    $('.copy').on('click', function() {
        var targetID = $(this).data('target-id');
        copyToClipboard('#' + targetID);
    });


// end center card functionality

    $('#saveButtons').on('click', function(event) {
        event.preventDefault();
        
        var formData = $('#AddButtonForm').serialize();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/add/buttons', 
            data:formData,
            
            success: function (data) {
                $('#addBtnModal').modal('hide');
                $('#AddButtonForm')[0].reset();
                Swal.fire({
                    icon: "success",
                    title: "Done",
                    text: data.message,
                  });
            },
            error: function (xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                console.log(response)
                if (response.errors) {  
                    $.each(response.errors, function (field, errors) {
                        if (errors.length > 0) {
                            firstError = errors[0];
                            return false; 
                        }
                    });
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: firstError,
                    });
                    }else{
                        Swal.fire({
                            icon: "question",
                            title: "Oops...",
                            text: "Something went Wrong!",
                          }).then(function() {
                            window.location.href = '/user/home';
                          });
                    }
            }
        });
       });
       
});