<!doctype html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>AvacadoKiwi</title>
  <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
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

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  @livewireStyles
  <style>
    .item-content {
    /* padding: 10px; */
    /* background: #fff; */
    /* border: 1px solid #ccc; */
    /* margin: 5px 0; */
    transition: transform 1s ease, box-shadow 1s ease;
    /* Added transform and box-shadow for better visual effect */
}

.sortable-placeholder {
    border: solid #2e2e2e;
    /* 1px dashed #8ebdcd; */
    /* height: 40px; */
    margin: 3px;
    /* background-color: transparent; */
    background-color: #2e2e2e;
    border-radius: 10px;
    padding: 1px 8px;
    transition: all 0.5s
}
.ui-sortable-helper{
    background: #2e2e2e !important;
}
   .panel-container {
    position: relative;
    display: block;
    width: 100%;
    max-width: 100%;
    /* max-height: 100vh; */
    /* overflow: auto; */
    padding-right: 12px;
}
  
    .panel {
       /* Adjusted width for the panel with padding */
      height: auto; /* Initial height */
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 20px;
      padding-right: 20px;
      /* background-color: #474747;
      border: 1px solid #7b7273; */
      background-color: #4a4a4a;
      border: 1px solid #383838;
      transition: height 0.5s; /* Smooth transition for height change */
      position: relative; /* Ensure the button is positioned relative to this panel */
      z-index: 1; /* Ensure the panel is above the button */
      display: flex; /* Use flexbox for layout */
      flex-direction: column; /* Arrange items vertically */
      border-radius: 10px;
      margin-bottom: 10px;
    }
    .panel:last-child
    {
        margin-bottom: 0;
    }
    .expanded {
      height: 240px; /* Expanded height */
    }
  
    .panel.expanded{height: auto !important;}
    .toggle-button-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }
  
    .toggle-button {
      width: 33px; /* Set a fixed width for the button */
      height: 33px; /* Set a fixed height for the button */
      padding: 0; /* Remove padding */
      text-align: center;
      z-index: 999; /* Ensure the button is on top of other elements */
      /* background: linear-gradient(to right, #e556f5, #8f2fde); Set background color to light grey */
      background: #7a7a7a;
      border: none;
      border-radius: 50%; /* Make the button round */
      cursor: pointer;
      transition: transform 0.3s ease; /* Smooth transition for rotation */
      display: flex; /* Use flexbox for icon alignment */
      justify-content: center; /* Align icon horizontally */
      align-items: center; /* Align icon vertically */
    }
  
    .toggle-button i {
      color: #fff; /* Set color for the icon to black */
      transition: transform 0.3s ease; /* Smooth transition for rotation */
      font-size:12px;
    }
  
    .rotate {
      transform: rotate(90deg); /* Rotate the arrow 90 degrees */
    }
  
    .additional-buttons {
      opacity: 0; /* Initially hide the additional buttons */
      transition: opacity 0.4s ease-in-out; /* Add transition for opacity */
      margin-top: 10px; /* Add margin to separate the buttons from the button */
      overflow: hidden;
      display: none;
    }
  
    .panel.expanded .additional-buttons {
      opacity: 1; /* Show the additional buttons when panel is expanded */
      display: block;
    }
    .additional-buttons.expanded
    {
        height: auto;
    }
    .selected {
    background-color: red;
    border-radius: 10px;
    padding: 7px;
  }
  </style>
</head>

<body class="bg">
    <div class="loader1" style="display: none;">
    </div>
    {{-- @livewire('progress-tracker') --}}
    <!-- Start Header Section -->
    <header class="header">
        <div class="container-fluid">
            {{-- <div class="row">
                
                <div class="col-md-12 text-end"> --}}
                    
                <div class="d-flex justify-content-between align-items-center">
                    <span class="bin me-2" id="remove">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" id="remove"><g fill="white"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></g></svg> -->
                        <i class="fas fa-trash" id=""></i>
                    </span>
                    
                    
                    @php
                        $class = request()->is('user/home')?'selected':'';
                        $class1 = request()->is('user/groups')?'selected':'';
                    @endphp
                    <div class="receiptContainer">
                        <a href="{{route('web.home')}}" class="receiptIcons {{$class}}"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        <a href="{{route('groups')}}" class="receiptIcons {{$class1}}"><i class="fas fa-receipt"></i></a>
                        {{-- <span class="bin me-10" id=""> --}}
                        {{-- <i class="fas la-pen remove removed" style="color:#fff" id="editActiveToggleButton"></i> --}}
                    {{-- </span> --}}
                    </div>
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
                {{-- </div>
            </div> --}}
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
                    {{-- <div class="btnGroup w-100 me-2 buttonAppend">
                        @foreach ($buttons as $button)
                        <div class="cardItemValue" id="cardItemValueButton_{{@$button->id}}">
                            <span class="tag tag-data" data-button-position="{{$button->place}}" data-button-id="{{$button->id}}">{{$button->title}}
                            </span>
                            <span class="crossValue buttondeleteCrose removed remove " data-button-id="{{ @$button->id }}"><i class="las la-times"></i></span>
                        </div>
                        @endforeach
                    </div> --}}
                    <div class="btnGroup w-100 me-2 buttonAppend">
                        @foreach ($buttons as $button)
                        <div class="cardItemValue list-item" id="cardItemValueButton_{{@$button->id}}" data-id="{{@$button->id}}">
                          <div class="item-content">
                            <span class="order"></span>
                            <span class="tag tag-data" data-button-position="{{$button->place}}" data-button-id="{{$button->id}}" id="newId_{{$button->id}}">{{$button->title}}</span>
                            <span class="crossValue buttondeleteCrose removed remove" data-button-id="{{ @$button->id }}" id="crossId_{{$button->id}}"><i class="las la-times"></i></span><span class="editValue remove removed" id="editButton" data-id="{{@$button->id}}" data-bs-toggle="modal" data-bs-target="#editBtnModal" ><i class="las la-pen"></i></span>
                          </div>
                        </div>
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
                                                <input type="text" value="" placeholder="Button Name..." class="customControlInputs" name="title">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="customControlInputs" id="" rows="11" placeholder="Button Text..." name="description"></textarea>
                                            </div>
                                            <h4 class="modal-title mt-3">Display content in:</h4>
                                            <div class="labelContainer mt-2 mb-3">
                                                <div class="form-check form-check-inline ps-0">
                                                    <input type="radio" id="test1" value="{{App\Models\Button::First_Label}}" name="place" checked>
                                                    <label for="test1">Diagnoze</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input type="radio" id="test2" value="{{App\Models\Button::S_LABLE}}" name="place">
                                                    <label for="test2">Objektīvās atr.</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input type="radio" id="test3" value="{{App\Models\Button::THIRD_LABLE}}" name="place">
                                                    <label for="test3">Rekomendācijas</label>
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
                    {{-- edit buttons modal  --}}
                    
                </div>
            </div>
            <div class="modal fade" id="editBtnModal" tabindex="-1" aria-labelledby="addBtnModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header d-block border-0 p-0 mb-2">
                            <h5 class="modal-title" id="addBtnModalLabel">Edit Button</h5>
                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                        </div>
                        <div class="modal-body p-0">
                            <form class="editBtnForm" id="editButtonForm">
                                @csrf
                                <div class="form-group mb-2">
                                    <input type="text" value="" placeholder="Button Name..." class="customControlInputs" name="title" id="editTitle">
                                    <input type="hidden" name="button_id" value="" id="hiddenButonId">
                                </div>
                                <div class="form-group">
                                    <textarea class="customControlInputs" id="" rows="11" placeholder="Button Text..." name="description" id="editDescription"></textarea>
                                </div>
                                <h4 class="modal-title mt-3">Display content in:</h4>
                                <div class="labelContainer  mt-3 mb-3 d-flex flex-wrap gap-3">
                                    <div class="formCheck ps-0">
                                        <input type="radio" id="edit1" value="{{App\Models\Button::First_Label}}" name="place">
                                        <label for="edit1">Diagnoze</label>
                                    </div>
                                    <div class="formCheck">
                                        <input type="radio" id="edit2" value="{{App\Models\Button::S_LABLE}}" name="place">
                                        <label for="edit2">Objektīvās atr.</label>
                                    </div>
                                    <div class="formCheck">
                                        <input type="radio" id="edit3" value="{{App\Models\Button::THIRD_LABLE}}" name="place">
                                        <label for="edit3">Rekomendācijas</label>
                                    </div>
                                </div>
                                {{-- <div class="labelContainer mt-3 mb-3 d-flex flex-wrap gap-3">
                                    <div class="formCheck">
                                        <input type="radio" id="test1" value="1" name="place" class="d-none">
                                        <label for="test1">Diagnoze</label>
                                    </div>
                                    <div class="formCheck">
                                        <input type="radio" id="test2" value="2" name="place" class="d-none">
                                        <label for="test2">Objektīvās atr.</label>
                                    </div>
                                    <div class="formCheck">
                                        <input type="radio" id="test3" value="3" name="place" class="d-none">
                                        <label for="test3">Rekomendācijas</label>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                        <div class="modal-footer border-0 p-0">
                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="secondryBtn" id="editSubmitButton">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Buttons Row -->
            <!-- End Buttons Row -->
            <!-- Start Second Row -->
            <div class="row mt-3">
                <!-- Start LeftSection -->
                <div class="col-md-5 col-lg-5 mb-3 mb-md-0">
                    <div class="leftCard">
                        {{-- <ul class="leftCardMenus" id="UlTags">
                            @foreach ($customSearchObj as $item)
                            <li class="leftCardItems row" {{@$item->id}}>
                                <h6 class="cardItemHead col-md-4">{{@$item->title}}</h6>
                                <div class="col-md-8">
                                @foreach ($item->customTags as $tag)
                                    <div class="cardItemValue" id="cardItemValueTag_{{@$tag->id}}">
                                            <span class="tag tagTitle tags" data-tag="{{ @$tag->tag }}" data-type="true" data-id="{{ @$tag->id }}">{{@$tag->tag}} 
                                            </span>
                                            <span class="crossValue crossValue1 customtagdelete removed remove" data-id="{{ @$tag->id }}" ><i class="las la-times"></i></span>
                                    </div>
                                @endforeach
                                </div>
                            </li>
                            @endforeach
                           
                        </ul> --}}
                        {{-- <span class="addOnBtn mt-5" data-bs-toggle="modal" data-bs-target="#addOnBtnModal"><i class="las la-plus"></i></span> --}}
                        {{-- <div class="leftBtmBtn mt-3 text-end">
                            <button class="clearBtn" id="removeAllData">Clear</button>
                        </div> --}}
                        
                        <!-- Start AddBtn modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="addOnBtnModal" tabindex="-1" aria-labelledby="addOnBtnLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addOnBtnLabel">Create Group</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm" id="searchableTags">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="group_name">
                                                </div>
                                                {{-- <div class="u-tagsinput">
                                                    <input id="tagsInput" type="text" value="" data-role="tagsinput" class="customControlInputs" name="tags">
                                                </div> --}}
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="secondryBtn" id="addLableSubmit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- edit main group  --}}
                            <div class="modal fade" id="editMaingroup" tabindex="-1" aria-labelledby="addOnBtnLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addOnBtnLabel">Edit Group</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm" id="editMaingroupIdForm">
                                                @csrf
                                                <input type="hidden" name="group_lable" id="editMaingroupId" value="">
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="group_name" id="group_name">
                                                </div>
                                                {{-- <div class="u-tagsinput">
                                                    <input id="tagsInput" type="text" value="" data-role="tagsinput" class="customControlInputs" name="tags">
                                                </div> --}}
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0 p-0">
                                        <button type="button" class="clearBtn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="secondryBtn" id="updateGroupName">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{-- end --}}

                            <div class="modal fade" id="addOnBtnModalTags" tabindex="-1" aria-labelledby="addOnBtnLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="addOnBtnLabel">Tags</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm" id="addTags">
                                                @csrf
                                                <input type="hidden" name="customSearchObj_id" id="customSearchObj_id">
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
                                        <button type="button" class="secondryBtn" id="addLableSubmitTag">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ========================================================================= --}}
                            <div class="main2">
                                <div class="d-flex align-items-start justify-content-between listingTemp ">
                                    <div class="panel-container">
                                        @foreach ($customSearchParent as $item)
        
                                        <div class="panel" id="panel">
                                            <!-- <div class="d-flex align-items-center">
                                                <span class="editModal editMainGroup" data-id="{{@$item->id}}" data-bs-toggle="modal" data-bs-target="#editMaingroup" ><i class="las la-pen"></i></span>
                                            </div> -->
                                          <div class="toggle-button-container">
                                            <div class="toggleTxtContainer" data-id="{{@$item->id}}">
                                                <p style="margin: 0; flex-grow: 1;color:#ffff">{{$item->title}}&nbsp;&nbsp;</p>
                                                <span class="editModal remove removed editMainGroup me-2" data-id="{{@$item->id}}" data-bs-toggle="modal" data-bs-target="#editMaingroup" ><i class="las la-pen"></i></span>
                                                <span class="editModal remove removed removeGroup me-2" data-id="{{@$item->id}}" data-bs-toggle="modal" ><i class="fas fa-trash"></i></span>
                                            </div>
                                            
                                            
                                            <div class="d-flex">
                                                <button class="toggle-button toggleOnClass">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                          </div>
                                          <div class="additional-buttons">
                                            <div class="d-flex justify-content-between">
                                            <div class="leftCardMenusArea">
                                            <ul class="leftCardMenus ul_{{$item->id}}" id="UlTags">
                                                @foreach ($customSearchObj as $groupNames)
                                                @if ($item->id == $groupNames->parent_id)
                                                <li class="leftCardItems row" {{@$groupNames->id}}>
                                                    <h6 class="cardItemHead col-md-4">{{@$groupNames->title}}</h6>
                                                    <div class="col-md-8">
        
                                                    @foreach ($groupNames->customTags as $tag)
                                                        <div class="cardItemValue" id="cardItemValueTag_{{@$tag->id}}">
                                                                <span class="tag tagTitle tags" data-tag="{{ @$tag->tag }}" data-type="true" data-id="{{ @$tag->id }}">{{@$tag->tag}} 
                                                                </span>
                                                                <span class="crossValue crossValue1 customtagdelete removed remove" data-id="{{ @$tag->id }}" ><i class="las la-times"></i></span>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </li>
                                                @endif
                                                @endforeach
                                               
                                                </ul>
                                            </div>
                                            <span class="addOnBtn me-0" data-bs-toggle="modal" data-bs-target="#addOnBtnModalTags" ><i class="las la-plus tagId" data-id="{{$item->id}}"></i></span>
                                        </div>
                                          </div>
                                          {{-- <div class="additional-buttons newtag_{{$item->id}}">
                                            @forelse ($item->customTags as $tag)
                                            @if (!empty($tag))
                                            <div class="cardItemValue" id="cardItemValueTag_{{@$tag->id}}">
                                                <span class="tag tagTitle tags" data-tag="{{ @$tag->tag }}" data-type="true" data-id="{{ @$tag->id }}">{{@$tag->tag}} 
                                                </span>
                                                <span class="crossValue crossValue1 customtagdelete removed remove" data-id="{{ @$tag->id }}" ><i class="las la-times"></i></span>
                                            </div>  
                                            @endif
                                            
                                            @empty
                                                
                                            @endforelse
                                        </div> --}}
        
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    
                                </div>
                                <div class="btnListContainer">
                                    <div class="outerModalBtn">
                                        <span class="addOnBtn me-2" data-bs-toggle="modal" data-bs-target="#addOnBtnModal"><i class="las la-plus"></i></span>
                                    </div>
                                    <div class="leftBtmBtn mt-3 text-end">
                                        <button class="clearBtn" id="removeAllData">Clear</button>
                                    </div>
                                </div>
                            </div>
                        
                        
                        <!-- Start InnerCollapseLabelBtn Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="InnerCollapseLabelBtn" tabindex="-1" aria-labelledby="InnerCollapseLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="InnerCollapseLabel">Create Labels</h5>
                                            {{-- <p class="modal-subtext">Edit field and create fast access template</p> --}}
                                        </div>
                                        <div class="modal-body p-0">
                                            <form class="addLabelsForm" id="searchableTags" action="{{route('inner.lable.store')}}">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <input type="text" value="" placeholder="Nosaukums..." class="customControlInputs" name="title">
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
                        <!-- End InnerCollapseLabelBtn Modal -->
                         <!-- Start OuterModalBtn Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="outerModalBtn" tabindex="-1" aria-labelledby="outerModalBtnLabel" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block border-0 p-0 mb-2">
                                            <h5 class="modal-title" id="outerModalBtn">Create Labels</h5>
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
                        <!-- End OuterModalBtn Modal -->
                    {{-- ================================================================================ --}}
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
                                        <input type="search" class="formControl" placeholder="Meklēt pēc nosaukuma" id="searchInput">
                                    </div>
                                </form>
                                <span class="addOnBtn mt-2 mb-1 m-auto" data-bs-toggle="modal" data-bs-target="#createTemp"><i class="las la-plus"></i></span>
                                <!-- Start RightMid Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="createTemp" tabindex="-1" aria-labelledby="createTempLabel" aria-hidden="true" data-bs-backdrop="static" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header d-block border-0 p-0 mb-2">
                                                <h5 class="modal-title" id="createTempaLabel">Create Template</h5>
                                                <p class="modal-subtext">Edit fields and create fast access template</p>
                                            </div>
                                            <div class="modal-body p-0">
                                                <form class="addBtnForm" id="addPrescriptionForm">
                                                    @csrf
                                                    <div class="form-group mb-2">
                                                        {{-- <input type="text" value="" placeholder="Name..." class="customControlInputs" name="name"> --}}
                                                        <select name="parent_groups" id="parent_groups" class="customControlInputs">
                                                            @foreach ($customSearchParent as $item)
                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div id="prescription-parent_groups-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Template Name..." class="customControlInputs" name="name">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Template Description..." class="customControlInputs" name="description">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <input type="text" value="" placeholder="Diagnoze..." class="customControlInputs" name="diagn">
                                                        <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="6" placeholder="Objektīvās atradnes..." name="objective"></textarea>
                                                        <div id="prescription-objective-error" class="messageprescription" data-form="prescription"></div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <textarea class="customControlInputs" id="" rows="6" placeholder="Rekomendācijas..." name="recomend"></textarea>
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
                                                            {{-- <input type="text" value="" placeholder="Name..." class="customControlInputs" name="name"> --}}
                                                            <select name="parent_groups" id="parent_groups" class="customControlInputs">
                                                                @foreach ($customSearchParent as $item)
                                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div id="prescription-parent_groups-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Template Name..." class="customControlInputs" name="name" id="edit_name">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Template Description..." class="customControlInputs" name="description" id="edit_description">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <input type="text" value="" placeholder="Diagnoze..." class="customControlInputs" name="diagn" id="edit_diagn">
                                                            <div id="prescription-diagn-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            {{-- <input type="text" name="objective" class="customControlInputs form-control" id="edit_objective" style="height: 100px;"> --}}
                                                            <textarea class="customControlInputs" rows="6" placeholder="Objektīvās atradnes..." name="objective" id="edit_objective"></textarea>
                                                            <div id="prescription-objective-error" class="messageprescription" data-form="prescription"></div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            {{-- <input type="text" name="recomend" class="customControlInputs form-control" id="edit_recomend" style="height: 100px;"> --}}
                                                            <textarea class="customControlInputs"  rows="6" placeholder="Rekomendācijas..." name="recomend" id="edit_recomend"></textarea>
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
                                    <textarea class="me-2 " placeholder="Objektīvās atradnes..." rows="9" id="to_objective"></textarea>
                                    <button class="secondryBtn copy"  data-target-id="to_objective" type="button">Copy</button>
                                </div>
                                <div class="rek field">
                                    <textarea class="me-2 " placeholder="Rekomendācijas..." rows="9" id="to_recomend"></textarea>
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
        {{-- @livewire('progress-tracker') --}}

    </section>
    <!-- End SecondRow -->
 <!-- Start Js -->
 {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> --}}
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script src="{{ asset('js/theme/extensions/toastr.min.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts
 <script src="{{ asset('js/web/scripts.js') }}"></script>
 <script src="{{ asset('js/pages/web/main-screen.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap-tagsinput.min.js') }}"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/Draggable.min.js"></script>
 <script>
    function clearErrors() {
    $('.messageprescription').html('');
    $('#addPrescriptionForm')[0].reset();
    $("#EdidPrescriptionForm")[0].reset();
    $("#tagsInputprescreption").tagsinput('removeAll');
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
 <script>
  $(document).on('click', '#remove', function() {
    $('.remove').toggleClass('removed');
    $('.bin').toggleClass("delAllCross");
    if (!$('.removeEdit').hasClass('removed')) {
        // alert()
        $('.removeEdit').addClass('removed');
    }
});

$(document).on('click', '#editActiveToggleButton', function() {
    $('.removeEdit').toggleClass('removed');
});
 </script>
    
    <script>
        $(document).on('click', '.toggleOnClass', function() {
            var panel = $(this).closest('.panel'); // Find the closest panel to the clicked toggle button
            var additionalButtons = panel.find(".additional-buttons");
            var arrowIcon = $(this).find("i");
    
            if (!panel.hasClass("expanded")) { // If panel is not expanded
                panel.addClass("expanded");
                additionalButtons.addClass("expanded");
                arrowIcon.addClass("rotate");
            } else { // If panel is expanded
                panel.removeClass("expanded");
                additionalButtons.removeClass("expanded");
                arrowIcon.removeClass("rotate");
            }
        });
        
    </script>
    <script>
//         $(document).on('click', '.editMainGroup', function(e){
                    
// alert()
//                     var lableId = $(this).data('id'); 
//                     $("#editMaingroupId").val(lableId);

//         });
//         <script>
        $(document).on('click', '.editMainGroup', function(e){
                    var lableId = $(this).data('id'); 
                    $("#editMaingroupId").val(lableId);
             $.ajax({
                 url: site_url + '/user/groups/editMainGroup/' + lableId, // Assuming this URL hits your controller action
                 type: 'GET',
                 success: function(response) {
                     console.log(response);
                     $("#group_name").val(response.group)
                     
                 },
                 error: function(xhr, status, error) {
                     // Handle error
                     console.error(error);
                 }
             });

             
        });
    </script>
    <script>
    $("#updateGroupName").click(function() {
        // Serialize the form data
        var formData = $("#editMaingroupIdForm").serialize();
        
        // Send the form data using AJAX
        $.ajax({
            type: "POST",
            url: site_url + "/user/groups/updateGroupName", // Replace with your endpoint URL
            data: formData,
            success: function(response) {
                // Handle success response
                $("#editMaingroup").modal('hide');
                toastr.success(response.message, 'Success!', toastCofig);
                window.location.reload();
                getDropDown();
                // Optionally, do something with the response
            },
            error: function(xhr, status, error) {
                toastr.error("Error saving form data:", error, toastCofig);
                console.error(error);
            }
        });
    });

    </script>

{{-- <script>
    var rowSize = 5; // => container height / number of items
    var container = document.querySelector(".container");
    var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;
  
    gsap.to(container, {duration: 0.5, autoAlpha: 1 });
  
    function changeIndex(item, to) {
      // Change position in array
      arrayMove(sortables, item.index, to);
  
      // Change element's position in DOM. Not always necessary. Just showing how.
      if (to === total - 1) {
        container.appendChild(item.element);
      } else {
        var i = item.index > to ? to : to + 1;
        container.insertBefore(item.element, container.children[i]);
      }
  
      // Set index for each sortable
      sortables.forEach((sortable, index) => sortable.setIndex(index));
    }
  
    function Sortable(element, index) {
      var content = element.querySelector(".item-content");
      var order = element.querySelector(".order");
  
      var animation = gsap.to(content, { duration: 0.3, boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px", force3D: true, scale: 1.1, paused: true });
  
      var dragger = new Draggable(element, {
        onPress: downAction,
        onRelease: upAction,
        onDrag: dragAction,
        cursor: "inherit",
        type: "x"
      });
  
      // Public properties and methods
      var sortable = {
        dragger: dragger,
        element: element,
        index: index,
        setIndex: setIndex
      };
  
      gsap.set(element, { x: index * rowSize });
  
      function setIndex(index) {
        sortable.index = index;
        order.textContent = index + 1;
  
        // Don't layout if you're dragging
        if (!dragger.isDragging) layout();
      }
  
      function downAction() {
        animation.play();
        this.update();
      }
  
      function dragAction() {
        // Calculate the current index based on element's position
        var index = clamp(Math.round(this.x / rowSize), 0, total - 1);
  
        if (index !== sortable.index) {
          changeIndex(sortable, index);
        }
      }
  
      function upAction() {
        animation.reverse();
        layout();
      }
  
      function layout() {
        gsap.to(element, { duration: 0.3, x: sortable.index * rowSize });
      }
  
      return sortable;
    }
  
    // Changes an elements's position in array
    function arrayMove(array, from, to) {
      array.splice(to, 0, array.splice(from, 1)[0]);
    }
  
    // Clamps a value to a min/max
    function clamp(value, a, b) {
      return value < a ? a : value > b ? b : value;
    }
</script> --}}

<script>
    // $(function() {
    //     $(".btnGroup").sortable({
    //         placeholder: "sortable-placeholder",
    //         update: function(event, ui) {
    //             // Optional: Send the new order to the server
    //             var sortedIDs = $(this).sortable("toArray");
    //             console.log(sortedIDs);
    //         }
    //     });
    // });
    $(function() {
        $(".btnGroup").sortable({
            placeholder: "sortable-placeholder",
            // helper: "clone",
            delay: 15,
            distance: 1,
            cursor: "move",
            tolerance: "pointer",
            
            start: function(event, ui) {
                console.log(ui.helper.outerWidth());
                // ui.helper.outerHeight()
                // ui.placeholder.height(ui.helper.outerHeight());
                ui.placeholder.width(100);
            },
            update: function(event, ui) {
                var sortedIDs = $(this).sortable("toArray");
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log(sortedIDs);
                $.ajax({
                    type: "POST",
                    headers: {
                    // Include CSRF token in the headers
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: site_url + "/user/update/order/tags", // Replace with your endpoint URL
                    data: {
                        "sortedIDs" : sortedIDs,
                    },
                    success: function(response) {
                        console.log(response);
                        // Optionally, do something with the response
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Error saving form data:", error, toastCofig);
                        console.error(error);
                    }
                });
                // Optionally send the new order to the server here
            }
        });
    });

</script>
<script>
    
</script>
    
  <!-- End Js -->
  
 </body>
 </html>
