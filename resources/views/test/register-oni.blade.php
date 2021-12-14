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
        <div class="card mx-3 w-100">
          <form method="POST" action="{{ route('register') }}">
            @csrf
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Daftar Sekarang</h5>
          </div>
          <div class="card-body">
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Email</p>
                <div class="input-group input-group-md">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Password</p>
                <div class="input-group input-group-md">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nomor HP</p>
                <div class="input-group input-group-md">
                  <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" autofocus placeholder="Nomor HP">
                  @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nama</p>
                <div class="input-group input-group-md">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Kabupaten / Kota</p>
                <div class="input-group input-group-md">
                  <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ old('kota') }}" required autocomplete="kota" autofocus placeholder="Kabupate/Kota">
                  @error('kota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <p class="card-text mb-0 fw-bold">Kode Pos</p>
                <div class="input-group input-group-md">
                  <input id="kode_pos" type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}" required autocomplete="kode_pos" autofocus placeholder="Kode Pos">
                  @error('kode_pos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Alamat</p>
                <div class="input-group input-group-md">
                  <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus placeholder="Alamat">
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
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

        {{-- pendaftaran berhasil: hapus d-none --}}
        <div class="d-none card mx-3 w-100">
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Pendaftaran Berhasil</h5>
            <p class="mb-0">Silahkan cek email untuk melakukan verifikasi pendaftaran.</p>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
