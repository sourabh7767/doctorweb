    $(document).ready(function () {
        function handleAuth(action, data,className) {
            $.ajax({
                url: '/' + action,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                       
                        if(action === 'user/login'){
                            swal({
                                icon:"success",
                                text: "Login successfully!",
                                buttons:false,
                                timer: 1500, 
                                timerProgressBar: true, 
                              }).then(function() {
                                window.location.href = '/user/home';
                              });
                       
                        }else{
                            swal({
                                icon:"success",
                                text: "Sign up successfully!",
                                timer: 1500, 
                                buttons:false,
                                timerProgressBar: true,
                              }).then(function() {
                                window.location.href = '/';
                              });
                        }
                    }else{
                        swal({
                            icon:"error",
                            text: "Something went wrong!",
                            timer: 1500, 
                            buttons:false,
                            timerProgressBar: true,
                          }).then(function() {
                            window.location.href = '/';
                          });
                    }
                },
                error: function (xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    
                    if (response.errors) {  
                            $.each(response.errors, function (key, value) {
                                console.log('#' + key + '-error')
                                console.log('.error-message[data-form="' + action + '"]',"=====================>");
                                $('.message[data-form="' + className + '"]').html('');
                               $('#' + className + '-' + key + '-error').html('<span style="color:red;font-weight:20px;">' + value[0] + '</span>');
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
            handleAuth('signup', formData ,'signup');
        });
        
        // Event listener for login form submission
        $('#login-form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            handleAuth('user/login', formData , 'login');
        });
    });

        $(function () {
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#signInPassword").attr("type", type);
            });
        });
        $(function () {
            $("#signUpPass").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#signUpPassword").attr("type", type);
            });
        });
        $(function () {
            $("#signUpConfirmPass").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#signUpConfirmPassword").attr("type", type);
            });
        });