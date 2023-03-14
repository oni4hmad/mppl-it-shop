@extends('layouts.main')

@section('content')

  <style>
    .text-truncate-container h5 {
      -webkit-line-clamp: 4;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  <div class="container">
    <div class="d-flex flex-row">

      {{-- sidebar --}}

      <div class="ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          <h5 class="text-primary fw-bold mb-3">Categories</h5>
          <a href="/search?{{ isset(request()->search) ? "search=".request()->search : "" }}" class="text-decoration-none"><p class="fw-bold ps-3 text-break {{ isset(request()->category) ? "text-secondary" : "text-dark text-decoration-underline" }}">All Products</p></a>
          @foreach ($categories as $category)
            <a href="/search?category={{ $category->slug }}{{ isset(request()->search) ? "&search=".request()->search : "" }}" class="text-decoration-none"><p class="fw-bold ps-3 text-break {{ $category->slug == request()->category ? "text-dark text-decoration-underline" : "text-secondary" }}">{{ $category->nama}}</p></a>
          @endforeach
        </div>
      </div>

      {{-- products --}}

      <div class="flex-fill ps-4 py-4">

        {{-- no result to show --}}
        @if(!count($products))
          <div class="container-fluid py-4 text-center bg-white">
            <p class="text-secondary"><strong>No result found</strong></p>
          </div>
        @endif

        <div class="container">
          <div class="row">

            @foreach($products as $product)
              <a href="/product/{{ $product->slug }}" class="card border-secondary p-0 h-100 me-3 mb-3 text-decoration-none text-dark" style="width: 10rem; min-height: 20rem; max-height: 20rem;">
                <div class="card-img-top" style="width: 9.9rem; height: 10rem;">
                  <div class="card-img-top w-100 h-100 bg-image" style="background-image: url('/{{ $product->photo_1->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                </div>
                <div class="card-body p-2 border-top border-secondary">
                  <div class="text-truncate-container">
                    <h5 class="card-title m-0 fs-6 fw-normal">{{ $product->nama }}</h5>
                  </div>
                  <div class="position-absolute bottom-0 pb-1">
                    <p class="card-text my-0 fs-6 fw-bolder">Rp.{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <div class="d-flex align-items-center mb-1">
                      <i class="fas fa-star text-warning"></i>
                      <p class="card-text ms-1 fs-6 fw-normal text-secondary">{{ number_format($product->rating, 1) }} | Terjual
                        {{ $product->terjual }}</p>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach

          </div>

          {{-- pagination --}}
          @if($products->hasPages())
            <div class="row pt-3">
              <div class="d-flex justify-content-center">
                {{ $products->onEachSide(2)->links() }}
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection
