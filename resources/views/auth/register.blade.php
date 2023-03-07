@extends('layouts.main')

@section('content')

  {{-- hide numeric updown button --}}
  <style>
    /* background register */
    body {
      background: #E7F0F7;
    }

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

  <div class="container">
    <div class="row py-4" style="min-height: 90vh;">
      <div class="col">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h1 class="fw-bold text-primary" style="font-size: 5rem;">IT SHOP</h1>
          <p class="mb-2 fw-bold fs-5">Siap mengcarry kebutuhan digitalmu.</p>
          <p class="fw-bold fs-6 text-secondary">Gabung dan mulai bangun PC impianmu.</p>
        </div>
      </div>
      <div class="col d-flex align-items-center">

        {{-- form registrasi --}}
        <form method="POST" action="#">
          <div id="registration-form" class="card mx-3 w-100">
            <div class="card-header">
              <h5 class="fw-bolder text-dark mb-0 py-2">Daftar Sekarang</h5>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger m-1">
                <p class="fw-bold">Registrasi Gagal:</p>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="/register" method="post">
              @csrf
              {{--body daftar--}}
              <div class="card-body">
                <div class="row py-2">
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Email</p>
                    <div class="input-group input-group-md">
                      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" aria-describedby="inputGroup-sizing-sm" placeholder="Email" value="{{ old('email') }}">
                    </div>
                  </div>
                </div>
                <div class="row py-2">
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Password</p>
                    <div class="input-group input-group-md">
                      <input type="password" class="form-control" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Password">
                    </div>
                  </div>
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Confirm Password</p>
                    <div class="input-group input-group-md">
                      <input type="password" class="form-control" name="password_confirmation" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
                <div class="row py-2">
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Nomor HP</p>
                    <div class="input-group input-group-md">
                      <input type="number" class="form-control" name="nomor_hp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nomor HP" value="{{ old('nomor_hp') }}">
                    </div>
                  </div>
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Nama</p>
                    <div class="input-group input-group-md">
                      <input type="text" class="form-control" name="nama" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nama" value="{{ old('nama') }}">
                    </div>
                  </div>
                </div>
                <div class="row py-2">
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Kabupaten / Kota</p>
                    <div class="input-group input-group-md">
                      <input type="text" class="form-control" name="kota" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Kabupaten / Kota" value="{{ old('kota') }}">
                    </div>
                  </div>
                  <div class="col-4">
                    <p class="card-text mb-0 fw-bold">Kode Pos</p>
                    <div class="input-group input-group-md">
                      <input type="number" class="form-control" name="kode_pos" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Kode Pos" value="{{ old('kode_pos') }}">
                    </div>
                  </div>
                </div>
                <div class="row py-2">
                  <div class="col">
                    <p class="card-text mb-0 fw-bold">Alamat</p>
                    <div class="input-group input-group-md">
                      <input type="text" class="form-control" name="alamat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Alamat" value="{{ old('alamat') }}">
                    </div>
                  </div>
                </div>
              </div>
              {{-- btn daftar --}}
              <div class="card-footer bg-transparent">
                <button type="submit" class="btn btn-primary w-100 mb-2 fw-bold fs-5">Daftar</button>
              </div>
            </form>
          </div>
        </form>

        {{-- pendaftaran berhasil: hapus d-none --}}
        <div id="registration-sucess-card" class="d-none card mx-3 w-100">
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Pendaftaran Berhasil</h5>
            <p class="mb-0">Silahkan melakukan login.</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{--javascript--}}
  <script>
    @if(isset($registration_success) && $registration_success)
      document.querySelector("#registration-sucess-card").classList.remove('d-none');
      document.querySelector("#registration-form").classList.add('d-none');
    @endif
  </script>

@endsection
