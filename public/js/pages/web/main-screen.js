var site_url = window.location.protocol + '//' + window.location.host;

$(document).ready(function () {
    $("#submitPrescription").click(function () {
        $('.loader').show();
        var formData = $("#addPrescriptionForm").serialize();
        $.ajax({
            type: "POST",  
            url: site_url + "/user/add/prescription",  
            data: formData,
            success: function (response) {
                $('.loader').hide();
                $('#addPrescriptionForm')[0].reset();
                $('#createTemp').hide();
                $("#tagsInput").tagsinput('removeAll');
                toastr.success(response.message, 'Success!', toastCofig);
                window.location.href = '/user/home';
            },
            error: function (xhr, status, error) {
                $('.loader').hide();
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
        //$('.loader').show();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/get/prescription/list',
            data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
                searchTerm: searchTerm,
            },
            success: function (data) {
                $('#searchResults').html(data);
               // $('.loader').hide();
            },
            
        });
    });

$(document).on('click', '.crossValue' ,function (e) {   
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
                $('.loader').show();
                $.ajax({
                    type: 'post',
                    url: site_url + '/user/delete/card', // Update with your actual route
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'card_id': prescriptionId
                    },
                    success: function (data) {
                        toastr.success(data.message, 'Success!', toastCofig);
                        cardArea.remove(); // Remove the card from the DOM
                        $('.loader').hide();
                    },
                    error: function (error) {
                        $('.loader').hide();
                        toastr.success("Error deleting prescription:", 'Error!', toastCofig);
                        console.error('Error deleting prescription:', error);
                        // Handle error if needed
                    }
                });
            }
            $('.loader').hide();
        });
    
  });
  $(document).on('click', '.cardArea' ,function (e) {
    // $(".cardArea").removeClass("active");
    isActive =  $(this).hasClass('active');
    $(this).toggleClass('active');
      $('.loader').show();
    var cardBody = $(this).find('.cardBody');
    var cardId = cardBody.data('id');
    $('#to_diagn').val('');
    $('#to_objective').val('');
    $('#to_recomend').val('');
    $.ajax({
        type: 'get',
        url: site_url + '/user/prescription/data', 
        data:{card_id:cardId},
        
        success: function (data) {
            var prescriptionData = data.object;
            if(!isActive){
                $('#to_diagn').val(function (_, currentValue) {
                    return currentValue + '\n' + prescriptionData.diagn;
                });

                $('#to_objective').val(function (_, currentValue) {
                    return currentValue + '\n' + prescriptionData.objective;
                });

                $('#to_recomend').val(function (_, currentValue) {
                    return currentValue + '\n' + prescriptionData.recomend;
                });
            }
            $('.loader').hide();
            // toastr.success(data.message, 'Success!', toastCofig);   
        },
    });

  });

function copyToClipboard(element) {
    var copyText = $(element).val();
    navigator.clipboard.writeText(copyText)
    toastr.success("Copied", 'Success!', toastCofig);
}
    $('.copy').on('click', function() {
        var targetID = $(this).data('target-id');
        copyToClipboard('#' + targetID);
    });


// end center card functionality

        $(document).on('click', '#saveButtons' ,function (event) {
        event.preventDefault();
        $('.loader').show();
        var formData = $('#AddButtonForm').serialize();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/add/buttons', 
            data:formData,
            
            success: function (data) {
                $('#addBtnModal').modal('hide');
                $('#AddButtonForm')[0].reset();

                var newButton = data.newButton;
                var buttonHTML = '<div class="cardItemValue">' +
                    '<span class="tag tag-data" data-button-position="' + newButton.place + '" data-button-id="' + newButton.id + '">' + newButton.title + '</span>' +
                    '<span class="crossValue buttondeleteCrose" data-button-id="' + newButton.id + '"><i class="las la-times"></i></span>' +
                '</div>';
                console.log(buttonHTML)
                    $('.buttonAppend').append(buttonHTML);
                $('.loader').hide();
                toastr.success(data.message, 'Success!', toastCofig);
                  
            },
            error: function (xhr, status, error) {
                $('.loader').hide();
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
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/change-password', 
            data:formData,
            
            success: function (data) {
                $('#changePasswordModel').modal('hide');
                $('#changePasswordForm')[0].reset();
                $('.loader').hide();
                toastr.success(data.message, 'Success!', toastCofig);
            },
            error: function (xhr, status, error) {
                $('.loader').hide();
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
          var button = $(this);
          var buttonId = $(this).data('button-id');
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
                        $('.loader').show();
                        $.ajax({
                            type: 'post',
                            url: site_url + '/user/delete/button',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'button_id': buttonId
                            },
                            success: function (data) {
                                toastr.success(data.message, 'Success!', toastCofig);
                                button.closest('.cardItemValue').remove();
                            },
                            error: function (error) {
                                console.error('Error deleting button:', error);
                            }
                        });
                    }
                    $('.loader').hide();
                });
            
          });

          $('#addLableSubmit').on('click', function(event) {
            event.preventDefault();
            var formData = $('#searchableTags').serialize();
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: site_url + '/user/add/search/tags', 
                data:formData,
                
                success: function (data) {
                    $('.loader').hide();
                    $('#addOnBtnModal').modal('hide');
                    $('#searchableTags')[0].reset();
                    $("#tagsInput").tagsinput('removeAll');
                    console.log("=========>",data)
                   // Assuming data.newCustomSearch is an array with one element
                   var newCustomSearchHTML = `
                   <li class="leftCardItems row" data-id="${data.newCustomSearch[0].id}">
                       <h6 class="cardItemHead col-md-4">${data.newCustomSearch[0].title}</h6>
                       <div class="col-md-8">
                           ${data.newCustomSearch[0].custom_tags && data.newCustomSearch[0].custom_tags.length > 0
                               ? data.newCustomSearch[0].custom_tags.map(tag => `
                                   <div class="cardItemValue">
                                       <span class="tag" data-tag="${tag.tag}" data-type="true">${tag.tag}</span>
                                       <span class="crossValue crossValue1 customtagdelete" data-id="${tag.id}"><i class="las la-times"></i></span>
                                   </div>
                               `).join('')
                               : ''}
                       </div>
                   </li>
               `;
                $('#UlTags').append(newCustomSearchHTML);
                toastr.success(data.message, 'Success!', toastCofig);
                },
                error: function (xhr, status, error) {
                    $('.loader').hide();
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
            $('.loader').show();
            var formData = new FormData($('#UpdateProfileForm')[0]);
        
            $.ajax({
                url: '/user/update-profile',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('.loader').hide();
                    $('#updateProfileModal').modal('hide');
                    toastr.success(data.message, 'Success!', toastCofig);
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    $('.loader').hide();
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

$('.buttonAppend').on('click', '.tag-data', function() {
        var buttonId = $(this).data('button-id');
        var buttonPosition = $(this).data('button-position');
        
        if(!$(this).hasClass('active')){
            $.ajax({
                url: site_url + '/user/get-button-description',
                type: 'POST',
                data: { button_id: buttonId,'_token': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.description) {
                        // Update input field based on button position
                        if (buttonPosition === 1) {
                            const textarea = document.getElementById('to_diagn');
                            textarea.value += response.description + '\n';
                            // $('#to_diagn').val(function (_, currentValue) {
                            //     return currentValue + '\n' + response.description;
                            // });
                        } else if (buttonPosition === 2) {
                            const textarea = document.getElementById('to_objective');
                            textarea.value += response.description + '\n';
                            // $('#to_objective').val(function (_, currentValue) {
                            //     return currentValue + '\n' + response.description;
                            // });
                        } else if (buttonPosition === 3) {
                            const textarea = document.getElementById('to_recomend');
                            textarea.value += response.description + '\n';
                            // $('#to_recomend').val(function (_, currentValue) {
                            //     return currentValue + '\n' + response.description;
                            // });
                        } else {
                            console.error('Invalid button position.');
                        }
                    } else {
                        console.error('Button description not found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }else{
            $.ajax({
                url: site_url + '/user/get-button-description',
                type: 'POST',
                data: { button_id: buttonId,'_token': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.description) {
                        // Update input field based on button position
                        if (buttonPosition === 1) {
                            const textarea = document.getElementById('to_diagn');
                            textarea.value = textarea.value.replace(response.description+'\n', '');
                            // console.log("replaced======>",textarea.value.replace(response.description + '\n', ''))
                        } else if (buttonPosition === 2) {
                            const textarea = document.getElementById('to_objective');
                            textarea.value = textarea.value.replace(response.description+'\n', '');
                           
                        } else if (buttonPosition === 3) {
                            const textarea = document.getElementById('to_recomend');
                            textarea.value = textarea.value.replace(response.description+'\n', '');
                        } else {
                            console.error('Invalid button position.');
                        }
                    } else {
                        console.error('Button description not found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }
        $(this).toggleClass('active');
    });

    // $(document).on('click', 'button.secondryOutline', function() {
    //     $(this).toggleClass('active');
    // });
    
    // $(document).on('click', 'button.secondryOutline.active', function() {
    //     $(this).toggleClass('active');
    // });

    // $(document).on('click', 'button.secondryOutline', function() {
    //     $(this).toggleClass('active');
    // });

    $(document).on('click', '.tag', function () {
    //$('.tag').on('click', function () {
        $('.loader').show();
        var isActive = $(this).hasClass('active');
        $(this).toggleClass('active', !isActive);
        var activeTags = $('.tag.active');
        var searchData = [];
        activeTags.each(function () {
            var tagData = {
                searchTerm: $(this).data('tag')
            };
            searchData.push(tagData);
        });

        var searchDataString = searchData.map(function (tag) {
            return tag.searchTerm;
        }).join(',');
        if (searchDataString.trim() === '') {
            $('#searchResults').html('');
            $('.loader').hide();
            return true;
        }
        $.ajax({
            type: 'POST',
            url: site_url + '/user/get/prescription/list',
            data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
                searchTerm: searchDataString,
                type:true
            },
            success: function (data) {
                $('.loader').hide();
                $('#searchResults').html(data);
            },
            
        });
    });

    $('#removeAllData').on('click', function () {
        
        $('#searchResults').html('');
        $("#UlTags span.active").removeClass('active');
        $('#to_diagn').val("");
        $('#to_objective').val("");
        $('#to_recomend').val("");
        $("#searchInput").val("");
        $(".secondryOutline").removeClass('active');
    });
    
    $(document).on('click', '.customtagdelete', function () {
        var tagId = $(this).data('id');
        var deleteButton = $(this);
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
                $('.loader').show();
                $.ajax({
                    type: 'post',
                    url: site_url + '/user/delete/left/tags',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'tag_id': tagId
                    },
                    success: function (data) {
                        $('.loader').hide();
                        deleteButton.closest('.cardItemValue').remove();
                        if ($('.cardItemValue').length === 0) {
                            deleteButton.closest('.leftCardItems').remove();
                        }
                        toastr.success(data.message, 'Success!', toastCofig);
                    },
                });
            }
        });
    });
});