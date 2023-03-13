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
  <script src="/js/copy-kode-pembayaran.js"></script>

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
            <p class="card-text mb-0 fw-bold">Nomor Rekening</p>
            <div class="d-flex mb-4 justify-content-between align-items-center">
              <p class="card-text fw-bold fs-4 mb-0 me-4">{{ '827708912341234' }}</p>
              <button id="copy-kode-pembayaran" data-clipboard-text="{{ '827708912341234' }}" type="button" class="btn btn-outline-primary fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="manual" title="Copied!">
                <i class="fas fa-copy me-1"></i>Salin
              </button>
            </div>
            <p class="card-text mb-0 fw-bold">Total Pembayaran</p>
            <div class="d-flex justify-content-between align-items-center">
              <p class="card-text fw-bold fs-4 mb-0 me-4">Rp7.015.000</p>
              <button type="button" class="btn btn-outline-primary btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modal-detail-order">Detail Order</button>
            </div>
          </div>
          <div class="card-footer bg-transparent">
            {{-- cek status --}}
            <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-upload-bukti-pembayaran">Upload Bukti Pembayaran</button>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  <!-- modal: upload bukti pembayaran -->
  <div class="modal fade" id="modal-upload-bukti-pembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Upload Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/category" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Atas Nama</p>
                <input name="atas_nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="formFile" class="form-label fw-bold">Foto Bukti Pembayaran</label>
                <input class="form-control" name="bukti_pembayaran" type="file" id="formFile" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: detail order -->
  <div class="modal fade" id="modal-detail-order" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Detail Order (ID: 12001)</h5>
            <p class="mb-0 text-secondary">Total: 3 barang</p>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @for ($i = 0; $i < 3; $i++)
            <div class="row mb-3">
              <div class="col-auto pe-0">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
              <div class="col ms-2 ps-0">
                <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
              </div>
            </div>
          @endfor
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm px-5 text-white fw-bold" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>


@endsection
