{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Kelola Produk</title>
</head>
<body>
    <section style="padding-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Kelola Produk
                            <a href="/add-product" class="btn btn-success">Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            @if (Session::has('product_deleted'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('product_deleted') }}
                                </div>
                            @endif
                            @if (Session::has('product_added'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('product_added') }}
                                </div>
                            @endif
                            @if (Session::has('product_updated'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('product_updated') }}
                                </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><img src="{{ asset('images') }}/{{ $product->foto1 }}" style="max-width:60px"></td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->harga }}</td>
                                            <td>{{ $product->kategori }}</td>
                                            <td>{{ $product->deskripsi }}</td>
                                            <td>
                                                <a href="/edit-product/{{ $product->id }}" class="btn btn-info">Edit</a>
                                                <a href="/delete-product/{{ $product->id }}" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html> --}}

@extends('layouts.main')

@section('content')

  {{-- css --}}
  <style>
    #side-nav:hover {
      background-color: #F2F2F2;
    }
  </style>

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>
  <script src="js/sticky-header-menu-fix.js"></script>
  <script src="js/sticky-table-item-fix.js"></script>

  <div class="container">
    <div class="row">

      {{-- sidebar --}}
      <div class="col-auto ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          {{-- sidebar: profile --}}
          <div class="row border-bottom pb-4 mb-4">
            <div class="col px-0 pe-1" style="max-width: 50px; max-height: 50px;">
              <div style="width: 50px; height: 50px;">
                <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('{{ asset('profile_pic') }}/{{ Auth::user()->profile_pic }}'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>
            <div class="col">
              <p class="m-0 p-0 fw-bold text-break">{{ Auth::user()->name }}</p>
              <p class="m-0 p-0 text-primary text-break">Admin</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-home me-2"></i>Home</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-decoration-underline">
            <i class="fas fa-microchip me-2"></i>Produk</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-user-cog me-2"></i>Teknisi</p>
          </a>
          <p class="my-3 p-2 py-3 border-top border-bottom fw-bold text-break text-secondary">Orderan</p>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-server me-2"></i>Produk Elektronik</p>
          </a>
          <a href="#" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break text-secondary">
            <i class="fas fa-cog me-2"></i>Jasa Servis</p>
          </a>
        </div>
      </div>

      <div class="col">
        {{-- header menu --}}
        <div class="row bg-light border-bottom border-end sticky-top" id="sticky-header-menu">
          <h5 class="fw-bold text-primary pt-4 pb-2">Kelola Produk</h5>
          <div class="d-flex flex-row align-items-center mb-3">
            <p class="text-secondary fw-bold me-3 mb-0">Kategori</p>
            <div class="input-group input-group-sm px-0 me-5" style="width: 150px;">
              <select class="form-select" id="inputGroupSelect01">
                <option value="0" selected>All Products</option>
                <option value="1">Processor</option>
                <option value="2">Graphics Card</option>
                <option value="3">Memory</option>
                <option value="4">Storage</option>
                <option value="5">Monitor</option>
              </select>
            </div>
            <div class="input-group input-group-sm rounded" style="width: 250px;">
              <button type="button" class="btn btn-white bg-white border-end-0 border rounded-end rounded-pill px-3">
                <i class="fas fa-search text-secondary"></i>
              </button>
              <input type="search" class="form-control rounded-start rounded-pill border-start-0" placeholder="Cari produk" aria-label="Search" aria-describedby="search-addon" />
            </div>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold">+ Kategori</button>
            <button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill fw-bold">+ Produk</button>
          </div>
          <div class="container-fluid border-top bg-white">
            <div class="row">
              <div class="col-6">
                <p class="mb-0 py-2 fw-bold">Produk</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Harga</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Kategori</p>
              </div>
              <div class="col-2">
                <p class="mb-0 py-2 fw-bold">Action</p>
              </div>
            </div>
          </div>
        </div>

        {{-- table --}}
        @for ($j = 0; $j < 3; $j++)
          {{-- table row --}}
          <div class="row border-bottom border-end bg-white">
            <div class="col-6">

              {{-- product item --}}
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
                <div class="--sticky-table-item col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 fw-bolder text-break">VGA MSI GT1030 AERO ITX 2G OC | GT 1030</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            {{-- harga --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Rp3.050.000</p>
            </div>
            {{-- kategori --}}
            <div class="col-2 py-3">
              <p class="--sticky-table-item mb-0 fw-bold" style="z-index: 1;">Graphics Card</p>
            </div>
            {{-- action: edit / delete --}}
            <div class="col-2 py-3">
              <div class="--sticky-table-item" style="z-index: 1;">
                <div class="row">
                  <div class="col-auto">
                    <a href="#"><i class="fas fa-edit"></i></a>
                  </div>
                  <div class="col-auto">
                    <a href="#"><i class="fas fa-trash"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endfor

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

@endsection