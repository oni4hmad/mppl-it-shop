@extends('layouts.main')

@section('content')

  {{--sticky content fix--}}
  <script src="/js/sticky-content-fix.js"></script>
  {{--autonumeric: currency formatting--}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.2/autoNumeric.min.js" integrity="sha512-x1gR+AwmBYNFnEk4ixRnurDnPeGmhkUVGZtuF5LYRvXk2z3uIbIhpQswbl2X0qTIB1/kx+PNzTwqD+ZOuYtHbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    window.onload = () => {
      const autoNumericOptionsEuro = {
        digitGroupSeparator        : '.',
        decimalCharacter           : ',',
        decimalPlaces              : '0',
        minimumValue               : '0',
        currencySymbol             : 'Rp ',
        emptyInputBehavior         : 'zero',
        currencySymbolPlacement    : AutoNumeric.options.currencySymbolPlacement.prefix,
        unformatOnSubmit           : true
      };
      document.querySelectorAll('input[name="harga"]').forEach(e => {
        new AutoNumeric(e, autoNumericOptionsEuro);
      });
    };
  </script>

  {{-- error/errors/success toast --}}
  @include('partials.toast-error-success')

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      @include('partials.admin-sidebar')

      <div class="col border-end">
        {{-- header menu --}}
        <div class="row bg-light" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Kurir</h5>
          <form action="/manage-product">
            <div class="d-flex flex-row align-items-center mb-3">
              <div class="input-group input-group-sm rounded" style="width: 250px;">
                <button type="button" class="btn btn-white bg-white border-end-0 border border-secondary rounded-end rounded-pill px-3" disabled>
                  <i class="fas fa-search text-secondary"></i>
                </button>
                <input type="search" name="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari kurir" aria-label="Search" aria-describedby="search-addon" value="" />
              </div>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-courier">+ Kurir</button>
              <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#modal-tambah-tipe-pengiriman">+ Tipe Pengiriman</button>
            </div>
          </form>
          <div class="container-fluid border-top border-bottom bg-white">
            <div class="row">
              <div class="col-4">
                <p class="mb-0 py-2 fw-bold">Kurir</p>
              </div>
              <div class="col-8">
                <div class="row">
                  <div class="col-4">
                    <p class="mb-0 py-2 fw-bold">Tipe Pengiriman</p>
                  </div>
                  <div class="col-4">
                    <p class="mb-0 py-2 fw-bold">Harga</p>
                  </div>
                  <div class="col-4">
                    <p class="mb-0 py-2 fw-bold">Action</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- table --}}

        {{-- table row --}}
        @foreach($couriers as $courier)
          <div class="row border-bottom bg-white">

            {{-- payment name --}}
            <div class="col-4 d-flex flex-row  py-3">
              <p class="mb-0 me-4 fw-bolder text-break">{{ $courier->nama }}</p>
              {{-- action: edit / delete --}}
              <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#modal-edit-kurir{{ $courier->id }}">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-courier{{ $courier->id }}">
                <i class="fas fa-trash"></i>
              </a>
            </div>

            <div class="col-8">
              @foreach($courier->courier_types as $courierType)
                @php($isLastCourierType = $loop->index == count($courier->courier_types)-1)
                <div class="row {{ $isLastCourierType ? "" : "border-bottom" }}">
                  {{-- tipe pengiriman --}}
                  <div class="col-4 py-3">
                    <p class="mb-0 fw-bold" style="z-index: 1;">{{ $courierType->nama }}</p>
                  </div>
                  {{-- harga --}}
                  <div class="col-4 py-3">
                    <p class="mb-0 fw-bold" style="z-index: 1;">Rp{{ number_format($courierType->harga, 0, ',', '.') }}</p>
                  </div>
                  {{-- action: edit / delete --}}
                  <div class="col-4 py-3">
                    <div class="--sticky-table-item" style="z-index: 1;">
                      <div class="row">
                        <div class="col-auto">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-courier-type{{ $courierType->id }}"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="col-auto">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-courier-type{{ $courierType->id }}"><i class="fas fa-trash"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
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
  {{-- data-bs-toggle="modal" data-bs-target="#modal-" --}}


  @foreach($couriers as $courier)

    <!-- modal: delete kurir -->
    <div class="modal fade" id="modal-delete-courier{{ $courier->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Kurir?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 text-center">Konfirmasi penghapusan kurir.</p>
          </div>
          <form action="/manage-courier/{{ $courier->id }}" method="post">
            @method('delete')
            @csrf
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Hapus</button>
              <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal: edit kurir -->
    <div class="modal fade" id="modal-edit-kurir{{ $courier->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Kurir</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/manage-courier/{{ $courier->id }}" method="post">
            @method('put')
            @csrf
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col">
                  <p class="mb-0 fw-bold">Nama Kurir</p>
                  <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Kurir" value="{{ $courier->nama }}" required>
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

    @foreach($courier->courier_types as $courierType)

      <!-- modal: delete tipe pengiriman -->
      <div class="modal fade" id="modal-delete-courier-type{{ $courierType->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Tipe Pengiriman?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mb-0 text-center">Konfirmasi penghapusan tipe pengiriman.</p>
            </div>
            <form action="/manage-courier/type/{{ $courierType->id }}" method="post">
              @method('delete')
              @csrf
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm p-1 fw-bold w-100">Hapus</button>
                <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal: edit tipe pengiriman -->
      <div class="modal fade" id="modal-edit-courier-type{{ $courierType->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Tipe Pengiriman</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/manage-courier/type/{{ $courierType->id }}" method="post">
              @method('put')
              @csrf
              <div class="modal-body">
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Nama Tipe Pengiriman</p>
                    <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Tipe Pengiriman" value="{{ $courierType->nama }}" required>
                  </div>
                  <div class="col">
                    <p class="mb-0 fw-bold">Kurir</p>
                    <select class="form-select" name="courier_id" disabled>
                      <option value="{{ $courierType->courier->id }}">{{ $courierType->courier->nama }}</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <p class="mb-0 fw-bold">Harga</p>
                    <input id="harga" name="harga" type="text" class="form-control" autocomplete="name" autofocus placeholder="Harga" value="{{ $courierType->harga }}" required>
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

    @endforeach

  @endforeach

  <!-- modal: tambah kurir -->
  <div class="modal fade" id="modal-tambah-courier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Kurir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/manage-courier" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Kurir</p>
                <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Kurir" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal: tambah tipe pengiriman -->
  <div class="modal fade" id="modal-tambah-tipe-pengiriman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Tipe Pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/manage-courier/type" method="post">
          @csrf
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Nama Tipe Pengiriman</p>
                <input id="nama" name="nama" type="text" class="form-control" autocomplete="name" autofocus placeholder="Nama Tipe Pengiriman" required>
              </div>
              <div class="col">
                <p class="mb-0 fw-bold">Pilih Kurir</p>
                <select class="form-select" name="courier_id" required>
                  @foreach($couriers as $courier)
                  <option value="{{ $courier->id }}">{{ $courier->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <p class="mb-0 fw-bold">Harga</p>
                <input id="harga" name="harga" type="text" class="form-control" autocomplete="name" autofocus placeholder="Harga" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
