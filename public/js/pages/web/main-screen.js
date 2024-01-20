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
                $("#tagsInput").tagsinput('removeAll');
                $('#createTemp').hide();
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
                } else {
                    Swal.fire({
                        icon: "question",
                        title: "Oops...",
                        text: "Something went Wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                    }).then(function () {
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

    $(document).on('click', '.crossValue', function (e) {
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
    $(document).on('click', '.cardArea', function (e) {
        var $this = $(this);
        var isActive = $this.hasClass('active');
        $(".cardArea").removeClass("active");
        if (!isActive) {
            $this.addClass('active');
        }
        $('.loader').show();
        var cardBody = $(this).find('.cardBody');
        var cardId = cardBody.data('id');
        $('#to_diagn').val('');
        $('#to_objective').val('');
        $('#to_recomend').val('');
        $.ajax({
            type: 'get',
            url: site_url + '/user/prescription/data',
            data: { card_id: cardId },

            success: function (data) {
                var prescriptionData = data.object;
                if (!isActive) {
                    $('#to_diagn').val(function (_, currentValue) {
                        if (currentValue === "") {

                            return replaceWithDate(currentValue + prescriptionData.diagn + '\n');
                        } else {

                            return replaceWithDate(currentValue + '\n' + prescriptionData.diagn);
                        }

                    });

                    $('#to_objective').val(function (_, currentValue) {
                        if (currentValue === "") {
                            return replaceWithDate(currentValue + prescriptionData.objective + '\n');
                        } else {
                            return replaceWithDate(currentValue + '\n' + prescriptionData.objective);
                        }
                    });

                    $('#to_recomend').val(function (_, currentValue) {
                        if (currentValue === "") {
                            return replaceWithDate(currentValue + prescriptionData.recomend + '\n');
                        } else {
                            return replaceWithDate(currentValue + '\n' + prescriptionData.recomend);
                        }

                    });
                }
                $('.loader').hide();
                // toastr.success(data.message, 'Success!', toastCofig);   
            },
        });

    });

    function copyToClipboard(element , button) {
        var copyText = $(element).val();
        navigator.clipboard.writeText(copyText)
            $(button).addClass("copyActive");
            setTimeout(function () {
                $(button).removeClass("copyActive");
            }, 2500);
        toastr.success("Copied", 'Success!', toastCofig);
    }
    $('.copy').on('click', function () {
        button = this;
        var targetID = $(this).data('target-id');
        copyToClipboard('#' + targetID ,button);
    });


    // end center card functionality

    $(document).on('click', '#saveButtons', function (event) {
        event.preventDefault();
        $('.loader').show();
        var formData = $('#AddButtonForm').serialize();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/add/buttons',
            data: formData,

            success: function (data) {
                $('#addBtnModal').modal('hide');
                $('#AddButtonForm')[0].reset();

                var newButton = data.newButton;
                var buttonHTML = '<div class="cardItemValue" id="cardItemValueButton_' + newButton.id + '">' +
                    '<span class="tag tag-data" data-button-position="' + newButton.place + '" data-button-id="' + newButton.id + '">' + newButton.title + '</span>' +
                    '<span class="crossValue buttondeleteCrose removed remove" data-button-id="' + newButton.id + '"><i class="las la-times"></i></span>' +
                    '</div>';

                $('.buttonAppend').append(buttonHTML);
                $('.loader').hide();
                toastr.success(data.message, 'Success!', toastCofig);

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
                } else {
                    Swal.fire({
                        icon: "question",
                        title: "Oops...",
                        text: "Something went Wrong!",
                    }).then(function () {
                        window.location.href = '/user/home';
                    });
                }
            }
        });
    });
    $('#changePasswordButton').on('click', function (event) {
        event.preventDefault();
        var formData = $('#changePasswordForm').serialize();
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/change-password',
            data: formData,

            success: function (data) {
                $('#changePasswordModel').modal('hide');
                $('#changePasswordForm')[0].reset();
                $('.loader').hide();
                toastr.success(data.message, 'Success!', toastCofig);
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
                } else if (response.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.error,
                    })

                }
                else {
                    Swal.fire({
                        icon: "question",
                        title: "Oops...",
                        text: 'something went wrong',
                    })
                }
            }
        });

    });

    $(document).on('click', '.buttondeleteCrose', function (e) {
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

    $('#addLableSubmit').on('click', function (event) {
        event.preventDefault();
        var formData = $('#searchableTags').serialize();
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/add/search/tags',
            data: formData,

            success: function (data) {
                $('.loader').hide();
                $('#addOnBtnModal').modal('hide');
                $('#searchableTags')[0].reset();
                $("#tagsInput").tagsinput('removeAll');

                // Assuming data.newCustomSearch is an array with one element
                var newCustomSearchHTML = `
                   <li class="leftCardItems row" data-id="${data.newCustomSearch[0].id}">
                       <h6 class="cardItemHead col-md-4">${data.newCustomSearch[0].title}</h6>
                       <div class="col-md-8">
                           ${data.newCustomSearch[0].custom_tags && data.newCustomSearch[0].custom_tags.length > 0
                        ? data.newCustomSearch[0].custom_tags.map(tag => `
                                   <div class="cardItemValue" id="cardItemValueTag_${tag.id}">
                                       <span class="tag tagTitle tags" data-tag="${tag.tag}" data-type="true" data-id="${tag.id}">${tag.tag}</span>
                                       <span class="crossValue crossValue1 customtagdelete removed remove" data-id="${tag.id}"><i class="las la-times"></i></span>
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
                } else {
                    Swal.fire({
                        icon: "question",
                        title: "Oops...",
                        text: "Something went Wrong!",
                    })
                }
            }
        });

    });
    $('#submitUpdateProfile').on('click', function (event) {
        event.preventDefault();
        $('.loader').show();
        var formData = new FormData($('#UpdateProfileForm')[0]);

        $.ajax({
            url: '/user/update-profile',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('.loader').hide();
                $('#updateProfileModal').modal('hide');
                toastr.success(data.message, 'Success!', toastCofig);

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

    $('#getProfileData').on('click', function (event) {
        $.ajax({
            type: 'GET',
            url: site_url + '/user/get-profile-data',
            success: function (data) {

                $('#preview').attr('src', data.profile_image);

                $('#updateFull_name').val(data.full_name);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $('#clearChangePasswordForm').on('click', function (event) {
        event.preventDefault();
        $('#changePasswordForm')[0].reset();
    });
        $('.buttonAppend').on('click', '.tag-data', function () {

            var buttonId = $(this).data('button-id');
            // var $container = $('#cardItemValueButton_' + buttonId);
            var buttonPosition = $(this).data('button-position');
            // if (!$('#cardItemValueButton_' + buttonId).hasClass('active')) {
                $.ajax({
                    url: site_url + '/user/get-button-description',
                    type: 'POST',
                    data: { button_id: buttonId, '_token': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        var description = response.description;
                        var lineCount = (description.match(/\r\n|\r|\n/g) || []).length + 1;
                        var textarea = document.getElementById(getTextareaId(buttonPosition));
                        var button = $('#cardItemValueButton_' + buttonId);
                        if (button.hasClass('active')) {
                            if (lineCount > 1) {
                                description.split(/\r\n|\r|\n/).forEach(function (line) {
                                    console.log(line);
                                    if (line.trim() !== '') {
                                        textarea.value = textarea.value.replace(line + '\n', '');
                                    }
                                    // console.log(textarea.value);
                                });
                            } else {
                                textarea.value = textarea.value.replace(description + '\n');
                            }
                            button.removeClass('active');
                        } else {
                                textarea.value = textarea.value + description + '\n';
                                button.addClass('active');
                        }
  
                    },
                });



        // Function to get the textarea ID based on the button position
        function getTextareaId(buttonPosition) {
            switch (buttonPosition) {
                case 1:
                    return 'to_diagn';
                case 2:
                    return 'to_objective';
                case 3:
                    return 'to_recomend';
                default:
                    console.error('Invalid button position.');
                    return '';
            }
        }

        // $(this).toggleClass('active');
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

    $(document).on('click', '.tags', function () {
        //$('.tag').on('click', function () {

        $('.loader').show();
        var dataId = $(this).data('id');
        var cardItemValueTag = $('#cardItemValueTag_' + dataId);
        $(this).toggleClass('active');
        cardItemValueTag.toggleClass('active', $(this).hasClass('active'));
        var activeTags = $('.tags.active');
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
                type: true
            },
            success: function (data) {
                $('.loader').hide();
                data = '\n' + data;

                $('#searchResults').html(data);
            },

        });
    });

    $('#removeAllData').on('click', function () {

        $('#searchResults').html('');
        $(".cardItemValue").removeClass('active');
        $('#to_diagn').val("");
        $('#to_objective').val("");
        $('#to_recomend').val("");
        $("#searchInput").val("");
        $(".tagTitle").removeClass('active');
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
                        if (data.count == 0) {
                            window.location.href = '/user/home';
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '.editPrescriptionUser', function () {
        $('.loader').show();
        // var eventModal = new bootstrap.Modal(document.getElementById('editPrescriptionAdmin'));
        // eventModal.show();
        var prescreptionId = $(this).data('id');
        $.ajax({
            url: site_url + '/user/get/edit/prescreption/' + prescreptionId,
            type: 'get',
            data: prescreptionId,
            success: function (response) {
                $("#edit_name").val(response.object.name)
                $("#edit_description").val(response.object.description)
                $("#edit_diagn").val(response.object.diagn)
                $("#edit_objective").val(response.object.objective)
                $("#edit_recomend").val(response.object.recomend)
                $("#prescreprionId").val(response.object.id);
                $("#UserId").val(response.object.user_id);
                var ids = [];
                var tagValues = response.tags.map(function (tag) {
                    $('#tagsInputprescreption').tagsinput('add', tag.tags);
                    ids.push(tag.id);
                });
                $('#tagIds').val(ids);
                $('.loader').hide();
                console.log(tagValues)
                //   console.log(response.object);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    $('#submitEditPrescription').on('click', function () {
        $('.loader').show();
        var formData = $("#EdidPrescriptionForm").serialize();
        $.ajax({
            url: site_url + '/user/edit/prescreption',
            type: 'POST',
            data: formData,
            success: function (response) {

                console.log(response.object)
                $('#editPrescription').modal('hide');
                $('#EdidPrescriptionForm')[0].reset();
                $("#tagsInputprescreption").tagsinput('removeAll');
                $('.loader').hide();
                toastr.success(response.message, 'Success!', toastCofig);
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
                } else {
                    Swal.fire({
                        icon: "question",
                        title: "Oops...",
                        text: "Something went Wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                    }).then(function () {
                        window.location.href = '/user/home';
                    });
                }
            }
        });

    });
    function replaceWithDate(inputText) {
        let formattedText = inputText.replace(/&&DATE&&/g, function () {
            return new Date().toLocaleDateString('en-GB');
        });
    
        formattedText = formattedText.replace(/&&DATE\+(\d+)&&/g, function (match, p1) {
            const incrementValue = parseInt(p1, 10) || 0;
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + incrementValue);
            return currentDate.toLocaleDateString('en-GB');
        });
    
        return formattedText;
    }
    function hasNewline(inputString) {
        // Regular expression to match newline character
        const newlineRegex = /\n/;
    
        // Test if the inputString contains any newline character
        return newlineRegex.test(inputString);
    }

});