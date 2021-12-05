@extends('layouts.main')

@section('content')

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
              <p class="m-0 p-0 fw-bold text-break">Oni Ahmad</p>
              <p class="m-0 p-0 text-primary text-break">Pelanggan</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p class="fw-bold text-break text-dark text-decoration-underline">Produk Elektronik</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold text-break text-secondary">Servis Komputer</p></a>
        </div>
      </div>

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Riwayat Order</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <p class="text-secondary fw-bold me-3 mb-0">Kategori</p>
            <div class="input-group input-group-sm px-0 me-5" style="width: 150px;">
              <select class="form-select" id="inputGroupSelect01">
                <option value="0" selected>All Products</option>
                <option value="1">Processor</option>
                <option value="2">Graphics Card</option>
                <option value="3">Memory</option>
                <option value="4">Storage</option>
                <option value="5">Monitor</option>
              </select>
            </div>
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <button type="button" class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3">
                <i class="fas fa-search text-secondary"></i>
              </button>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari orderan" aria-label="Search" aria-describedby="search-addon" />
            </div>
          </div>
          <div class="container-fluid border-top bg-white">
            <div class="row">
              <div class="col-5">
                <p class="mb-0 py-2 fw-bold">Order</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Status</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Total Bayar</p>
              </div>
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Action</p>
              </div>
            </div>
          </div>
        </div>

        {{-- table --}}
        @for ($j = 0; $j < 3; $j++)
          {{-- table row --}}
          <div class="row border-bottom border-end bg-white">
            <div class="col-5">

              {{-- order item --}}
              @for ($i = 0; $i < 2; $i++)
                <div class="row mx-0 py-3">
                  {{-- image --}}
                  <div class="col-auto px-0 rounded-3">
                    <div class="p-0 me-1">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                  </div>
                  {{-- product name --}}
                  <div class="col d-flex flex-column justify-content-between">
                    <div class="row justify-content-between">
                      <div class="col-auto">
                        <p class="mb-0 text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                        <p class="px-0 fw-bolder text-break">Rp1.500.000</p>
                      </div>
                    </div>
                  </div>
                </div>
              @endfor

            </div>
            {{-- status --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Pembayaran</p>
            </div>
            {{-- total bayar --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
            </div>
            {{-- action --}}
            <div class="col-3 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">Action</button>
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
