var site_url = window.location.protocol + '//' + window.location.host;

$(document).ready(function () {
    $("#submitPrescription").click(function () {
        $('#loader').show();
        var formData = $("#addPrescriptionForm").serialize();
        $.ajax({
            type: "POST",  
            url: site_url + "/user/add/prescription",  
            data: formData,
            success: function (response) {
                $('#loader').hide();
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

                var newButton = data.newButton;
                var buttonHTML = '<button class="secondryOutline active_' + newButton.id + '" data-button-id="' + newButton.id + '"><span class="btnText">' + newButton.title + '</span> <span class="crossValue"><i class="las la-times"></i></span></button>';
                if (newButton.id % 2 === 0) {
                    $('#buttonContainer2').append(buttonHTML);
                } else {
                    $('#buttonContainer').append(buttonHTML);
                }

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
    $('#changePasswordButton').on('click', function(event) {
        event.preventDefault();
        var formData = $('#changePasswordForm').serialize();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/change-password', 
            data:formData,
            
            success: function (data) {
                $('#changePasswordModel').modal('hide');
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
                    }else if(response.error){
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.error,
                          })

                    }
                    else{
                        Swal.fire({
                            icon: "question",
                            title: "Oops...",
                            text: 'something went wrong',
                          })
                    }
            }
        });

    });
    
    $(document).on('click', '.buttondeleteCrose' ,function (e) {
          var button = $(this).closest('.secondryOutline');
          var buttonId = button.data('button-id');
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
                            url: site_url + '/user/delete/button',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'button_id': buttonId
                            },
                            success: function (data) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: data.message,
                                    icon: "success"
                                  });
                                
                                  button.remove(); 
                            },
                            error: function (error) {
                                console.error('Error deleting button:', error);
                            }
                        });
                    }
                });
            
          });

          $('#addLableSubmit').on('click', function(event) {
            event.preventDefault();
            var formData = $('#searchableTags').serialize();
            $.ajax({
                type: 'POST',
                url: site_url + '/user/add/search/tags', 
                data:formData,
                
                success: function (data) {
                    $('#addOnBtnModal').modal('hide');
                    // var newButton = data.newButton;
                    // var buttonHTML = '<button class="secondryOutline active_' + newButton.id + '" data-button-id="' + newButton.id + '"><span class="btnText">' + newButton.title + '</span> <span class="crossValue"><i class="las la-times"></i></span></button>';
                    //     $('#buttonContainer').append(buttonHTML);
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
                              })
                        }
                }
            });
    
        });
        $('#submitUpdateProfile').on('click', function(event) {
            event.preventDefault();
            var formData = new FormData($('#UpdateProfileForm')[0]);
        
            $.ajax({
                url: '/user/update-profile',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#updateProfileModal').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: "Done",
                        text: data.message,
                      });
                    console.log(response);
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
                    }
                }
            });
        });
    
        $(function () {
            $("#change_old_pass_eye").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#change_old_pass").attr("type", type);
            });
        });
        $(function () {
            $("#change_new_pass_eye").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#change_new_pass").attr("type", type);
            });
        });
        $(function () {
            $("#change_confirm_pass_eye").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#change_confirm_pass").attr("type", type);
            });
        });
        
        $('#getProfileData').on('click', function(event) {
    $.ajax({
        type: 'GET',
        url: site_url + '/user/get-profile-data', 
        success: function (data) {
            console.log(data)
            $('#preview').attr('src',data.profile_image);

            $('#updateFull_name').val(data.full_name);
        },
        error: function (error) {
            console.log(error);
        }
    });
});
$('#clearChangePasswordForm').on('click', function(event) {
    event.preventDefault();
$('#changePasswordForm')[0].reset();
});

});