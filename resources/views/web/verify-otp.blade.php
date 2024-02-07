<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>\
<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/extensions/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme/plugins/extensions/ext-component-toastr.css') }}">
<style>
    .otp-field {
  flex-direction: row;
  column-gap: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.otp-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.otp-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.otp-field input::-webkit-inner-spin-button,
.otp-field input::-webkit-outer-spin-button {
  display: none;
}

.resend {
  font-size: 12px;
}

.footer {
  position: absolute;
  bottom: 10px;
  right: 10px;
  color: black;
  font-size: 12px;
  text-align: right;
  font-family: monospace;
}

.footer a {
  color: black;
  text-decoration: none;
}
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
<section class="container-fluid bg-body-tertiary d-block">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
          <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
            <div class="card-body p-5 text-center">
              <h4>Verify</h4>
              <p>Your code was sent to you via email</p>
            <form action="{{route('verifyOtpView')}}" method="post">
                @csrf
              <div class="otp-field mb-4">
                <input type="hidden" name="user_id" value="{{$id}}">
                <input type="number" name="digit1" />
                <input type="number" name="digit2" disabled />
                <input type="number" name="digit3" disabled />
                <input type="number" name="digit4" disabled />
              </div>
  
              <button class="btn btn-primary buttonReset mb-3">
                Verify
              </button>
            </form>
              <p class="resend text-muted mb-0">
                Didn't receive code? <a href="{{route('resendOtpWeb',['user_id' => @$id])}}">Request again</a>
              </p>
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
      <script>
        const inputs = document.querySelectorAll(".otp-field > input");
const button = document.querySelector(".btn");

window.addEventListener("load", () => inputs[0].focus());
button.setAttribute("disabled", "disabled");

inputs[0].addEventListener("paste", function (event) {
  event.preventDefault();

  const pastedValue = (event.clipboardData || window.clipboardData).getData(
    "text"
  );
  const otpLength = inputs.length;

  for (let i = 0; i < otpLength; i++) {
    if (i < pastedValue.length) {
      inputs[i].value = pastedValue[i];
      inputs[i].removeAttribute("disabled");
      inputs[i].focus;
    } else {
      inputs[i].value = ""; // Clear any remaining inputs
      inputs[i].focus;
    }
  }
});

inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    const currentInput = input;
    const nextInput = input.nextElementSibling;
    const prevInput = input.previousElementSibling;

    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    if (
      nextInput &&
      nextInput.hasAttribute("disabled") &&
      currentInput.value !== ""
    ) {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    if (e.key === "Backspace") {
      inputs.forEach((input, index2) => {
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }

    button.classList.remove("active");
    button.setAttribute("disabled", "disabled");

    const inputsNo = inputs.length;
    if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
      button.classList.add("active");
      button.removeAttribute("disabled");

      return;
    }
  });
});
      </script>
  </section>