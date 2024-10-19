<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Font CDNs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <!-- Css CDNs -->
    <link rel="stylesheet" type="text/css" href="{{asset("landing-page/css/bootstrap.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("landing-page/css/custom.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("landing-page/css/responsive.css")}}">
    <!-- OwlCarousel CDNs -->
    <style>
        
        .loader{
        /* position: absolute; */
        z-index: 9999;
        height: 100%;
        }
        .lds-roller {
    display: inline-block;
    /* height: 64px; */
    /* width: 64px; */
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 999999;
}
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Title -->
    <title>Avacadokiwi</title>
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
</head>

<body>

    <header id="header" class="sticky">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container">
                <a class="navbar-brand" href="#"><img class="collaborateIcons" src="{{asset("landing-page/img/brands/avacadokiwi_logo3_png_bevel.png")}}" alt=""></a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbarNav align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clients">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="loginBtn" href="{{route('web.index')}}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main id="main">
        <!-- Start Hero Section -->
        <section class="" id="home">
            <div class="spce">
                <div class="container">
                    
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6">
                        <video class="pe-4" style="padding-top: 20px;" width="100%" height="365" loop autoplay muted playsinline>
                            <source src="{{asset("landing-page/video/homeSmall.webm")}}" type="video/mp4">
                            <!-- <source src="{{asset("landing-page/video/homeSmall.ogg")}}" type="video/ogg"> -->
                        </video>
                        </div>
                        <div class="col-sm-12 col-md-6" style="padding-left: 75px;">
                            <h1 class="heroHeading">
                                Simple, Precise and Powerful
                            </h1>
                            <p class="description my-4">
                                Best prescription tool available on the market. This web app is a selfstanding software
                                created for medical professionals to make everyday writing routine effortless.
                            </p>
                            <div class="d-flex flex-md-row flex-column align-md-items-center align-items-start gap-4">
                                <!-- <a href="" class="primaryBtn text-uppercase">Download Now</a> -->
                                <a href="" class="watchVideo" data-bs-toggle="modal" data-bs-target="#watchVideo" data-keyboard="false" data-backdrop="static"> 
                                    <i class="fas fa-play-circle"></i>
                                    <span>Watch Tutorial    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero Section -->

        <!-- Start BrandsSlider Section -->
        <section class="brandSliders bg-light">
            <div class="container">
                <div class="owl-carousel owl-theme brandOwl-carousel-js">
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/tos.png")}}" alt="HoolaHire" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/orto.png")}}" alt="Patel" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/jurmalas.jpg")}}" alt="Lioit" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/aslimn.jpg")}}" alt="Panax" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/pskus.png")}}" alt="Panax" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/315413793_146115781508284_6223348106729794721_n.jpg")}}" alt="Panax" class="brandImg">
                    </div>
                </div>
            </div>
        </section>
        <!-- End BrandsSlider Section -->

        <!-- Start AboutUs Section -->
        <section class="" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1000">
                        <div class="aboutContent">
                            <img src="{{asset("landing-page/img/intuitive.png")}}" alt="aboutImg" class="aboutImg">
                            <h4 class="subHeading">Intuitive</h4>
                            <p class="description">Very simple and straight forward design as well as well structured
                                tutorial will make Your start carefree.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="1500">
                        <div class="aboutContent">
                            <img src="{{asset("landing-page/img/customize.png")}}" alt="" class="aboutImg">
                            <h4 class="subHeading">Easy to customize</h4>
                            <p class="description">You can add any buttons, any templates, 
                                create new template groups and tags in Your work area.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="2000">
                        <div class="aboutContent">
                            <img src="{{asset("landing-page/img/1000.png")}}" alt="" class="aboutImg">
                            <h4 class="subHeading">1000+ templates</h4>
                            <p class="description">Big library of templates ready to be used right now!
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-duration="2000">
                        <div class="aboutContent">
                            <img src="{{asset("landing-page/img/free.png")}}" alt="" class="aboutImg">
                            <h4 class="subHeading">Free </h4>
                            <p class="description">Its completely free to use! No hidden costs !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End AboutUs Section -->
        <!-- Start Features Section -->
        <section class="bg-light" id="features">
          <div class="spce">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-7" data-aos="fade-right" data-aos-duration="1200">
                    <video class="problemVideo" width="100%" height="270" loop autoplay muted playsinline>
                            <source src="{{asset("landing-page/video/featureVideo.webm")}}" type="video/mp4">
                            <!-- <source src="{{asset("landing-page/video/homeSmall.ogg")}}" type="video/ogg"> -->
                        </video>
                    </div>
                        <div class="col-sm-12 col-md-5">
                            <h3 class="heading mb-3">Problems we solve :</h3>
                            <ul class="mt-5 featuresTask">
                                <li>
                                    <h4 class="descriptionDark">Precision</h4>
                                    <ul>
                                        <li class="description mb-0">- Fast and efortless access to the precise
                                            prescription template You need</li>
                                    </ul>
                                </li>
                                <li>
                                    <h4 class="descriptionDark" style="color: #4B4B4C;">Customization</h4>
                                    <ul>
                                        <li class="description mb-0">- Template creation/customization.</li>
                                        <li class="description mb-0">- Fast acess button creation/customization</li>
                                    </ul>

                                </li>
                                <li>
                                    <h4 class="descriptionDark" style="color: #4B4B4C;">Acessibility</h4>
                                    <ul>
                                        <li class="description mb-0">- Acess from any computer that has internet on it.
                                        </li>
                                        <li class="description mb-0">- No need to carry folders, notes, .doc files, .txt
                                            files , everything is in one place</li>
                                    </ul>
                                </li>
                                <li>
                                    <h4 class="descriptionDark" style="color: #4B4B4C;">Best Workflow</h4>
                                    <ul>
                                        <li class="description mb-0">- You are not dependant on any hospital provided
                                            software</li>
                                        <li class="description mb-0">- Have the same workflow everywhere You go </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
          </div>
        </section>
        <!-- End Features Section -->
        <!-- Start GetMore Section -->
        <section class="getDone" id="">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                            <div class="chart mb-5 mb-sm-0" data-percent="75">
                                <div class="chart-content">
                                <div class="chart-title"></div>
                                <div class="chart-number">15</div>
                                <div class="line line-center"></div>
                                <div class="chart-type">min</div>
                                </div>
                            </div>
                            <div class="chart" data-percent="5">
                                <div class="chart-content">
                                <div class="chart-title"></div>
                                <div class="chart-number">10</div>
                                <div class="line line-center"></div>
                                <div class="chart-type">seconds</div>
                                </div>
                            </div> 
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <h3 class="heading mb-4">Get more done</h3>
                        <p class="description">On Average one prescription takes around 10-15 minutes to be created.
                            With this App You can cut down this time to literally <b>couple of seconds.</b>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End GetMore Section -->
        <!-- Start Collaborate  Section -->
        <section class="collaborate bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6">
                        <div class="collaborateContent">
                            <div class="collaborateHead">
                                <h3 class="heading mb-2">Apps features</h3>
                                <p class="description">Sign up for AvacadoKiwi and explore the best features Yourself
                                </p>
                            </div>
                            <ul class="row mt-5">
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                     <img src="{{asset("landing-page/img/account.png")}}" alt="" class="collaborateIcons">                                        <div>
                                            <h4 class="descriptionDark">Your own account </h4>
                                            <p class="description">Your own playground , customize it as You would
                                                customize Your own working desk</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <img src="{{asset("landing-page/img/stroage.png")}}" alt="" class="collaborateIcons">
                                        <div>
                                            <h4 class="descriptionDark">Universal storage </h4>
                                            <p class="description">Store Your Templates where you can acess them in the
                                                order You are used to
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <img src="{{asset("landing-page/img/Library.png")}}" alt="" class="collaborateIcons">
                                        <div>
                                            <h4 class="descriptionDark">Library </h4>
                                            <p class="description">You will find biggest prescription library for any
                                                medical professional.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <img src="{{asset("landing-page/img/fastAccessBtn.png")}}" alt="" class="collaborateIcons">
                                        <div>
                                            <h4 class="descriptionDark">Fast acess buttons </h4>
                                            <p class="description">Write sophisticated sentences in a click of a
                                                preprogrammed button
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                    <img src="{{asset("landing-page/img/free.png")}}" alt="" class="collaborateIcons">
                                        <div>
                                            <h4 class="descriptionDark">Free </h4>
                                            <p class="description">Its free to use, seriously </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                        <video class="featureVideo" style="max-width: 100%;" width="100%" height="450" loop autoplay muted playsinline>
                            <source src="{{asset("landing-page/video/problemsVideo.webm")}}" type="video/mp4">
                            <!-- <source src="{{asset("landing-page/video/homeSmall.ogg")}}" type="video/ogg"> -->
                        </video>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Collaborate  Section -->
        <!-- Start ClientsSays Section -->
        <section class="" id="clients">
            <div class="container">
                
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6">
                        <div class="owl-carousel owl-theme client-carousel-js text-center">
                            <div class="item">
                                <img src="{{asset("landing-page/img/clients/m-salnikovs.png")}}" alt="" class="clientImg">
                                <h4 class="subHeading mt-3 mb-1">M.Saļņikovs</h4>
                                <p class="description">
                                    It really makes my everyday tasks so much easier.
                                    Working in emergency department amount of patients can be overwhelming and writing
                                    prescriptions, objective findings, examination results for each and every patient is
                                    not a quick task. This app allows me to work 10x faster resulting happy patients,
                                    bigger patient flow, precise and thought through recommendations on a click of a
                                    mouse button , Also a library of my collegues recommendations is very helpful.
                                </p>
                            </div>
                            {{-- <div class="item">
                                <img src="{{asset("landing-page/img/clients/2.jpg")}}" alt="" class="clientImg">
                                <h4 class="subHeading mt-3 mb-1">James Thornton</h4>
                                <p class="description">
                                    «Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias harum aperiam ea. Tempore
                                    cumque, debitis accusamus iusto beatae corporis illum quos illo itaque esse. Sapiente porro
                                    pariatur necessitatibu!
                                </p>
                            </div>
                            <div class="item">
                                <img src="{{asset("landing-page/img/clients/3.jpg")}}" alt="" class="clientImg">
                                <h4 class="subHeading mt-3 mb-1">James Thornton</h4>
                                <p class="description">
                                    «Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias harum aperiam ea. Tempore
                                    cumque, debitis accusamus iusto beatae corporis illum quos illo itaque esse. Sapiente porro
                                    pariatur necessitatibu!
                                </p>
                            </div>
                            <div class="item">
                                <img src="{{asset("landing-page/img/clients/1.jpg")}}" alt="" class="clientImg">
                                <h4 class="subHeading mt-3 mb-1">James Thornton</h4>
                                <p class="description">
                                    «Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias harum aperiam ea. Tempore
                                    cumque, debitis accusamus iusto beatae corporis illum quos illo itaque esse. Sapiente porro
                                    pariatur necessitatibu!
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End ClientsSays Section -->
        <!-- Start ContactUs Section -->
        <section class="contactUs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h3 class="heading">Want to Learn <br>more?</h3>
                    </div>
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <p class="description text-white">
                            Feel free to cantact us regarding any question, suggestion or help , we will be glad to hear
                            from You !
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <a class="primaryBtn" data-bs-toggle="modal" data-bs-target="#contactUs">Contact us</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End ContactUs Section -->
        <!-- Start Pricing Section -->
        <!-- <section class="pricing" id="pricing">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-8 text-center">
                        <h3 class="heading mb-3">Pricing</h3>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, maxime tempora quaerat ratione iste. Nulla excepturi voluptatem error repellat.
                        </p>
                    </div>
                </div>
               <div class="spaceTop">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="planCard">
                            <h2 class="heroHeading mb-4"><span class="pricingDolr">$</span> 29</h2>
                            <h6 class="planTitle">Beginner Plan</h6>
                            <hr>
                            <ul class="planDetails">
                                <li>First premium feature</li>
                                <li>Second premium one goes here</li>
                                <li>Third premium feature here</li>
                                <li>Final premium feature</li>
                            </ul>
                            <button class="primaryBtn">Select Plan</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="planCard active">
                            <h2 class="heroHeading mb-4"><span class="pricingDolr">$</span> 39</h2>
                            <h6 class="planTitle">Standard Plan</h6>
                            <hr>
                            <ul class="planDetails">
                                <li>First premium feature</li>
                                <li>Second premium one goes here</li>
                                <li>Third premium feature here</li>
                                <li>Final premium feature</li>
                            </ul>
                            <button class="primaryBtn">Select Plan</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="planCard">
                            <h2 class="heroHeading mb-4"><span class="pricingDolr">$</span> 49</h2>
                            <h6 class="planTitle">Premium Plan</h6>
                            <hr>
                            <ul class="planDetails">
                                <li>First premium feature</li>
                                <li>Second premium one goes here</li>
                                <li>Third premium feature here</li>
                                <li>Final premium feature</li>
                            </ul>
                            <button class="primaryBtn">Select Plan</button>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </section> -->
        <!-- End Pricing Section -->
        <!-- Start Subscribe Section -->
        <!-- <section class="subscribe bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h3 class="heading mb-3">Subscribe</h3>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        </p>
                        <div class="input-group mt-5 subscribeInputGroup">
                            <input type="text" class="form-control subscribeControl" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text text-uppercase" id="basic-addon2">
                                <button class="primaryBtn">
                                    <i class="fa-solid fa-envelope me-2"></i> 
                                    <span>Subscribe </span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Subscribe Section -->
    </main>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="socials">
                        <li>
                            <a href="javscript:void(0);" class="socialIcons">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javscript:void(0);" class="socialIcons">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javscript:void(0);" class="socialIcons">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javscript:void(0);" class="socialIcons">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="copyright mt-2">
                        <span class="description">© 2024 . All right reserved by <a href="">salnicoff</a></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- Start WatchVideo Modal -->
        <div class="modal fade flip-modal" id="watchVideo" tabindex="-1" aria-labelledby="watchVideoLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content flip">
                    <span class="position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: -30px;
                    right: 0;
                    color: #fff;
                    font-size: 20px; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                    <div class="modal-body px-0 py-0" style="height: 500px;">
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/MlPBbIZ6c1o" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- End WatchVideo Modal -->
        <!-- Start ContactUs Modal -->
        {{-- <div class="modal fade" id="contactUs" tabindex="-1" aria-labelledby="contactUsLabel"
        aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title fs-2 fw-bold" id="contactUsLabel">Contact</h5>
                        <button type="button" class="btn-close position-absolute text-sm" data-bs-dismiss="modal" aria-label="Close" style="top: 20px; right: 20px; font-size: 12px; color: #4B4B4C;"></button>
                    </div>
                    <div class="modal-body">
                        <form class="contactForm" action="{{route("contact-us")}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid error @enderror" id="name" name="name" placeholder="Name*">
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="email" class="form-control @error('name') is-invalid error @enderror" id="email" name="email" placeholder="Email*">
                                    @error('email')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <textarea class="form-control @error('name') is-invalid error @enderror" id="message-text" name="message" placeholder="Message*" rows="5"></textarea>
                                    @error('message')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <input class="primaryBtn d-block mx-auto" type="submit" value="Send Request">
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="modal fade" id="contactUs" tabindex="-1" aria-labelledby="contactUsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title fs-2 fw-bold" id="contactUsLabel">Contact</h5>
                        <button type="button" class="btn-close position-absolute text-sm" data-bs-dismiss="modal"
                            aria-label="Close" style="top: 20px; right: 20px; font-size: 12px; color: #4B4B4C;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="spinner-border lds-roller loderGroup d-none" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        <form class="contactForm" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name*">
                                    <span class="invalid-feedback" id="error-name"></span>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email*">
                                    <span class="invalid-feedback" id="error-email"></span>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <textarea class="form-control" id="message-text" name="message" placeholder="Message*" rows="5"></textarea>
                                    <span class="invalid-feedback" id="error-message"></span>
                                </div>
                            </div>
                            <input class="primaryBtn d-block mx-auto" type="submit" value="Send Request">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Start ContactUs Modal -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset("landing-page/js/bootstrap.bundle.min.js")}}"></script>
   
    <script src="{{asset("landing-page/js/script.js")}}"></script>
    <script src="{{asset("landing-page/metter.js")}}"></script>
    <script>
        $(document).ready(function () {
        $(document).on('click',".btn-close",function(e){
            $('#name').removeClass('is-invalid');
            $('#error-name').text('');
            $('#email').removeClass('is-invalid');
            $('#error-email').text('');
            $('#message-text').removeClass('is-invalid');
            $('#error-message').text('');
        
        })
            $('.contactForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission
                let formData = $(this).serialize(); // Serialize the form data
                $(".loderGroup").removeClass("d-none");
                $.ajax({
                    type: 'POST',
                    url: '{{ route("contact-us") }}', // Laravel route for form submission
                    data: formData,
                    success: function (response) {
                        // alert()
                        $(".loderGroup").addClass("d-none");
                        console.log(response);
                        
                        if (response.success) {
                            setTimeout(function() {
                                alert(response.message);
                                // Code to execute after 1 second
                            }, 1000);
                            $('#contactForm')[0].reset(); // Reset the form
                            var contactModal = bootstrap.Modal.getInstance($('#contactUs')); // Get the modal instance
                            contactModal.hide(); // Hide the modal
                            // alert(response.message);
                        }
                    },
                    error: function (xhr) {
                        // Clear previous errors
                        $(".loderGroup").removeClass("d-none");
                        $('.invalid-feedback').text('');
                        $('.form-control').removeClass('is-invalid');
                        $(".loderGroup").addClass("d-none");
                        if (xhr.status === 422) {
                            $(".loderGroup").addClass("d-none");
                            let errors = xhr.responseJSON.errors;
    
                            if (errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#error-name').text(errors.name[0]);
                            }
                            if (errors.email) {
                                $('#email').addClass('is-invalid');
                                $('#error-email').text(errors.email[0]);
                            }
                            if (errors.message) {
                                $('#message-text').addClass('is-invalid');
                                $('#error-message').text(errors.message[0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
    {{-- <script>
         $(window).scroll( function(){

            $('.chart').each( function(i){
                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                if( bottom_of_window > bottom_of_object ){
                    $('.chart').easyPieChart({
                    scaleColor:false,
                    trackColor:'#ebedee',
                    barColor: function(percent) {
                        var ctx = this.renderer.getCtx();
                        var canvas = this.renderer.getCanvas();
                        var gradient = ctx.createLinearGradient(0,0,canvas.width,0);
                            gradient.addColorStop(0, "#6442c7");
                            gradient.addColorStop(1, "#bea7ff");
                        return gradient;
                    },
                    lineWidth:6,
                    lineCap: false,
                    rotate:180,
                    size:180,
                    animate:1000
                    });
                }
            }); 
            });


            $('.js-play').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            }
            });
    </script> --}}
</body>

</html>