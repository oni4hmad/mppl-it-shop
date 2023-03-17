
{{-- toast show --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    @if ($message = Session::get('success'))
      {{--show success toast--}}
      let toastSuccessEl = document.getElementById('toast-success');
      let changeSuccessText = (text) => toastSuccessEl.querySelector('.toast-body').innerHTML = `${text}`;
      let toastSuccess = new bootstrap.Toast(toastSuccessEl);
      changeSuccessText("{{ $message }}");
      toastSuccess.show();
    @elseif ($message = Session::get('error'))
      {{--show error validation toast--}}
      let toastErrorEl = document.getElementById('toast-error');
      let changeErrorText = (text) => toastErrorEl.querySelector('.toast-body').innerHTML = `${text}`;
      let toastError = new bootstrap.Toast(toastErrorEl);
      changeErrorText("{{ $message }}");
      toastError.show();
    @elseif ($errors->any())
      {{--show error validation toast--}}
      let toastErrorsEl = document.getElementById('toast-error');
      let changeErrorsText = (text) => toastErrorsEl.querySelector('.toast-body').innerHTML = `${text}`;
      let toastErrors = new bootstrap.Toast(toastErrorsEl);
      let messages = "Pengisian gagal:";
      @foreach ($errors->all() as $error)
        messages += "<li>{{ $error }}</li>";
      @endforeach
      changeErrorsText(messages);
      toastErrors.show();
    @endif
  });
</script>

{{--toast success--}}
<div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
  <div id="toast-success" class="toast align-items-center bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body text-white">
        Hello, world! This is a toast message.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

{{--toast error--}}
<div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
  <div id="toast-error" class="toast align-items-center bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="300000">
    <div class="d-flex">
      <div class="toast-body text-white">
        Hello, world! This is a toast message.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
