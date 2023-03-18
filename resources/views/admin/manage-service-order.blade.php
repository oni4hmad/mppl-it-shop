@php use App\Enums\ServiceOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>
    #side-nav:hover {
      background-color: #F2F2F2;
    }
  </style>

  {{-- sticky content fix --}}
  <script src="/js/sticky-content-fix.js"></script>

  {{-- deskripsi masalah text-truncation --}}
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('[id^="deskripsi-masalah"]')?.forEach(el => {
        let textEl = el.parentNode.querySelector(`#text-${el.id}`);
        let deskripsiMasalah = el.value;
        textEl.textContent = el.value;
        if (deskripsiMasalah.length > 155) {
          let textTruncated = deskripsiMasalah.substring(0, 140) + "...";
          textEl.innerText = textTruncated;
          let expandToggler = '<a href="#" class="mb-0 me-2 small text-break ms-2 text-decoration-none">selengkapnya</a>';
          let wrapper = document.createElement('div');
          wrapper.innerHTML = expandToggler;
          wrapper.firstChild.onclick = e => {
            e.preventDefault();
            if (e.target.innerText === "selengkapnya") {
              textEl.textContent = deskripsiMasalah;
              textEl.appendChild(e.target);
              e.target.textContent = "...sembunyikan";
            } else {
              textEl.textContent = textTruncated;
              textEl.appendChild(e.target);
              e.target.textContent = "selengkapnya";
            }
          }
          textEl.appendChild(wrapper.firstChild);
        }
      });
    });
  </script>

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end" id="sticky-header-menu">
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

          {{-- card-dynamic --}}
          @foreach($serviceOrders as $serviceOrder)
            <div class="col-12 p-3 mb-2 rounded-3 border">
            {{-- status, id, user, waktu order --}}
            <div class="row w-100 mb-3">
              <div class="col">
                @switch($serviceOrder->status)
                  @case(ServiceOrderStatus::MENCARI_TEKNISI)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Mencari Teknisi</p>
                    @break
                  @case(ServiceOrderStatus::DALAM_SERVIS)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-info">Dalam Servis</p>
                    @break
                  @case(ServiceOrderStatus::SERVIS_SELESAI)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">Servis Selesai</p>
                    @break
                  @case(ServiceOrderStatus::DIBATALKAN)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-secondary">Servis Selesai</p>
                    @break
                @endswitch
              </div>
              <div class="col-auto px-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: {{ $serviceOrder->id }}</p>
                  <i class="far fa-user me-2 text-secondary"></i>
                  <p class="mb-0 px-0 me-4 text-break text-secondary">{{ $serviceOrder->user->nama }}</p>
                  <i class="far fa-clock me-2 text-secondary"></i>
                  <p class="mb-0 px-0 text-break text-secondary">{{ date_format($serviceOrder->created_at,"D, d M Y - h:i A") }}</p>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="row mx-0">
                <div class="col-5 ps-0 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Servis:</p>
                    <input id="deskripsi-masalah-{{ $serviceOrder->id }}" type="hidden" value="{{ $serviceOrder->deskripsi_masalah }}">
                    <p id="text-deskripsi-masalah-{{ $serviceOrder->id }}" class="mb-0 text-break"></p>
                  </div>
                </div>
                <div class="col-4 border-end">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Alamat</p>
                    <p class="mb-0 text-break">{{ $serviceOrder->nama }} ({{ $serviceOrder->nomor_hp }})<br>{{ $serviceOrder->address_order->alamat }}, Kota {{ $serviceOrder->address_order->kota }}, {{ $serviceOrder->address_order->kode_pos }}</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="row">
                    <p class="mb-0 fw-bold text-break">Permintaan Jadwal</p>
                    <p class="mb-0 text-break">{{ date_format(new DateTime($serviceOrder->waktu),"l, d M Y") }}</p>
                    <p class="mb-0 text-break">Jam {{ date_format(new DateTime($serviceOrder->waktu),"H:i \W\I\B") }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mx-0">
              <div class="col px-3 py-1 rounded-3 border bg-light">
                <div class="d-flex align-items-center">
                  <p class="mb-0 me-1 px-0 fw-bold text-break" style="min-width: 350px;">Teknisi:</p>
                  <p class="mb-0 me-1 px-0 fw-bold text-break">Total Biaya:</p>
                </div>
              </div>
              <div class="col-auto ps-2 pe-0">
                @switch($serviceOrder->status)
                  @case(ServiceOrderStatus::MENCARI_TEKNISI)
                    <button type="button" class="btn btn-sm btn-primary rounded-3 h-100 fw-bold" style="min-width: 220px;">Cari Teknisi</button>
                    @break
                  @case(ServiceOrderStatus::DALAM_SERVIS)
                    <button type="button" class="btn btn-sm btn-primary rounded-3 h-100 fw-bold" style="min-width: 220px;" disabled>Cari Teknisi</button>
                    @break
                  @case(ServiceOrderStatus::SERVIS_SELESAI)
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-3 h-100 fw-bold" style="min-width: 220px;" data-bs-toggle="modal" data-bs-target="#modal-catatan-teknisi{{ $serviceOrder->id }}">Catatan Teknisi</button>
                    @break
                  @case(ServiceOrderStatus::DIBATALKAN)
                    @break
                @endswitch
              </div>
            </div>
          </div>
          @endforeach

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
  @foreach($serviceOrders as $serviceOrder)

    @switch($serviceOrder->status)
      @case(ServiceOrderStatus::MENCARI_TEKNISI)
        @break
      @case(ServiceOrderStatus::DALAM_SERVIS)
        @break
      @case(ServiceOrderStatus::SERVIS_SELESAI)
        <div class="modal fade" id="modal-catatan-teknisi{{ $serviceOrder->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <p class="px-0 mb-0 text-secondary">Diservis oleh: {{ $serviceOrder->technician->user->nama }}</p>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 fw-bold">Total Biaya</p>
                <input id="" type="text" value="{{ $serviceOrder->biaya }}" class="form-control mb-3" required autocomplete="name" autofocus placeholder="Total biaya" disabled>
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
