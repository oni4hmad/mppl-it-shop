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
          <a href="/order-history-product" class="text-decoration-none"><p class="fw-bold text-break text-secondary">Produk Elektronik</p></a>
          <a href="/order-history-service" class="text-decoration-none"><p class="fw-bold text-break text-dark text-decoration-underline">Servis Komputer</p></a>
        </div>
      </div>

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Riwayat Order</h5>
          <div class="d-flex flex-row align-items-center mb-3">
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

        {{-- table row --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">

            {{-- service item --}}
            <div class="row mx-0 py-3">
              {{-- foto teknisi --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- service name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">Servis: terkena virus</p>
                    <p class="mb-0 px-0 text-break">Teknisi: (sedang dicari)</p>
                    <p class="mb-0 text-secondary text-break">2 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Mencari Teknisi</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">-</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-batalkan-pesanan">Batalkan Pesanan</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 9001</p>
            </div>
          </div>
        </div>

        {{-- table row --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">

            {{-- service item --}}
            <div class="row mx-0 py-3">
              {{-- foto teknisi --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- service name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">Servis: komputer tidak bisa menyala</p>
                    <p class="mb-0 px-0 text-break">Teknisi: Budi Ramadhan</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Diproses</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">-</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-batalkan-pesanan">Batalkan Pesanan</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 9000</p>
            </div>
          </div>
        </div>

        {{-- table row --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">

            {{-- service item --}}
            <div class="row mx-0 py-3">
              {{-- foto teknisi --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- service name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">Servis: komputer tidak bisa menyala</p>
                    <p class="mb-0 px-0 text-break">Teknisi: Budi Ramadhan</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Selesai</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp150.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-catatan-teknisi">Catatan Teknisi</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 8999</p>
            </div>
          </div>
        </div>

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

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  <!-- modal: batalkan pesanan -->
  <div class="modal fade" id="modal-batalkan-pesanan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Pesanan?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi pembalasan pesanan Anda.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: catatan teknisi -->
  <div class="modal fade" id="modal-catatan-teknisi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Catatan Teknisi (Order ID: 8999)</h5>
            <p class="mb-0 text-secondary">Diservis oleh: Budi Ramadhan</p>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 fw-bold">Total Biaya</p>
          <input id="" type="text" value="150000" class="form-control mb-3" required autocomplete="name" autofocus placeholder="Total biaya" disabled>
          <p class="mb-0 fw-bold">Rincian Servis</p>
          <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Rincian servis" disabled>tidak ada penggantian perangkat keras komputer, hanya pembersihan komputer, pembaruan thermal paste, dan install ulang windows (total Rp150.000)</textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm px-5 text-white fw-bold" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

@endsection
