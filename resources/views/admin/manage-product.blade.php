@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>
    #side-nav:hover {
      background-color: #F2F2F2;
    }
    .toast-container {
      z-index: 1080;
    }
  </style>

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>
  <script src="js/sticky-header-menu-fix.js"></script>
  <script src="js/sticky-table-item-fix.js"></script>

  {{--toast success--}}
  <div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
    <div id="liveToast" class="toast align-items-center bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body text-white">
          Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  {{--toast error validation--}}
  <div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
    <div id="liveToast2" class="toast align-items-center bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="300000">
      <div class="d-flex">
        <div class="toast-body text-white">
          Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script>
    window.onload = () => {
      const toastLiveExample = document.getElementById('liveToast');
      const changeText = (text) => toastLiveExample.querySelector('.toast-body').innerHTML = `${text}`;
      const toast = new bootstrap.Toast(toastLiveExample);
      {{--success--}}
      @if ($message = Session::get('success'))
        changeText("{{ $message }}");
        toast.show();
      @endif


      const toastLiveExample2 = document.getElementById('liveToast2');
      const changeText2 = (text) => toastLiveExample2.querySelector('.toast-body').innerHTML = `${text}`;
      const toast2 = new bootstrap.Toast(toastLiveExample2);

      {{--error validation--}}
      let message = "Pengisian gagal:";
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          message += "<li>{{ $error }}</li>";
        @endforeach
        changeText2(message);
        toast2.show();
      @endif
    }
  </script>

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col border-end">
        {{-- header menu --}}
        <div class="row bg-light border-bottom sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Produk</h5>
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
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari produk" aria-label="Search" aria-describedby="search-addon" />
            </div>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-kategori">+ Kategori</button>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk">+ Produk</button>
          </div>
          <div class="container-fluid border-top bg-white">
            <div class="row">
              <div class="col-6">
                <p class="mb-0 py-2 fw-bold">Produk</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Harga</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Kategori</p>
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
          <div class="col-6">

            {{-- product item --}}
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
              <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- harga --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp3.050.000</p>
          </div>
          {{-- kategori --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Graphics Card</p>
          </div>
          {{-- action: edit / delete --}}
          <div class="col-2 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <div class="row">
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-product"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-hapus-product"><i class="fas fa-trash"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- table row --}}
        <div class="row border-bottom bg-white">
          <div class="col-6">

            {{-- product item --}}
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
              <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          {{-- harga --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp3.050.000</p>
          </div>
          {{-- kategori --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Graphics Card</p>
          </div>
          {{-- action: edit / delete --}}
          <div class="col-2 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <div class="row">
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-product"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-hapus-product"><i class="fas fa-trash"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- pagination --}}
        <div class="row bg-light py-3">
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

  <!-- modal: hapus product -->
  <div class="modal fade" id="modal-hapus-product" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Produk?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penghapusan produk.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Hapus</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: tambah produk -->
  <div class="modal fade" id="modal-tambah-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/manage-product" method="post">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Produk</p>
                    <input id="" name="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Kategori</p>
                    <select class="form-select" id="" name="category_id">

                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                      @endforeach

                    </select>
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Harga</p>
                    <input id="" name="harga" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Harga">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Stok</p>
                    <input id="" name="stok" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Stok">
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Berat (gram)</p>
                    <input id="" name="berat" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                    <textarea id="" name="deskripsi" type="text" class="form-control" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;"></textarea>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                    <input class="form-control" name="photo_1" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Depan</label>
                    <input class="form-control" name="photo_2" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Samping</label>
                    <input class="form-control" name="photo_3" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Belakang</label>
                    <input class="form-control" name="photo_4" type="file" id="formFile">
                  </div>
                </div>
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

  <!-- modal: edit produk -->
  <div class="modal fade" id="modal-edit-product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ubah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Nama Produk</p>
                  <input id="" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk" value="VGA MSI GT1030 AERO ITX 2G OC | GT 1030 2GB1030 2GB">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Kategori</p>
                  <select class="form-select" id="">
                    <option value="0">Processor</option>
                    <option value="1" selected>Graphics Card</option>
                    <option value="2">Memory</option>
                    <option value="3">Storage</option>
                    <option value="4">Monitor</option>
                  </select>
                </div>
                <div class="col">
                  <p class="mb-0 fw-bold">Harga</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Harga" value="1500000">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Stok</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Stok" value="11">
                </div>
                <div class="col">
                  <p class="mb-0 fw-bold">Berat (gram)</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)" value="800">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                  <textarea id="" type="text" class="form-control" name="name" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;">Product Name : MSI GeForce GT 1030 2GB DDR4 - AERO ITX 2G OC&#13;&#10;Brand : MSI&#13;&#10;Interface : PCI Express x16 3.0&#13;&#10;GPU : GeForce GT 1030&#13;&#10;Base Clock : 1265 MHz&#13;&#10;Boost Clock : 1518 MHz&#13;&#10;Memory Clock Speed : 6008 MHz&#13;&#10;Memory Size : 2GB&#13;&#10;Memory Interface : 64 bit</textarea>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="mb-3">
                  <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                  <input class="form-control" type="file" id="formFile">
                </div>
              </div>
              <div class="row">
                <div class="mb-3">
                  <label for="formFile" class="form-label fw-bold">Foto Depan</label>
                  <input class="form-control" type="file" id="formFile">
                </div>
              </div>
              <div class="row">
                <div class="mb-3">
                  <label for="formFile" class="form-label fw-bold">Foto Samping</label>
                  <input class="form-control" type="file" id="formFile">
                </div>
              </div>
              <div class="row">
                <div class="mb-3">
                  <label for="formFile" class="form-label fw-bold">Foto Belakang</label>
                  <input class="form-control" type="file" id="formFile">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: tambah kategori -->
  <div class="modal fade" id="modal-tambah-kategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <input id="nama" name="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Nama Kategori">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="formFile" class="form-label fw-bold">Foto Kategori</label>
                <input class="form-control" name="photo" type="file" id="formFile">
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
