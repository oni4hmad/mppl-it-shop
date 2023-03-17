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
  <script src="/js/sticky-content-fix.js"></script>

  {{-- jquery: atur jumlah --}}
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="/js/atur-jumlah.js"></script>

  {{-- crypto.js encryption --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- dynamic content --}}
  <script>
    const couriers = {!! $couriers_json !!};
    const checkedProductStackCarts = {!! $checkedProductStackCarts !!};
    let ringkasanBelanja = {};

    const checkedProductStackCarts_hash = CryptoJS.MD5(JSON.stringify({!! $checkedProductStackCarts !!})).toString();

    // TODO: Remove this
    const php_checkoutCartHash = '{!! md5($checkedProductStackCarts) !!}';
    console.log(php_checkoutCartHash, checkedProductStackCarts_hash);

    const updateRingkasanBelanja = () => {
      let selectedCrId = parseInt(document.querySelector("#input-group-select-cr").value);
      let selectedCtId = parseInt(document.querySelector("#input-group-select-ct").value);
      let ongkos_kirim = couriers.find(e => e.id === selectedCrId)?.courier_types.find(e => e.id === selectedCtId).harga;

      let count = checkedProductStackCarts.map(i => i.kuantitas).reduce((a, b) => a + b, 0);
      let subtotal = checkedProductStackCarts.map(i => i.product.harga * i.kuantitas).reduce((a, b) => a + b, 0);
      let total_bayar = subtotal + ongkos_kirim;
      ringkasanBelanja = {
        count: count,
        subtotal: subtotal,
        ongkos_kirim: ongkos_kirim,
        total_bayar: total_bayar
      }
      console.log(ringkasanBelanja)

      // update ui element
      let rb = ringkasanBelanja;
      document.querySelector('#text-count-barang').innerText = `Subtotal (${rb.count} barang)`;
      document.querySelector('#text-subtotal').innerText = `Rp${rb.subtotal.toLocaleString('id-ID')}`;
      document.querySelector('#text-ongkos_kirim').innerText = `Rp${rb.ongkos_kirim.toLocaleString('id-ID')}`;
      document.querySelector('#text-total-bayar').innerText = `Rp${rb.total_bayar.toLocaleString('id-ID')}`;

      // update input form
      document.querySelector('input[name="checkedProductStackCarts_hash"]').value = checkedProductStackCarts_hash;
      document.querySelector('input[name="subtotal"]').value = rb.subtotal;
      document.querySelector('input[name="ongkos_kirim"]').value = rb.ongkos_kirim;
      document.querySelector('input[name="total_bayar"]').value = rb.total_bayar;
    }

    document.addEventListener("DOMContentLoaded", function () {

      // calculate ringkasan belanja
      updateRingkasanBelanja();

      // add onsubmit edit alamat event handler
      document.querySelector('#edit-alamat-form').onsubmit = (e) => {
        e.preventDefault();
        console.log('triggered', e);
        let newAddress = {
          kota: null,
          kode_pos: null,
          alamat: null
        };
        e.target.querySelectorAll('input').forEach(input => {
          document.querySelector(`#input-${input.name}`).value = input.value;
          newAddress[input.name] = input.value;
          console.log(input.name, input.value);
        });
        e.target.querySelector('[data-bs-dismiss="modal"]').click();
        document.querySelector('#text-alamat').innerText = `${newAddress.alamat}, Kota ${newAddress.kota}, ${newAddress.kode_pos}`;
        console.log(newAddress);
      };

    });

    function onCourierChanged() {
      let gselectCr = document.querySelector('#input-group-select-cr');
      let selectedCourierId = parseInt(gselectCr.value);
      let courier_types = couriers.find(e => e.id === selectedCourierId)?.courier_types;
      let gselectCt = document.querySelector('#input-group-select-ct');
      gselectCt.innerHTML = "";
      courier_types.forEach(ct => {
        gselectCt.add(new Option(`${ct.nama} - Rp${ct.harga.toLocaleString('id-ID')}`, ct.id));
      });
      updateRingkasanBelanja();
    }

    function onCourierTypeChanged() {
      updateRingkasanBelanja();
    }

    function placeOrder() {
      document.querySelector('#checkout-form').submit();
    }
  </script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

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
            @foreach($checkedProductStackCarts as $cProductStackCart)
              <div class="row mx-0 border-bottom py-3">
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('/{{ $cProductStackCart->product->photo_1->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                {{-- item checkout info --}}
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder">{{ $cProductStackCart->product->nama }}</p>
                      <p class="my-0 px-0 text-secondary">Quantity: {{ $cProductStackCart->kuantitas }}</p>
                      <p class="my-0 px-0 fw-bolder fs-5">Rp{{ number_format($cProductStackCart->product->harga * $cProductStackCart->kuantitas, 0, ',', '.') }}</p>
                      <p class="my-0 px-0 text-secondary">Rp{{ number_format($cProductStackCart->product->harga, 0, ',', '.') }} per item</p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>

        {{-- pengiriman dan pembayaran --}}
        <div class="card mt-4">
          <div class="card-header">
            <h5 class="fw-bolder text-primary">Pengiriman dan Pembayaran</h5>
          </div>
          <div class="card-body container-fluid p-0 py-3">

            <form id="checkout-form" action="/place-order" method="post">
              @csrf

              <div class="container px-0">
                <div class="row px-3 mx-0">
                  <div class="col me-4">
                    <div class="p-0">

                      {{-- nama penerima, nomor hp, alamat --}}
                      <div class="row">
                        <div class="col me-2 px-0">
                          <p class="text-break p-0 mb-0 fw-bold">Nama Penerima</p>
                          <div class="input-group input-group-sm mb-3">
                            <input type="text" value="{{ auth()->user()->nama }}" name="nama_penerima" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                          </div>
                        </div>
                        <div class="col px-0">
                          <p class="text-break p-0 mb-0 fw-bold">Nomor HP</p>
                          <div class="input-group input-group-sm mb-3">
                            <input type="number" value="{{ auth()->user()->nomor_hp }}" name="nomor_hp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                          <textarea id="text-alamat" class="form-control" aria-label="With textarea" disabled>{{ auth()->user()->alamat }}, Kota {{ auth()->user()->kota }}, {{ auth()->user()->kode_pos }}</textarea>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col">
                    <div class="p-0">

                      {{-- pengiriman, kurir, metode bayar --}}
                      <div class="row">
                        <div class="col me-2 px-0">
                          <p class="text-break p-0 mb-0 fw-bold">Pilih Kurir</p>
                          <div class="input-group input-group-sm mb-3">
                            <select class="form-select" id="input-group-select-cr" onchange="onCourierChanged()" name="courier_id">

                              @foreach($couriers as $cr)
                                <option value="{{ $cr->id }}">{{ $cr->nama }}</option>
                              @endforeach

                            </select>
                          </div>
                        </div>
                        <div class="col px-0">
                          <p class="text-break p-0 mb-0 fw-bold">Pilih Pengiriman</p>
                          <div class="input-group input-group-sm mb-3">
                            <select class="form-select" id="input-group-select-ct" onchange="onCourierTypeChanged()" name="courier_type_id">

                              @foreach($couriers[0]->courier_types as $ct)
                                <option value="{{ $ct->id }}">{{ $ct->nama }} - Rp{{ number_format($ct->harga, 0, ',', '.') }}</option>
                              @endforeach

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <p class="text-break p-0 mb-0 fw-bold">Metode Pembayaran</p>
                        <div class="input-group input-group-sm px-0 mb-3">
                          <select class="form-select" id="input-group-select-pm" name="payment_method_id">

                            @foreach($payment_methods as $pm)
                              <option value="{{ $pm->id }}">{{ $pm->nama }}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <input type="hidden" name="kota" id="input-kota" value="{{ auth()->user()->kota }}">
              <input type="hidden" name="kode_pos" id="input-kode_pos" value="{{ auth()->user()->kode_pos }}">
              <input type="hidden" name="alamat" id="input-alamat" value="{{ auth()->user()->alamat }}">

              <input type="hidden" name="checkedProductStackCarts_hash" value="">
              <input type="hidden" name="subtotal" value="">
              <input type="hidden" name="ongkos_kirim" value="">
              <input type="hidden" name="total_bayar" value="">

            </form>

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
              <p id="text-count-barang" class="card-text mb-0 fw-normal">Subtotal (5 barang)</p>
              <p id="text-subtotal" class="card-text text-primary fw-bold fs-4">Rp16.500.000</p>
              <p class="card-text mb-0 fw-normal">Ongkos Kirim</p>
              <p id="text-ongkos_kirim" class="card-text text-primary fw-bold fs-4">Rp15.000</p>
            </div>
            <div class="card-footer bg-transparent">
              <p class="card-text mb-0 fw-bold">Total Bayar</p>
              <p id="text-total-bayar" class="card-text text-dark fw-bold fs-4">Rp7.015.000</p>

              {{-- konfirmasi & bayar --}}
              <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="placeOrder()">Konfirmasi & Bayar</button>
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

        <form id="edit-alamat-form">
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-9">
                <p class="mb-0 fw-bold">Kabupaten / Kota</p>
                <input name="kota" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kabupaten / Kota" value="{{ auth()->user()->kota }}">
              </div>
              <div class="col">
                <p class="mb-0 fw-bold">Kode Pos</p>
                <input name="kode_pos" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Kode Pos" value="{{ auth()->user()->kode_pos }}">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-0 fw-bold">Alamat</p>
                <input name="alamat" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat" value="{{ auth()->user()->alamat }}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection
