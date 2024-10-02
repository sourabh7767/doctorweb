<html>
    <head>
        <title>Avacadokiwi</title>
        <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" type="text/css" /> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
        rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
        
        <style>
            :root {
                --primary-color: #4EA685;
                --secondary-color: #57B894;
                --black: #000000;
                --white: #ffffff;
                --gray: #efefef;
                --gray-2: #757575;

                --facebook-color: #4267B2;
                --google-color: #DB4437;
                --twitter-color: #1DA1F2;
                --insta-color: #E1306C;
            }

            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

            * {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,
            body {
                height: 100vh;
                overflow: hidden;
            }

            .container {
                position: relative;
                min-height: 100vh;
                overflow: hidden;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
                height: 100vh;
            }

            .col {
                width: 50%;
            }

            .align-items-center {
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            .form-wrapper {
                width: 100%;
                max-width: 28rem;
            }

            .form {
                padding: 1rem;
                background-color: var(--white);
                border-radius: 1.5rem;
                width: 100%;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                transform: scale(0);
                transition: .5s ease-in-out;
                transition-delay: .1s;
            }
            .logo_btn{
                position: absolute;
                top:30px;
                left:30px
            }
            .collaborateIcons{
                width: 50px;
                height: 50px;
                z-index: 222;
                position:relative;
            }

            .input-group {
                position: relative;
                width: 100%;
                margin: 1rem 0;
            }

            .input-group i {
                position: absolute;
                top: 27px;
                left: 1rem;
                transform: translateY(-50%);
                font-size: 1.4rem;
                color: var(--gray-2);
            }

            .input-group input {
                width: 100%;
                padding: 1rem 3rem;
                font-size: 1rem;
                background-color: var(--gray);
                border-radius: .5rem;
                border: 0.125rem solid var(--white);
                outline: none;
            }

            .input-group input:focus {
                border: 0.125rem solid var(--primary-color);
            }

            .form button {
                cursor: pointer;
                width: 100%;
                padding: .6rem 0;
                border-radius: .5rem;
                border: none;
                background-color: var(--primary-color);
                color: var(--white);
                font-size: 1.2rem;
                outline: none;
            }

            .form p {
                margin: 1rem 0;
                font-size: .7rem;
            }

            .flex-col {
                flex-direction: column;
            }

            .social-list {
                margin: 2rem 0;
                padding: 1rem;
                border-radius: 1.5rem;
                width: 100%;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                transform: scale(0);
                transition: .5s ease-in-out;
                transition-delay: 1.2s;
            }

            .social-list>div {
                color: var(--white);
                margin: 0 .5rem;
                padding: .7rem;
                cursor: pointer;
                border-radius: .5rem;
                cursor: pointer;
                transform: scale(0);
                transition: .5s ease-in-out;
            }

            .social-list>div:nth-child(1) {
                transition-delay: 1.4s;
            }

            .social-list>div:nth-child(2) {
                transition-delay: 1.6s;
            }

            .social-list>div:nth-child(3) {
                transition-delay: 1.8s;
            }

            .social-list>div:nth-child(4) {
                transition-delay: 2s;
            }

            .social-list>div>i {
                font-size: 1.5rem;
                transition: .4s ease-in-out;
            }

            .social-list>div:hover i {
                transform: scale(1.5);
            }

            .facebook-bg {
                background-color: var(--facebook-color);
            }

            .google-bg {
                background-color: var(--google-color);
            }

            .twitter-bg {
                background-color: var(--twitter-color);
            }

            .insta-bg {
                background-color: var(--insta-color);
            }

            .pointer {
                cursor: pointer;
            }

            .container.sign-in .form.sign-in,
            .container.sign-in .social-list.sign-in,
            .container.sign-in .social-list.sign-in>div,
            .container.sign-up .form.sign-up,
            .container.sign-up .social-list.sign-up,
            .container.sign-up .social-list.sign-up>div {
                transform: scale(1);
            }

            .content-row {
                position: absolute;
                top: 0;
                left: 0;
                pointer-events: none;
                z-index: 6;
                width: 100%;
            }

            .text {
                margin: 4rem;
                color: var(--white);
            }

            .text h2 {
                font-size: 3.5rem;
                font-weight: 800;
                margin: 2rem 0;
                transition: 1s ease-in-out;
            }

            .text p {
                font-weight: 600;
                transition: 1s ease-in-out;
                transition-delay: .2s;
            }

            .img img {
                width: 30vw;
                transition: 1s ease-in-out;
                transition-delay: .4s;
            }

            .text.sign-in h2,
            .text.sign-in p,
            .img.sign-in img {
                transform: translateX(-250%);
            }

            .text.sign-up h2,
            .text.sign-up p,
            .img.sign-up img {
                transform: translateX(250%);
            }

            .container.sign-in .text.sign-in h2,
            .container.sign-in .text.sign-in p,
            .container.sign-in .img.sign-in img,
            .container.sign-up .text.sign-up h2,
            .container.sign-up .text.sign-up p,
            .container.sign-up .img.sign-up img {
                transform: translateX(0);
            }

            /* BACKGROUND */

            .container::before {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                height: 100vh;
                width: 300vw;
                transform: translate(35%, 0);
                background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
                transition: 1s ease-in-out;
                z-index: 6;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                border-bottom-right-radius: max(50vw, 50vh);
                border-top-left-radius: max(50vw, 50vh);
            }

            .container.sign-in::before {
                transform: translate(0, 0);
                right: 50%;
            }

            .container.sign-up::before {
                transform: translate(100%, 0);
                right: 50%;
            }
            .field_icon{
                z-index: 3;
                position: absolute;
                right: 0;
                top: 27px;
                transform: translate(-50%, -50%);
                cursor: pointer;
            }
            .loader
            {
            position: fixed;
                z-index: 9999;
                background: #648edb0a;
                height: 100%;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(7px);
            }
            .messagelogin, .messagesignup {
                text-align: start;
                position: relative;
                left: 6px;
                top: 2px;
            }
            .errorMsg{
                color: red;
                font-weight: 500;
                font-size: 12px
            }

            /* RESPONSIVE */

            @media only screen and (max-width: 425px) {

                .container::before,
                .container.sign-in::before,
                .container.sign-up::before {
                    height: 100vh;
                    border-bottom-right-radius: 0;
                    border-top-left-radius: 0;
                    z-index: 0;
                    transform: none;
                    right: 0;
                }

                /* .container.sign-in .col.sign-up {
                    transform: translateY(100%);
                } */

                .container.sign-in .col.sign-in,
                .container.sign-up .col.sign-up {
                    transform: translateY(0);
                }

                .content-row {
                    align-items: flex-start !important;
                }

                .content-row .col {
                    transform: translateY(0);
                    background-color: unset;
                }

                .col {
                    width: 100%;
                    position: absolute;
                    padding: 2rem;
                    background-color: var(--white);
                    border-top-left-radius: 2rem;
                    border-top-right-radius: 2rem;
                    transform: translateY(100%);
                    transition: 1s ease-in-out;
                }

                .row {
                    align-items: flex-end;
                    justify-content: flex-end;
                }

                .form,
                .social-list {
                    box-shadow: none;
                    margin: 0;
                    padding: 0;
                }

                .text {
                    margin: 0;
                }

                .text p {
                    display: none;
                }

                .text h2 {
                    margin: .5rem;
                    font-size: 2rem;
                }
            }
        </style>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
    </head>
    <body>
    <div class="loader" style="display: none;">    
            <div class="spinner-grow text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div id="container" class="container">
            <!-- FORM SECTION -->
            <div class="row">
                <a class="logo_btn" href="{{url('')}}"><img class="collaborateIcons" src="{{asset("landing-page/img/brands/avacadokiwi_logo3_png_bevel.png")}}" alt=""></a>
                <!-- SIGN UP -->
                <div class="col align-items-center flex-col sign-up">
                    <div class="form-wrapper align-items-center">
                        <form action="{{route('signup')}}" method="POST" name="signup-form" id="signup-form">
                            @csrf
                        <div class="form sign-up">
                            <div class="input-group">
                                <i class="fas fa-user"></i>
                                <input type="email" placeholder="Email" name="email" data-form="signup">
                                <div id="signup-email-error" class="messagesignup" data-form="signup"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="password" id="signUpPassword" data-form="signup">
                                <span id="signUpPass" class="fa fa-fw fa-eye field_icon"></span>
                                <div id="signup-password-error" class="messagesignup" data-form="signup"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Confirm password" name="confirm_password" id="signUpConfirmPassword" data-form="signup">
                                <span id="signUpConfirmPass" class="fa fa-fw fa-eye field_icon"></span> 
                                <div id="signup-confirm_password-error" class="messagesignup" data-form="signup"></div>
                            </div>
                            <button>
                                Sign up
                            </button>
                            <p>
                                <span>
                                    Already have an account?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Sign in here
                                </b>
                            </p>
                        </div>
                        </form>
                    </div>
                
                </div>
                <!-- END SIGN UP -->
                <!-- SIGN IN -->
                <div class="col align-items-center flex-col sign-in">
                    <div class="form-wrapper align-items-center">
                        <form action="" method="post" id="login-form">
                            @csrf
                        <div class="form sign-in">
                            <div class="input-group">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Email" name="email" data-form="login">
                                <div id="login-email-error" class="messagelogin" data-form="login"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="password" id="signInPassword" data-form="login">
                                <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
                                <div id="login-password-error" class="messagelogin" data-form="login"></div>
                            </div>
                            <button>
                                Sign in
                            </button>
                            <a href="{{route('forgetPasswordView')}}"><p>
                                <b>
                                    Forgot password?
                                </b>
                            </p></a>
                            <p>
                                <span>
                                    Don't have an account?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Sign up here
                                </b>
                            </p>
                        </div>
                    </form>
                    </div>
                    <div class="form-wrapper">
            
                    </div>
                </div>
                <!-- END SIGN IN -->
            </div>
            <!-- END FORM SECTION -->
            <!-- CONTENT SECTION -->
            <div class="row content-row">
                <!-- SIGN IN CONTENT -->
                <div class="col align-items-center flex-col">
                    <div class="text sign-in">
                        <h2>
                            Welcome
                        </h2>
        
                    </div>
                    <div class="img sign-in">
            
                    </div>
                </div>
                <!-- END SIGN IN CONTENT -->
                <!-- SIGN UP CONTENT -->
                <div class="col align-items-center flex-col">
                    <div class="img sign-up">
                    
                    </div>
                    <div class="text sign-up">
                        <h2>
                            Join with us
                        </h2>
        
                    </div>
                </div>
                <!-- END SIGN UP CONTENT -->
            </div>
            <!-- END CONTENT SECTION -->
        </div>
    </body>
    </html>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/pages/users/userAuth.js') }}"></script>
    <script src="{{ asset('js/theme/extensions/toastr.min.js') }}"></script>
    <script>
      let toastCofig = {
                 closeButton: true,
                 tapToDismiss: false,
                 timeOut: 2000,
             }
 
             @if(session('success'))
                 toastr.success("{{ session('success') }}", 'Success!', toastCofig);
             @endif
             @if(session('error'))
                 toastr.error("{{ session('error') }}", 'Error!',  toastCofig);
             @endif
  </script>
<script>
    function clearErrors() {
    $('.message').html('');
}
    let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
    clearErrors();
    $('#signup-form')[0].reset();
    $('#login-form')[0].reset();
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 10)
</script>
