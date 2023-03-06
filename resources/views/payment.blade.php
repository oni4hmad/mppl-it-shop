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

  {{-- js: copy kode pembayaran --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
  <script src="js/copy-kode-pembayaran.js"></script>

  <div class="container my-4" style="height: 85vh;">
    <div class="row w-100 justify-content-center">
      {{-- batas akhir pembayaran --}}
      <h5 class="text-center fw-normal">Batas Akhir Pembayaran</h5>
      <h5 class="text-center fw-bolder">Selasa, 29 Juni 2021 02:22</h5>

      {{-- card: informasi pembayaran --}}
      <div class="col-sm-12 col-md-7 col-lg-5 col-xl-4 pt-4">
        <div class="card shadow mb-5 bg-body rounded">
          <div class="card-header bg-primary">
            <p class="mb-0 fw-normal text-white">Metode Pembayaran</p>
            <h5 class="fw-bold text-white">BNI Virtual Account</h5>
          </div>
          <div class="card-body py-4">
            <p class="card-text mb-0 fw-bold">Nomor Virtual Account</p>
            <div class="d-flex mb-4 justify-content-between">
              <p class="card-text fw-bold fs-4 mb-0 me-4">{{ '827708912341234' }}</p>
              <button id="copy-kode-pembayaran" data-clipboard-text="{{ '827708912341234' }}" type="button" class="btn btn-outline-primary fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="manual" title="Copied!">
                <i class="fas fa-copy me-1"></i>Salin
              </button>
            </div>
            <p class="card-text mb-0 fw-bold">Total Pembayaran</p>
            <p class="card-text fw-bold fs-4">Rp7.015.000</p>
          </div>
          <div class="card-footer bg-transparent">
            {{-- cek status --}}
            <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = '/track';" }}">Cek Status</button>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
