@extends('layouts.main')

@section('content')

  {{-- hide numeric updown button --}}
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

  </style>

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>

  {{-- jquery: atur jumlah --}}
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/atur-jumlah.js"></script>

  <div class="container mb-4">
    <div class="row">
      <div class="col-lg-8 col-xl-9 py-4">

        {{-- checkout list --}}
        <div class="card">
          <div class="card-header">
            <h5 class="fw-bolder text-primary">Check Out</h5>
          </div>

          <div class="card-body container-fluid py-0">
            {{-- checkout item --}}
            @for ($i = 0; $i < 5; $i++)
              <div class="row mx-0 border-bottom py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- item checkout info --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="my-0 px-0 text-secondary">Quantity: 3</p>
                      <p class="my-0 px-0 fw-bolder fs-5">Rp3.000.000</p>
                      <p class="my-0 px-0 text-secondary">Rp1.000.000 per item</p>
                    </div>
                  </div>
                </div>
              </div>
            @endfor

          </div>
        </div>

        {{-- pengiriman dan pembayaran --}}
        <div class="card mt-4">
          <div class="card-header">
            <h5 class="fw-bolder text-primary">Pengiriman dan Pembayaran</h5>
          </div>

          <div class="card-body container-fluid p-0 py-3">
            {{-- checkout item --}}
            <div class="container px-0">
              <div class="row px-3 mx-0">
                <div class="col me-4">
                  <div class="p-0">
                    {{-- nama penerima, nomor hp, alamat --}}
                    <div class="row">
                      <div class="col me-2 px-0">
                        <p class="text-break p-0 mb-0 fw-bold">Nama Penerima</p>
                        <div class="input-group input-group-sm mb-3">
                          <input type="text" value="{{ 'Oni Ahmad' }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </div>
                      <div class="col px-0">
                        <p class="text-break p-0 mb-0 fw-bold">Nomor HP</p>
                        <div class="input-group input-group-sm mb-3">
                          <input type="number" value="{{ '0891275835' }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-auto ps-0">
                        <p class="text-break p-0 mb-0 fw-bold">Alamat</p>
                      </div>
                      <div class="col-auto ps-0">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-alamat"><p class="text-break p-0 mb-0 fw-bold">Edit Alamat</p></a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-group px-0" style="height: 8rem;">
                        <textarea class="form-control" aria-label="With textarea" disabled>Jl. Manukan Indah II 19C/8, Kec. Tandes,&#13;&#10;Kota Surabaya, Jawa Timur, 60185</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="p-0">
                    {{-- pengiriman, kurir, metode bayar --}}
                    <div class="row">
                      <div class="col me-2 px-0">
                        <p class="text-break p-0 mb-0 fw-bold">Pilih Pengiriman</p>
                        <div class="input-group input-group-sm mb-3">
                          <select class="form-select" id="inputGroupSelect01">
                            <option value="0">Next Day</option>
                            <option value="1" selected>Regular</option>
                          </select>
                        </div>
                      </div>
                      <div class="col px-0">
                        <p class="text-break p-0 mb-0 fw-bold">Pilih Kurir</p>
                        <div class="input-group input-group-sm mb-3">
                          <select class="form-select" id="inputGroupSelect01">
                            <option value="0">JNE</option>
                            <option value="1" selected>AnterAja</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <p class="text-break p-0 mb-0 fw-bold">Metode Pembayaran</p>
                      <div class="input-group input-group-sm px-0 mb-3">
                        <select class="form-select" id="inputGroupSelect01">
                          <option value="0">Mandiri Virtual Account</option>
                          <option value="1" selected>BNI Virtual Account</option>
                          <option value="2">BCA Virtual Account</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- ringkasan belanja --}}
      <div class="col-lg-4 col-xl-3 py-4">
        <div class="sticky-top" id="sticky-fix">
          <div class="card">
            <div class="card-header">
              <h5 class="fw-bolder text-primary">Ringkasan Belanja</h5>
            </div>
            <div class="card-body">
              <p class="card-text mb-0 fw-normal">Subtotal (5 barang)</p>
              <p class="card-text text-primary fw-bold fs-4">Rp16.500.000</p>
              <p class="card-text mb-0 fw-normal">Ongkos Kirim</p>
              <p class="card-text text-primary fw-bold fs-4">Rp15.000</p>
            </div>
            <div class="card-footer bg-transparent">
              <p class="card-text mb-0 fw-bold">Total Bayar</p>
              <p class="card-text text-dark fw-bold fs-4">Rp7.015.000</p>

              {{-- konfirmasi & bayar --}}
              <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = 'payment';" }}">Konfirmasi & Bayar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-editxxx" --}}

  <!-- modal: edit alamat -->
  <div class="modal fade" id="modal-edit-alamat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Alamat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-9">
              <p class="mb-0 fw-bold">Kabupaten / Kota</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kabupaten / Kota">
            </div>
            <div class="col">
              <p class="mb-0 fw-bold">Kode Pos</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kode Pos">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-0 fw-bold">Alamat</p>
              <input id="nama" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
        </div>
      </div>
    </div>
  </div>

@endsection
