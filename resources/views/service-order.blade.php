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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
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

      // pemesanan jasa service berhasil
      @if ($message = Session::get('success'))
        document.querySelector('#form-pesan-servis').classList.add('d-none');
        document.querySelector('#order-berhasil').classList.remove('d-none');
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
      @endif
    });
  </script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container" style="min-height: 90vh;">
    <div class="row py-4 justify-content-center">

      {{-- form persan jasa service --}}
      <div id="form-pesan-servis" class="col-sm-12 col-md-7 col-lg-6">
        <div class="card bg-body rounded">
          <div class="card-header">
            <h5 class="fw-bold text-primary">Pesan Jasa Servis</h5>
          </div>
          <form action="/service-order" method="post">
          @csrf
            <div class="card-body py-4">
              <div class="row py-2">
                <div class="col">
                  <p class="card-text mb-0 fw-bold">Nama Pemesan</p>
                  <div class="input-group input-group-md">
                    <input name="nama" type="text" class="form-control" aria-describedby="emailHelp" aria-describedby="inputGroup-sizing-sm" placeholder="Nama Pemesan" value="{{ old('nama') ?? auth()->user()->nama }}" required>
                  </div>
                </div>
                <div class="col">
                  <p class="card-text mb-0 fw-bold">Nomor HP</p>
                  <div class="input-group input-group-md">
                    <input name="nomor_hp" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Nomor HP" value="{{ old('nomor_hp') ?? auth()->user()->nomor_hp }}" required>
                  </div>
                </div>
              </div>
              <div class="row py-2">
                <div class="col">
                  <p class="card-text mb-0 fw-bold">Waktu</p>
                  <div class="input-group input-group-md">
                    <input name="jam" type="time" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ old('jam') }}" required>
                  </div>
                </div>
                <div class="col">
                  <p class="card-text mb-0 fw-bold">Pilih Tanggal</p>
                  <div class="input-group input-group-md">
                    <input name="tanggal" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ old('tanggal') }}" required>
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
                      <textarea name="deskripsi_masalah" class="form-control" aria-label="With textarea" placeholder="Deskripsikan masalah yang komputer kamu alami. (co: komputer tidak bisa menyala tapi suara kipas terdengar)">{{ old('deskripsi_masalah') }}</textarea>
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
                      <textarea id="text-alamat" class="form-control" aria-label="With textarea" disabled>{{ old('alamat') ?? auth()->user()->alamat }}, Kota {{ old('kota') ?? auth()->user()->kota }}, {{ old('kode_pos') ?? auth()->user()->kode_pos }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" name="kota" id="input-kota" value="{{ old('kota') ?? auth()->user()->kota }}" required>
            <input type="hidden" name="kode_pos" id="input-kode_pos" value="{{ old('kode_pos') ?? auth()->user()->kode_pos }}" required>
            <input type="hidden" name="alamat" id="input-alamat" value="{{ old('alamat') ?? auth()->user()->alamat }}" required>

            <div class="card-footer bg-transparent">
              {{-- btn: buat pesanan --}}
{{--              <button type="button" class="btn btn-primary w-100 fw-bold" onclick="pesananBerhasil()">Buat Pesanan</button>--}}
              <button type="submit" class="btn btn-primary w-100 fw-bold">Buat Pesanan</button>
            </div>
          </form>
        </div>
      </div>

      @if (session()->has('success'))
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
      @endif

    </div>
  </div>

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

        <form id="edit-alamat-form">
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-9">
                <p class="mb-0 fw-bold">Kabupaten / Kota</p>
                <input name="kota" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Kabupaten / Kota" value="{{ old('kota') ?? auth()->user()->kota }}">
              </div>
              <div class="col">
                <p class="mb-0 fw-bold">Kode Pos</p>
                <input name="kode_pos" type="number" class="form-control" required autocomplete="name" autofocus placeholder="Kode Pos" value="{{ old('kode_pos') ?? auth()->user()->kode_pos }}">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-0 fw-bold">Alamat</p>
                <input name="alamat" type="text" class="form-control" required autocomplete="name" autofocus placeholder="Alamat" value="{{ old('alamat') ?? auth()->user()->alamat }}">
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
