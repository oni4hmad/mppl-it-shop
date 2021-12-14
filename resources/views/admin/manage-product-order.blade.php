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
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Order Produk Elektronik</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <p class="text-secondary fw-bold me-3 mb-0">Kategori</p>
            <div class="input-group input-group-sm px-0 me-5" style="width: 150px;">
              <select class="form-select" id="inputGroupSelect01">
                <option value="0" selected>All Order</option>
                <option value="1">Menunggu Dibayar</option>
                <option value="2">Menunggu Resi</option>
                <option value="3">Sedang Dikirim</option>
                <option value="4">Order Selesai</option>
                <option value="5">Dibatalkan</option>
              </select>
            </div>
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <button type="button" class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3">
                <i class="fas fa-search text-secondary"></i>
              </button>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari order" aria-label="Search" aria-describedby="search-addon" />
            </div>
          </div>
        </div>

        {{-- order cards --}}
        <div class="row border-end p-2">

          {{-- card-1 --}}
          <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Menunggu Resi</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 12001</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Oni Ahmad</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <div class="col-auto pe-0">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                    <div class="col ms-2 ps-0">
                      <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    </div>
                  </div>
                  <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modal-detail-order">
                    <div class="d-flex flex-row align-items-center py-2">
                      <p class="mb-0 me-2 fw-bold text-break">Lihat 2 Produk Lainnya</p>
                      <i class="fas fa-external-link-alt"></i>
                    </div>
                  </a>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Oni Ahmad (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Kurir</p>
                    <p class="mb-0 text-break">JNE Regular</p>
                    <p class="mb-0 text-break text-secondary">(2 - 4 hari) - Rp50.000</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="d-flex flex-row align-items-center h-100">
                  <p class="mb-0 me-1 px-0 fw-bold text-break">Total Harga</p>
                  <p class="mb-0 me-2 px-0 fw-bold text-break text-secondary">(4 Barang):</p>
                  <p class="mb-0 px-0 fw-bold text-break">Rp15.050.000</p>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold" style="min-width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-input-resi">Input Resi</button>
              </div>
            </div>
          </div>

          {{-- card-2 --}}
          <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="mb-0 px-0 me-4 fw-bold text-break text-secondary">Menunggu Dibayar</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 12000</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Oni Ahmad</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <div class="col-auto pe-0">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                      </div>
<<<<<<< HEAD
                    </div>
                    <div class="col ms-2 ps-0">
                      <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
=======
>>>>>>> origin
                    </div>
                    <div class="col ms-2 ps-0">
                      <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    </div>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Oni Ahmad (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Kurir</p>
                    <p class="mb-0 text-break">JNE Regular</p>
                    <p class="mb-0 text-break text-secondary">(2 - 4 hari) - Rp50.000</p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Oni Ahmad (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Kurir</p>
                    <p class="mb-0 text-break">JNE Regular</p>
                    <p class="mb-0 text-break text-secondary">(2 - 4 hari) - Rp50.000</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="d-flex flex-row align-items-center h-100">
                  <p class="mb-0 me-1 px-0 fw-bold text-break">Total Harga</p>
                  <p class="mb-0 me-2 px-0 fw-bold text-break text-secondary">(4 Barang):</p>
                  <p class="mb-0 px-0 fw-bold text-break">Rp15.050.000</p>
                </div>
              </div>
<<<<<<< HEAD
=======
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="d-flex flex-row align-items-center h-100">
                  <p class="mb-0 me-1 px-0 fw-bold text-break">Total Harga</p>
                  <p class="mb-0 me-2 px-0 fw-bold text-break text-secondary">(4 Barang):</p>
                  <p class="mb-0 px-0 fw-bold text-break">Rp15.050.000</p>
                </div>
              </div>
>>>>>>> origin
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm bg-danger text-white rounded-3 px-5 h-100 fw-bold" style="min-width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-tolak-order">Tolak Order</button>
              </div>
            </div>
          </div>

          {{-- card-3 --}}
          <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Sedang Dikirim</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 11999</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Oni Ahmad</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <div class="col-auto pe-0">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                    <div class="col ms-2 ps-0">
                      <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    </div>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Oni Ahmad (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Kurir</p>
                    <p class="mb-0 text-break">JNE Regular</p>
                    <p class="mb-0 text-break text-secondary">(2 - 4 hari) - Rp50.000</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="d-flex flex-row align-items-center h-100">
                  <p class="mb-0 me-1 px-0 fw-bold text-break">Total Harga</p>
                  <p class="mb-0 me-2 px-0 fw-bold text-break text-secondary">(4 Barang):</p>
                  <p class="mb-0 px-0 fw-bold text-break">Rp15.050.000</p>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold" style="min-width: 200px;" onclick="location.href='track'">Lacak</button>
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

  <!-- modal: tolak order -->
  <div class="modal fade" id="modal-tolak-order" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Tolak Order?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penolakan order.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: input resi -->
  <div class="modal fade" id="modal-input-resi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Input Resi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 fw-bold">Masukkan Nomor Resi</p>
          <input id="email" type="number" class="form-control" name="name" value="" required autocomplete="name" autofocus placeholder="Nomor Resi">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: detail order -->
  <div class="modal fade" id="modal-detail-order" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Detail Order (ID: 12001)</h5>
            <p class="mb-0 text-secondary">Total: 3 barang</p>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @for ($i = 0; $i < 3; $i++)
            <div class="row mb-3">
              <div class="col-auto pe-0">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
              <div class="col ms-2 ps-0">
                <p class="mb-0 fw-bold text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
              </div>
            </div>
          @endfor
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm px-5 text-white fw-bold" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

@endsection
