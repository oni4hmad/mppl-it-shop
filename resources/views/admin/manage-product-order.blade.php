@php use App\Enums\ProductOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>
    #side-nav:hover {
      background-color: #F2F2F2;
    }

    {{-- fix button danger format broken --}}
    .fixed-btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .fixed-btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    .btn-warning {
      background-color: #ffc107;
      color: black;
    }

    .btn-success {
      background-color: #28a745;
      color: white;
    }

    .btn-success:hover {
      background-color: #218838;
      color: white;
    }
  </style>

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

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
                <option value="">All Orders</option>
                <option value="">Menunggu Pembayaran</option>
                <option value="">Menunggu Resi</option>
                <option value="">Sedang Dikirim</option>
                <option value="">Selesai</option>
                <option value="">Dibatalkan</option>
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
          {{-- card dynamic --}}
          @foreach($productOrders as $productOrder)
            <div class="col-12 p-3 mb-2 rounded-3 border">
              {{-- status, id, user, waktu order --}}
              <div class="row w-100 mb-3">
                <div class="col">

                @switch($productOrder->status)
                  @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Menunggu Pembayaran</p>
                    @break
                  @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Menunggu Verifikasi</p>
                    @break
                  @case(ProductOrderStatus::MENUNGGU_RESI)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-warning">Menunggu Resi</p>
                    @break
                  @case(ProductOrderStatus::SEDANG_DIKIRIM)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-info">Sedang Dikirim</p>
                    @break
                  @case(ProductOrderStatus::ORDER_SELESAI)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-success">Selesai</p>
                    @break
                  @case(ProductOrderStatus::DIBATALKAN)
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-muted">Dibatalkan</p>
                    @break
                @endswitch

                </div>
                <div class="col-auto px-0">
                  <div class="d-flex align-items-center">
                    <p class="mb-0 px-0 me-4 fw-bold text-break text-primary">ID: {{ $productOrder->id }}</p>
                    <i class="far fa-user me-2 text-secondary"></i>
                    <p class="mb-0 px-0 me-4 text-break text-secondary">{{ $productOrder->user->nama }}</p>
                    <i class="far fa-clock me-2 text-secondary"></i>
                    <p class="mb-0 px-0 text-break text-secondary">{{ date_format($productOrder->created_at,"D, d M Y - h:i A") }}</p>
                  </div>
                </div>
              </div>

              <div class="col-12 mb-3">
                <div class="row mx-0">

                  <div class="col-5 ps-0 border-end">
                    <div class="row">
                      @php
                        $firstProductStack = $productOrder->product_stack_orders->first();
                      @endphp
                      <div class="col-auto pe-0">
                        <div style="width: 6.5rem; height: 6.5rem;">
                          <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('/{{ $firstProductStack->photo->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                        </div>
                      </div>
                      <div class="col ms-2 ps-0">
                        <p class="mb-0 fw-bold text-break">{{ $firstProductStack->nama }}</p>
                        <p class="mb-0 px-0 text-break">{{ $firstProductStack->kuantitas }} barang x Rp{{ number_format($firstProductStack->harga, 0, ',', '.') }}</p>
                      </div>
                    </div>

                    @php
                      $kuantitas_arr = $productOrder->product_stack_orders->map(function ($productStackOrder){
                        return $productStackOrder->kuantitas;
                      });
                      $count_barang = $kuantitas_arr->sum();
                      $count_stack = count($productOrder->product_stack_orders);
                    @endphp
                    @if($count_stack > 1)
                      <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#modal-detail-order{{ $productOrder->id }}">
                        <div class="d-flex flex-row align-items-center py-2">
                          <p class="mb-0 me-2 fw-bold text-break">Lihat {{ $count_stack-1 }} Produk Lainnya</p>
                          <i class="fas fa-external-link-alt"></i>
                        </div>
                      </a>
                    @endif
                  </div>

                  <div class="col-4 border-end">
                    <div class="row">
                      <p class="mb-0 fw-bold text-break">Alamat</p>
                      <p class="mb-0 text-break">{{ $productOrder->nama_penerima }} ({{ $productOrder->nomor_hp }})<br>{{ $productOrder->address_order->alamat }}, Kota {{ $productOrder->address_order->kota }},
                        {{ $productOrder->address_order->kode_pos }}</p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="row">
                      <p class="mb-0 fw-bold text-break">Kurir</p>
                      <p class="mb-0 text-break">{{ $productOrder->courier->nama }} {{ $productOrder->courier_type->nama }}</p>
                      <p class="mb-0 text-break text-secondary">Rp{{ number_format($productOrder->ongkos_kirim, 0, ',', '.') }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mx-0">
                <div class="col px-3 py-1 rounded-3 border bg-light">
                  <div class="d-flex flex-row align-items-center h-100">
                    <p class="mb-0 me-1 px-0 fw-bold text-break">Total Harga</p>
                    <p class="mb-0 me-2 px-0 fw-bold text-break text-secondary">({{ $count_barang }} Barang):</p>
                    <p class="mb-0 px-0 fw-bold text-break">Rp{{ number_format($productOrder->total_bayar, 0, ',', '.') }}</p>
                  </div>
                </div>
                <div class="col-auto ps-2 pe-0">

                  @switch($productOrder->status)
                    @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
                      <button type="button" class="btn btn-sm btn-danger fixed-btn-danger text-white rounded-3 px-5 h-100 fw-bold" style="min-width: 250px;" data-bs-toggle="modal" data-bs-target="#modal-tolak-order{{ $productOrder->id }}">Batalkan Order</button>
                      @break
                    @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
                      <button type="button" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold" style="min-width: 250px;" data-bs-toggle="modal" data-bs-target="#modal-verifikasi-bukti-pembayaran{{ $productOrder->id }}">Verifikasi Pembayaran</button>
                      @break
                    @case(ProductOrderStatus::MENUNGGU_RESI)
                      <button type="button" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold" style="min-width: 250px;" data-bs-toggle="modal" data-bs-target="#modal-input-resi{{ $productOrder->id }}">Input Resi</button>
                      @break
                    @case(ProductOrderStatus::SEDANG_DIKIRIM)
                      <a href="/track/{{ $productOrder->id }}" class="btn btn-sm btn-primary rounded-3 px-5 h-100 fw-bold" style="min-width: 250px;">Lacak</a>
                      @break
                    @case(ProductOrderStatus::ORDER_SELESAI)
                      @break
                    @case(ProductOrderStatus::DIBATALKAN)
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

  @foreach($productOrders as $productOrder)
    @php
      $kuantitas_arr = $productOrder->product_stack_orders->map(function ($productStackOrder){
        return $productStackOrder->kuantitas;
      });
      $count_barang = $kuantitas_arr->sum();
    @endphp

    @if(count($productOrder->product_stack_orders) > 1)
      <!-- modal: detail order -->
      <div class="modal fade" id="modal-detail-order{{ $productOrder->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <div class="container-fluid">
              <div class="row align-items-center">
                <div class="col-auto ps-0">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail Order </h5>
                </div>
                <div class="col-auto px-0">
                  <p class="small py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: 4</p>
                </div>
              </div>
              <div class="row">
                <p class="px-0 mb-0 text-secondary">Total: {{ $count_barang }} barang</p>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @foreach($productOrder->product_stack_orders as $productStackOrder)
              <div class="row mb-3">
                <div class="col-auto pe-0">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('/{{ $productStackOrder->photo->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
                <div class="col ms-2 ps-0">
                  <p class="mb-0 fw-bold text-break">{{ $productStackOrder->nama }}</p>
                  <p class="mb-0 px-0 text-break">{{ $productStackOrder->kuantitas }} barang x Rp{{ number_format($productStackOrder->harga, 0, ',', '.') }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm px-5 text-white fw-bold" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    @endif

    @switch($productOrder->status)
      @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
        <!-- modal: tolak order -->
        <div class="modal fade" id="modal-tolak-order{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Tolak Order?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Apakah kamu yakin ingin menolak pesanan?</p>
              </div>
              <form action="/cancel-order-product/{{ $productOrder->id }}" method="post">
                @csrf
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Iya</button>
                  <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @break
      @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
        <!-- modal: verifikasi bukti pembayaran -->
        <div class="modal fade" id="modal-verifikasi-bukti-pembayaran{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-auto p-0">
                      <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Bukti Pembayaran</h5>
                    </div>
                    <div class="col-auto p-0">
                      <p class="small ms-3 py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $productOrder->id }}</p>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row mb-3 h-auto w-100 d-flex justify-content-center">
                  <img src="/{{ $productOrder->bukti_pembayaran->path ?? 'img/default.png' }}" class="img-rounded px-0 rounded-3 w-75 border">
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Atas Nama</p>
                    <input name="nama_pembayar" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required value="{{ $productOrder->nama_pembayar }}" disabled>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger fixed-btn-danger btn-sm px-3 fw-bold text-white" data-bs-toggle="modal" data-bs-target="#modal-tolak-order{{ $productOrder->id }}">Tolak</button>
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-konfirmasi-pembayaran-order{{ $productOrder->id }}">Konfirmasi</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal: tolak order -->
        <div class="modal fade" id="modal-tolak-order{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Tolak Order?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Apakah kamu yakin ingin menolak pesanan?</p>
              </div>
              <form action="/cancel-order-product/{{ $productOrder->id }}" method="post">
                @csrf
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Iya</button>
                  <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal: konfirmsi pembayaran order -->
        <div class="modal fade" id="modal-konfirmasi-pembayaran-order{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Konfirmasi Pembayaran Order?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Apakah kamu yakin ingin mengonfirmasi pembayaran pesanan?</p>
              </div>
              <form action="/confirm-payment/{{ $productOrder->id }}" method="post">
                @csrf
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Iya</button>
                  <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Tidak</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @break
      @case(ProductOrderStatus::MENUNGGU_RESI)
        <!-- modal: input resi -->
        <div class="modal fade" id="modal-input-resi{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-auto p-0">
                      <h5 class="modal-title" id="staticBackdropLabel">Input Resi</h5>
                    </div>
                    <div class="col-auto p-0">
                      <p class="small ms-3 py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $productOrder->id }}</p>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form action="/update-resi/{{ $productOrder->id }}" method="post">
                @csrf
                <div class="modal-body">
                  <p class="mb-0 fw-bold">Masukkan Nomor Resi</p>
                  <input type="number" name="nomor_resi" class="form-control" value="" required autocomplete="name" autofocus placeholder="Nomor Resi">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm px-3 fw-bold text-white" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Submit</button>
                </div>
              </form>

            </div>
          </div>
        </div>
        @break
      @case(ProductOrderStatus::SEDANG_DIKIRIM)
        @break
      @case(ProductOrderStatus::ORDER_SELESAI)
        @break
      @case(ProductOrderStatus::DIBATALKAN)
        @break
    @endswitch

  @endforeach

@endsection
