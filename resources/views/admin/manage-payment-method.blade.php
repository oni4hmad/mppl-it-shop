@extends('layouts.main')

@section('content')

  {{--sticky content fix--}}
  <script src="/js/sticky-content-fix.js"></script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col border-end">
        {{-- header menu --}}
        <div class="row bg-light" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Metode Pembayaran</h5>
          <form action="/manage-product">
            <div class="d-flex flex-row align-items-center mb-3">
              <div class="input-group input-group-sm rounded" style="width: 250px;">
                <button type="button" class="btn btn-white bg-white border-end-0 border border-secondary rounded-end rounded-pill px-3" disabled>
                  <i class="fas fa-search text-secondary"></i>
                </button>
                <input type="search" name="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari metode pembayaran" aria-label="Search" aria-describedby="search-addon" value="" />
              </div>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-payment">+ Metode Pembayaran</button>
            </div>
          </form>
          <div class="container-fluid border-top border-bottom bg-white">
            <div class="row">
              <div class="col-5">
                <p class="mb-0 py-2 fw-bold">Metode Pembayaran</p>
              </div>
              <div class="col-5">
                <p class="mb-0 py-2 fw-bold">Nomor Rekening</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Action</p>
              </div>
            </div>
          </div>
        </div>

        {{-- table --}}

        {{-- table row --}}
        <div class="row border-bottom bg-white">

          {{-- payment name --}}
          <div class="col-5 py-3">
            <p class="mb-0 fw-bolder text-break">BNI (Nomor Rekening)</p>
          </div>

          {{-- metode pembayaran --}}
          <div class="col-5 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">45345-23423-23434</p>
          </div>

          {{-- action: edit / delete --}}
          <div class="col-2 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <div class="row">
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-payment"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-payment"><i class="fas fa-trash"></i></a>
                </div>
              </div>
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

  <!-- modal: delete payment -->
  <div class="modal fade" id="modal-delete-payment" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Metode Pembayaran?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penghapusan metode pembayaran.</p>
        </div>
        <form action="#" method="post">
          @method('delete')
          @csrf
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Hapus</button>
            <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: edit payment -->
  <div class="modal fade" id="modal-edit-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Metode Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/payment" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Metode Pembayaran</p>
                <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Metode Pembayaran" required>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nomor Rekening</p>
                <input id="nama" name="nomor_rekening" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nomor Rekening" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: tambah metode pembayaran -->
  <div class="modal fade" id="modal-tambah-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Metode Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/payment" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Metode Pembayaran</p>
                <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Metode Pembayaran" required>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nomor Rekening</p>
                <input id="nama" name="nomor_rekening" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nomor Rekening" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
