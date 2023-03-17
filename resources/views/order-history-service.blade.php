@php use App\Enums\ServiceOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  <style>
    /* truncate text display at least three line */
    .text-truncate-container p {
      -webkit-line-clamp: 3;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.user-sidebar')

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Riwayat Order</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <p class="text-secondary fw-bold me-3 mb-0">Kategori</p>
            <div class="input-group input-group-sm px-0 me-5" style="width: 150px;">
              <select class="form-select" id="inputGroupSelect01">
                <option value="">All Orders</option>
                <option value="">Mencari Teknisi</option>
                <option value="">Dalam Servis</option>
                <option value="">Servis Selesai</option>
                <option value="">Dibatalkan</option>
              </select>
            </div>
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <a class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3"
                 style="cursor: default !important;">
                <i class="fas fa-search text-secondary"></i>
              </a>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari orderan" aria-label="Search" aria-describedby="search-addon"/>
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

        {{-- table --}}

        {{-- table row --}}
        @foreach($serviceOrders as $serviceOrder)
          <div class="row border-bottom border-end bg-white">
            <div class="col-5">

              {{-- service item --}}
              <div class="row mx-0 py-3">
                {{-- foto teknisi --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-circle border border-secondary"
                           style="background-image: url('/{{ $serviceOrder->user->profile_picture ?? 'assets/user-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- service name --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <div class="text-truncate-container">
                        <p class="mb-0 fw-bolder text-break">Servis: {{ $serviceOrder->deskripsi_masalah }}</p>
                      </div>
                      <p class="mb-0 px-0 text-break">
                        Teknisi: {{ $serviceOrder->technician->user->nama ?? $serviceOrder->status == ServiceOrderStatus::MENCARI_TEKNISI ? '(sedang dicari)' : '(dibatalkan)' }}</p>
                      <p class="mb-0 text-secondary text-break">{{ date_format($serviceOrder->created_at,"d M Y") }}</p>
                      <a class="text-decoration-none" href="#" data-bs-toggle="modal"
                         data-bs-target="#modal-detail-pesanan{{ $serviceOrder->id }}">
                        <div class="d-flex flex-row align-items-center py-2">
                          <p class="mb-0 me-2 fw-bold text-break">Lihat Detail Pesanan</p>
                          <i class="fas fa-external-link-alt"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- status --}}
            <div class="col-2 py-3">
              @switch($serviceOrder->status)
                @case(ServiceOrderStatus::MENCARI_TEKNISI)
                  <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Mencari Teknisi</p>
                  @break
                @case(ServiceOrderStatus::DALAM_SERVIS)
                  <p class="--sticky-table-item mb-0 fw-bold text-info" style="z-index: 1;">Diproses</p>
                  @break
                @case(ServiceOrderStatus::SERVIS_SELESAI)
                  <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Selesai</p>
                  @break
                @case(ServiceOrderStatus::DIBATALKAN)
                  <p class="--sticky-table-item mb-0 fw-bold text-secondary" style="z-index: 1;">Dibatalkan</p>
                  @break
              @endswitch
            </div>
            {{-- total bayar --}}
            <div class="col-2 py-3">
              @switch($serviceOrder->status)
                @case(ServiceOrderStatus::SERVIS_SELESAI)
                  <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp{{ number_format($serviceOrder->biaya, 0, ',', '.') }}</p>
                  @break
                @default
                  <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">-</p>
              @endswitch
            </div>
            {{-- action --}}
            <div class="col-3 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">

                @switch($serviceOrder->status)
                  @case(ServiceOrderStatus::MENCARI_TEKNISI)
                    <button type="button" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-batalkan-pesanan{{ $serviceOrder->id }}">Batalkan Pesanan</button>
                    @break
                  @case(ServiceOrderStatus::DALAM_SERVIS)
                    @break
                  @case(ServiceOrderStatus::SERVIS_SELESAI)
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-catatan-teknisi{{ $serviceOrder->id }}">Catatan Teknisi</button>
                    @break
                  @case(ServiceOrderStatus::DIBATALKAN)
                    @break
                @endswitch
                <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: {{ $serviceOrder->id }}</p>

              </div>
            </div>
          </div>
        @endforeach

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

  @foreach($serviceOrders as $serviceOrder)

    <!-- modal: detail pesanan -->
    <div class="modal fade" id="modal-detail-pesanan{{ $serviceOrder->id }}" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <div class="container-fluid">
              <div class="row align-items-center">
                <div class="col-auto ps-0">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail Pesanan </h5>
                </div>
                <div class="col-auto px-0">
                  <p class="small py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $serviceOrder->id }}</p>
                </div>
              </div>
              <div class="row">
                <p class="px-0 mb-0 text-secondary">Diservis oleh: {{ $serviceOrder->technician->user->nama ?? $serviceOrder->status == ServiceOrderStatus::MENCARI_TEKNISI ? '(sedang dicari)' : '(dibatalkan)' }}</p>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Pemesan</p>
                <input id="nama" type="text" value="{{ $serviceOrder->nama }}" class="form-control" required autocomplete="name" autofocus placeholder="Nama Pemesan" disabled>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="p-0 m-0 fw-bold text-break">Alamat</p>
                <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Alamat" disabled>{{ $serviceOrder->address_order->alamat }}, Kota {{ $serviceOrder->address_order->kota }}, {{ $serviceOrder->address_order->kode_pos }}</textarea>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nomor HP</p>
                <input id="nama" type="text" value="{{ $serviceOrder->nomor_hp }}" class="form-control" required autocomplete="name" autofocus placeholder="Nomor HP" disabled>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Permintaan Jadwal Servis</p>
                <input id="nama" type="text" value="{{ date_format(new DateTime($serviceOrder->waktu),"l, d M Y, H:i \W\I\B") }}" class="form-control" required autocomplete="name" autofocus placeholder="Permintaan Jadwal Servis" disabled>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="p-0 m-0 fw-bold text-break">Masalah Yang Dialami</p>
                <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Masalah Yang Dialami" disabled>{{ $serviceOrder->deskripsi_masalah }}</textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm px-4 text-white fw-bold" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    @switch($serviceOrder->status)
      @case(ServiceOrderStatus::MENCARI_TEKNISI)
        <!-- modal: batalkan pesanan -->
        <div class="modal fade" id="modal-batalkan-pesanan{{ $serviceOrder->id }}" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Pesanan?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Konfirmasi pembatalan pesanan Anda.</p>
              </div>
              <form action="/service-order/{{ $serviceOrder->id }}/cancel" method="post">
                @csrf
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
                  <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @break
      @case(ServiceOrderStatus::DALAM_SERVIS)
        <!-- modal: batalkan pesanan -->
        <div class="modal fade" id="modal-batalkan-pesanan{{ $serviceOrder->id }}" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Pesanan?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Konfirmasi pembatalan pesanan Anda.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Ya</button>
                <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
              </div>
            </div>
          </div>
        </div>
        @break
      @case(ServiceOrderStatus::SERVIS_SELESAI)
        <!-- modal: catatan teknisi -->
        <div class="modal fade" id="modal-catatan-teknisi{{ $serviceOrder->id }}" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-auto ps-0">
                      <h5 class="modal-title" id="staticBackdropLabel">Catatan Teknisi </h5>
                    </div>
                    <div class="col-auto px-0">
                      <p class="small py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $serviceOrder->id }}</p>
                    </div>
                  </div>
                  <div class="row">
                    <p class="px-0 mb-0 text-secondary">Diservis oleh: {{ $serviceOrder->technician->user->nama ?? $serviceOrder->status == ServiceOrderStatus::MENCARI_TEKNISI ? '(sedang dicari)' : '(dibatalkan)' }}</p>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 fw-bold">Total Biaya</p>
                <input id="" type="text" value="Rp{{ number_format($serviceOrder->biaya, 0, ',', '.') }}" class="form-control mb-3" required autocomplete="name" autofocus placeholder="Total biaya" disabled>
                <p class="mb-0 fw-bold">Rincian Servis</p>
                <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Rincian servis" disabled>{{ $serviceOrder->rincian_servis }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm px-5 text-white fw-bold" data-bs-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>
        @break
      @case(ServiceOrderStatus::DIBATALKAN)
        @break
    @endswitch
  @endforeach

@endsection
