@php use App\Enums\ProductOrderStatus; @endphp
@extends('layouts.main')

@section('content')

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

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
                <a href="/track" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold">Lacak</a>
                <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: {{ $productOrder->id }}</p>
              </div>
            </div>
          </div>
        @endforeach

        {{-- baris order 1 (menunggu pembayaran) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-------- order item --------}}
            {{---- item 1 ----}}
            <div class="row mx-0 py-3">
              {{-- image --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-3 border border-secondary"
                         style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- product name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Pembayaran</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <a href="/payment" type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold border-white">Cek Kode Pembayaran</a>
              <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold border-white" data-bs-toggle="modal" data-bs-target="#modal-upload-bukti-pembayaran">Upload Bukti Pembayaran</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 11999</p>
            </div>
          </div>
        </div>

        {{-- baris order 2 (menunggu verifikasi) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-- order item --}}
            @for ($i = 0; $i < 1; $i++)
              {{---- item 1 ----}}
              <div class="row mx-0 py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- product name --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                      <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                    </div>
                  </div>
                </div>
              </div>
            @endfor
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Verifikasi</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-edit-bukti-pembayaran">Edit Bukti Pembayaran</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 12000</p>
            </div>
          </div>
        </div>

        {{-- baris order 3 (menunggu resi) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-- order item --}}
            @for ($i = 0; $i < 1; $i++)
              {{---- item 1 ----}}
              <div class="row mx-0 py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- product name --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                      <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                    </div>
                  </div>
                </div>
              </div>
            @endfor
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-warning" style="z-index: 1;">Menunggu Resi</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" disabled>Lacak</button>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 12000</p>
            </div>
          </div>
        </div>

        {{-- baris order 4 (sedang dikirim) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-- order item --}}
            @for ($i = 0; $i < 1; $i++)
              {{---- item 1 ----}}
              <div class="row mx-0 py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- product name --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                      <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                    </div>
                  </div>
                </div>
              </div>
            @endfor
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-primary" style="z-index: 1;">Sedang Dikirim</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <a href="/track" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold">Lacak</a>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 12000</p>
            </div>
          </div>
        </div>

        {{-- baris order 5 (selesai) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-------- order item --------}}
            {{---- item 1 ----}}
            <div class="row mx-0 py-3">
              {{-- image --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-3 border border-secondary"
                         style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- product name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-success" style="z-index: 1;">Selesai</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <button type="button" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk">Beri Rating</button>
              <div class="btn-group w-100">
                <button class="btn btn-primary btn-sm w-100 fw-bold text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Beri Rating
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</a></li>
                  <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk">COMMODI OCCAECATI ERROR NULLA CUMQUE QUIDEM EST VOLUPTATE ET BLANDITIIS</a></li>
                  <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modal-nilai-produk">AUT RERUM QUI COMMODI FACILIS LABORUM DOLOREM ASPERIORES</a></li>
                </ul>
              </div>
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 11998</p>
            </div>
          </div>
        </div>

        {{-- baris order 6 (dibatalkan) --}}
        <div class="row border-bottom border-end bg-white">
          <div class="col-5">
            {{-------- order item --------}}
            {{---- item 1 ----}}
            <div class="row mx-0 py-3">
              {{-- image --}}
              <div class="col-auto px-0 rounded-3">
                <div class="p-0 me-1">
                  <div style="width: 6.5rem; height: 6.5rem;">
                    <div class="w-100 h-100 rounded-3 border border-secondary"
                         style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
              </div>
              {{-- product name --}}
              <div class="col d-flex flex-column justify-content-between">
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                    <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  </div>
                </div>
              </div>
            </div>
            {{-------- endof: order item --------}}
          </div>
          {{-- status --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold text-danger" style="z-index: 1;">Dibatalkan</p>
          </div>
          {{-- total bayar --}}
          <div class="col-2 py-3">
            <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp15.050.000</p>
          </div>
          {{-- action --}}
          <div class="col-3 py-3">
            <div class="--sticky-table-item" style="z-index: 1;">
              <p class="--sticky-table-item mb-0 text-secondary w-100 text-center">Order ID: 11998</p>
            </div>
          </div>
        </div>

        {{-------------------- endof: table --------------------}}

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

  <!-- modal: nilai produk -->
  <div class="modal fade" id="modal-nilai-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
       aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nilai Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- produknya --}}
          <div class="row mx-0 py-3">
            {{-- image --}}
            <div class="col-auto px-0 rounded-3">
              <div class="p-0 me-1">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 rounded-3 border border-secondary"
                       style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
            </div>
            {{-- product name --}}
            <div class="col d-flex flex-column justify-content-between">
              <div class="row justify-content-between">
                <div class="col-auto">
                  <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                  <p class="mb-0 px-0 text-break">1 barang x Rp4.000.000</p>
                  <p class="mb-0 text-secondary text-break">3 Juni 2021</p>
                  <div class="d-flex flex-row align-items-center">
                    <p class="mb-0 me-2 text-primary fw-bold">Rating (1-5):</p>
                    <input type="number" name="" id="" min="1" max="5" value="5">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <textarea id="" type="text" class="form-control" name="name" rows="3" required autocomplete="name" autofocus
                    placeholder="Tambahkan review"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal
          </button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Kirim</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal: upload bukti pembayaran -->
  <div class="modal fade" id="modal-upload-bukti-pembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Upload Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/category" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Atas Nama</p>
                <input name="atas_nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required>
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

  <!-- modal: edit bukti pembayaran -->
  <div class="modal fade" id="modal-edit-bukti-pembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" action="/category" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-3 h-auto w-100 d-flex justify-content-center">
              <img src="/img/default.png" class="img-rounded px-0 rounded-3 w-75 border">
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Atas Nama</p>
                <input name="atas_nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama" required>
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

@endsection
