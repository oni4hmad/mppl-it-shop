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
      @include('partials.admin-sidebar')

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
            <button type="button" class="btn btn-sm btn-primary px-2 ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-teknisi">+ Teknisi Servis</button>
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
                    <p class="mb-0 fw-bolder text-break">Hasan Abi</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- Pesanan --}}
          <div class="col-2 py-3">
            <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modal-detail-pesanan">
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
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu
              Konfirmasi</p>
          </div>
          {{-- Action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
                <p class="text-white m-0" data-bs-toggle="modal" data-bs-target="#modal-batalkan-permintaan">Batalkan Permintaan</p>
              </button>
            </div>
          </div>
        </div>

        {{-- table row 3 --}}
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
            <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modal-detail-pesanan">
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

  <!-- modal: detail pesanan -->
  <div class="modal fade" id="modal-detail-pesanan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Detail Pesanan (ID: 8999)</h5>
            <p class="mb-0 text-secondary">Diservis oleh: Budi Ramadhan</p>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 fw-bold">Nama Pemesan</p>
              <input id="nama" type="text" value="Fajar Satria" class="form-control" required autocomplete="name" autofocus placeholder="Nama Pemesan" disabled>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <p class="p-0 m-0 fw-bold text-break">Alamat</p>
              <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Alamat" disabled>Ruko West Point, Jl. Raya Sambikerep No.25 H, Sambikerep, Surabaya Jawa Timur, 60185</textarea>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 fw-bold">Nomor HP</p>
              <input id="nama" type="text" value="628945681234" class="form-control" required autocomplete="name" autofocus placeholder="Nomor HP" disabled>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 fw-bold">Permintaan Jadwal Servis</p>
              <input id="nama" type="text" value="Selasa, 29 Juni 2021, Jam 12.00" class="form-control" required autocomplete="name" autofocus placeholder="Permintaan Jadwal Servis" disabled>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <p class="p-0 m-0 fw-bold text-break">Masalah Yang Dialami</p>
              <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Masalah Yang Dialami" disabled>Indikator cpu komputer menyala tapi layar blank</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm px-4 text-white fw-bold" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: batalkan permintaan -->
  <div class="modal fade" id="modal-batalkan-permintaan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Permintaan?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi pembatalan permintaan servis.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: tambah teknisi -->
  <div class="modal fade" id="modal-tambah-teknisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Teknisi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 fw-bold">Masukkan Email</p>
          <input id="email" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus placeholder="Email">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
        </div>
      </div>
    </div>
  </div>

@endsection
