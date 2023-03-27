@php use App\Enums\UserType; @endphp
@extends('layouts.main')

@section('content')

  <!-- sticky content fix -->
  <script src="/js/sticky-content-fix.js"></script>

  {{-- jquery: atur jumlah --}}
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="/js/atur-jumlah.js"></script>

  {{-- add to cart --}}
  <script>
    function addToCart() {
      let product_id = {{ $product->id }};
      let csrf_token = document.querySelector("meta[name='csrf-token']").content;
      let quantity = document.querySelector("#quantity").value;
      let btnAddToCart = document.querySelector("#btn-add-to-cart");
      btnAddToCart.disabled = true;

      const modal = new bootstrap.Modal('#modal-berhasil-masuk-keranjang');
      const showModal = (headerText, bodyText, btnText = "Lihat Keranjang", btnHref = "/cart") => {
        document.querySelector('#modal-berhasil-masuk-keranjang #staticBackdropLabel').textContent = headerText;
        document.querySelector('#modal-berhasil-masuk-keranjang .modal-body p').textContent = bodyText;
        document.querySelector('#modal-berhasil-masuk-keranjang .modal-footer a').textContent = btnText;
        document.querySelector('#modal-berhasil-masuk-keranjang .modal-footer a').href = btnHref;
        modal.show()
      };

      fetch("/cart", {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          "X-CSRF-TOKEN": csrf_token
        },
        body: JSON.stringify({
          "product_id": product_id,
          "kuantitas": quantity
        }),
        method: "POST"
      }).then(response => {
        if (!response.ok) {
          console.log(response);
          response.text().then(text => {
            console.log("failed", text);
            showModal(
              "Gagal Menambahkan",
              "Product gagal ditambahkan ke keranjang. Silahkan refresh halaman dan coba lagi.",
              "Refresh Halaman",
              location.href
            );
          });
          return;
        }
        response.json().then(json => {
          console.log("response", json);
          if (!json.error) {
            showModal("Berhasil Ditambahkan", json.message);
            btnAddToCart.disabled = false;
          } else {
            showModal(
              "Gagal Menambahkan",
              json.message,
              "Refresh Halaman",
              location.href
            );
          }
        })
      });
    }
  </script>

  <div class="container mb-4">
    <div class="row">

      {{-- product + ulasan --}}
      <div class="col-lg-8 col-xl-9">
        {{-- data produk --}}
        <div class="row pt-4">

          {{-- foto product --}}
          <div class="col-5 ps-0 pe-4">

            {{-- foto product: besar --}}
            <div class="d-block">
              <div style="width: 100%; height: 20rem;">
                <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_1->path ?? "img/default.png" }}'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>

            {{-- foto product: kecil x3 --}}
            <div class="d-flex flex-row justify-content-between m-0 p-0 mt-2">
              <div class="p-0 me-1">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_2->path ?? "img/default.png" }}'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
              <div class="p-0 me-1">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_3->path ?? "img/default.png" }}'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
              <div class="p-0">
                <div style="width: 6.5rem; height: 6.5rem;">
                  <div class="w-100 h-100 bg-image rounded-3 border border-body" style="background-image: url('/{{ $product->photo_4->path ?? "img/default.png" }}'); background-size: cover; background-position: center center;"></div>
                </div>
              </div>
            </div>

          </div>

          {{-- detail product --}}
          <div class="col-7">
            <div class="row">
              <h5 class="fw-bold text-break">{{ $product->nama }}</h5>
              <div class="d-flex align-items-center text-dark">
                <p class="m-0 me-1">Terjual {{ $product->terjual }}</p>
                <p class="m-0 mx-1">•</p>
                <i class="fas fa-star text-warning me-1"></i>
                <p class="m-0">{{ number_format($product->rating, 1) }} ({{ $product->jumlah_ulasan }} ulasan)</p>
              </div>
            </div>
            <div class="row mt-2">
              <h3 class="fw-bolder">Rp{{ number_format($product->harga, 0, ',', '.') }}</h3>
            </div>
            <div class="row my-2 border-top border-bottom">
              <p class="py-1 my-0 fw-bold text-primary">Detail</p>
            </div>
            <div class="row">
              <div class="col-8">
                <p class="text-break">{!! nl2br(stripcslashes($product->deskripsi)) !!}</p>
              </div>
              <div class="col-4">
                <p class="m-0"><b>Berat:</b></p>
                <p class="m-0">{{ $product->berat }} Gram</p>
                <br>
                <p class="m-0"><b>Kategori:</b></p>
                <p class="m-0">{{ $product->category->nama }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- title: ulasan --}}
        <div class="row pt-4 pb-2">
          <h5 class="pb-1 w-100 fw-bolder text-primary border-bottom">Ulasan</h5>
        </div>

        {{-- ulasan pengguna --}}
        @if(!$product->product_ratings()->exists())
          <div class="row pb-3 mb-3">
            <div class="col text-center">
              <h5 class="text-secondary">Belum ada ulasan.</h5>
            </div>
          </div>
        @endif

        @foreach($product->product_ratings as $productRating)
          <div class="row pb-3 mb-3 border-bottom">
            <div class="col" style="max-width: 250px;">
              <div class="row">
                <div class="col" style="max-width: 80px;">
                  <div style="width: 60px; height: 60px;">
                    <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('/{{ $productRating->productStackOrder->photo->path ?? 'assets/user-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
                  </div>
                </div>
                <div class="col">
                  <p class="m-0 p-0 fw-bold text-break">{{ $productRating->user->nama }}</p>
                  <p class="m-0 p-0 text-secondary text-break">5 jam yang lalu</p>
                </div>
              </div>
            </div>

            {{-- isi ulasan --}}
            <div class="col m-0 p-0">

              {{-- bintang --}}
              <div class="row">
                <div class="col mb-2">
                  @for ($i = 0; $i < $productRating->nilai_rating; $i++)
                    <i class="fas fa-star text-warning me-1"></i> {{-- kuning --}}
                  @endfor
                  @for ($i = 5; $i > $productRating->nilai_rating; $i--)
                    <i class="fas fa-star text-secondary me-1"></i> {{-- abu-abu --}}
                  @endfor
                </div>

                {{-- option dropdown: ulasan --}}
                @php
                  $isThisUserAuthor = auth()->check() ? $productRating->user->id == auth()->user()->id : false;
                  $isThisUserAdmin = auth()->check() ? auth()->user()->user_type == UserType::ADMINISTRATOR : false;
                @endphp

                @if($isThisUserAuthor || $isThisUserAdmin)
                  <div class="col text-end">
                    <div class="btn-group">
                      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split text-white py-0" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-lg-end">
                        @if($isThisUserAdmin)
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-balas-ulasan{{ $productRating->id }}">Balas</a></li>
                        @endif
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-ulasan{{ $productRating->id }}">Ubah</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-hapus-ulasan{{ $productRating->id }}">Hapus</a></li>
                      </ul>
                    </div>
                  </div>
                @endif
              </div>

              {{-- teks ulasan --}}
              <div class="row ms-1 pe-2">
                <p class="p-0 pe-3 m-0 text-break">{!! nl2br(stripcslashes($productRating->deskripsi_rating)) !!}</p>

                {{-- reply admin --}}
                @foreach($productRating->rating_comments as $ratingComment)
                  <div class="row m-0 mt-3 py-2 rounded-3 bg-light">
                    <div class="col" style="max-width: 80px;">
                      <div style="width: 60px; height: 60px;">
                        <div class="w-100 h-100 bg-image rounded-circle border border-2 border-primary" style="background-image: url('/{{ $ratingComment->user->profile_picture->path ?? 'assets/admin-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <div class="col">
                          <p class="mb-0 fw-bold text-break">{{ $ratingComment->user->nama }}</p>
                          <p class="mb-0 text-secondary text-break">5 jam yang lalu</p>
                        </div>

                        @if($isThisUserAdmin)
                        <div class="col-auto">
                          {{-- option dropdown: komentar --}}
                          <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split text-white py-0" data-bs-toggle="dropdown" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-edit-comment{{ $ratingComment->id }}">Ubah</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-comment{{ $ratingComment->id }}">Hapus</a></li>
                            </ul>
                          </div>
                        </div>
                        @endif
                      </div>

                      <div class="row mt-2">
                        <p class="my-0 text-break">{!! nl2br(stripcslashes($ratingComment->komentar)) !!}</p>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- atur jumlah --}}
      <div class="col-lg-4 col-xl-3 py-4">
        <div class="sticky-top" id="sticky-fix">
          <div class="card">
            <div class="card-header">
              <h5 class="fw-bolder">Atur Jumlah</h5>
            </div>
            <div class="card-body">
              <form action="/checkout/{{ $product->id }}" method="post">
                @csrf

                {{-- numeric up down --}}
                <div class="d-flex flex-row align-items-center input-group mb-3">
                  <span class="input-group-btn">
                    <button type="button" class="quantity-left-minus btn btn-primary btn-number" data-type="minus" data-field="">
                      <i class="fas fa-minus text-white"></i>
                    </button>
                  </span>
                  <input type="number" id="quantity" name="kuantitas" class="form-control input-number" value="1" min="1" max="{{ $product->stok }}">
                  <span class="input-group-btn">
                    <button type="button" class="quantity-right-plus btn btn-primary btn-number" data-type="plus" data-field="">
                      <i class="fas fa-plus text-white"></i>
                    </button>
                  </span>
                  <p class="card-text ms-3">Stok <b>{{ $product->stok }}</b></p>
                </div>

                {{-- masukkan keranjang / checkout --}}
                @if(auth()->check())
                  <button id="btn-add-to-cart" type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="addToCart()">Masukkan Keranjang</button>
                @else
                  <a href="/login" id="btn-add-to-cart" class="btn btn-primary w-100 mb-2 fw-bold">Masukkan Keranjang</a>
                @endif
                <button type="submit" class="btn btn-outline-primary w-100 fw-bold">Checkout</button>

              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  <!-- data-bs-toggle="modal" data-bs-target="#modal-editxxx" -->

  <!-- modal: berhasil ditambahkan ke keranjang -->
  <div class="modal fade" id="modal-berhasil-masuk-keranjang" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Berhasil Ditambahkan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col">
              <p class="mb-0 text-center" id="">Item berhasil ditambahkan ke keranjang.</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="/cart" class="btn btn-primary btn-sm p-2 fw-bold w-100">Lihat Keranjang</a>
        </div>
      </div>
    </div>
  </div>

  @foreach($product->product_ratings as $productRating)

    @php
      $isThisUserAuthor = auth()->check() ? $productRating->user->id == auth()->user()->id : false;
      $isThisUserAdmin = auth()->check() ? auth()->user()->user_type == UserType::ADMINISTRATOR : false;
    @endphp

    @if($isThisUserAuthor || $isThisUserAdmin)
      <!-- modal: edit ulasan -->
      <div class="modal fade" id="modal-edit-ulasan{{ $productRating->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Ulasan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/product-rating/{{ $productRating->id }}" method="post">
              @method('put')
              @csrf
              <div class="modal-body">
                {{-- produknya --}}
                <div class="row mx-0 py-3">
                  {{-- image --}}
                  <div class="col-auto px-0 rounded-3">
                    <div class="p-0 me-1">
                      <div style="width: 6.5rem; height: 6.5rem;">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('/{{ $productRating->productStackOrder->photo->path ?? 'img/default.png' }}'); background-size: cover; background-position: center center;"></div>
                      </div>
                    </div>
                  </div>
                  {{-- product name --}}
                  <div class="col d-flex flex-column justify-content-between">
                    <div class="row justify-content-between">
                      <div class="col-auto">
                        <p class="mb-0 fw-bolder text-break">{{ $productRating->productStackOrder->nama }}</p>
                        <p class="mb-0 px-0 text-break">{{ $productRating->productStackOrder->kuantitas }} barang x Rp{{ number_format($productRating->productStackOrder->harga, 0, ',', '.') }}</p>
                        <p class="mb-0 text-secondary text-break">{{ date_format($productRating->productStackOrder->created_at,"l, d M Y") }}</p>
                        <div class="d-flex flex-row align-items-center">
                          <p class="mb-0 me-2 text-primary fw-bold">Rating (1-5):</p>
                          <input type="number" name="nilai_rating" id="" min="1" max="5" value="{{ $productRating->nilai_rating }}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <textarea type="text" class="form-control" name="deskripsi_rating" rows="3" required autofocus placeholder="Tambahkan review">{{ $productRating->deskripsi_rating }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal: hapus ulasan -->
      <div class="modal fade" id="modal-hapus-ulasan{{ $productRating->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Ulasan?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 text-center">Konfirmasi penghapusan ulasan.</p>
          </div>
          <form action="/product-rating/{{ $productRating->id }}" method="post">
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

      @if($isThisUserAdmin)
      <!-- modal: balas ulasan -->
      <div class="modal fade" id="modal-balas-ulasan{{ $productRating->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Balas Ulasan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/rating-comment/{{ $productRating->id }}" method="post">
              @csrf
              <div class="modal-body">
                {{-- ulasan pengguna --}}
                <div class="row pb-3 mb-3 border-bottom">
                  {{-- profile --}}
                  <div class="col" style="max-width: 250px;">
                    <div class="row">
                      <div class="col" style="max-width: 80px;">
                        <div style="width: 60px; height: 60px;">
                          <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('/{{ $productRating->user->profile_picture->path ?? 'assets/user-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
                        </div>
                      </div>
                      <div class="col">
                        <p class="m-0 p-0 fw-bold text-break">{{ $productRating->user->nama }}</p>
                        <p class="m-0 p-0 text-secondary text-break">5 jam yang lalu</p>
                      </div>
                    </div>
                  </div>
                  {{-- isi ulasan --}}
                  <div class="col m-0 p-0">
                    {{-- bintang --}}
                    <div class="row">
                      <div class="col mb-2">
                        @for ($i = 0; $i < $productRating->nilai_rating; $i++)
                          <i class="fas fa-star text-warning me-1"></i> {{-- kuning --}}
                        @endfor
                        @for ($i = 5; $i > $productRating->nilai_rating; $i--)
                          <i class="fas fa-star text-secondary me-1"></i> {{-- abu-abu --}}
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>

                {{-- teks ulasan --}}
                <div class="row border-bottom px-3 pb-3 mb-3">
                  <p class="p-0 m-0 text-break">{{ $productRating->deskripsi_rating }}</p>
                </div>
                <p class="p-0 m-0 fw-bold text-break">Balasan:</p>
                <textarea type="text" class="form-control" name="komentar" rows="3" required autocomplete="name" autofocus placeholder="Balasan"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
    @endif

    @if($isThisUserAdmin)
      @foreach($productRating->rating_comments as $ratingComment)
      <!-- modal: edit comment -->
      <div class="modal fade" id="modal-edit-comment{{ $ratingComment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Komentar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/rating-comment/{{ $ratingComment->id }}" method="post">
              @method('put')
              @csrf
              <div class="modal-body">
                <textarea type="text" class="form-control" name="komentar" rows="3" required autofocus placeholder="Tambahkan komentar">{{ $ratingComment->komentar }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-3 text-white fw-bold" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal: delete comment -->
      <div class="modal fade" id="modal-delete-comment{{ $ratingComment->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus Komentar?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="mb-0 text-center">Konfirmasi penghapusan komentar.</p>
            </div>
            <form action="/rating-comment/{{ $ratingComment->id }}" method="post">
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
      @endforeach
    @endif

  @endforeach

@endsection
