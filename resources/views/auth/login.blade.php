@extends('layouts.main')

@section('content')

  {{-- hide numeric updown button --}}
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>

  <div class="container" style="min-height: 90vh;">
    <div class="row py-4">

      <div class="col d-flex align-items-center justify-content-center">

        {{-- form login --}}
        <div id="login-form" class="card mx-3">
          {{--card-head login--}}
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Login</h5>
          </div>

          @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
              <strong>{{ $message }}</strong> Silahkan coba lagi.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger m-1">
              <p class="fw-bold">Login Gagal:</p>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="/login" method="post">
            @csrf

            {{--card-body login--}}
            <div class="card-body">
              <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus value="">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" value="">
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
              </div>
            </div>

            {{-- btn login --}}
            <div class="card-footer text-center bg-transparent py-3">
              <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
              <a class="btn btn-link p-0 m-0" href="#">Forgot Your Password?</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

  <script>
    // buat demo aja yo
    // kalau diklik 'Cek Status Pesanan'
    function pesananBerhasil() {
      let form_pesan_servis = document.querySelector('#form-pesan-servis');
      form_pesan_servis.classList.add("d-none");
      let card_order_berhasil = document.querySelector('#order-berhasil');
      card_order_berhasil.classList.remove("d-none");
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
  </script>

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  <!-- modal: edit alamat -->
  <div class="modal fade" id="modal-edit-alamat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Alamat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-9">
              <p class="mb-0 fw-bold">Kabupaten / Kota</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kabupaten / Kota">
            </div>
            <div class="col">
              <p class="mb-0 fw-bold">Kode Pos</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kode Pos">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-0 fw-bold">Alamat</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
        </div>
      </div>
    </div>
  </div>

@endsection
