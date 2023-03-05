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
          <a href="/order-history-product" class="text-decoration-none"><p class="fw-bold text-break text-dark text-decoration-underline">Produk Elektronik</p></a>
          <a href="/order-history-service" class="text-decoration-none"><p class="fw-bold text-break text-secondary">Servis Komputer</p></a>
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

        {{-------------------- table --------------------}}

        {{-- baris order 1 --}}
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
                      <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                      <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                    </div>
                  </div>
                </div>
              </div>
            @endfor

          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Sedang Dikrim</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" onclick="{{ "location.href = 'track';" }}">Lacak</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 12000</p>
            </div>
          </div>
        </div>

        {{-- baris order 2 --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">

            {{-------- order item --------}}

            {{---- item 1 ----}}
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
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>

            {{-------- endof: order item --------}}

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
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" onclick="{{ "location.href = 'payment';" }}">Cek Kode Pembayaran</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 11999</p>
            </div>
          </div>
        </div>

        {{-- baris order 2 --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">

            {{-------- order item --------}}

            {{---- item 1 ----}}
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
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>

            {{-------- endof: order item --------}}

          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Selesai</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk">Beri Rating</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 11998</p>
            </div>
          </div>
        </div>

        {{-------------------- endof: table --------------------}}

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
  {{-- data-bs-toggle="modal" data-bs-target="#modal-editxxx" --}}

  <!-- modal: nilai produk -->
  <div class="modal fade" id="modal-nilai-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nilai Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- produknya --}}
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
                  <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                  <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                  <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  <div class="d-flex flex-row align-items-center">
                    <p class="mb-0 me-2 text-primary fw-bold">Rating (1-5):</p>
                    <input type="number" name="" id="" min="1" max="5" value="5">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Tambahkan review"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Kirim</button>
        </div>
      </div>
    </div>
  </div>
@endsection
