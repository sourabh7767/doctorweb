








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
  {{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
      .data-table .card-header{
    border-bottom: 1px solid #474747 !important;
}
.card-header{
    background-color:  #474747 !important;
    color:white;
}
.card-body{
  color:white;
  background-color:  #474747 !important;

}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    color:white;
}
table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    padding-right: 30px;
    color:white;
}
.heart-effect {
        /* Define your desired effect here */
        animation: heartBeat 1s;
        color:peru;
    }

    @keyframes heartBeat {
        0% {
            transform: scale(1);
        }
        25% {
            transform: scale(1.2);
        }
        50% {
            transform: scale(1);
        }
        75% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }
    table.table-bordered.dataTable tbody td:nth-child(1){
        color:#A5e5ff;
    }
    .pointers{
        
      cursor: pointer;
      text-align: center;
      color: #fff;
    }
    .getCenter {
      text-align: center;
      
    }
    .card{
        border: #474747;
    }
    .selected {
    background-color: red;
    border-radius: 10px;
    padding: 10px;
  }
 
    </style>
</head>

<body class="bg">
    <div class="loader1" style="display: none;">
        {{-- <div class="spinner-grow text-primary spinner-border-xl" role="status">
            <span class="visually-hidden">Loading...</span>
        </div> --}}
    </div>
    <!-- Start Header Section -->
    <header class="header">
        <div class="container-fluid">
            {{-- <div class="row">
                
                <div class="col-md-12 text-end"> --}}
                    
                <div class="d-flex justify-content-between align-items-center">
                    <span class="bin me-2" id="remove">
                        
                    </span>
                    @php
                     $class = request()->is('user/home')?'selected':'';
                        $class1 = request()->is('user/groups')?'selected':'';
                @endphp
                
                    <div class="receiptContainer">
                        <a href="{{route('web.home')}}" class="receiptIcons"><i class="fa fa-desktop {{$class}}" aria-hidden="true"></i></a>
                        <a href="{{route('groups')}}" class="receiptIcons"><i class="fas fa-receipt {{$class1}}"></i></a>
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

                {{-- ==============update profile=============== --}}
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

              {{-- =================change password================== --}}
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
                    
                      {{-- {{dd($user->full_name)}} --}}
                        <!-- Start UpdateProfile Modal -->
                            <!-- Modal -->
                           
    </header>
    <!-- End Header Section -->
    <!-- Start SecondRow -->
    <section class="midSec mt-3">
        <div class="row">
            <div class="col-12">
              <div class="card data-table">
                 <div class="card-header">
                    <h4 class="m-0" style="text-align: center;font-size:30px;">&nbsp;{{ __('Library') }} </h4><div style="text-align: center;">{{$totalCards}} Groups <br>
                        {{$totalPrescreptions}} Templates Available.</div>
                    
                  <!--<a href="{{ route('users.create') }}" class="dt-button create-new btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create New User</a>-->
                </div>
              
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="cardsTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      {{-- <th style="color:white;">S.No</th> --}}
                      <th>Title</th>
                      <th>Author</th>
                      <th>Downloads</th>
                      <th>Created At</th>
                       <th>Update At</th>
                       <th>Templates</th>
                      <th data-orderable="false" style="color:white;">Action</th>
                    </tr>
                    </thead>
                
                  </table>
                </div>
            
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
         </div> 
         <div class="midContainerCard">
          <div class="modal fade" id="copyPrescriptionModal" tabindex="-1" aria-labelledby="editPrescriptionLabel" aria-hidden="true" data-bs-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-block border-0 p-0 mb-2">
                        <h5 class="modal-title" id="copyPrescriptionModal">Copy Trauma Template</h5>
                    </div>
                    <div class="modal-body p-0">
                      <div id="searchResults"></div>
                    </div>
                    <div class="modal-footer border-0 p-0">
                    <button type="button" class="clearBtn" data-bs-dismiss="modal" onclick="clearErrors();">Close</button>
                    {{-- <button type="button" class="secondryBtn" id="submitEditPrescription" >Save</button> --}}
                    </div>
                </div>
            </div>
        </div>
         </div>
    </section>
    <!-- End SecondRow -->
    {{-- @include('include.dataTableScripts')  --}}
 <!-- Start Js -->
 {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> --}}
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 <script src="{{ asset('js/theme/extensions/toastr.min.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('js/web/scripts.js') }}"></script>
 <script src="{{ asset('js/pages/web/main-screen.js') }}"></script>
 <script src="{{ asset('js/web/bootstrap-tagsinput.min.js') }}"></script>
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
