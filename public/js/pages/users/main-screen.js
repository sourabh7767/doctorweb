var site_url = window.location.protocol + '//' + window.location.host;
$(document).ready(function () {
    $(".abc").click(function () {
        alert('hit')
        var formData = $("#addPrescriptionForm").serialize();
        $.ajax({
            type: "POST",  
            url: site_url+"/user/add/prescription",  
            data: formData,
            success: function (response) {
                alert('Prescription added successfully!')
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


// start center card functionality

    $('.cardSearch').on('input', function () {
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
    $('.copy').on('click', function() {
        var targetID = $(this).data('target-id');
        copyToClipboard('#' + targetID);
    });
});

// end center card functionality