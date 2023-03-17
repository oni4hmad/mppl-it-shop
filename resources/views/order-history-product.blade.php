@php use App\Enums\ProductOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  {{-- fix button danger format broken --}}
  <style>
    .fixed-button {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .fixed-button:hover {
      background-color: #c82333;
      border-color: #bd2130;
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

  <script>
    window.onload = () => {
      @if ($message = Session::get('success'))
        {{--show success toast--}}
        let toastSuccessEl = document.getElementById('toast-success');
        let changeSuccessText = (text) => toastSuccessEl.querySelector('.toast-body').innerHTML = `${text}`;
        let toastSuccess = new bootstrap.Toast(toastSuccessEl);
        changeSuccessText("{{ $message }}");
        toastSuccess.show();
      @elseif ($errors->any())
        {{--show error validation toast--}}
        let toastErrorEl = document.getElementById('toast-error');
        let changeErrorText = (text) => toastErrorEl.querySelector('.toast-body').innerHTML = `${text}`;
        let toastError = new bootstrap.Toast(toastErrorEl);
        let message = "Pengisian gagal:";
        @foreach ($errors->all() as $error)
          message += "<li>{{ $error }}</li>";
        @endforeach
        changeErrorText(message);
        toastError.show();
      @endif
    };
  </script>

  {{--toast success--}}
  <div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
    <div id="toast-success" class="toast align-items-center bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body text-white">
          Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  {{--toast error--}}
  <div class="toast-container position-fixed p-3 py-5 bottom-0 start-50 translate-middle-x z-3">
    <div id="toast-error" class="toast align-items-center bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="300000">
      <div class="d-flex">
        <div class="toast-body text-white">
          Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

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
                <option value="">Menunggu Pembayaran</option>
                <option value="">Menunggu Resi</option>
                <option value="">Sedang Dikirim</option>
                <option value="">Selesai</option>
                <option value="">Dibatalkan</option>
              </select>
            </div>
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <a class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3" style="cursor: default !important;">
                <i class="fas fa-search text-secondary"></i>
              </a>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari orderan" aria-label="Search" aria-describedby="search-addon" />
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

        {{-------------------- table --------------------}}

        @foreach($productOrders as $productOrder)
          {{-- baris order dynamic --}}
          <div class="row border-bottom border-end bg-white">
            <div class="col-5">
              {{-- order item --}}
              @foreach($productOrder->product_stack_orders as $productStackOrder)
                <a href="/product/{{ $productStackOrder->product->slug }}" class="text-decoration-none text-black">
                  <div class="row mx-0 py-3">
                    {{-- image --}}
                    <div class="col-auto px-0 rounded-3">
                      <div class="p-0 me-1">
                        <div style="width: 6.5rem; height: 6.5rem;">
                          <div class="w-100 h-100 rounded-3 border"
                               style="background-image: url('/{{ $productStackOrder->photo->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                        </div>
                      </div>
                    </div>
                    {{-- product name --}}
                    <div class="col d-flex flex-column justify-content-between">
                      <div class="row justify-content-between">
                        <div class="col-auto">
                          <p class="mb-0 fw-bolder text-break">{{ $productStackOrder->nama }}</p>
                          <p class="mb-0 px-0 text-break">{{ $productStackOrder->kuantitas }} barang x
                            Rp{{ number_format($productStackOrder->harga, 0, ',', '.') }}</p>
                          <p
                            class="mb-0 text-secondary text-break">{{ date_format($productStackOrder->created_at,"D, d M Y - h:i A") }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
            {{-- status --}}
            <div class="col-2 py-3">
              @switch($productOrder->status)
                @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
                  <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Pembayaran</p>
                  @break
                @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
                  <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Verifikasi</p>
                  @break
                @case(ProductOrderStatus::MENUNGGU_RESI)
                  <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Resi</p>
                  @break
                @case(ProductOrderStatus::SEDANG_DIKIRIM)
                  <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Sedang Dikirim</p>
                  @break
                @case(ProductOrderStatus::ORDER_SELESAI)
                  <p class="--sticky-table-item mb-0 fw-bold text-success" style="z-index: 1;">Selesai</p>
                  @break
                @case(ProductOrderStatus::DIBATALKAN)
                  <p class="--sticky-table-item mb-0 fw-bold text-muted" style="z-index: 1;">Dibatalkan</p>
                  @break
                @default
                  <p class="--sticky-table-item mb-0 fw-bold text-danger" style="z-index: 1;">Tidak Diketahui</p>
              @endswitch
            </div>
            {{-- total bayar --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">
                Rp{{ number_format($productOrder->total_bayar, 0, ',', '.') }}</p>
            </div>
            {{-- action --}}
            <div class="col-3 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                @switch($productOrder->status)
                  @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
                    <a href="/payment/{{ $productOrder->id }}" type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold border-white">Cek Kode Pembayaran</a>
                    <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold border-white" data-bs-toggle="modal" data-bs-target="#modal-upload-bukti-pembayaran{{ $productOrder->id }}">Upload Bukti Pembayaran</button>
                    {{-- TODO: btn batalkan pesanan not yet done --}}
                    <a class="btn btn-danger fixed-button btn-sm rounded-3 w-100 fw-bold text-white border-white" data-bs-toggle="modal" data-bs-target="#modal-batalkan-pesanan{{ $productOrder->id }}">Batalkan Pesanan</a>
                    @break
                  @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
                    <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-edit-bukti-pembayaran{{ $productOrder->id }}">Edit Bukti Pembayaran</button>
                    @break
                  @case(ProductOrderStatus::MENUNGGU_RESI)
                    <button class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" disabled>Lacak</button>
                    @break
                  @case(ProductOrderStatus::SEDANG_DIKIRIM)
                    <a href="/track/{{ $productOrder->id }}" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold border border-white">Lacak</a>
                    <form action="/mark-order-done/{{ $productOrder->id }}" method="post">
                      @method('put')
                      @csrf
                      <button type="submit" class="btn btn-success btn-sm rounded-3 w-100 fw-bold border border-white text-white">Konfirmasi Diterima</button>
                    </form>
                    @break
                  @case(ProductOrderStatus::ORDER_SELESAI)
                    @php
                      $productStackOrders = $productOrder->product_stack_orders;
                      $productStackOrderWithoutRating = $productStackOrders->filter(function ($productStackOrder) {
                        return !$productStackOrder->product_rating()->exists();
                      });
                    @endphp
                    @if(count($productStackOrderWithoutRating) >= 1)
                      <div class="btn-group w-100">
                        <button class="btn btn-primary btn-sm w-100 fw-bold text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Beri Rating</button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                          @foreach($productStackOrderWithoutRating as $productStackOrder)
                            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk{{ $productStackOrder->id }}">{{ $productStackOrder->product->nama }}</a></li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    @break
                @endswitch
                <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: {{ $productOrder->id }}</p>
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
  {{-- data-bs-toggle="modal" data-bs-target="#modal-editxxx" --}}

  @foreach($productOrders as $productOrder)
    @switch($productOrder->status)
      @case(ProductOrderStatus::MENUNGGU_PEMBAYARAN)
        <!-- modal: batalkan pesnaan -->
        <div class="modal fade" id="modal-batalkan-pesanan{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Batalkan Pesanan?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="mb-0 text-center">Apakah kamu yakin ingin membatalkan pesanan?</p>
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

        <!-- modal: upload bukti pembayaran -->
        <div class="modal fade" id="modal-upload-bukti-pembayaran{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-auto p-0">
                      <h5 class="modal-title" id="staticBackdropLabel">Upload Bukti Pembayaran</h5>
                    </div>
                    <div class="col-auto p-0">
                      <p class="small ms-3 py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $productOrder->id }}</p>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form enctype="multipart/form-data" action="/payment/{{ $productOrder->id }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                  <div class="row mb-2">
                    <div class="col">
                      <p class="mb-0 fw-bold">Atas Nama</p>
                      <input name="nama_pembayar" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label for="formFile" class="form-label fw-bold">Foto Bukti Pembayaran</label>
                      <input class="form-control" name="bukti_pembayaran" type="file" id="formFile" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @break
      @case(ProductOrderStatus::MENUNGGU_VERIFIKASI)
        <!-- modal: edit bukti pembayaran -->
        <div class="modal fade" id="modal-edit-bukti-pembayaran{{ $productOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row align-items-center">
                    <div class="col-auto p-0">
                      <h5 class="modal-title" id="staticBackdropLabel">Edit Bukti Pembayaran</h5>
                    </div>
                    <div class="col-auto p-0">
                      <p class="small ms-3 py-0 px-2 m-0 bg-secondary rounded-3 text-white fw-bold">Order ID: {{ $productOrder->id }}</p>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form enctype="multipart/form-data" action="/payment/{{ $productOrder->id }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                  <div class="row mb-3 h-auto w-100 d-flex justify-content-center">
                    <img src="/{{ $productOrder->bukti_pembayaran->path ?? 'img/default.png' }}" class="img-rounded px-0 rounded-3 w-75 border">
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                      <p class="mb-0 fw-bold">Atas Nama</p>
                      <input name="nama_pembayar" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required value="{{ $productOrder->nama_pembayar }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label for="formFile" class="form-label fw-bold">Foto Bukti Pembayaran</label>
                      <input class="form-control" name="bukti_pembayaran" type="file" id="formFile" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @break
      @case(ProductOrderStatus::MENUNGGU_RESI)
        @break
      @case(ProductOrderStatus::SEDANG_DIKIRIM)
        @break
      @case(ProductOrderStatus::ORDER_SELESAI)
        <!-- modal: nilai produk -->
        @php
          $productStackOrders = $productOrder->product_stack_orders;
          $productStackOrderWithoutRating = $productStackOrders->filter(function ($productStackOrder) {
            return !$productStackOrder->product_rating()->exists();
          });
        @endphp
        @foreach($productStackOrderWithoutRating as $productStackOrder)
        <div class="modal fade" id="modal-nilai-produk{{ $productStackOrder->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nilai Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/product-rating/{{ $productStackOrder->id }}" method="post">
                @csrf
                <div class="modal-body">
                  {{-- produknya --}}
                  <div class="row mx-0 py-3">
                    {{-- image --}}
                    <div class="col-auto px-0 rounded-3">
                      <div class="p-0 me-1">
                        <div style="width: 6.5rem; height: 6.5rem;">
                          <div class="w-100 h-100 rounded-3 border border-secondary"
                               style="background-image: url('/{{ $productStackOrder->photo->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                        </div>
                      </div>
                    </div>
                    {{-- product name --}}
                    <div class="col d-flex flex-column justify-content-between">
                      <div class="row justify-content-between">
                        <div class="col-auto">
                          <p class="mb-0 fw-bolder text-break">{{ $productStackOrder->product->nama }}</p>
                          <p class="mb-0 px-0 text-break">{{ $productStackOrder->kuantitas }} barang x Rp{{ number_format($productStackOrder->harga, 0, ',', '.') }}</p>
                          <p class="mb-0 text-secondary text-break">{{ date_format($productStackOrder->created_at,"D, d M Y - h:i A") }}</p>
                          <div class="d-flex flex-row align-items-center">
                            <p class="mb-0 me-2 text-primary fw-bold">Rating (1-5):</p>
                            <input type="number" name="nilai_rating" id="" min="1" max="5" value="5">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <textarea type="text" name="deskripsi_rating" class="form-control" rows="3" required autocomplete="name" autofocus placeholder="Tambahkan review"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Kirim</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endforeach
        @break
    @endswitch
  @endforeach

@endsection
