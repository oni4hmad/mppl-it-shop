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

  <div class="container">
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
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-home me-2"></i>Home</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-microchip me-2"></i>Produk</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-decoration-underline">
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

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Teknisi Servis</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <button type="button" class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3">
                <i class="fas fa-search text-secondary"></i>
              </button>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari teknisi servis" aria-label="Search" aria-describedby="search-addon" />
            </div>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold">+ Teknisi Servis</button>
          </div>
          <div class="container-fluid border-top bg-white">
            <div class="row">
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Nama Teknisi</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Pesanan</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Nomor HP</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Status</p>
              </div>
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Action</p>
              </div>
            </div>
          </div>
        </div>


        {{-- table --}}

        {{-- table row 1 --}}
        <div class="row border-bottom border-end bg-white">
          {{-- nama teknisi --}}
          <div class="col-3">

            {{-- service item --}}
            <div class="row mx-0 py-3">
              {{-- foto teknisi --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 4rem; height: 4rem;">
                    <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- service name --}}
              <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">Budi Ramadhan</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- Pesanan --}}
          <div class="col-2 py-3">
            <a class="text-decoration-none" href="#">
              <div class="--sticky-table-item d-flex flex-row align-items-center">
                <div class="input-group input-group-sm px-0">
                  <select class="form-select w-100" id="inputGroupSelect01">
                    <option value="0" selected>ID: 9001</option>
                    <option value="1">ID: 9002</option>
                    <option value="2">ID: 9003</option>
                  </select>
                </div>
              </div>
            </a>
          </div>
          {{-- Nomor HP --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">0852-3565-9596</p>
          </div>
          {{-- Status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Tersedia</p>
          </div>
          {{-- Action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
                <p class="text-white m-0">Kirim Permintaan</p>
              </button>
            </div>
          </div>
        </div>

        {{-- table row 2 --}}
        @for ($i = 0; $i < 2; $i++)
          <div class="row border-bottom border-end bg-white">
            {{-- nama teknisi --}}
            <div class="col-3">

              {{-- service item --}}
              <div class="row mx-0 py-3">
                {{-- foto teknisi --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 4rem; height: 4rem;">
                      <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- service name --}}
                <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">Atta Halilintar</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            {{-- Pesanan --}}
            <div class="col-2 py-3">
              <a class="text-decoration-none" href="#">
                <div class="--sticky-table-item d-flex flex-row align-items-center">
                  <p class="mb-0 fw-bold text-primary" style="z-index: 1;">Lihat Detail</p>
                  <i class="fas fa-external-link-alt ms-2"></i>
                </div>
              </a>
            </div>
            {{-- Nomor HP --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">0852-3565-9596</p>
            </div>
            {{-- Status --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold text-danger" style="z-index: 1;">Tidak Tersedia</p>
            </div>
            {{-- Action --}}
            <div class="col-3 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill w-100 fw-bold" disabled>
                  <p class="text-white m-0">Kirim Permintaan</p>
                </button>
              </div>
            </div>
          </div>
        @endfor

        {{-- pagination --}}
        <div class="row border-end bg-light py-3">
          <nav aria-label="...">
            <ul class="pagination m-0 p-0 my-1 d-flex justify-content-center">
              <li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </div>

@endsection
