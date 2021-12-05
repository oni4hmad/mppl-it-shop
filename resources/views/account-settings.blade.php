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

  <div class="container">
    <div class="row py-4 justify-content-center" style="min-height: 90vh;">
      <div class="col-6">

        {{-- opsi pengaturan akun --}}
        <div class="card w-100">
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Pengaturan Akun</h5>
          </div>
          <div class="card-body">
            <div class="row py-3">
              <div class="col-3">
                <p class="card-text mb-0 text-break fw-bold">Nama</p>
              </div>
              <div class="col">
                <p class="card-text mb-0 text-break">Oni Ahmad</p>
              </div>
              <div class="col-2">
                <a href="#"><p class="card-text mb-0 text-break">Edit</p></a>
              </div>
            </div>
            <div class="row py-3">
              <div class="col-3">
                <p class="card-text mb-0 text-break fw-bold">Email</p>
              </div>
              <div class="col">
                <p class="card-text mb-0 text-break">oni_ahmad@gmail.com</p>
              </div>
              <div class="col-2">
                <a href="#"><p class="card-text mb-0 text-break">Edit</p></a>
              </div>
            </div>
            <div class="row py-3">
              <div class="col-3">
                <p class="card-text mb-0 text-break fw-bold">Nomor HP</p>
              </div>
              <div class="col">
                <p class="card-text mb-0 text-break">089512341234</p>
              </div>
              <div class="col-2">
                <a href="#"><p class="card-text mb-0 text-break">Edit</p></a>
              </div>
            </div>
            <div class="row py-3">
              <div class="col-3">
                <p class="card-text mb-0 text-break fw-bold">Alamat</p>
              </div>
              <div class="col">
                <p class="card-text mb-0 text-break">Jl. Manukan Indah II 19C/8, Kota Surabaya, Jawa Timur, 60185</p>
              </div>
              <div class="col-2">
                <a href="#"><p class="card-text mb-0 text-break">Edit</p></a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col" style="max-width: 250px;">


        {{-- opsi foto --}}
        <div class="card w-100">
          <div class="card-img-top p-3 pb-0" style="width: auto; height: 12em;">
            <div class="card-img-top w-100 h-100 bg-image border" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
          </div>
          <div class="card-body">
            {{-- pilih foto --}}
            <button type="button" class="btn btn-outline-primary w-100 fw-bold fs-6">Pilih Foto</button>
          </div>
          {{-- Ubah password --}}
          <div class="card-footer bg-transparent">
            <button type="button" class="btn btn-outline-primary my-2 w-100 fw-bold fs-6">Ubah Password</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
