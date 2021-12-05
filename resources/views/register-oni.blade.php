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
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Daftar Sekarang</h5>
          </div>
          <div class="card-body">
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Email</p>
                <div class="input-group input-group-md">
                  <input type="email" class="form-control" aria-describedby="emailHelp" aria-describedby="inputGroup-sizing-sm" placeholder="Email">
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Password</p>
                <div class="input-group input-group-md">
                  <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Password">
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nomor HP</p>
                <div class="input-group input-group-md">
                  <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nomor HP">
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nama</p>
                <div class="input-group input-group-md">
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nama">
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Kabupaten / Kota</p>
                <div class="input-group input-group-md">
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Kabupaten / Kota">
                </div>
              </div>
              <div class="col-4">
                <p class="card-text mb-0 fw-bold">Kode Pos</p>
                <div class="input-group input-group-md">
                  <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Kode Pos">
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Alamat</p>
                <div class="input-group input-group-md">
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Alamat">
                </div>
              </div>
            </div>
          </div>
          {{-- btn daftar --}}
          <div class="card-footer bg-transparent">
            <button type="button" class="btn btn-primary w-100 mb-2 fw-bold fs-5">Daftar</button>
          </div>
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
