@extends('layouts.main')

@section('content')

  {{--sticky content fix--}}
  <script src="/js/sticky-content-fix.js"></script>
  {{--autonumeric: currency formatting--}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.2/autoNumeric.min.js" integrity="sha512-x1gR+AwmBYNFnEk4ixRnurDnPeGmhkUVGZtuF5LYRvXk2z3uIbIhpQswbl2X0qTIB1/kx+PNzTwqD+ZOuYtHbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    window.onload = () => {
      const autoNumericOptionsEuro = {
        digitGroupSeparator        : '.',
        decimalCharacter           : ',',
        decimalPlaces              : '0',
        minimumValue               : '0',
        currencySymbol             : 'Rp ',
        emptyInputBehavior         : 'zero',
        currencySymbolPlacement    : AutoNumeric.options.currencySymbolPlacement.prefix,
        unformatOnSubmit           : true
      };
      document.querySelectorAll('input[name="harga"]').forEach(e => {
        new AutoNumeric(e, autoNumericOptionsEuro);
      });
    };
  </script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col border-end">
        {{-- header menu --}}
        <div class="row bg-light" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Produk</h5>
          <form action="/manage-product">
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="text-secondary fw-bold me-3 mb-0">Kategori</p>
              <div class="input-group input-group-sm px-0 me-5" style="width: 150px;">
                <select class="form-select" id="inputGroupSelect01" name="category" onchange="this.form.submit()">
                  <option value="">All Products</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ $category->slug == request()->category ? "selected" : "" }}>{{ $category->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="input-group input-group-sm rounded" style="width: 250px;">
                <button type="button" class="btn btn-white bg-white border-end-0 border border-secondary rounded-end rounded-pill px-3" disabled>
                  <i class="fas fa-search text-secondary"></i>
                </button>
                <input type="search" name="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari produk" aria-label="Search" aria-describedby="search-addon" value="{{ request()->search }}" />
              </div>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-kategori">+ Kategori</button>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk">+ Produk</button>
            </div>
          </form>
          <div class="container-fluid border-top border-bottom bg-white">
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

          {{-- no result to show --}}
          @if(!count($products))
            <div class="container-fluid py-4 text-center bg-white">
              <p class="text-secondary"><strong>No result found</strong></p>
            </div>
          @endif
        </div>

        {{-- table --}}

        {{-- table row --}}
        @foreach($products as $product)
          <div class="row border-bottom bg-white">
            <div class="col-6">

              {{-- product item --}}
              <a class="text-decoration-none text-black" href="/product/{{ $product->slug }}">
                <div class="row mx-0 py-3">
                  {{-- image --}}
                  <div class="col-auto px-0 rounded-3">
                    <div class="p-0 me-1">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-body" style="background-image: url('/{{ $product->photo_1->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                  </div>
                  {{-- product name --}}
                  <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                    <div class="row justify-content-between">
                      <div class="col-auto">
                        <p class="mb-0 fw-bolder text-break">{{ $product->nama }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

            </div>
            {{-- harga --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
            </div>
            {{-- kategori --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">{{ $product->category->nama }}</p>
            </div>
            {{-- action: edit / delete --}}
            <div class="col-2 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                <div class="row">
                  <div class="col-auto">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-product{{ $product->id }}"><i class="fas fa-edit"></i></a>
                  </div>
                  <div class="col-auto">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-product{{ $product->id }}"><i class="fas fa-trash"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        {{-- pagination --}}
        @if($products->hasPages())
          <div class="row bg-light pt-3">
            <div class="d-flex justify-content-center">
              {{ $products->onEachSide(2)->links() }}
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  <!-- modal: delete product -->
  @foreach($products as $product)
    <div class="modal fade" id="modal-delete-product{{ $product->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Produk?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 text-center">Konfirmasi penghapusan produk.</p>
          </div>
          <form action="/manage-product/{{ $product->id }}/delete" method="post">
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
  @endforeach

  <!-- modal: edit produk -->
  @foreach($products as $product)
    <div class="modal fade" id="modal-edit-product{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ubah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/manage-product" method="post">
          @method('put')
          @csrf
          <input type="hidden" name="id" value="{{ $product->id }}">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Produk</p>
                    <input id="" type="text" name="nama" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk" value="{{ $product->nama }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Kategori</p>
                    <select class="form-select" id="" name="category_id">

                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? "selected" : "" }}>{{ $category->nama }}</option>
                      @endforeach

                    </select>
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Harga</p>
                    <input id="" type="text" name="harga" class="form-control" required autocomplete="name" autofocus placeholder="Harga" value="{{ $product->harga }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Stok</p>
                    <input id="" type="number" name="stok" min="0" class="form-control" required autocomplete="name" autofocus placeholder="Stok" value="{{ $product->stok }}">
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Berat (gram)</p>
                    <input id="" type="number" name="berat" min="0" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)" value="{{ $product->berat }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                    <textarea id="" type="text" name="deskripsi" class="form-control" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:170px;">{{ $product->deskripsi }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="d-flex justify-content-between mb-3">
                    <div style="width: 5.5rem; height: 5.5rem;">
                      <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_1->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                    <div style="width: 5.5rem; height: 5.5rem;">
                      <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_2->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                    <div style="width: 5.5rem; height: 5.5rem;">
                      <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_3->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                    <div style="width: 5.5rem; height: 5.5rem;">
                      <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_4->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                    <input class="form-control form-control-sm" name="photo_1" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Depan</label>
                    <input class="form-control form-control-sm" name="photo_2" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Samping</label>
                    <input class="form-control form-control-sm" name="photo_3" type="file" id="formFile">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Belakang</label>
                    <input class="form-control form-control-sm" name="photo_4" type="file" id="formFile">
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
  @endforeach

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
                    <input id="" name="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Nama Produk" value="{{ old('nama') }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Kategori</p>
                    <select class="form-select" id="" name="category_id">

                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? "selected" : "" }}>{{ $category->nama }}</option>
                      @endforeach

                    </select>
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Harga</p>
                    <input id="" type="text" name="harga" class="form-control" required autocomplete="name" autofocus placeholder="Harga" value="{{ old('harga') }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Stok</p>
                    <input id="" name="stok" min="0" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Stok" value="{{ old('stok') }}">
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Berat (gram)</p>
                    <input id="" name="berat" min="0" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Berat (gram)" value="{{ old('berat') }}">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="p-0 m-0 fw-bold text-break">Deskripsi</p>
                    <textarea id="" name="deskripsi" type="text" class="form-control" rows="10" required autocomplete="name" autofocus placeholder="Deskripsi" style="overflow-y:scroll; max-height:100px;">{{ old('deskripsi') }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="row">
                  <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Foto Utama</label>
                    <input class="form-control" name="photo_1" type="file" id="formFile" required>
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

  <!-- modal: tambah kategori -->
  <div class="modal fade" id="modal-tambah-kategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/manage-category" method="post">
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
