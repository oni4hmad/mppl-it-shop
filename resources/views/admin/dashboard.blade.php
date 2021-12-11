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
      <div class="col-auto ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          {{-- sidebar: profile --}}
          <div class="row border-bottom pb-4 mb-4">
            <div class="col px-0 pe-1" style="max-width: 50px; max-height: 50px;">
              <div style="width: 50px; height: 50px;">
                <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>
            <div class="col">
              <p class="m-0 p-0 fw-bold text-break">Pokimane</p>
              <p class="m-0 p-0 text-primary text-break">Admin</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-decoration-underline">
            <i class="fas fa-home me-2"></i>Home</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-microchip me-2"></i>Produk</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-user-cog me-2"></i>Teknisi</p>
          </a>
          <p class="my-3 p-2 py-3 border-top border-bottom fw-bold text-break text-secondary">Orderan</p>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-server me-2"></i>Produk Elektronik</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-cog me-2"></i>Jasa Servis</p>
          </a>
        </div>
      </div>

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
                <p class="card-text mb-0">4 produk dijual</p>
              </div>
              <div class="card-footer bg-transparent">
                <button type="button" class="btn btn-primary w-100 mb-2 fw-bold">Kelola Produk</button>
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
                <button type="button" class="btn btn-primary w-100 mb-2 fw-bold">Kelola Teknisi</button>
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
                <button type="button" class="btn btn-primary w-100 mb-2 fw-bold">Kelola Orderan</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
