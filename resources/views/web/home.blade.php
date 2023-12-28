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
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/web/bootstrap-tagsinput.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg">
    <div class="loader " style="display: none;">
        <div class="spinner-grow text-primary spinner-border-xl" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
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
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateProfileModal" id="getProfileData"> <i class="las la-edit"></i> <span>Update Profile</span></a>
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePasswordModel"><i class="las la-key"></i> <span>Change Password </span></a>
                          <a class="dropdown-item" href="{{route('userLogout')}}"><i class="las la-sign-out-alt"></i><span>Logout</span></a>
                        </div>
                      </div>
                      {{-- {{dd($user->full_name)}} --}}
                        <!-- Start UpdateProfile Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form  class="updateProfileForm" id="UpdateProfileForm" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="previewContainer text-center">
                                                        <div class="previewDivArea">
                                                            <img src="" id="preview" class="img-fluid" alt="" style="background: url('https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png');">
                                                            <div class="previewInput">
                                                                <label for="profileImage" class="profileEditLabel">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </label>
                                                                <input type="file" class="form-control d-none" id="profileImage" accept="" oninput="previewImage(this)" name="profileImage" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="labelTxt text-start mb-1" id="updateProfileName">Enter name</label>
                                                    <input type="text" id="updateFull_name" placeholder="Enter your name..." class="customControlInputs" name="full_name" value="">
                                                </div>  
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal" onclick="clearForm()">Close</button>
                                        <button type="button" class="secondryBtn"  id="submitUpdateProfile">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End UpdateProfile modal -->
                        <!-- Start ChangePassword Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="changePasswordModel" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex flex-column align-items-start border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="changePasswordModel">Change Your Password</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="changePasswordForm" id="changePasswordForm">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <input type="password" value="" placeholder="Current Password..." class="customControlInputs" name="change_old_pass" id="change_old_pass">
                                                    <span id="change_old_pass_eye" class="fa fa-fw fa-eye field_icon"></span> 
                                                </div>  
                                                <div class="form-group mb-2">
                                                    <input type="password" value="" placeholder="New Password Password..." class="customControlInputs" name="change_new_pass" id="change_new_pass">
                                                    <span id="change_new_pass_eye" class="fa fa-fw fa-eye field_icon"></span> 
                                                </div>  
                                                <div class="form-group mb-2">
                                                    <input type="password" value="" placeholder="Re-enter New Password Password..." class="customControlInputs" name="change_confirm_pass" id="change_confirm_pass">
                                                    <span sdd="change_confirm_pass_eye" class="fa fa-fw fa-eye field_icon"></span> 
                                                </div>  
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal" id="clearChangePasswordForm">Close</button>
                                        <button type="button" class="secondryBtn" id="changePasswordButton">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End ChangePassword modal -->
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Section -->
    <!-- Start SecondRow -->
    <section class="midSec mt-3">
        <div class="container-fluid">
            <!-- Start Buttons Row -->
            <!-- Start Buttons Row -->
            <div class="main-wrapper">
                <div class="buttons-wrapper">
                    <div class="btnGroup w-100 me-2 buttonAppend">
                        @foreach ($buttons as $button)
                        <div class="cardItemValue" id="cardItemValueButton_{{@$button->id}}">
                            <span class="tag tag-data" data-button-position="{{$button->place}}" data-button-id="{{$button->id}}">{{$button->title}}
                            </span>
                            <span class="crossValue buttondeleteCrose" data-button-id="{{ @$button->id }}"><i class="las la-times"></i></span>
                        </div>
                        {{-- <button class="secondryOutline" data-button-position="{{$button->place}}" data-button-id="{{$button->id}}"><span class="btnText">{{$button->title}}</span> <span class="crossValue buttondeleteCrose"><i class="las la-times"></i></span></button> --}}
                        @endforeach
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
                                        {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                    </div>
                                    <div class="modal-body p-0">
                                        <form class="addBtnForm" id="AddButtonForm">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="title">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="customControlInputs" id="" rows="11" placeholder="Rekomendjdjas..." name="description"></textarea>
                                            </div>
                                            <h4 class="modal-title mt-3">Choose Label</h4>
                                            <div class="labelContainer mt-3 mb-3    ">
                                                <div class="form-check form-check-inline ps-0">
                                                    <input type="radio" id="test1" value="{{App\Models\Button::First_Label}}" name="place" checked>
                                                    <label for="test1">First Label</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input type="radio" id="test2" value="{{App\Models\Button::S_LABLE}}" name="place">
                                                    <label for="test2">S Label</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input type="radio" id="test3" value="{{App\Models\Button::THIRD_LABLE}}" name="place">
                                                    <label for="test3">Third Label</label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0 p-0">
                                    <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="secondryBtn" id="saveButtons">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End AddBtn modal -->
                </div>
            </div>
            <!-- End Buttons Row -->
            <!-- End Buttons Row -->
            <!-- Start Second Row -->
            <div class="row mt-3">
                <!-- Start LeftSection -->
                <div class="col-md-5 col-lg-5 mb-3 mb-md-0">
                    <div class="leftCard">
                        <ul class="leftCardMenus" id="UlTags">
                            @foreach ($customSearchObj as $item)
                            <li class="leftCardItems row" {{@$item->id}}>
                                <h6 class="cardItemHead col-md-4">{{@$item->title}}</h6>
                                <div class="col-md-8">
                                @foreach ($item->customTags as $tag)
                                    <div class="cardItemValue" id="cardItemValueTag_{{@$tag->id}}">
                                            <span class="tag tagTitle tags" data-tag="{{ @$tag->tag }}" data-type="true" data-id="{{ @$tag->id }}">{{@$tag->tag}} 
                                            </span>
                                            <span class="crossValue crossValue1 customtagdelete" data-id="{{ @$tag->id }}"><i class="las la-times"></i></span>
                                    </div>
                                @endforeach
                                </div>
                            </li>
                            @endforeach
                           
                        </ul>
                        <span class="addOnBtn mt-5" data-bs-toggle="modal" data-bs-target="#addOnBtnModal"><i class="las la-plus"></i></span>
                        <div class="leftBtmBtn mt-3 text-end">
                            <button class="clearBtn" id="removeAllData">Clear</button>
                        </div>
                        
                        <!-- Start AddBtn modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="addOnBtnModal" tabindex="-1" aria-labelledby="addOnBtnLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addOnBtnLabel">Create Labels</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm" id="searchableTags">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="title">
                                                </div>
                                                <div class="u-tagsinput">
                                                    <input id="tagsInput" type="text" value="" data-role="tagsinput" class="customControlInputs" name="tags">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="secondryBtn" id="addLableSubmit">Save</button>
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
                                        <input type="search" class="formControl" placeholder="Maklot poc nosaukuma" id="searchInput">
                                    </div>
                                </form>
                                <span class="addOnBtn mt-2 mb-1 m-auto" data-bs-toggle="modal" data-bs-target="#createTemp"><i class="las la-plus"></i></span>
                                <!-- Start RightMid Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="createTemp" tabindex="-1" aria-labelledby="createTempLabel" aria-hidden="true" data-bs-backdrop="static" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header d-block border-0 p-0 mb-2">
                                                <h5 class="modal-title" id="createTempaLabel">Create Trauma Template</h5>
                                                <p class="modal-subtext">Edit fields and create fast access template</p>
                                            </div>
                                            <div class="modal-body p-0">
                                                <form class="addBtnForm" id="addPrescriptionForm">
                                                    @csrf
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Name..." class="customControlInputs" name="name">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Description..." class="customControlInputs" name="description">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="diagn">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="6" placeholder="Rekomendjdjas..." name="objective"></textarea>
                                                        <div id="prescription-objective-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="6" placeholder="Rekomendjdjas..." name="recomend"></textarea>
                                                        <div id="prescription-recomend-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="u-tagsinput mb-2">
                                                        <input id="tagsInput" placeholder="Tags" type="text" value="" data-role="tagsinput" class="customControlInputs" name="tags">
                                                        <div id="prescription-tags-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0 p-0">
                                            <button type="button" class="clearBtn" data-bs-dismiss="modal" onclick="clearErrors();">Close</button>
                                            <button type="button" class="secondryBtn" id="submitPrescription" >Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End RightMid Modal -->
                                <div class="midContainerCard">
                                    {{-- <div class="cardArea active">
                                        <div class="cardBody">
                                            <h6 class="titleTxt">L03.0 Lb. plaukstas I pirksta panaricijs</h6>
                                            <p class="description">Panaricijs lb. plaukstas I pirksta</p>
                                        </div>
                                        <span class="crossValue"><i class="las la-times"></i></span>
                                    </div> --}}
                                    <div id="searchResults"></div>
                                    <div class="modal fade" id="editPrescription" tabindex="-1" aria-labelledby="editPrescriptionLabel" aria-hidden="true" data-bs-backdrop="static" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block border-0 p-0 mb-2">
                                                    <h5 class="modal-title" id="createTempaLabel">Update Trauma Template</h5>
                                                    <p class="modal-subtext">Edit fields and create fast access template</p>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <form class="addBtnForm" id="EdidPrescriptionForm">
                                                        @csrf
                                                        <input type="hidden" name="prescreprion_id" id="prescreprionId">
                                                        <input type="hidden" name="user_id" id="UserId">
                                                        <input type="hidden" name="tag_ids" id="tagIds">
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Name..." class="customControlInputs" name="name" id="edit_name">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Description..." class="customControlInputs" name="description" id="edit_description">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="diagn" id="edit_diagn">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            {{-- <input type="text" name="objective" class="customControlInputs form-control" id="edit_objective" style="height: 100px;"> --}}
                                                            <textarea class="customControlInputs" id="" rows="6" placeholder="Rekomendjdjas..." name="objective" id="edit_objective"></textarea>
                                                            <div id="prescription-objective-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            {{-- <input type="text" name="recomend" class="customControlInputs form-control" id="edit_recomend" style="height: 100px;"> --}}
                                                            <textarea class="customControlInputs" id="" rows="6" placeholder="Rekomendjdjas..." name="recomend" id="edit_recomend"></textarea>
                                                            <div id="prescription-recomend-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="u-tagsinput mb-2">
                                                            <input id="tagsInputprescreption" type="text" value="" data-role="tagsinput" class="presccreption form-control" name="tags">
                                                            <div id="prescription-tags-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer border-0 p-0">
                                                <button type="button" class="clearBtn" data-bs-dismiss="modal" onclick="clearErrors();">Close</button>
                                                <button type="button" class="secondryBtn" id="submitEditPrescription" >Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End RightMid Section -->
                        <!-- Start RightofLeft Section -->
                        <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-7 mb-3 mb-xl-0">
                            <form class="detailsForm">
                                <div class="dg field">
                                    <textarea placeholder="Diagnoze..." class="me-2" id="to_diagn" rows="1"></textarea>
                                    <button class="secondryBtn copy" data-target-id="to_diagn"  type="button">Copy</button>
                                </div>
                                <div class="obj field">
                                    <textarea class="me-2 " placeholder="Objektīvās atradnes..." rows="10" id="to_objective"></textarea>
                                    <button class="secondryBtn copy"  data-target-id="to_objective" type="button">Copy</button>
                                </div>
                                <div class="rek field">
                                    <textarea class="me-2 " placeholder="Rekomendācijas..." rows="10" id="to_recomend"></textarea>
                                    <button class="secondryBtn copy"  data-target-id="to_recomend" type="button">Copy</button>
                                </div>
                            </form>
                        </div>
                        <!-- End RightofLeft Section -->
                   </div>
                </div>
                <!-- End RightSection -->
            </div>
            <!-- <div id="loader" style="display: none;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div> -->
            <!-- End Second Row -->
        </div>
    </section>
    <!-- End SecondRow -->
 <!-- Start Js -->
 {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> --}}
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script src="{{ asset('js/theme/extensions/toastr.min.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('js/web/scripts.js') }}"></script>
 <script src="{{ asset('js/pages/web/main-screen.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap-tagsinput.min.js') }}"></script>
 <script>
    function clearErrors() {
    $('.messageprescription').html('');
    $('#addPrescriptionForm')[0].reset();;
}
 </script>
 <script>
    // $('button').on('click', function() {
    //     var buttonId = $(this).attr('data-button-id'); 
    //     $('.active_' + buttonId).toggleClass('active');
    // });
    function clearForm(){
        // console.log($('#changePasswordForm'));
        $('#AddButtonForm')[0].reset();
       }
 </script>
 <script>
    $(document).ready(function() {
    var tagValues = $("#tagsInput").tagsinput('items');
    
    console.log("Tag values:", tagValues);
    });
    function previewImage(input) {
        var preview = document.getElementById('preview');
        var file = input.files[0];

        if (file) {
        preview.src = URL.createObjectURL(file);
        } else {
        preview.src = "";
        }
    }
 </script>
 
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

  <!-- End Js -->
 </body>
 </html>
