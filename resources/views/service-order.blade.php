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

  <div class="container" style="min-height: 90vh;">
    <div class="row py-4 justify-content-center">

      {{-- form persan jasa service --}}
      <div id="form-pesan-servis" class="col-sm-12 col-md-7 col-lg-6">
        <div class="card bg-body rounded">
          <div class="card-header">
            <h5 class="fw-bold text-primary">Pesan Jasa Servis</h5>
          </div>
          <div class="card-body py-4">
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nama Pemesan</p>
                <div class="input-group input-group-md">
                  <input type="text" class="form-control" aria-describedby="emailHelp" aria-describedby="inputGroup-sizing-sm" placeholder="Nama Pemesan">
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Nomor HP</p>
                <div class="input-group input-group-md">
                  <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nomor HP">
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Waktu</p>
                <div class="input-group input-group-md">
                  <input type="time" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
              </div>
              <div class="col">
                <p class="card-text mb-0 fw-bold">Pilih Tanggal</p>
                <div class="input-group input-group-md">
                  <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
              </div>
            </div>
            <div class="row pb-3">
              <p class="card-text mb-0 text-secondary">Teknisi akan menghubungi anda melalui nomor HP untuk kesepakatan waktu lebih lanjut.</p>
            </div>
            <div class="row py-2">
              <div class="col">
                <p class="card-text mb-0 fw-bold">Masalah Yang Dialami</p>
                <div class="row">
                  <div class="input-group" style="height: 8rem;">
                    <textarea class="form-control" aria-label="With textarea">Komputer tidak bisa menyala tapi suara kipas terdengar</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row py-2">
              <div class="col">
                <div class="d-flex flex-row">
                  <p class="card-text mb-0 me-3 fw-bold">Alamat</p>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-alamat"><p class="card-text mb-0 fw-bold">Edit Lokasi</p></a>
                </div>
                <div class="row">
                  <div class="input-group" style="height: 8rem;">
                    <textarea class="form-control" aria-label="With textarea" disabled>Jl. Manukan Indah II 19C/8, Kec. Tandes,&#13;&#10;Kota Surabaya, Jawa Timur, 60185</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer bg-transparent">
            {{-- btn: buat pesanan --}}
            <button type="button" class="btn btn-primary w-100 fw-bold" onclick="pesananBerhasil()">Buat Pesanan</button>
          </div>
        </div>
      </div>

      {{-- form pesanan berhasil: hapus d-none --}}
      <div id="order-berhasil" class="d-none col-sm-12 col-md-7 col-lg-6">
        <div class="card bg-body rounded">
          <div class="card-header">
            <h5 class="fw-bold text-primary">Pesan Jasa Servis</h5>
          </div>
          <div class="card-body py-4">
            <div class="row py-2">
              <p class="card-text mb-0">Pemesanan jasa servis berhasil dibuat, tunggu teknisi kami menghubungi nomor HP anda.</p>
            </div>
          </div>
          <div class="card-footer bg-transparent">
            {{-- btn: cek status pesanan --}}
            <button type="button" class="btn btn-primary w-100 fw-bold" onclick="window.location='/order-history-service'">Cek Status Pesanan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // buat demo aja yo
    // kalau diklik 'Cek Status Pesanan'
    function pesananBerhasil() {
      let form_pesan_servis = document.querySelector('#form-pesan-servis');
      form_pesan_servis.classList.add("d-none");
      let card_order_berhasil = document.querySelector('#order-berhasil');
      card_order_berhasil.classList.remove("d-none");
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
  </script>

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}

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
