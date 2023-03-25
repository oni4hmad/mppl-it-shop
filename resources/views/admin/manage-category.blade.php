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
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Kategori</h5>
          <form action="/manage-product">
            <div class="d-flex flex-row align-items-center mb-3">
              <div class="input-group input-group-sm rounded" style="width: 250px;">
                <button type="button" class="btn btn-white bg-white border-end-0 border border-secondary rounded-end rounded-pill px-3" disabled>
                  <i class="fas fa-search text-secondary"></i>
                </button>
                <input type="search" name="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari kategori" aria-label="Search" aria-describedby="search-addon" value="" />
              </div>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-category">+ Kategori</button>
            </div>
          </form>
          <div class="container-fluid border-top border-bottom bg-white">
            <div class="row">
              <div class="col-7">
                <p class="mb-0 py-2 fw-bold">Kategori</p>
              </div>
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Total Produk</p>
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
          <div class="col-7">
            {{-- category item --}}
            <a class="text-decoration-none text-black" href="#">
              <div class="row mx-0 py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6rem; height: 6rem;">
                      <div class="w-100 h-100 rounded-3 border border-body" style="background-image: url('/{{ 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- category name --}}
                <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">Monitor</p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- kategori --}}
          <div class="col-3 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">129</p>
          </div>

          {{-- action: edit / delete --}}
          <div class="col-2 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <div class="row">
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-category"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-category"><i class="fas fa-trash"></i></a>
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

  <!-- modal: delete category -->
  <div class="modal fade" id="modal-delete-category" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Kategori?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penghapusan kategori.</p>
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

  <!-- modal: edit category -->
  <div class="modal fade" id="modal-edit-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/category" method="post">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Kategori</p>
                    <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Kategori" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label for="formFile" class="form-label fw-bold">Foto Kategori</label>
                    <input class="form-control" name="photo" type="file" id="formFile" required>
                  </div>
                </div>
              </div>
              <div class="col-auto d-flex align-items-center">
                <div class="p-0 me-1">
                  <div style="width: 6rem; height: 6rem;">
                    <div class="w-100 h-100 rounded-3 border border-body" style="background-image: url('/{{ 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
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

  <!-- modal: tambah kategori -->
  <div class="modal fade" id="modal-tambah-category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/category" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Kategori</p>
                <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Kategori" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="formFile" class="form-label fw-bold">Foto Kategori</label>
                <input class="form-control" name="photo" type="file" id="formFile" required>
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
