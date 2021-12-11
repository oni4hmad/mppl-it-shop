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

  <div class="container" style="min-height: 90vh;">
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
              <p class="m-0 p-0 fw-bold text-break">Atta Halilintar</p>
              <p class="m-0 p-0 text-primary text-break">Teknisi Servis</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-decoration-underline">
            <i class="fas fa-user-cog me-2"></i>Permintaan Servis</p>
          </a>
        </div>
      </div>


      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2 mb-0">Permintaan Kesediaan Servis</h5>
          <div class="d-flex flex-row align-items-center mb-3">
          </div>
        </div>

        {{-- form informasi servis --}}
        <div class="row border-bottom border-end bg-white py-4 px-2">
          <div class="col-9">
            <p class="card-text mb-0 fw-bold">Nama Pelanggan</p>
            <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" name="" value="Fiodhy Ardito Narawangsa" disabled>
            </div>
            <p class="card-text mb-0 fw-bold">Alamat</p>
            <div class="input-group input-group-md mb-3" style="height: 6rem;">
              <textarea class="form-control" aria-label="With textarea" disabled>Jl Raya Dukuh Kupang No.139, Gunung Anyar, Surabaya Jawa Timur, 60621</textarea>
            </div>
            <p class="card-text mb-0 fw-bold">Nomor HP</p>
            <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" name="" value="+6283192753645" disabled>
            </div>
            <p class="card-text mb-0 fw-bold">Permintaan Jadwal Servis</p>
            <div class="input-group input-group-md mb-3">
              <input type="text" class="form-control" name="" value="+Selasa, 29 Juni 2021, Jam 12.00" disabled>
            </div>
            <p class="card-text mb-0 fw-bold">Masalah Yang Dialami</p>
            <div class="input-group input-group-md mb-3" style="height: 6rem;">
              <textarea class="form-control" aria-label="With textarea" disabled>Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa</textarea>
            </div>
          </div>

          {{-- button action --}}
          <div class="col pt-4">
            <div class="--sticky-table-item row px-3 sticky-top" id="sticky-fix" style="z-index: 1;">
              <button type="button" class="btn btn-primary py-3 fw-bold mb-3" onclick="{{ "location.href = '#';" }}">
                <p class="mb-0">Terima</p>
              </button>
              <button type="button" class="btn bg-danger py-3 fw-bold" onclick="{{ "location.href = '#';" }}">
                <p class="text-white mb-0">Tolak</p>
              </button>
              <p class="mt-2 text-center text-secondary">ORDER ID: 12000</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
