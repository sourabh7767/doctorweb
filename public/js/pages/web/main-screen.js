var site_url = window.location.protocol + '//' + window.location.host;

$(document).ready(function () {
    function getDropDown(){
        // Code to append divs

        // Make an AJAX request to fetch updated dropdown values
        $.ajax({
            url: '/user/home', // Assuming this is your route to fetch dropdown values
            method: 'GET',
            success: function(response) {
                console.log(response)
                // Assuming response is an array of dropdown options
                var options = response.success;

                // Clear existing dropdown options
                $('#parent_groups').empty();

                // Append new options to the dropdown
                $.each(options, function(index, value) {
                    $('#parent_groups').append($('<option>', {
                        value: value.id,
                        text: value.title
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


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
                    '<span class="crossValue buttondeleteCrose removed remove" data-button-id="' + newButton.id + '"><i class="las la-times"></i></span><span class="editValue remove removed" id="editButton" data-id="' + newButton.id + '" data-bs-toggle="modal" data-bs-target="#editBtnModal" ><i class="las la-pen"></i></span>' +
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
        var customId =  $("#customSearchObj_id").val();
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

            var newPanelHTML = `
            <div class="panel" id="panel">
                <div class="toggle-button-container">
                <div class="toggleTxtContainer" data-id="${data.newCustomSearch[0].id}">
                    <p style="margin: 0; flex-grow: 1;color:#ffff;">${data.newCustomSearch && data.newCustomSearch.length > 0 ? data.newCustomSearch[0].title : 'Title Placeholder'}&nbsp;&nbsp;</p>
                    <span class="editModal remove removed editMainGroup me-2" data-id="${data.newCustomSearch[0].id}" data-bs-toggle="modal" data-bs-target="#editMaingroup" ><i class="las la-pen"></i></span>
                    <span class="editModal remove removed removeGroup me-2" data-id="${data.newCustomSearch[0].id}" data-bs-toggle="modal" ><i class="fas fa-trash"></i></span>
                    </div>
                    <div class="d-flex">
                        <button class="toggle-button toggleOnClass">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="additional-buttons newtag_${data.newCustomSearch[0].id}"">
                <div class="d-flex justify-content-between">
                    <div class="leftCardMenusArea">
                    <ul class="leftCardMenus ul_${data.newCustomSearch[0].id}" id="UlTags">
                    </ul>
                    </div>
                <span class="addOnBtn me-0" data-bs-toggle="modal" data-bs-target="#addOnBtnModalTags" ><i class="las la-plus tagId" data-id="${data.newCustomSearch && data.newCustomSearch.length > 0 ? data.newCustomSearch[0].id : '123'}"></i></span>
                </div>
                </div>
            </div>
        `;


                // $('#UlTags').append(newCustomSearchHTML);
                $('.panel-container').append(newPanelHTML);
                 $.ajax({
                    url:site_url +  '/user/home', // Assuming this is your route to fetch dropdown values
                    method: 'GET',
                    success: function(response) {
                        console.log(response)
                        // Assuming response is an array of dropdown options
                        var options = response.success;

                        // Clear existing dropdown options
                        $('#parent_groups').empty();

                        // Append new options to the dropdown
                        $.each(options, function(index, value) {
                            $('#parent_groups').append($('<option>', {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
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
        $(document).on('click', '.tagId', function (event) {
        var id = $(this).data('id');
        $("#customSearchObj_id").val(id);
    });
    $('#addLableSubmitTag').on('click', function (event) {
        event.preventDefault();
       var customId =  $("#customSearchObj_id").val();
        var formData = $('#addTags').serialize();
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: site_url + '/user/add/search/tags',
            data: formData,

            success: function (data) {
                $('.loader').hide();
                $('#addOnBtnModalTags').modal('hide');
                $('#addTags')[0].reset();
                $("#tagsInput").tagsinput('removeAll');

                // Assuming data.newCustomSearch is an array with one element
            //     var newCustomSearchHTML = `
            //        <li class="leftCardItems row" data-id="${data.newCustomSearch[0].id}">
            //            <h6 class="cardItemHead col-md-4">${data.newCustomSearch[0].title}</h6>
            //            <div class="col-md-8">
            //                ${data.newCustomSearch[0].custom_tags && data.newCustomSearch[0].custom_tags.length > 0
            //             ? data.newCustomSearch[0].custom_tags.map(tag => `
            //                        <div class="cardItemValue" id="cardItemValueTag_${tag.id}">
            //                            <span class="tag tagTitle tags" data-tag="${tag.tag}" data-type="true" data-id="${tag.id}">${tag.tag}</span>
            //                            <span class="crossValue crossValue1 customtagdelete removed remove" data-id="${tag.id}"><i class="las la-times"></i></span>
            //                        </div>
            //                    `).join('')
            //             : ''}
            //            </div>
            //        </li>
            //    `;
            var newPanelHTML = `
                    ${data.newCustomSearch && data.newCustomSearch.length > 0 && data.newCustomSearch[0].custom_tags && data.newCustomSearch[0].custom_tags.length > 0
                    ? data.newCustomSearch[0].custom_tags.map(tag => `
                        <div class="cardItemValue" id="cardItemValueTag_${tag.id}">
                            <span class="tag tagTitle tags" data-tag="${tag.tag}" data-type="true" data-id="${tag.id}">${tag.tag}</span>
                            <span class="crossValue crossValue1 customtagdelete removed remove" data-id="${tag.id}"><i class="las la-times"></i></span>
                        </div>
                    `).join('')
                    : ''}
        `;
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
        
                // $('#UlTags').append(newCustomSearchHTML);
                $('.ul_'+customId).append(newCustomSearchHTML);
                
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

        $(document).on('click', '#getProfileData', function (event) {
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
                                description.split(/\r\n|\r|\n/).forEach(function (line) {
                                    console.log(line);
                                    if (line.trim() !== '') {
                                        textarea.value = textarea.value.replace(line + '\n', '');
                                    }
                                    // console.log(textarea.value);
                                });

                                 
                                    // textarea.value = textarea.value.replace(regex, '');
                                    // textarea.value = textarea.value.replace(/\n/g, '');
                                // textarea.value = textarea.value.replace(description + '\n');
                            }
                            button.removeClass('active');
                        } else {
                                textarea.value = textarea.value + description + '\n';
                                button.addClass('active');
                        }
  
                    },
                });

            //     if (button.hasClass('active')) {
            //         if (lineCount > 1) {
                       
            //             description.split(/\r\n|\r|\n/).forEach(function (line) {
            //                 console.log(line);
            //                 if (line.trim() !== '') {
            //                     textarea.value = textarea.value.replace(line + '\n', '');
            //                 }
            //                 // console.log(textarea.value);
            //             });
            //         } else {
            //             description.split(/\r\n|\r|\n/).forEach(function (line) {
            //                 console.log(line);
            //                 if (line.trim() !== '') {
            //                     textarea.value = textarea.value.replace(line + '\n', '');
            //                 }
            //                 // console.log(textarea.value);
            //             });

                         
            //                 // textarea.value = textarea.value.replace(regex, '');
            //                 // textarea.value = textarea.value.replace(/\n/g, '');
            //             // textarea.value = textarea.value.replace(description + '\n');
            //         }
            //         button.removeClass('active');
            //     } else {
            //             textarea.value = textarea.value + description + '\n';
            //             button.addClass('active');
            //     }

            // },

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
        // var panel = $(".toggleOnClass").closest('.panel');
        // panel.removeClass("expanded");
        // var additionalButtons = panel.find(".additional-buttons");
        // var arrowIcon = panel.find("i");
        // additionalButtons.removeClass("expanded");
        // arrowIcon.removeClass("rotate");
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
                $("#parent_groups option").each(function() {
                    // Check if the current option's value matches the selected value
                    if ($(this).val() == response.object.parent_group_id) {
                        // If it matches, mark it as selected
                        $(this).prop("selected", true);
                    }
                });
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

  
    var table;
    $(document).ready(function() {
        console.log(site_url, '======site_url');
        
        table = $('#cardsTable').DataTable({
            "bLengthChange": false,
            "search": "Search records...",
            "info": false,
            pageLength: 50,
            ajax: site_url + "/user/groups/",
            createdRow: function( row, data, dataIndex ) {
                //         // Set the data-status attribute, and add a class
                        $(row).attr('data-href', 'user/groups/view/'+data.id);
                        $(row).attr('data-id', data.id);
                
                
                    },
                    
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false,className:'getCenter'},
                { data: 'title', name: 'title' ,className:'pointers'},
                { data: 'template_count', name: 'template_count' ,className:'getCenter'},
                { data: 'user_id', name: 'user_id' ,className:'getCenter'},
                { data: 'download_count', name: 'download_count',className:'getCenter'},
                { data: 'created_at', name: 'created_at',className:'getCenter'},
                { data: 'updated_at', name: 'updated_at' ,className:'getCenter'},
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('input[type=search]').attr('placeholder', 'Search records...');
        
        $(document).on('click', '.allreadyCopied', function (e) {
            e.preventDefault();
            var element = $(this);
            var groupId = element.data("id"); 
            element.addClass('heart-effect');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Perform AJAX request to copy data
            $.ajax({
                url: site_url + '/user/delete/deleteOwnRecord/' + groupId, // Assuming the URL to copy data is set in the href attribute
                type: 'POST',
                headers: {
                    // Include CSRF token in the headers
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle success if needed
                    toastr.success(response.message, 'Success!', toastCofig);
                    console.log('Data copied successfully');
                    table.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                },
                complete: function() {
                    // Remove heart effect after a delay
                    setTimeout(function() {
                        element.removeClass('heart-effect');
                    }, 1000); // Adjust the duration (in milliseconds) as needed
                }
            });
        });
        $(document).on('click', '.copyData', function (e) {
            e.preventDefault();
            var element = $(this);
            var groupId = element.data("id"); 
            element.addClass('heart-effect');
            // Perform AJAX request to copy data
            $.ajax({
                url: site_url + '/user/groups/copy/' + groupId, // Assuming the URL to copy data is set in the href attribute
                type: 'GET',
                success: function(response) {
                    // Handle success if needed
                    toastr.success(response.message, 'Success!', toastCofig);
                    console.log('Data copied successfully');
                    table.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                },
                complete: function() {
                    // Remove heart effect after a delay
                    setTimeout(function() {
                        element.removeClass('heart-effect');
                    }, 1000); // Adjust the duration (in milliseconds) as needed
                }
            });
        });
        $('#cardsTable').on('click', 'tbody td:nth-child(1)', function() {
            var rowData = $(this).closest('tr').data(); // Get data attributes of the clicked row
            var cardId = rowData.id; // Assuming 'id' is the attribute containing the card ID
            var url = site_url + '/user/groups/view/' + cardId;
            $.ajax({
                url: site_url + '/user/groups/view/' + cardId, // Assuming this URL hits your controller action
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // Populate modal with data
                    // $('#cardModal .modal-body').html(response);
                    $('#searchResults').html(response); // Assuming the response contains HTML for the modal body
                    $('#copyPrescriptionModal').modal('show'); // Show the modal
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
            // // Navigate to the URL
        });
        
        // $(document).on('click', '.las la-pen', function() {
            // $('.abc').on('click', function (event) {
        //         $(document).on('click', '.abc', function(e){
                    
                    
        //     var lableId = $(this).data('id'); 
        //     alert(lableId)
        //     $("#editMaingroupId").val(lableId);// Get data attributes of the clicked row
        //     // // var cardId = rowData.id; // Assuming 'id' is the attribute containing the card ID
        //     // var url = site_url + '/user/groups/view/' + cardId;
        //     // $.ajax({
        //     //     url: site_url + '/user/groups/view/' + cardId, // Assuming this URL hits your controller action
        //     //     type: 'GET',
        //     //     success: function(response) {
        //     //         console.log(response);
        //     //         // Populate modal with data
        //     //         // $('#cardModal .modal-body').html(response);
        //     //         $('#searchResults').html(response); // Assuming the response contains HTML for the modal body
        //     //         $('#copyPrescriptionModal').modal('show'); // Show the modal
        //     //     },
        //     //     error: function(xhr, status, error) {
        //     //         // Handle error
        //     //         console.error(error);
        //     //     }
        //     // });
        //     // // Navigate to the URL
        // });
    });
   

});
$(document).on('click', '.removeGroup', function (e) {
    var cardArea = $(this).closest('.panel');
    var groupId = $(this).data('id');

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
                url: site_url + '/user/delete/group', // Update with your actual route
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'group_id': groupId
                },
                success: function (data) {
                    toastr.success(data.message, 'Success!', toastCofig);
                    cardArea.remove(); // Remove the card from the DOM
                    $('.loader').hide();
                },
                error: function (error) {
                    $('.loader').hide();
                    toastr.error("Error deleting prescription:", 'Error!', toastCofig);
                    console.error('Error deleting prescription:', error);
                    // Handle error if needed
                }
            });
        }
        $('.loader').hide();
    });

});
$(document).on('click', '#editButton', function (event) {
    event.preventDefault();
    $('.loader').show();
    var butonId = $(this).data('id');
     $.ajax({
        type: 'GET',
        url: site_url + '/user/edit/buttons/'+butonId,
        // data: {formData},
        success: function (data) {
            console.log(data.button);
            console.log();
            $("#editTitle").val(data.button.title);
            $('#editButtonForm textarea[name="description"]').val(data.button.description);
            if (data.button.place == 1) {
                $('#edit1').prop('checked', true);
            } else if (data.button.place == 2) {
                $('#edit2').prop('checked', true);
            } else if (data.button.place == 3) {
                $('#edit3').prop('checked', true);
            }
            // $("input[name='place'][value='" + data.button.place + "']").prop('checked', true);
            $("#hiddenButonId").val(data.button.id);
            $('.loader').hide();
            // toastr.success(data.message, 'Success!', toastCofig);

        },
    });
});

$(document).on('click', '#editSubmitButton', function (event) {
    event.preventDefault();
    $('.loader').show();
    // var thisButton = $(this);
    var formData = $('#editButtonForm').serialize();
    $.ajax({
        type: 'post',
        url: site_url + '/user/update/buttons',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#editBtnModal').modal('hide');
            $('#editButtonForm')[0].reset();
            $('#newId_' + data.newButton.id).text("");
            $('#newId_' + data.newButton.id).text(data.newButton.title);
            $('#newId_' + data.newButton.id).attr('data-button-position', data.newButton.place);
            // data-button-position
            $('.loader').hide();
            toastr.success(data.message, 'Success!', toastCofig);

        },
        error: function (xhr, status, error) {
            $('.loader').hide();
            var response = JSON.parse(xhr.responseText);
            console.log(response);
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

$("#editModal").on('click','editButton',function(){
    $('#editBtnModal').modal('show');
    var editButtonId = $("#editButton").val();
    $.ajax({
        type: 'GET',
        url: site_url + '/user/edit/buttons',
        data: { id: editButtonId },
        success: function (data) {
          console.log(data);
          
            // $('.buttonAppend').append(buttonHTML);
            $('.loader').hide();
            // toastr.success(data.message, 'Success!', toastCofig);
            $('#editButtonForm input[name="title"]').val(data.title);
            $('#editButtonForm textarea[name="description"]').val(data.description);
            if (data.place === 'Diagnoze') {
                $('#test1').prop('checked', true);
            } else if (data.place === 'Objektīvās atr.') {
                $('#test2').prop('checked', true);
            } else if (data.place === 'Rekomendācijas') {
                $('#test3').prop('checked', true);
            }
            $('.loader').hide();

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

})