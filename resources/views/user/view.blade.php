@extends('layouts.admin')

@section('title') User @endsection
<style>
/*  
  table,tr,th,td {
    text-align: center;
      } */
    .modal .modal-body {
        height: calc(100vh - 170px);
        overflow-y: auto !important;
        overflow-x:hidden
    }
    #copyModalView .modal-body{height: 300px}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@section('content')

<!-- Main content -->
    <section>
      <div class="loader" style="display: none;">
        <div class="spinner-grow text-primary spinner-border-xl" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
       <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                                    </li>
                                     <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a>
                                    </li>
                                    <li class="breadcrumb-item active">View
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
              </div>


        <div class="row">
          <div class="col-12">
            <div class="card">
  
              <!-- /.card-header -->
              <div class="card-body">

                     <table id="w0" class="table table-striped table-bordered detail-view">
                      <tbody>
                        <tr>
                          <th>ID</th>
                          <td colspan="1">{{$model->id}}</td>
                          <th>Full Name</th>
                          <td colspan="1">{{$model->full_name}}</td>
                        </tr>
                                    <tr>
                                      <th>Email</th>
                                      <td colspan="1"><a href="mailto:jashely775@gmail.com">{{$model->email}}</a></td>
                                      <th>Role</th>
                                      <td colspan="1">{{$model->getUserRole()}}</td>
                                    </tr>
                                   
                                    
                                   <tr>
                                    <th>Status</th>
                                      <td colspan="1"><span class="badge badge-light-{{$model->getStatusBadge()}}">{{$model->getStatus()}}</span></td>
                                      <th>Created At</th>
                                      <td colspan="1">{{$model->created_at}}</td>
                                    </tr>
                                     <tr>
                                     
                                      <th>Updated At</th>
                                      <td colspan="1">{{$model->updated_at}}</td>
                                     
                                    </tr>
                               </tbody>
                           </table>
                           <table class="table table-striped table-bordered detail-view">
                            <tbody>
                              <tr>
                                <th style="text-align: center;" colspan="3">Prescriptions</th>
                                  <th><a class="btn btn-primary" id="multipleCopyData" data-id="{{@$model->id}}">Copy prescriptions</i></a></th>
                              </tr>
                              <tr>
                                <th style="width: 50px;">id</th>
                                <th>title</th>
                                <th>Description</th>
                                <th>View</th>
                              </tr>
                              @forelse ($priscription as $item)
                              <tr>
                                <td>
                                  {{@$item->id}}
                                </td>
                                <td>
                                  {{@$item->name}}
                                </td>
                                <td>
                                  {{@$item->description}}
                                </td>
                                <td>
                                  <i style="cursor: pointer;" class="fas fa-eye getPriscriptionData" data-id="{{@$item->id}}"></i>
                                </td>
                              </tr>
                              @empty
                              <td>
                               n/a
                              </td>
                              <td>
                               n/a
                              </td>
                              @endforelse
                            </tbody>
                           </table>
                           <div>
                             {{$priscription->links()}}
                          </div>
                          <br>

                          <div class="row"> 
                            <div class="col-md-4">
                              <a id="tool-btn-manage"  class="btn btn-primary text-right" href="{{route('users.index')}}" title="Back">Back</a>
                            </div>
                            <div class="col-md-4">
                              <a href="{{route('user.changeStatus',$model->id)}}" class="active_status btn btn-{{($model->status ==1)?'danger':'primary'}}"  data-id = {{$model->id}} title="Manage">{{($model->status == 1)?"Inactive":"Active"}}</i></a>
                            </div>
                          </div>


              
              </div>
          
              <!-- /.card-body -->

            </div>

            <select name="cars" id="cars" multiple multiselect-search="true">
              <option value="1">Audi</option>
              <option  value="2">BMW</option>
              <option  value="3">Mercedes</option>
              <option value="4">Volvo</option>
              <option value="5">Lexus</option>
              <option value="6">Tesla</option>
            </select>

            <!-- /.card -->
        </div>
       </div>   
<!-- Scrollable modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Prescription info</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
              <div class="mb-3">
                  <label for="copy_name" class="form-label">Name:</label>
                  <input type="text" class="form-control" id="copy_name">
              </div>
              <div class="mb-3">
                <label for="copy_description" class="form-label">Description:</label>
                <textarea type="text" class="form-control" id="copy_description" rows="3"></textarea>
              </div>
              <div class="mb-3">
                  <label for="copy_diagn" class="form-label">Diagn</label>
                  <textarea type="text" class="form-control" id="copy_diagn" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="copy_objective" class="form-label">Objective:</label>
                <input type="text" class="form-control" id="copy_objective">
              </div>
              <div class="mb-3">
                <label for="copy_recomend" class="form-label">Recommendation:</label>
                <input type="text" class="form-control" id="copy_recomend">
              </div>
            </div>
           
            
            <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="copyToButton" >Copy to </button>
          </div>

      </div>
  </div>
</div>
<div class="modal fade" id="copyModalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" >
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h5 class="modal-title" id="examplePrescription">Select Users</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <h4>Users</h4>
                <select class="js-select2" id="multiple-checkboxes" multiple="multiple">
                  <option class="" disabled>select users</option>
                  </select>
                  <div id="errorUserNotSelected" style="color:red;"></div>
              </div>
          </div>
          </div>
           
            
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveCopiedData" >Copy </button>
        </div>

    </div>
</div>
</div>

{{-- ================================== --}}

<div class="modal fade" id="copyAllPrescreptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h5 class="modal-title" id="examplePrescription">Select Users</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <h4>Users</h4>
                <select class="js-select2" id="multiple-Prescriptio" multiple="multiple">
                  <option class="" disabled>select users</option>
                  </select>
                  <div id="errorUserNotSelectedOuter" style="color:red;"></div>
              </div>
              <div class="row">
                <select name="cars" id="cars" multiple multiselect-search="true">
                  <option value="1">Audi</option>
                  <option  value="2">BMW</option>
                  <option  value="3">Mercedes</option>
                  <option value="4">Volvo</option>
                  <option value="5">Lexus</option>
                  <option value="6">Tesla</option>
                </select>
              </div>
          </div>
          </div>
           
            
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveMultipleCopiedData" data-id="{{@$model->id}}">Copy </button>
        </div>

    </div>
</div>
</div>

{{-- ========================================= --}}
</section>
@push('page_script')
<script src="{{ asset('js/web/multiselect-dropdown.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script>
  $(".js-select2").select2({
closeOnSelect : false,
placeholder : "Select Users",
// allowHtml: true,
allowClear: true,
tags: true
});
</script>


<script>
  var site_url = window.location.protocol + '//' + window.location.host;
  $(document).ready(function () {
        $('.getPriscriptionData').on('click', function () {
            var itemId = $(this).data('id');
            $.ajax({
                url: site_url + '/admin/prescription/data',
                type: 'GET',
                data: { card_id: itemId },
                success: function (response) {
                  console.log(response.object)
                    var eventModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                   response.object; 
                   $("#copy_name").val(response.object.name)
                   $("#copy_description").val(response.object.description)
                   $("#copy_diagn").val(response.object.diagn)
                   $("#copy_objective").val(response.object.objective)
                   $("#copy_recomend").val(response.object.recomend)
                   $("#copyToButton").val(response.object.id);
                      eventModal.show();
                    console.log(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
<script>
   $('#exampleModal').on('shown.bs.modal', function () {
        // When the "Copy to" button is clicked
        $('#copyToButton').click(function () {
          var priscriptionId = $(this).val();
          $.ajax({
                url: site_url + '/admin/copy/to/user',
                type: 'GET',
                data: { prescription_id: priscriptionId },
                success: function (response) {
                  
                  var eventModal = new bootstrap.Modal(document.getElementById('copyModalView'));
                  eventModal.show()
                  $('.js-select2').html("");
                  $('.js-select2').html(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    $('#copyModalView').on('shown.bs.modal', function () {
      $('#saveCopiedData').click(function () {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
        // Hide the first modal
        var prescriptionId = $('.prescription').data('id');
        var selectedUsers = $('#multiple-checkboxes').val();
        if (!selectedUsers || selectedUsers.length === 0) {
          $("#errorUserNotSelected").html("Please select at least one user.");
          return false;
        }
        $.ajax({
            url: site_url + '/admin/save/copy/data',
            type: 'POST', 
            data: {
                prescription_id: prescriptionId,
                selected_users: selectedUsers,
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                // Handle the success response as needed
                window.location.reload();
                console.log('Success:', response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
  });
  // saveMultipleCopiedData
  $('#multipleCopyData').click(function () {
          var userId = $(this).data('id');
          $.ajax({
                url: site_url + '/admin/copy/all/to/user',
                type: 'GET',
                data: { user_id: userId },
                success: function (response) {
                  
                  var eventModal = new bootstrap.Modal(document.getElementById('copyAllPrescreptionModal'));
                  eventModal.show()
                  $('.js-select2').html("");
                  $('.js-select2').html(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
        // $('#saveMultipleCopiedData').click(function () {
          $(document).on('click', '#saveMultipleCopiedData', function () {
            var userId = $(this).data('id');
            $('#multiple-Prescriptiom').multiselect({
            includeSelectAllOption: true,
          });
          // Hide the first modal
          var selectedUsers = $('#multiple-Prescriptio').val();
          if (!selectedUsers || selectedUsers.length === 0) {
            $("#errorUserNotSelectedOuter").html("Please select at least one user.");
            return false;
          }
          $.ajax({
              url: site_url + '/admin/save',
              type: 'POST', 
              data: {
                user_id : userId,
                  selected_users: selectedUsers,
                  '_token': $('meta[name="csrf-token"]').attr('content'),
              },
              success: function (response) {
                  window.location.reload();
                  console.log('Success:', response);
              },
              error: function (error) {
                  console.error('Error:', error);
              }
          });
        });
</script>
@endpush
@endsection
