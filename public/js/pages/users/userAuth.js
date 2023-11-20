    $(document).ready(function () {
        function handleAuth(action, data) {
            $.ajax({
                url: '/' + action,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        if(action === 'user/login'){
                        window.location.href = '/user/home';
                        }else{
                            window.location.href = '/';
                        }
                    }else{
                        alert();
                    }
                },
                error: function (xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    
                    if (response.errors) {  
                            $.each(response.errors, function (key, value) {
                                console.log('#' + key + '-error')
                                $('.error-message[data-form="' + action + '"]').html('');
                               $('#' + action + '-' + key + '-error').html('<span style="color:red;font-weight:20px;">' + value[0] + '</span>');
                            });
                        }else{
                            alert()
                        }
                }
            });
        }


        // Event listener for signup form submission
        $('#signup-form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            handleAuth('signup', formData);
        });
        
        // Event listener for login form submission
        $('#login-form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            handleAuth('user/login', formData);
        });
    });