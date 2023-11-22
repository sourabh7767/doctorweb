<!doctype html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Built Better</title>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="{{ asset('css/web/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/web/custom.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/web/responsive.css') }}" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
  <link rel="stylesheet" href="{{ asset('css/web/bootstrap-tagsinput.css') }}">
</head>

<body class="bg">
    <!-- Start Header Section -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-end">
                    <div class="dropdown menuDropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="las la-bars"></i></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#"> <i class="las la-edit"></i> <span>Update Profile</span></a>
                          <a class="dropdown-item" href="#"><i class="las la-key"></i> <span>Change Password </span></a>
                          <a class="dropdown-item" href="{{route('userLogout')}}"><i class="las la-sign-out-alt"></i><span>Logout</span></a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Section -->
    <!-- Start SecondRow -->
    <section class="midSec mt-3">
        <div class="container-fluid">
            <!-- Start Buttons Row -->
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="d-block d-md-flex align-items-center">
                        <div class="btnGroup w-100 me-2">
                            <button class="secondryOutline active"><span class="btnText">Kruki</span> <span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Imovax Ir Velkta </span><span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Imovax atsakas </span><span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Alkohols izelpa </span><span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Alkohols asinis</span> <span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">MRI</span> <span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">CTg</span> <span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Fizikaias proc. </span><span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Rehabillitologa konsult. </span><span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Asins anazitzes</span> <span class="crossValue"><i class="las la-times"></i></span></button>
                            <button class="secondryOutline"><span class="btnText">Traumatologa konsult. </span><span class="crossValue"><i class="las la-times"></i></span></button>
                        </div>
                        <span class="addOnBtn m-auto m-md-0 mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#addBtnModal">
                            <i class="las la-plus"></i>
                        </span>
                        <!-- Start AddBtn modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="addBtnModal" tabindex="-1" aria-labelledby="addBtnModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addBtnModalLabel">Create Button</h5>
                                            <p class="modal-subtext">Edit field and create fast access template</p>
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addBtnForm">
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="customControlInputs" id="" rows="11" placeholder="Rekomendjdjas..."></textarea>
                                                </div>
                                                <h4 class="modal-title mt-3">Choose Label</h4>
                                                <div class="labelContainer mt-3 mb-3    ">
                                                    <div class="form-check form-check-inline ps-0">
                                                        <input type="radio" id="test1" name="radio-group" checked>
                                                        <label for="test1">First Label</label>
                                                    </div>
                                                    <div class="form-check form-check-inline ">
                                                        <input type="radio" id="test2" name="radio-group">
                                                        <label for="test2">S Label</label>
                                                    </div>
                                                    <div class="form-check form-check-inline ">
                                                        <input type="radio" id="test3" name="radio-group">
                                                        <label for="test3">Third Label</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="secondryBtn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End AddBtn modal -->
                    </div>
                </div>
                <div class="col-md-6  mb-3 mb-md-0">
                    <div class="d-flex align-items-center">
                        <span class="addOnBtn d-none"><i class="las la-plus"></i></span>
                        <div class="btnGroup">
                            <button class="secondryOutline">
                                <span class="btnText">Bericox 90mg</span>
                                <span class="crossValue"><i class="las la-times"></i>
                            </button>
                            <button class="secondryOutline"><span class="btnText">Co-Codamol 500/30mg </span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Amoxicillin/Clavulanic 875 mg/125 mg</span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Dolmen 25 mg</span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Neiromidine 20mg</span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Neirontin 300mg</span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Aceclofenac 100mg</span><span class="crossValue"><i class="las la-times"></i></button>
                            <button class="secondryOutline"><span class="btnText">Duracef 500 mg</span><span class="crossValue"><i class="las la-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Buttons Row -->
            <!-- Start Second Row -->
            <div class="row mt-3">
                <!-- Start LeftSection -->
                <div class="col-md-5 col-lg-5 mb-3 mb-md-0">
                    <div class="leftCard">
                        <ul class="leftCardMenus">
                            <li class="leftCardItems row">
                                <h6 class="cardItemHead col-md-4">Side</h6>
                                <p class="cardItemValue col-md-8 ">
                                    <span class="active">left</span>
                                    <span>right</sapan>
                                </p>
                            </li>
                            <li class="leftCardItems row">
                                <h6 class="cardItemHead col-md-4">Apvidus</h6>
                                <p class="cardItemValue col-md-8">
                                    <span>Roka</span>
                                    <span>Kaja</span>
                                    <span>Kruskurvis</span>
                                    <span>Mugurkauis</span>
                                    <span>Krusti</span>
                                </p>
                            </li>
                            <li class="leftCardItems row">
                                <h6 class="cardItemHead col-md-4">Trauma</h6>
                                <p class="cardItemValue col-md-8">
                                    <span>Luzums</span>
                                    <span>Sasitums</span>
                                    <span>Susticpums</span>
                                    <span>Mezgijums</span>
                                    <span>Bruce</span>
                                    <span>Toska</span>
                                    <span>Amputacija</span>
                                    <span>Cits</span>
                                </p>
                            </li>
                            <li class="leftCardItemsr row">
                                <h6 class="cardItemHead col-md-4">DNL</h6>
                                <p class="cardItemValue col-md-8">
                                    <span>Atverta</span>
                                    <span>Nav</span>
                                    <span>nepiec.</span>
                                </p>
                            </li>
                        </ul>
                        <div class="leftBtmBtn mt-3 text-end">
                            <button class="clearBtn">Clear</button>
                        </div>
                        <span class="addOnBtn" data-bs-toggle="modal" data-bs-target="#addOnBtnModal"><i class="las la-plus"></i></span>
                        <!-- Start AddBtn modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="addOnBtnModal" tabindex="-1" aria-labelledby="addOnBtnLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addOnBtnLabel">Create Labels</h5>
                                            <p class="modal-subtext">Edit field and create fast access template</p>
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm">
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <textarea class="customControlInputs" id="" rows="11" placeholder="Rekomendjdjas..."></textarea>
                                                </div> -->
                                                <div class="u-tagsinput">
                                                    <input id="tagsInput" type="text" value="HTML5, CSS3, JavaScript, jQuery" data-role="tagsinput" class="customControlInputs">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="secondryBtn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End AddBtn modal -->
                    </div>
                </div>
                <!-- End LeftSection -->
                <!-- Start RightSection -->
                <div class="col-md-7 col-lg-7 mb-3 mb-md-0">
                   <div class="row">
                        <!-- Start RightMid Section -->
                        <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-5 mb-3 mb-xl-0">
                            <div class="bgContain midContainer">
                                <form class="">
                                    <div class="form-group">
                                        <input type="search" class="formControl" placeholder="Maklot poc nosaukuma">
                                    </div>
                                </form>
                                <span class="addOnBtn mt-2 mb-1 m-auto" data-bs-toggle="modal" data-bs-target="#createTemp"><i class="las la-plus"></i></span>
                                <!-- Start RightMid Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="createTemp" tabindex="-1" aria-labelledby="createTempLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header d-block border-0 p-0 mb-2">
                                                <h5 class="modal-title" id="createTempaLabel">Create Trauma Template</h5>
                                                <p class="modal-subtext">Edit fields and create fast access template</p>
                                            </div>
                                            <div class="modal-body p-0">
                                                <form class="addBtnForm">
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="12" placeholder="Rekomendjdjas..."></textarea>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="12" placeholder="Rekomendjdjas..."></textarea>
                                                    </div>
                                                    <div class="u-tagsinput mb-2">
                                                        <input id="tagsInput" type="text" value="HTML5, CSS3, JavaScript, jQuery" data-role="tagsinput" class="customControlInputs">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0 p-0">
                                            <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="secondryBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End RightMid Modal -->
                                <div class="midContainerCard">
                                    <div class="cardArea active">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">My template name and diagnosis</h6>
                                            <p class="description">my template description</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                    <div class="cardArea">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End RightMid Section -->
                        <!-- Start RightofLeft Section -->
                        <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-7 mb-3 mb-xl-0">
                            <form class="detailsForm">
                                <div class="dg field">
                                    <input type="text" placeholder="Diagnoze..." class="bg-transparent border-0 me-2 w-100">
                                    <button class="secondryBtn">Copy</button>
                                </div>
                                <div class="obj field">
                                    <textarea class="me-2" placeholder="Objektīvās atradnes..." rows="6"></textarea>
                                    <button class="secondryBtn">Copy</button>
                                </div>
                                <div class="rek field">
                                    <textarea class="me-2" placeholder="Rekomendācijas..." rows="10"></textarea>
                                    <button class="secondryBtn">Copy</button>
                                </div>
                            </form>
                        </div>
                        <!-- End RightofLeft Section -->
                   </div>
                </div>
                <!-- End RightSection -->
            </div>
            <!-- End Second Row -->
        </div>
    </section>
    <!-- End SecondRow -->
 <!-- Start Js -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
 <script src="{{ asset('js/web/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('js/web/scripts.js') }}"></script>
 
 <script src="{{ asset('js/web/bootstrap-tagsinput.min.js') }}"></script>
 
 <script>
    $(document).ready(function() {
	$('.btnText').on('click', function() {
	  // Toggle the 'active' class on the parent button
	  $(this).parent('.secondryOutline').toggleClass('active');
	});

	$('.crossValue').on('click', function() {
	  // Add your delete logic here
	  alert("Are you sure you want to remove?");
	});
  });
 </script>
 <!-- End Js -->
 </body>
 </html>
