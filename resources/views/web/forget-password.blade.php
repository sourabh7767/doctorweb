<!-- Password Reset 6 - Bootstrap Brain Component -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/password-resets/password-reset-6/assets/css/password-reset-6.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
<style>
    .bg{
        background-color: #57B894;
        height: 100vh;
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
<section class="bg p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-3 p-md-4 p-xl-5">
                 <div class="row">
                <div class="col-12">
                  <hr class="mt-3 mb-2 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <a href="{{route('web.index')}}" class="link-secondary text-decoration-none">< Back</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h2 class="h3">Forget Password</h2>
                    <h3 class="fs-6 fw-normal text-secondary m-0">Provide the email address associated with your account to recover your password.</h3>
                  </div>
                </div>
              </div>
              <form action="{{route('forgetPassword')}}" method="POST">
                @csrf
                <div class="row gy-3 overflow-hidden">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" >
                      @if($errors->has('email'))
                          <div class="error" style="color: red;">{{ $errors->first('email') }}</div>
                      @endif
                      <label for="email" class="form-label">Email</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn bsb-btn-2xl  buttonReset" type="submit">Reset Password</button>
                    </div>
                  </div>
                </div>
              </form>
             
            </div>
          </div>
        </div>
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
  </section>