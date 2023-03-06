@extends('layouts.main')

@section('content')

  {{-- js: copy nomor resi --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
  <script src="js/copy-kode-pembayaran.js"></script>

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>

  <div class="container">
    <div class="row justify-content-center py-4">
      <div class="col-2">
        <div class="row px-3 sticky-top" id="sticky-fix">
          <button type="button" class="btn btn-outline-primary py-3 fw-bold" onclick="{{ "location.href = '/order-history-product';" }}">
            <i class="fas fa-chevron-circle-left me-2"></i>Kembali
          </button>
          <p class="mt-2 text-center text-secondary">ORDER ID: 12000</p>
        </div>
      </div>

      <div class="col-8">

        {{-- progress circle --}}
        <div class="row px-3">
          <div class="col-auto">
            <div class="d-flex align-items-center justify-content-center bg-primary px-3 rounded-circle" style="width: 100px; height: 100px;">
              <i class="fas fa-check text-white fa-3x"></i>
            </div>
          </div>
          <div class="col">
            <div class="row h-50 border-bottom border-secondary"></div>
          </div>
          <div class="col-auto">
            <div class="d-flex align-items-center justify-content-center bg-primary px-3 rounded-circle" style="width: 100px; height: 100px;">
              <i class="fas fa-check text-white fa-3x"></i>
            </div>
          </div>
          <div class="col">
            <div class="row h-50 border-bottom border-secondary"></div>
          </div>
          <div class="col-auto">
            <div class="d-flex align-items-center justify-content-center bg-secondary px-3 rounded-circle" style="width: 100px; height: 100px;">
              <i class="fas fa-check text-white fa-3x"></i>
            </div>
          </div>
        </div>

        {{-- progress title --}}
        <div class="row px-3 mb-4">
          <div class="col-auto">
            <div class="d-flex justify-content-center" style="width: 100px;">
              <p class="mb-0 text-break fw-bold text-center">Dikemas</p>
            </div>
          </div>
          <div class="col">
          </div>
          <div class="col-auto">
            <div class="d-flex justify-content-center" style="width: 100px;">
              <p class="mb-0 text-break fw-bold text-center">Dalam Perjalanan</p>
            </div>
          </div>
          <div class="col">
          </div>
          <div class="col-auto">
            <div class="d-flex justify-content-center" style="width: 100px;">
              <p class="mb-0 text-break fw-bold text-center">Sampai Tujuan</p>
            </div>
          </div>
        </div>

        {{-- nomor resi & track barang --}}
        <div class="row bg-primary justify-content-center rounded-3">
          <div class="card px-0 bg-body rounded">
            <div class="card-header bg-primary">
              <h5 class="mb-0 fw-bold text-white">Detail</h5>
            </div>
            <div class="card-body py-4">
              <p class="card-text mb-0 fw-bold">Nomor Resi</p>
              <div class="d-flex mb-4 pb-4 justify-content-start border-bottom">
                <p class="card-text fw-bold fs-4 mb-0 me-4">{{ '002714553710' }}</p>
                <button id="copy-kode-pembayaran" data-clipboard-text="{{ '002714553710' }}" type="button" class="btn btn-outline-primary fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="manual" title="Copied!">
                  <i class="fas fa-copy me-2"></i>Salin
                </button>
              </div>

              {{-- detail track paket --}}
              {{-- tanggal --}}
              <div class="row">
                <div class="col-lg-1 col-md-2 d-flex justify-content-center align-items-center">
                  <i class="fas fa-circle text-primary fa-2x"></i>
                </div>
                <div class="col d-flex align-items-center">
                  <p class="mb-0 text-break fw-bold text-primary">28 Jun 2021</p>
                </div>
              </div>
              {{-- info status --}}
              <div class="row">
                <div class="col-lg-1 col-md-2 d-flex justify-content-center align-items-center">
                  <div class="vr"></div>
                </div>
                <div class="col py-2 d-flex align-items-center">
                  <p class="mb-0 text-break fw-bold text-dark">Paket telah di pick up</p>
                </div>
              </div>
              {{-- tanggal --}}
              <div class="row">
                <div class="col-lg-1 col-md-2 d-flex justify-content-center align-items-center">
                  <i class="fas fa-circle text-primary fa-2x"></i>
                </div>
                <div class="col d-flex align-items-center">
                  <p class="mb-0 text-break fw-bold text-primary">28 Jun 2021</p>
                </div>
              </div>
              {{-- info status --}}
              <div class="row">
                <div class="col-lg-1 col-md-2 d-flex justify-content-center align-items-center">
                  <div class="vr"></div>
                </div>
                <div class="col py-2 d-flex align-items-center">
                  <p class="mb-0 text-break fw-bold text-dark">Permintaan pickup telah diterima</p>
                </div>
              </div>

            </div>
          </div>
        </div>
        {{-- card details --}}

      </div>
      <div class="col-2">
        {{-- sisi kanan kosong --}}
        {{-- ini jangan dihapus --}}
      </div>
    </div>
  </div>

@endsection
