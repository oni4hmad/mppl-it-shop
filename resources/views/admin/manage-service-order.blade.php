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
                <option value="1">Mencari Teknisi</option>
                <option value="2">Dalam Servis</option>
                <option value="3">Servis Selesai</option>
                <option value="4">Dibatalkan</option>
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
              <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Mencari Teknisi</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 12001</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Fiody Ardhito</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Servis:</p>
                    <p class="mb-0 text-break">Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa</p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Fiody Ardhito (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Permintaan Jadwal</p>
                    <p class="mb-0 text-break">Selasa, 29 Juni 2021</p>
                    <p class="mb-0 text-break">Jam 12.00</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="row">
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Teknisi:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Total Biaya:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-primary rounded-3 h-100 fw-bold" style="min-width: 200px;" onclick="location.href='manage-technician'">Cari Teknisi</button>
              </div>
            </div>
          </div>

          {{-- card-2 --}}
          <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Dalam Servis</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 12000</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Fiody Ardhito</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Servis:</p>
                    <p class="mb-0 text-break">Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa</p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Fiody Ardhito (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
<<<<<<< HEAD
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Permintaan Jadwal</p>
                    <p class="mb-0 text-break">Selasa, 29 Juni 2021</p>
                    <p class="mb-0 text-break">Jam 12.00</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="row">
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Teknisi:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
=======
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Permintaan Jadwal</p>
                    <p class="mb-0 text-break">Selasa, 29 Juni 2021</p>
                    <p class="mb-0 text-break">Jam 12.00</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="row">
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Teknisi:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
>>>>>>> origin
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Total Biaya:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-secondary rounded-3 h-100 fw-bold" style="min-width: 200px;" disabled>Cari Teknisi</button>
              </div>
            </div>
          </div>

          {{-- card-3 --}}
          <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="d-flex flex-row align-items-center mb-3">
              <p class="mb-0 px-0 me-4 fw-bold text-break text-secondary">Servis Selesai</p>
              <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: 11999</p>
              <i class="far fa-user me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">Fiody Ardhito</p>
              <i class="far fa-clock me-2 text-secondary"></i>
              <p class="mb-0 px-0 me-4 text-break text-secondary">29 Juni 2021 - 10:30 WIB</p>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
<<<<<<< HEAD
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Servis:</p>
                    <p class="mb-0 text-break">Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa</p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Fiody Ardhito (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
=======
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Servis:</p>
                    <p class="mb-0 text-break">Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa</p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">Fiody Ardhito (089512341234)<br>Jl. Manukan Indah II 19C/8, Kec. Tandes, Kota Surabaya, Jawa Timur, 60185</p>
                  </div>
                </div>
>>>>>>> origin
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Permintaan Jadwal</p>
                    <p class="mb-0 text-break">Selasa, 29 Juni 2021</p>
                    <p class="mb-0 text-break">Jam 12.00</p>
                  </div>
<<<<<<< HEAD
=======
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="row">
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Teknisi:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Total Biaya:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
>>>>>>> origin
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-3 h-100 fw-bold" style="min-width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-catatan-teknisi">Catatan Teknisi</button>
              </div>
            </div>
<<<<<<< HEAD
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="row">
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Teknisi:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                  <div class="col-6 d-flex flex-row">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Total Biaya:</p>
                    <p class="mb-0 px-0 fw-bold text-break me-4">-</p>
                  </div>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-3 h-100 fw-bold" style="min-width: 200px;" data-bs-toggle="modal" data-bs-target="#modal-catatan-teknisi">Catatan Teknisi</button>
              </div>
            </div>
=======
>>>>>>> origin
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

  <!-- modal: catatan teknisi -->
  <div class="modal fade" id="modal-catatan-teknisi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Catatan Teknisi (Order ID: 11999)</h5>
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
