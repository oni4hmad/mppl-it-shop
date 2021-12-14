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

  <div class="container">
    <div class="row py-4 justify-content-center" style="min-height: 90vh;">
      <div class="col-6">

        {{-- opsi pengaturan akun --}}
        @if (Session::has('name_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('name_updated') }}
          </div>
        @endif
        @if (Session::has('email_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('email_updated') }}
          </div>
        @endif
        @if (Session::has('no_hp_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('no_hp_updated') }}
          </div>
        @endif
        @if (Session::has('alamat_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('alamat_updated') }}
          </div>
        @endif
        @if (Session::has('password_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('password_updated') }}
          </div>
        @endif
        @if (Session::has('password_wrong'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('password_wrong') }}
          </div>
        @endif
        @if (Session::has('image_updated'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('image_updated') }}
          </div>
        @endif
        <div class="card w-100">
          <div class="card-header">
            <h5 class="fw-bolder text-dark mb-0 py-2">Pengaturan Akun</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('product.update') }}" method="POST">
              @csrf
              <div class="row py-3">
                <div class="col-3">
                  <p class="card-text mb-0 text-break fw-bold">Nama</p>
                </div>
                <div class="col">
                  <p class="card-text mb-0 text-break">{{ Auth::user()->name }}</p>
                </div>
                <div class="col-2">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-nama"><p class="card-text mb-0 text-break">Edit</p></a>
                </div>
              </div>
              <div class="row py-3">
                <div class="col-3">
                  <p class="card-text mb-0 text-break fw-bold">Email</p>
                </div>
                <div class="col">
                  <p class="card-text mb-0 text-break">{{ Auth::user()->email }}</p>
                </div>
                <div class="col-2">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-email"><p class="card-text mb-0 text-break">Edit</p></a>
                </div>
              </div>
              <div class="row py-3">
                <div class="col-3">
                  <p class="card-text mb-0 text-break fw-bold">Nomor HP</p>
                </div>
                <div class="col">
                  <p class="card-text mb-0 text-break">{{ Auth::user()->no_hp }}</p>
                </div>
                <div class="col-2">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-nomorhp"><p class="card-text mb-0 text-break">Edit</p></a>
                </div>
              </div>
              <div class="row py-3">
                <div class="col-3">
                  <p class="card-text mb-0 text-break fw-bold">Alamat</p>
                </div>
                <div class="col">
                  <p class="card-text mb-0 text-break">{{ Auth::user()->alamat }}</p>
                </div>
                <div class="col-2">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-alamat"><p class="card-text mb-0 text-break">Edit</p></a>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
      <div class="col" style="max-width: 350px;">


        {{-- opsi foto --}}
        <div class="card w-100">
          <div class="card-img-top p-3 pb-0" style="width: auto; height: 12em;">
            <div class="card-img-top w-100 h-100 bg-image border" style="background-image: url('{{ asset('profile_pic') }}/{{ Auth::user()->profile_pic }}'); background-size: cover; background-position: center center;"></div>
          </div>
          <div class="card-body">
            {{-- pilih foto --}}
            <form enctype="multipart/form-data" action="{{ route('profile.updateImage') }}" method="POST">
              @method("put")
              @csrf
              <input type="file" name="profile_pic" class="form-control mb-2" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
              <button type="submit" class="btn btn-outline-primary w-100 fw-bold fs-6">Upload Foto</button>
            </form>
          </div>
          {{-- Ubah password --}}
          <div class="card-footer bg-transparent">
            <button type="button" class="btn btn-outline-primary my-2 w-100 fw-bold fs-6" data-bs-toggle="modal" data-bs-target="#modal-edit-password">Ubah Password</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->

  <!-- modal: edit nama -->
  <div class="modal fade" id="modal-edit-nama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('profile.updateName') }}" method="post">
          @method("put")
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Nama</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 fw-bold">Nama</p>
            <input id="nama" type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus placeholder="Nama">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: edit Email -->
  <div class="modal fade" id="modal-edit-email" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('profile.updateEmail') }}" method="POST">
          @method("put")
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Email</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 fw-bold">Email</p>
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email" autofocus placeholder="Email">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: edit email berhasil -->
  {{-- <div class="modal fade" id="modal-edit-email-berhasil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Email Verifikasi Terkirim</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-break">Silahkan cek email yang baru untuk melakukan verifikasi</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm px-4 text-white fw-bold" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- modal: edit nomor hp -->
  <div class="modal fade" id="modal-edit-nomorhp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('profile.updateNoHp') }}" method="post">
          @method("put")
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Nomor HP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 fw-bold">Nomor HP</p>
            <input id="nomorhp" type="text" class="form-control" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}" required autocomplete="no_hp" autofocus placeholder="Nomor HP">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: edit alamat -->
  <div class="modal fade" id="modal-edit-alamat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('profile.updateAlamat') }}" method="POST">
          @method("put")
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Alamat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-9">
                <p class="mb-0 fw-bold">Kabupaten / Kota</p>
                <input id="nama" type="text" class="form-control" name="kota" value="{{ old('kota', Auth::user()->kota) }}" required autocomplete="name" autofocus placeholder="Kabupaten / Kota">
              </div>
              <div class="col">
                <p class="mb-0 fw-bold">Kode Pos</p>
                <input id="nama" type="text" class="form-control" name="kode_pos" value="{{ old('kode_pos', Auth::user()->kode_pos) }}" required autocomplete="name" autofocus placeholder="Kode Pos">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-0 fw-bold">Alamat</p>
                <input id="nama" type="text" class="form-control" name="alamat" value="{{ old('alamat', Auth::user()->alamat) }}" required autocomplete="name" autofocus placeholder="Alamat">
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

  <!-- modal: ubah password -->
  <div class="modal fade" id="modal-edit-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('profile.updatePassword') }}" method="POST">
          @method("put")
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 fw-bold">Password Lama</p>
            <input id="password-lama" type="password" class="form-control mb-3"  name="current_password" required autocomplete="name" autofocus placeholder="Password Lama">
            <p class="mb-0 fw-bold">Password Baru</p>
            <input id="password-baru" type="password" class="form-control mb-3" name="password" required autocomplete="name" autofocus placeholder="Password Baru">
            <p class="mb-0 fw-bold">Ulangi Password Baru</p>
            <input id="password-baru-ulang" type="password" class="form-control" name="password_confirmation" required autocomplete="name" autofocus placeholder="Password Baru">
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
