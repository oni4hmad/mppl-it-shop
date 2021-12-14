@extends('layouts.main')

@section('content')

  <!-- carousel promo -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <a href="#promo"><img src="img/promo/promo1.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
            <div class="carousel-item">
              <a href="#promo"><img src="img/promo/promo2.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
            <div class="carousel-item">
              <a href="#promo"><img src="img/promo/promo3.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- banner: jual produk / servis komputer -->
  <div class="container">
    <div class="row mt-1">
      <div class="position-relative col-8 p-2">
        <div class="position-absolute bottom-0 start-0 ps-3">
          <div class="container pb-3">
            <div class="row">
              <h2 class="text-white fw-bold">Cari Komponen</h2>
              <h2 class="text-white fw-bold">PC Impianmu</h2>
            </div>
          </div>
          <div class="container pb-5">
            <div class="row">
              <div class="col-12">
                <a class="btn btn-primary w-50 fw-bold btn-lg rounded-pill" href="search" role="button">Cari Produk</a>
              </div>
            </div>
          </div>
        </div>
        <img src="img/banner/home_bg-produk-elektronik.png" class="img-fluid rounded-3" alt="banner produk elektronik">
      </div>
      <div class="position-relative col-4 p-2">
        <div class="position-absolute bottom-0 start-0 ps-3">
          <div class="container pb-3">
            <div class="row">
              <h2 class="text-white fw-bold">Pesan Teknisi</h2>
              <h2 class="text-white fw-bold">Servis Terbaik</h2>
            </div>
          </div>
          <div class="container pb-5">
            <div class="row">
              <div class="col-12">
                <a class="btn btn-primary w-70 fw-bold btn-lg rounded-pill" href="/service-order" role="button">Pesan Jasa Servis</a>
              </div>
            </div>
          </div>
        </div>
        <img src="img/banner/home_bg-servis-komputer.png" class="img-fluid rounded-3" alt="banner produk elektronik">
      </div>
    </div>
  </div>

  <!-- category -->
  <!-- category: title -->
  <div class="container mt-3">
    <div class="d-flex flex-row">
      <h1 class="fw-bold text-primary">Category&nbsp;</h1>
      <div class="container">
        <div class="row">
          <div class="col-12 border-2 border-bottom" style="height: 30px;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- category: grid -->
  <div class="container mb-5">
    <div class="d-flex justify-content-between mt-2" style="height: 180px;">
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/proci.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Processor</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/gpu.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Graphics Card</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/ram.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Memory</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/storage.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Storage</h2>
          </a>
        </div>
      </div>
      <div class="w-100 position-relative bg-image rounded-3" style="background-image: url('img/category/monitor.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 pb-1 ms-3">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Monitor</h2>
          </a>
        </div>
      </div>
    </div>
  </div>

@endsection