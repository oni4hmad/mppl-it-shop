@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>
    #side-nav:hover {
      background-color: #F2F2F2;
    }
  </style>

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>
  <script src="js/sticky-header-menu-fix.js"></script>
  <script src="js/sticky-table-item-fix.js"></script>

  <div class="container" style="min-height: 90vh;">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      {{-- dashboard info --}}
      <div class="col">
        <div class="row py-4 px-4">
          <div class="col-3 p-0 me-2">
            {{-- card 1 --}}
            <div class="card h-100 rounded">
              <div class="card-header">
                <p class="mb-0 fw-bold">Produk</p>
              </div>
              <div class="card-body py-4">
                <p class="card-text mb-0">{{ $countProduct }} produk dijual</p>
              </div>
              <div class="card-footer bg-transparent">
                <a href="/manage-product"><button type="button" class="btn btn-primary w-100 mb-2 fw-bold">Kelola Produk</button></a>
              </div>
            </div>
          </div>
          <div class="col-3 p-0 ms-2 me-2">
            {{-- card 2 --}}
            <div class="card h-100 rounded">
              <div class="card-header">
                <p class="mb-0 fw-bold">Teknisi Servis</p>
              </div>
              <div class="card-body py-4">
                <p class="card-text mb-0">2 teknisi servis</p>
                <ul>
                  <li>1 tersedia</li>
                  <li>1 tidak tersedia</li>
                </ul>
              </div>
              <div class="card-footer bg-transparent">
                <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = 'manage-technician'" }}">Kelola Teknisi</button>
              </div>
            </div>
          </div>
          <div class="col h-100 p-0 ms-2">
            {{-- card 3 --}}
            <div class="card h-100 rounded">
              <div class="card-header">
                <p class="mb-0 fw-bold">Orderan</p>
              </div>
              <div class="card-body py-4">
                <div class="row">
                  <div class="col">
                    <p class="card-text mb-0">7 barang terjual</p>
                    <ul>
                      <li>3 belum diproses</li>
                      <li>0 diproses</li>
                      <li>1 sedang dikirim</li>
                      <li>2 selesai</li>
                    </ul>
                  </div>
                  <div class="col">
                    <p class="card-text mb-0">2 pesanan servis</p>
                    <ul>
                      <li>1 diproses</li>
                      <li>1 selesai</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-transparent">
                <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = 'manage-product-order'" }}">Kelola Orderan</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
