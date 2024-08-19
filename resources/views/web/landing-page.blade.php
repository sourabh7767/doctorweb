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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Title -->
    <title>Homepage</title>
</head>

<body>

    <header id="header" class="sticky">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container">
                <a class="navbar-brand" href="#">Morris.</a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbarNav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
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
                            <a class="nav-link" href="#pricing">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.index')}}">Login</a>
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
                            <img src="{{asset("landing-page/img/heroMobile.png")}}" alt="MobileImg" class="heroMobileImg">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h1 class="heroHeading">
                                Simple and Powerful
                            </h1>
                            <p class="description my-4">
                                There are many variations of passages of Lorem Ipsum
                                available, but the majority have suffered alteration
                            </p>
                            <div class="d-flex flex-md-row flex-column align-md-items-center align-items-start gap-4">
                                <a href="" class="primaryBtn text-uppercase">Download Now</a>
                                <a href="" class="watchVideo" data-bs-toggle="modal" data-bs-target="#watchVideo">
                                    <i class="fas fa-play-circle"></i>
                                    <span>Watch video</span>
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
                        <img src="{{asset("landing-page/img/brands/1.png")}}" alt="HoolaHire" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/2.png")}}" alt="Patel" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/3.png")}}" alt="Lioit" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/4.png")}}" alt="Whitney" class="brandImg">
                    </div>
                    <div class="item">
                        <img src="{{asset("landing-page/img/brands/5.png")}}" alt="Panax" class="brandImg">
                    </div>
                </div>
            </div>
        </section>
        <!-- End BrandsSlider Section -->

        <!-- Start AboutUs Section -->
        <section class="" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="aboutContent">
                            <i class="fa-brands fa-wordpress aboutIcons"></i>
                            <h4 class="subHeading">Modern</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="1500">
                        <div class="aboutContent">
                            <i class="fa-solid fa-code aboutIcons"></i>
                            <h4 class="subHeading">Easy to customize</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="2000">
                        <div class="aboutContent">
                            <i class="fa-brands fa-soundcloud aboutIcons"></i>
                            <h4 class="subHeading">Light</h4>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod
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
                    <div class="col-sm-12 col-md-6" data-aos="fade-right" data-aos-duration="1200">
                        <img src="{{asset("landing-page/img/features.png")}}" alt="FeaturesMobile" class="featuresImg">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <h3 class="heading mb-3">Access tasks</h3>
                        <ul class="mt-5 featuresTask">
                            <li>
                                <h4 class="descriptionDark">Font awesome</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Placeat, eum. Minus nesciunt</p>
                            </li>
                            <li>
                                <h4 class="descriptionDark" style="color: #4B4B4C;">Bootstrap 4x</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Placeat, eum. Minus nesciunt</p>
                            </li>
                            <li>
                                <h4 class="descriptionDark" style="color: #4B4B4C;">Valid html</h4>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Placeat, eum. Minus nesciunt</p>
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
                            <div class="chart mb-5 mb-sm-0" data-percent="74.5">
                                <div class="chart-content">
                                <div class="chart-title">Burn</div>
                                <div class="chart-number">8,45</div>
                                <div class="line line-center"></div>
                                <div class="chart-type">Calories</div>
                                </div>
                            </div>
                            <div class="chart" data-percent="55.5">
                                <div class="chart-content">
                                <div class="chart-title">Active time</div>
                                <div class="chart-number">4:54</div>
                                <div class="line line-center"></div>
                                <div class="chart-type">Hours</div>
                                </div>
                            </div> 
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <h3 class="heading mb-4">Get more done</h3>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, atque
                            iure ex corrupti, architecto delectus accusamus suscipit minus dolorem quibusdam incidunt
                            culpa enim. Deserunt earum veniam temporibus excepturi fugiat dicta!
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
                    <div class="col-sm-12 col-md-7">
                        <div class="collaborateContent">
                            <div class="collaborateHead">
                                <h3 class="heading mb-2">Collaborate on shared tasks</h3>
                                <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas harum,
                                hic officiis commodi reprehenderit explicabo</p>
                            </div>
                            <ul class="row mt-5">
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fas fa-wifi collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fab fa-vine collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fab fa-wordpress collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fas fa-headphones collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fas fa-signal collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-sm-12 col-md-6 mb-5">
                                    <div class="d-flex gap-3">
                                        <i class="fas fa-flask collaborateIcons"></i>
                                        <div>
                                            <h4 class="descriptionDark">Clean design</h4>
                                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5" data-aos="fade-up" data-aos-duration="1200">
                        <img src="{{asset("landing-page/img/3-375x753.png")}}" alt="" class="collaborateImg">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Collaborate  Section -->
        <!-- Start ClientsSays Section -->
        <section class="" id="clients">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6 text-center">
                        <h3 class="heading mb-3">Clients says</h3>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6">
                        <div class="owl-carousel owl-theme client-carousel-js text-center">
                            <div class="item">
                                <img src="{{asset("landing-page/img/clients/1.jpg")}}" alt="" class="clientImg">
                                <h4 class="subHeading mt-3 mb-1">James Thornton</h4>
                                <p class="description">
                                    «Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias harum aperiam ea. Tempore
                                    cumque, debitis accusamus iusto beatae corporis illum quos illo itaque esse. Sapiente porro
                                    pariatur necessitatibu!
                                </p>
                            </div>
                            <div class="item">
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
                            </div>
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
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur laboriosam voluptate,
                            maiores iusto, distinctio officiis
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
        <section class="pricing" id="pricing">
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
        </section>
        <!-- End Pricing Section -->
        <!-- Start Subscribe Section -->
        <section class="subscribe bg-light">
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
        </section>
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
                        <span class="description">© 2016 Brett. All rights reserved by <a href="">Murren20</a></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- Start WatchVideo Modal -->
        <div class="modal fade flip-modal" id="watchVideo" tabindex="-1" aria-labelledby="watchVideoLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content flip">
                    <span class="position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: -30px;
                    right: 0;
                    color: #fff;
                    font-size: 20px; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                    <div class="modal-body px-0 py-0">
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/fwIxyDx8Dck?si=IxOhneW0ZIXccDlc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- End WatchVideo Modal -->
        <!-- Start ContactUs Modal -->
        <div class="modal fade" id="contactUs" tabindex="-1" aria-labelledby="contactUsLabel"
        aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title fs-2 fw-bold" id="contactUsLabel">Contact</h5>
                        <button type="button" class="btn-close position-absolute text-sm" data-bs-dismiss="modal" aria-label="Close" style="top: 20px; right: 20px; font-size: 12px; color: #4B4B4C;"></button>
                    </div>
                    <div class="modal-body">
                        <form class="contactForm">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Name*">
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email*">
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <textarea class="form-control" id="message-text" placeholder="Message*" rows="5"></textarea>
                                </div>
                            </div>
                            <input class="primaryBtn d-block mx-auto" type="submit" value="Send Request">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Start ContactUs Modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset("landing-page/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("landing-page/js/script.js")}}"></script>
    <script src="{{asset("landing-page/metter.js")}}"></script>
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