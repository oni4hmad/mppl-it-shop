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

      <div class="col" style="min-height: 90vh;">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
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
<<<<<<< HEAD
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold">+ Kategori</button>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk"><button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold">+ Produk</button></a>
=======
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-kategori">+ Kategori</button>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk">+ Produk</button>
>>>>>>> origin
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
<<<<<<< HEAD
        @foreach ($products as $product)
          {{-- table row --}}
          <div class="row border-bottom border-end bg-white">
            <div class="col-6">

              {{-- product item --}}
              <div class="row mx-0 py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('{{ asset('images') }}/{{ $product->foto1 }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- product name --}}
                <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">{{ $product->name }}</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            {{-- harga --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
            </div>
            {{-- kategori --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">{{ $product->kategori }}</p>
            </div>
            {{-- action: edit / delete --}}
            <div class="col-2 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                <div class="row">
                  <div class="col-auto">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-product-{{ $product->id }}"><i class="fas fa-edit"></i></a>
=======

        {{-- table row --}}
        <div class="row border-bottom border-end bg-white">
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
        <div class="row border-bottom border-end bg-white">
          <div class="col-6">

            {{-- product item --}}
            <div class="row mx-0 py-3">
              {{-- image --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
>>>>>>> origin
                  </div>
                </div>
              </div>
              {{-- product name --}}
              <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
<<<<<<< HEAD
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-hapus-product-{{ $product->id }}"><i class="fas fa-trash"></i></a>
=======
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
>>>>>>> origin
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
<<<<<<< HEAD
          @endforeach
=======
        </div>
>>>>>>> origin

        {{-- pagination --}}
        <div class="row border-end bg-light py-3" >
          {{ $products->onEachSide(1)->links() }}
        </div>
      </div>

    </div>
  </div>



  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}
  
  <!-- modal: hapus product -->
  @foreach ($products as $product)
  <div class="modal fade" id="modal-hapus-product-{{ $product->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100" onclick="location.href='/delete-product/{{ $product->id }}'">Hapus</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <!-- modal: tambah produk -->
  <div class="modal fade" id="modal-tambah-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Produk</p>
                    <input id="" type="text" name="name" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Kategori</p>
                    <select name="kategori" class="form-select" id="">
                      <option value="Processor">Processor</option>
                      <option value="Graphics Card">Graphics Card</option>
                      <option value="Memory">Memory</option>
                      <option value="Storage">Storage</option>
                      <option value="Monitor">Monitor</option>
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
                    <textarea id="" name="deskripsi" type="text" class="form-control" name="name" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;"></textarea>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                    <input class="form-control" name="foto1" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Depan</label>
                    <input class="form-control" name="foto2" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Samping</label>
                    <input class="form-control" name="foto3" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Belakang</label>
                    <input class="form-control" name="foto4" type="file" id="formFile">
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
  @foreach ($products as $product)  
  <div class="modal fade" id="modal-edit-product-{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" action="{{ route('product.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row">
              <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Produk</p>
                    <input id="" type="text" name="name" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk" value="{{ $product->name }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Kategori</p>
                    <select name="kategori" class="form-select" id="">
                      <option value="Processor">Processor</option>
                      <option value="Graphics Card">Graphics Card</option>
                      <option value="Memory">Memory</option>
                      <option value="Storage">Storage</option>
                      <option value="Monitor">Monitor</option>
                    </select>
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Harga</p>
                    <input id="" name="harga" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Harga" value="{{ $product->harga }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Stok</p>
                    <input id="" name="stok" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Stok" value="{{ $product->stok }}">
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Berat (gram)</p>
                    <input id="" name="berat" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)" value="{{ $product->berat }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                    <textarea id="" name="deskripsi" type="text" class="form-control" name="name" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;">{{ $product->deskripsi }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                    <input class="form-control" name="foto1" type="file" id="formFile" value="{{ $product->foto1 }}">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Depan</label>
                    <input class="form-control" name="foto2" type="file" id="formFile" value="{{ $product->foto2 }}">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Samping</label>
                    <input class="form-control" name="foto3" type="file" id="formFile" value="{{ $product->foto3 }}">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Belakang</label>
                    <input class="form-control" name="foto4" type="file" id="formFile" value="{{ $product->foto4 }}">
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Ubah</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  @endforeach

  <!-- modal: tambah kategori -->
  <div class="modal fade" id="modal-tambah-kategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 fw-bold">Nama Kategori</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="formFile" class="form-label fw-bold">Foto Kategori</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
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
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Nama Produk</p>
                  <input id="" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Kategori</p>
                  <select class="form-select" id="">
                    <option value="0">Processor</option>
                    <option value="1">Graphics Card</option>
                    <option value="2">Memory</option>
                    <option value="3">Storage</option>
                    <option value="4">Monitor</option>
                  </select>
                </div>
                <div class="col">
                  <p class="mb-0 fw-bold">Harga</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Harga">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Stok</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Stok">
                </div>
                <div class="col">
                  <p class="mb-0 fw-bold">Berat (gram)</p>
                  <input id="" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                  <textarea id="" type="text" class="form-control" name="name" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;"></textarea>
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
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
        </div>
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
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 fw-bold">Nama Kategori</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="formFile" class="form-label fw-bold">Foto Kategori</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
        </div>
      </div>
    </div>
  </div>

@endsection
