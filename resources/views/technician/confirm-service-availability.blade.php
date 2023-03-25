@php use App\Enums\ServiceOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>

    {{-- fix button danger format broken --}}
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
  </style>

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  @if(isset($activeServiceOrder)
    && $activeServiceOrder->status == ServiceOrderStatus::DALAM_SERVIS)
    {{--autonumeric: currency formatting--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.2/autoNumeric.min.js" integrity="sha512-x1gR+AwmBYNFnEk4ixRnurDnPeGmhkUVGZtuF5LYRvXk2z3uIbIhpQswbl2X0qTIB1/kx+PNzTwqD+ZOuYtHbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- auto number format --}}
    <script>
      window.onload = () => {
        const autoNumericOptionsRupiah = {
          digitGroupSeparator        : '.',
          decimalCharacter           : ',',
          decimalPlaces              : '0',
          minimumValue               : '0',
          currencySymbol             : 'Rp ',
          emptyInputBehavior         : 'zero',
          currencySymbolPlacement    : AutoNumeric.options.currencySymbolPlacement.prefix,
          unformatOnSubmit           : true
        };
        document.querySelectorAll('input[name="biaya"]')?.forEach(e => {
          new AutoNumeric(e, autoNumericOptionsRupiah);
        });
      }
    </script>
  @endif

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <script>
    function convertRemToPixels(rem) {
      return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
    }

    document.addEventListener("DOMContentLoaded", function () {
      let sticky_action_els = document.querySelectorAll("[id^='sticky-action']");
      sticky_action_els.forEach(sticky_action_el => {
        let navbar_height = document.querySelector("#navbar_top").offsetHeight;
        let headermenu_height = document.querySelector("#sticky-header-menu").offsetHeight;
        let currRem = convertRemToPixels(1) * 1.5; // pt-4
        onScrollCallback();

        function onScrollCallback(event) {
          // console.log(navbar_height, headermenu_height, document.documentElement.scrollTop);
          if (document.documentElement.scrollTop > headermenu_height + currRem) {
            let offset = document.documentElement.scrollTop - (headermenu_height + currRem);
            if (offset < navbar_height + currRem) {
              sticky_action_el.style.paddingTop = `${offset}px`;
            } else {
              sticky_action_el.style.paddingTop = `${navbar_height + currRem}px`;
            }
          } else sticky_action_el.style.paddingTop = `0px`;
        }

        let window_height = window.innerHeight;
        window.addEventListener("resize", (event) => {
          window_height = window.innerHeight;
          window.removeEventListener("scroll", onScrollCallback);
          window.addEventListener("scroll", onScrollCallback);
        });
        window.addEventListener("scroll", onScrollCallback);
      });
    });
  </script>

  <div class="container" style="min-height: 90vh; display: flex; flex-direction: column;">
    <div class="row" style="flex-grow: 1;">

      {{-- sidebar --}}
      <div id="sidebar" class="col-auto ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          {{-- sidebar: profile --}}
          <div class="row border-bottom pb-4 mb-4">
            <div class="col px-0 pe-1" style="max-width: 50px; max-height: 50px;">
              <div style="width: 50px; height: 50px;">
                <div class="w-100 h-100 bg-image rounded-circle border"
                     style="background-image: url('/{{ Auth::user()->profile_picture->path ?? 'assets/admin-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>
            <div class="col">
              <p class="m-0 p-0 fw-bold text-break">{{ auth()->user()->nama }}</p>
              <p class="m-0 p-0 text-primary text-break">Teknisi Servis</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p id="side-nav"
                                                      class="mb-0 p-2 fw-bold text-break text-decoration-underline">
              <i class="fas fa-user-cog me-2"></i>Permintaan Servis</p>
          </a>
        </div>
      </div>

      <div class="col border-end">
        {{-- header menu --}}
        <div class="row bg-light border-bottom" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2 mb-0">Permintaan Kesediaan Servis</h5>
          <div class="d-flex flex-row align-items-center mb-3">
          </div>
        </div>

        {{-- form informasi servis --}}
        @if(isset($activeServiceOrder))
          <div class="row border-bottom bg-white py-4 px-2">
            <div class="col-9">
              <p class="card-text mb-0 fw-bold">Nama Pelanggan</p>
              <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" name="" value="{{ $activeServiceOrder->nama }}" disabled>
              </div>
              <p class="card-text mb-0 fw-bold">Alamat</p>
              <div class="input-group input-group-md mb-3" style="height: 6rem;">
                <textarea class="form-control" aria-label="With textarea" disabled>{{ $activeServiceOrder->address_order->alamat }}, Kota {{ $activeServiceOrder->address_order->kota }}, {{ $activeServiceOrder->address_order->kode_pos }}</textarea>
              </div>
              <p class="card-text mb-0 fw-bold">Nomor HP</p>
              <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" name="" value="{{ $activeServiceOrder->nomor_hp }}" disabled>
              </div>
              <p class="card-text mb-0 fw-bold">Permintaan Jadwal Servis</p>
              <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" name="" value="{{ date_format(new DateTime($activeServiceOrder->waktu),"l, d M Y, H:i \W\I\B") }}" disabled>
              </div>
              <p class="card-text mb-0 fw-bold">Masalah Yang Dialami</p>
              <div class="input-group input-group-md mb-3" style="height: 12rem;">
                <textarea class="form-control" aria-label="With textarea" disabled>{{ $activeServiceOrder->deskripsi_masalah }}</textarea>
              </div>
            </div>

            @if($activeServiceOrder->status == ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI)
              {{-- button action : terima / tolak servis --}}
              <div class="col pt-4">
                <div class="--sticky-table-item row px-3 sticky-top" id="sticky-action" style="z-index: 1;">
                  <button type="button" class="btn btn-primary py-3 fw-bold mb-3" data-bs-toggle="modal"
                          data-bs-target="#modal-terima-permintaan">
                    <p class="mb-0">Terima</p>
                  </button>
                  <button type="button" class="btn btn-danger py-3 fw-bold" data-bs-toggle="modal"
                          data-bs-target="#modal-tolak-permintaan">
                    <p class="text-white mb-0">Tolak</p>
                  </button>
                  <p class="mt-2 text-center text-secondary">ORDER ID: {{ $activeServiceOrder->id }}</p>
                </div>
              </div>
            @elseif($activeServiceOrder->status == ServiceOrderStatus::DALAM_SERVIS)
              {{-- button action : konfirmasi selesai (invisible: hapus d-none) --}}
              <div class="col pt-4">
                <div class="row px-3 sticky-top" id="sticky-action" style="z-index: 1;">
                  <p class="text-secondary text-center">Apabila servis selesai, maka tekan tombol dibawah ini:</p>
                  <button type="button" class="btn btn-primary py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-catatan-selesai">Konfirmasi Selesai</button>
                  <p class="mt-2 text-center text-secondary">ORDER ID: {{ $activeServiceOrder->id }}</p>
                </div>
              </div>
            @endif
          </div>
        @else
          <div class="container-fluid py-4 text-center bg-white">
            <p class="text-secondary"><strong>You have no request for service order.</strong></p>
          </div>
        @endif

      </div>
    </div>
  </div>


  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

  @if(isset($activeServiceOrder))

    @if($activeServiceOrder->status == ServiceOrderStatus::MENUNGGU_KONFIRMASI_TEKNISI)
      <!-- modal: terima permintaan -->
      <div class="modal fade" id="modal-terima-permintaan" data-bs-backdrop="static" data-bs-keyboard="false"
           tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Terima Permintaan?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mb-0 text-center">Apakah kamu ingin <b>menerima</b> permintaan service ini?</p>
            </div>
            <form action="/confirm-service-availability/accept/{{ $activeServiceOrder->id }}" method="post">
              @csrf
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Terima</button>
                <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal: tolak permintaan -->
      <div class="modal fade" id="modal-tolak-permintaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
           aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Tolak Permintaan?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mb-0 text-center">Apakah kamu ingin <b>menolak</b> permintaan service ini?</p>
            </div>
            <form action="/confirm-service-availability/reject/{{ $activeServiceOrder->id }}" method="post">
              @csrf
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Tolak</button>
                <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    @elseif($activeServiceOrder->status == ServiceOrderStatus::DALAM_SERVIS)
      <!-- modal: catatan selesai -->
      <div class="modal fade" id="modal-catatan-selesai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <div class="container-fluid">
                <div class="row align-items-center">
                  <div class="col-auto ps-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Selesai</h5>
                  </div>
                  <div class="col-auto px-0">
                    <p class="small py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $activeServiceOrder->id }}</p>
                  </div>
                </div>
                <div class="row">
                  <p class="px-0 mb-0 text-secondary">Diservis oleh: {{ $activeServiceOrder->technician->user->nama ?? ($activeServiceOrder->status == ServiceOrderStatus::MENCARI_TEKNISI ? '(sedang dicari)' : '(dibatalkan)') }}</p>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/confirm-service-availability/finish/{{ $activeServiceOrder->id }}" method="post">
              @csrf
              <div class="modal-body">
                <p class="mb-0 fw-bold">Total Biaya</p>
                <input id="" type="text" name="biaya" class="form-control mb-3" required autocomplete="name" autofocus placeholder="Total biaya">
                <p class="mb-0 fw-bold">Rincian Servis</p>
                <textarea id="" type="text" name="rincian_servis" class="form-control" rows="3" required autocomplete="name" autofocus placeholder="Rincian servis"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Konfirmasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif

  @endif

@endsection
