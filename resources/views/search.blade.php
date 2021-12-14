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
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-break text-dark text-decoration-underline">All Products</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-break text-secondary">Processor</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-break text-secondary">Graphics Card</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-break text-secondary">Storage</p></a>
          <a href="#" class="text-decoration-none"><p class="fw-bold ps-3 text-break text-secondary">Monitor</p></a>
        </div>
      </div>

      {{-- products --}}

      <div class="flex-fill ps-4 py-4">
        <div class="container">
          <div class="row">

            @foreach ($products as $product)
              <a href="/product/{{ $product->id }}" class="card border-secondary p-0 h-100 me-3 mb-3 text-decoration-none text-dark" style="width: 10rem; min-height: 20rem; max-height: 20rem;">
                <div class="card-img-top" style="width: 9.9rem; height: 10rem;">
                  <div class="card-img-top w-100 h-100 bg-image" style="background-image: url('{{ asset('images') }}/{{ $product->foto1 }}'); background-size: cover; background-position: center center;"></div>
                </div>
                <div class="card-body p-2 border-top border-secondary">
                  <h5 class="card-title m-0 fs-6 fw-normal">{{ $product->name }}</h5>
                  <div class="position-absolute bottom-0 pb-1">
                    <p class="card-text my-0 fs-6 fw-bolder">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <div class="d-flex align-items-center mb-1">
                      <i class="fas fa-star text-warning"></i>
                      <p class="card-text ms-1 fs-6 fw-normal text-secondary">4.9 | Terjual 500</p>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach

          </div>

          {{-- pagination --}}
          <div class="row mt-3">
            <div class="row border-end bg-light py-3" >
              {{ $products->onEachSide(1)->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
