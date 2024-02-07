<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
        rel="stylesheet" type="text/css" />
<!------ Include the above in your HEAD tag ---------->
<style>
    .pass_show{position: relative} 

.pass_show .ptxt { 

position: absolute; 

top: 50%; 

right: 10px; 

z-index: 1; 

color: #f36c01; 

margin-top: -10px; 

cursor: pointer; 

transition: .3s ease all; 

} 

.pass_show .ptxt:hover{color: #333333;} 
.row ,body {
    background-color: #57B894;
}
.buttonReset{
        background-color: #4fad8b;
        color:white;
    }
    .buttonReset:hover{
        background-color: #358467;
        color: white;
    }
</style>
<div class="col-md-6 offset-md-3">
    <span class="anchor" id="formChangePassword"></span>
    <hr class="mb-5">

    <!-- form card change password -->
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">Change Password</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" action="{{route('changePasswordWeb')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inputPasswordNew">New Password</label>
                    <input type="hidden" name="user_id" value="{{@$id}}">
                    <input type="password" class="form-control" id="change_new_pass" name="change_new_pass">
                    <span id="change_new_pass_eye" class="fa fa-fw fa-eye field_icon"></span> 
                    @if($errors->has('change_new_pass'))
                          <span class="error" style="color: red;">{{ $errors->first('change_new_pass') }}</span>
                      @endif
                </div>
                <div class="form-group">
                    <label for="inputPasswordNewVerify">Verify</label>
                    <input type="password" class="form-control" id="change_confirm_pass" name="change_confirm_pass">
                    <span id="change_confirm_pass_eye" class="fa fa-fw fa-eye field_icon"></span> 
                    @if($errors->has('change_confirm_pass'))
                          <span class="error" style="color: red;">{{ $errors->first('change_confirm_pass') }}</span>
                      @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg float-right">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <!-- /form card change password -->
<script>
     $(function () {
        $("#change_new_pass_eye").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#change_new_pass").attr("type", type);
        });
    });
    $(function () {
        $("#change_confirm_pass_eye").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#change_confirm_pass").attr("type", type);
        });
    });
</script>
</div>