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

      {{-- checkout list --}}
      <div class="col-lg-8 col-xl-9 py-4">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-bolder text-primary">Keranjang</h5>
          </div>
          <div class="card-body container-fluid pb-0">
            <div class="row form-check pb-2 mx-0 border-bottom">
              <div class="d-flex justify-content-between">
                <div>
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Pilih Semua
                  </label>
                </div>
                <a href="#" class="text-decoration-none"><p class="mb-0 fw-bold text-primary" data-bs-toggle="modal" data-bs-target="#modal-hapus-barang">Hapus Terpilih</p></a>
              </div>
            </div>

            {{-- checkout item --}}
            @for ($i = 0; $i < 5; $i++)
              <div class="row mx-0 border-bottom py-3">
                {{-- checkbox --}}
                <div class="col-auto">
                  <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                </div>
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                      <p class="px-0 fw-bolder text-break">Rp1.500.000</p>
                    </div>
                    {{-- delete item --}}
                    <div class="col-auto">
                      <a href="#" class="text-secondary"><i class="fas fa-trash" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#modal-hapus-barang"></i></a>
                    </div>
                  </div>
                  {{-- increment decrement --}}
                  <div class="row mx-0 justify-content-end">
                    <div class="col-2 px-0">
                      <div class="d-flex flex-row align-items-center px-0 input-group">
                        <span class="input-group-btn">
                          <button type="button" class="quantity-left-minus btn btn-primary btn-number p-0 px-1" data-type="minus" data-field="">
                            <i class="fas fa-minus text-white" aria-hidden="true"></i>
                          </button>
                        </span>
                        <input type="number" id="quantity" name="quantity" class="form-control input-number p-0 text-center" value="1" min="1" max="11">
                        <span class="input-group-btn">
                          <button type="button" class="quantity-right-plus btn btn-primary btn-number p-0 px-1" data-type="plus" data-field="">
                            <i class="fas fa-plus text-white" aria-hidden="true"></i>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endfor

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
              <p class="card-text text-primary fw-bold fs-4">Rp7.500.000</p>

              {{-- checkout --}}
              <button type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = 'checkout';" }}">Checkout (5)</button>
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

  <!-- modal: hapus barang -->
  <div class="modal fade" id="modal-hapus-barang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus 5 Barang?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="mb-0 text-center">Barang yang kamu pilih akan dihapus dari keranjang.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100">Hapus</button>
          <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

@endsection
