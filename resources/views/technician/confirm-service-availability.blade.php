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
                <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('{{ asset('profile_pic') }}/{{ Auth::user()->profile_pic }}'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>
            <div class="col">
              <p class="m-0 p-0 fw-bold text-break">{{ Auth::user()->name }}</p>
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

          {{-- button action : terima / tolak servis --}}
          <div class="col pt-4">
            <div class="--sticky-table-item row px-3 sticky-top" id="sticky-fix" style="z-index: 1;">
              <button type="button" class="btn btn-primary py-3 fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#modal-terima-permintaan">
                <p class="mb-0">Terima</p>
              </button>
              <button type="button" class="btn bg-danger py-3 fw-bold"  data-bs-toggle="modal" data-bs-target="#modal-tolak-permintaan">
                <p class="text-white mb-0">Tolak</p>
              </button>
              <p class="mt-2 text-center text-secondary">ORDER ID: 12000</p>
            </div>
          </div>

          {{-- button action : konfirmasi selesai (invisible: hapus d-none) --}}
          <div class="col pt-4 d-none">
            <div class="--sticky-table-item row px-3 sticky-top" id="sticky-fix" style="z-index: 1;">
              <p class="text-secondary text-center">Apabila servis selesai, maka tekan tombol dibawah ini:</p>
              <button type="button" class="btn bg-primary py-3 fw-bold"  data-bs-toggle="modal" data-bs-target="#modal-catatan-selesai">
                <p class="text-white mb-0">Konfirmasi Selesai</p>
              </button>
              <p class="mt-2 text-center text-secondary">ORDER ID: 12000</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>


  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  <!-- modal: tolak permintaan -->
  <div class="modal fade" id="modal-tolak-permintaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Tolak Permintaan?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penolakan permintaan servis.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: terima permintaan -->
  <div class="modal fade" id="modal-terima-permintaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Terima Permintaan?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Konfirmasi penerimaan permintaan servis.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: catatan selesai -->
  <div class="modal fade" id="modal-catatan-selesai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Selesai (Order ID: 9001)</h5>
            <p class="mb-0 text-secondary">Diservis oleh: Atta Halilintar</p>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 fw-bold">Total Biaya</p>
          <input id="" type="text" class="form-control mb-3" required autocomplete="name" autofocus placeholder="Total biaya">
          <p class="mb-0 fw-bold">Rincian Servis</p>
          <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Rincian servis"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Konfirmasi</button>
        </div>
      </div>
    </div>
  </div>

@endsection
