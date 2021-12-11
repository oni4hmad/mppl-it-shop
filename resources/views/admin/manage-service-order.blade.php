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
              <p class="m-0 p-0 fw-bold text-break">Pokimane</p>
              <p class="m-0 p-0 text-primary text-break">Admin</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-home me-2"></i>Home</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-microchip me-2"></i>Produk</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-user-cog me-2"></i>Teknisi</p>
          </a>
          <p class="my-3 p-2 py-3 border-top border-bottom fw-bold text-break text-secondary">Orderan</p>
          <a href="manage-product-order" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-server me-2"></i>Produk Elektronik</p>
          </a>
          <a href="manage-service-order" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-decoration-underline">
            <i class="fas fa-cog me-2"></i>Jasa Servis</p>
          </a>
        </div>
      </div>

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
          @for ($i = 0; $i < 3; $i++)
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
                  <button type="button" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold">Cari Teknisi</button>
                </div>
              </div>
            </div>
          @endfor
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

@endsection
