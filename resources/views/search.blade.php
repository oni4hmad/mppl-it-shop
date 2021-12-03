@extends('layouts.main')

@section('content')

  <!-- sticky content fix -->
  <script src="js/sticky-content-fix.js"></script>

  <div class="container">
    <div class="d-flex flex-row">

      {{-- sidebar --}}

      <div class="ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          <h5 class="text-primary fw-bold mb-3">Categories</h5>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-dark text-decoration-underline">All Products</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-secondary">Processor</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-secondary">Graphics Card</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-secondary">Storage</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-secondary">Monitor</p></a>
        </div>
      </div>

      {{-- products --}}

      <div class="flex-fill ps-4 py-4">
        <div class="container">
          <div class="row">

            @for ($i = 0; $i < 20; $i++)
              <a href="product" class="card border-secondary p-0 h-100 me-3 mb-3 text-decoration-none text-dark" style="width: 10rem; min-height: 20rem; max-height: 20rem;">
                <div class="card-img-top" style="width: 9.9rem; height: 10rem;">
                  <div class="card-img-top w-100 h-100 bg-image" style="background-image: url('https://picsum.photos/150/510'); background-size: cover; background-position: center center;"></div>
                </div>
                <div class="card-body p-2 border-top border-secondary">
                  <h5 class="card-title m-0 fs-6 fw-normal">VGA MSI GT1030 AERO ITX 2G OC | GT 1030 2GB1030 2GB</h5>
                  <div class="position-absolute bottom-0 pb-1">
                    <p class="card-text my-0 fs-6 fw-bolder">Rp.1.500.000</p>
                    <div class="d-flex align-items-center mb-1">
                      <i class="fas fa-star text-warning"></i>
                      <p class="card-text ms-1 fs-6 fw-normal text-secondary">4.9 | Terjual 500</p>
                    </div>
                  </div>
                </div>
              </a>
            @endfor

          </div>

          {{-- pagination --}}

          <div class="row mt-3">
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
  </div>

@endsection
