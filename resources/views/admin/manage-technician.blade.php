@php
  use App\Enums\ServiceOrderStatus;
  use App\Enums\TechnicianStatus;
  function addPhoneSeparators($phone) {
    return substr_replace(substr_replace($phone, '-', 4, 0), '-', 9, 0);
  }
@endphp
@extends('layouts.main')

@section('content')

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  {{-- select and send service handler --}}
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // const orderSelectGroup = document.querySelectorAll('select[id^="select-group-order-service"]');
      // const inputTechnicianIds = document.querySelectorAll('input[id^="input-technician-id"]');
      //
      // // set initial hidden input value
      // inputTechnicianId.value = orderSelectGroup.value;
      //
      // // handle on change
      // orderSelectGroup.addEventListener('change', e => {
      //   console.log(e.target, e.target.value);
      // });

      const formRequestServices = document.querySelectorAll('form[id^="form-request-service"]');
      formRequestServices.forEach(formRequestService => {
        formRequestService.addEventListener('submit', e => {
          e.preventDefault();
          const technicianId = e.target.id.split('-').pop();
          const inputServiceOrderId = e.target.querySelector(`#input-service-order-id-${technicianId}`);
          const orderSelectGroup = document.querySelector(`#select-group-order-service-${technicianId}`);
          inputServiceOrderId.value = orderSelectGroup.value;
          if (technicianId && inputServiceOrderId && orderSelectGroup) {
            e.target.submit();
          }
        });
      });
    });
  </script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Teknisi Servis</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <button type="button" class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3">
                <i class="fas fa-search text-secondary"></i>
              </button>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0"
                     placeholder="Cari teknisi servis" aria-label="Search" aria-describedby="search-addon"/>
            </div>
            <button type="button" class="btn btn-sm btn-primary px-2 ms-3 rounded-pill fw-bold" data-bs-toggle="modal"
                    data-bs-target="#modal-tambah-teknisi">+ Teknisi Servis
            </button>
          </div>
          <div class="container-fluid border-top bg-white">
            <div class="row">
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Nama Teknisi</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Pesanan</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Nomor HP</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Status</p>
              </div>
              <div class="col-3">
                <p class="mb-0 py-2 fw-bold">Action</p>
              </div>
            </div>
          </div>
        </div>


        {{-- table --}}

        {{-- table row dynamic --}}
        @foreach($technicians as $technician)
          <div class="row border-bottom border-end bg-white">
            {{-- nama teknisi --}}
            <div class="col-3">

              {{-- service item --}}
              <div class="row mx-0 py-3">
                {{-- foto teknisi --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 4rem; height: 4rem;">
                      <div class="w-100 h-100 rounded-circle border border-secondary"
                           style="background-image: url('/{{ $technician->user->profile_picture ?? 'assets/user-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- service name --}}
                <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">{{ $technician->user->nama }}</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            {{-- Pesanan --}}
            <div class="col-2 py-3">
              @switch($technician->status)
                @case(TechnicianStatus::TERSEDIA)
                  <div class="input-group input-group-sm px-0">
                    @if($noTechnicianServiceOrders->count() > 0)
                    <select class="form-select w-100" id="select-group-order-service-{{ $technician->id }}">
                      @foreach($noTechnicianServiceOrders as $serviceOrder)
                        @php
                          $maxLength = 25;
                          $trDeskripsiMasalah = strlen($serviceOrder->deskripsi_masalah) > $maxLength ?substr($serviceOrder->deskripsi_masalah, 0, $maxLength).'...' :$serviceOrder->deskripsi_masalah;
                        @endphp
                        <option value="{{ $serviceOrder->id }}">ID: {{ $serviceOrder->id }} / {{ $serviceOrder->user->nama }} / {{ $trDeskripsiMasalah }}</option>
                      @endforeach
                    </select>
                    @else
                      <p class="small text-muted fst-italic">(Tidak ada order)</p>
                    @endif
                  </div>
                  @break
                @default
                  <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modal-detail-pesanan{{ $technician->id }}">
                    <div class="--sticky-table-item d-flex flex-row align-items-center">
                      <p class="mb-0 fw-bold text-primary" style="z-index: 1;">Lihat Detail</p>
                      <i class="fas fa-external-link-alt ms-2"></i>
                    </div>
                  </a>
              @endswitch
            </div>
            {{-- Nomor HP --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">{{ addPhoneSeparators($technician->user->nomor_hp) }}</p>
            </div>
            {{-- Status --}}
            <div class="col-2 py-3">

              @switch($technician->status)
                @case(TechnicianStatus::TERSEDIA)
                  <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Tersedia</p>
                  @break
                @case(TechnicianStatus::MENUNGGU_KONFIRMASI)
                  <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Konfirmasi</p>
                  @break
                @case(TechnicianStatus::DALAM_SERVIS)
                  <p class="--sticky-table-item mb-0 fw-bold text-danger" style="z-index: 1;">Dalam Servis</p>
                  @break
                @default
              @endswitch

            </div>
            {{-- Action --}}
            <div class="col-3 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">

                @switch($technician->status)
                  @case(TechnicianStatus::TERSEDIA)

                    @if($noTechnicianServiceOrders->count() > 0)
                      <form action="/manage-service-order/request" method="post" id="form-request-service-{{ $technician->id }}">
                        @csrf
                        <input type="hidden" id="input-technician-id-{{ $technician->id }}" name="technician_id" value="{{ $technician->id }}">
                        <input type="hidden" id="input-service-order-id-{{ $technician->id }}" name="service_order_id" value="">
                        <button type="submit" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold">Kirim Permintaan</button>
                      </form>
                    @else
                      <button type="button" class="btn btn-secondary btn-sm rounded-3 w-100 fw-bold" disabled>Kirim Permintaan</button>
                    @endif
                    @break
                  @case(TechnicianStatus::MENUNGGU_KONFIRMASI)
                      <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-batalkan-permintaan{{ $technician->id }}">Batalkan Permintaan</button>
                    @break
                  @case(TechnicianStatus::DALAM_SERVIS)
                    <button type="button" class="btn btn-secondary btn-sm rounded-3 w-100 fw-bold" disabled>Kirim Permintaan</button>
                    @break
                  @default
                @endswitch

              </form></div>
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

  <!-- modal: tambah teknisi -->
  <div class="modal fade" id="modal-tambah-teknisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Teknisi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 fw-bold">Masukkan Email</p>
          <input id="email" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus placeholder="Email">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal
          </button>
          <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
        </div>
      </div>
    </div>
  </div>

  @foreach($technicians as $technician)

    @if($technician->status == TechnicianStatus::MENUNGGU_KONFIRMASI
      || $technician->status == TechnicianStatus::DALAM_SERVIS)

      @php
        $activeServiceOrder = $technician->service_orders()->active()->first();
      @endphp

      <!-- modal: batalkan permintaan -->
      <div class="modal fade" id="modal-batalkan-permintaan{{ $technician->id }}" data-bs-keyboard="false" tabindex="-1"
           aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Permintaan?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mb-0 text-center">Apakah kamu yakin ingin membatalkan permintaan servis untuk <b>{{ $technician->user->nama }}</b>?</p>
            </div>
            <form action="/manage-service-order/request/cancel" method="post">
              @csrf
              <div class="modal-footer">
                <input type="hidden" name="service_order_id" value="{{ $activeServiceOrder->id }}">
                <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Iya</button>
                <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal: detail pesanan -->

      <div class="modal fade" id="modal-detail-pesanan{{ $technician->id }}" data-bs-keyboard="false" tabindex="-1"
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
                    <p class="small py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $activeServiceOrder->id }}</p>
                  </div>
                </div>
                <div class="row">
                  <p class="px-0 mb-0 text-secondary">Diservis oleh: {{ $technician->user->nama ?? ($activeServiceOrder->status == ServiceOrderStatus::MENCARI_TEKNISI ? '(sedang dicari)' : '(dibatalkan)') }}</p>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Nama Pemesan</p>
                  <input id="nama" type="text" value="{{ $activeServiceOrder->nama }}" class="form-control" required autocomplete="name" autofocus placeholder="Nama Pemesan" disabled>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="p-0 m-0 fw-bold text-break">Alamat</p>
                  <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Alamat" disabled>{{ $activeServiceOrder->address_order->alamat }}, Kota {{ $activeServiceOrder->address_order->kota }}, {{ $activeServiceOrder->address_order->kode_pos }}</textarea>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Nomor HP</p>
                  <input id="nama" type="text" value="{{ $activeServiceOrder->nomor_hp }}" class="form-control" required autocomplete="name" autofocus placeholder="Nomor HP" disabled>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Permintaan Jadwal Servis</p>
                  <input id="nama" type="text" value="{{ date_format(new DateTime($activeServiceOrder->waktu),"l, d M Y, H:i \W\I\B") }}" class="form-control" required autocomplete="name" autofocus placeholder="Permintaan Jadwal Servis" disabled>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col">
                  <p class="p-0 m-0 fw-bold text-break">Masalah Yang Dialami</p>
                  <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus placeholder="Masalah Yang Dialami" disabled>{{ $activeServiceOrder->deskripsi_masalah }}</textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm px-4 text-white fw-bold" data-bs-dismiss="modal">OK
              </button>
            </div>
          </div>
        </div>
      </div>
    @endif

  @endforeach

@endsection
