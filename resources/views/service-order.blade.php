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
      <div class="col-sm-12 col-md-7 col-lg-6">
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
                  <a href="#"><p class="card-text mb-0 fw-bold">Edit Lokasi</p></a>
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
            <button type="button" class="btn btn-primary w-100 fw-bold">Buat Pesanan</button>
          </div>
        </div>
      </div>

      {{-- form pesanan berhasil: hapus d-none --}}
      <div class="d-none col-sm-12 col-md-7 col-lg-6">
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
            <button type="button" class="btn btn-primary w-100 fw-bold">Cek Status Pesanan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
