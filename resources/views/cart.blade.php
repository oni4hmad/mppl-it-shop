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
  <script src="/js/sticky-content-fix.js"></script>

  {{-- jquery: atur jumlah --}}
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="/js/atur-jumlah.js"></script>

  {{-- checkbox and quantity changed handler --}}
  <script>
    let productStackCarts = {!! $productStackCartsJson !!};
    let ringkasanBelanja = {};
    const hideCheckoutBtn = (hide) => {
      if (hide) document.querySelector('#btn-subtotal-barang').classList.add('d-none');
      else document.querySelector('#btn-subtotal-barang').classList.remove('d-none');
    }
    const disableCheckoutBtn = (disable) => {
      document.querySelector('#btn-subtotal-barang').disabled = disable;
    }
    const updateRingkasanBelanja = () => {
      ringkasanBelanja = {
        count: productStackCarts.filter(e => e.checked).map(i => i.kuantitas).reduce((a, b) => a + b, 0),
        subtotal: productStackCarts.filter(e => e.checked).map(i => i.product.harga * i.kuantitas).reduce((a, b) => a + b, 0),
      }
      document.querySelector('#text-subtotal-barang').innerText = `Subtotal (${ringkasanBelanja.count} barang)`;
      document.querySelector('#text-subtotal-harga').innerText = `Rp${ringkasanBelanja.subtotal.toLocaleString('id-ID')}`;
      document.querySelector('#btn-subtotal-barang').innerText = `Checkout (${ringkasanBelanja.count})`;
      hideCheckoutBtn(ringkasanBelanja.count <= 0);
      console.log(ringkasanBelanja);
    }
    console.log("productStackCarts", productStackCarts);

    // calculate ringkasan belanja
    document.addEventListener("DOMContentLoaded", function () {
      updateRingkasanBelanja();
    });

    function onCheckedChanged(productStackCartId, element) {
      let csrf_token = document.querySelector("meta[name='csrf-token']").content;
      const updateCheckedProductStackCart = (checked) => {
        productStackCarts.find(e => e.id === productStackCartId).checked = checked ? 1 : 0;
      };
      element.disabled = true;
      disableCheckoutBtn(true);

      fetch(`/cart/${productStackCartId}`, {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          "X-CSRF-TOKEN": csrf_token
        },
        body: JSON.stringify({
          "checked": element.checked,
        }),
        method: "PUT"
      }).then(response => {
        if (!response.ok) {
          element.checked = !element.checked;
          element.disabled = false;
          console.log(response);
          response.text().then(text => {
            console.log("failed", text);
          });
          return;
        }
        element.disabled = false;
        response.text().then(json => {
          console.log("response", json);
          if (!json.error) {
            updateCheckedProductStackCart(element.checked);
            updateRingkasanBelanja();
            disableCheckoutBtn(false);
            console.log("success 200");
          } else {
            console.log("error 200");
          }
        })
      });
    }

    function onDeleteItem(productStackCartId) {
      let csrf_token = document.querySelector("meta[name='csrf-token']").content;
      const hideModal = () => {
        document.querySelector(`#modal-hapus-barang${productStackCartId} [data-bs-dismiss="modal"]`).click()
      };
      const showLoading = (show) => {
        if (show) document.querySelector(`#loading-screen`).classList.remove('d-none');
        else document.querySelector(`#loading-screen`).classList.add('d-none');
      };
      const deleteProductStackCartItem = () => {
        document.querySelector(`#product-stack-cart-${productStackCartId}`).remove();
      }
      const cartItemCount = () => {
        return document.querySelectorAll(`[id^='product-stack-cart']`).length;
      }
      const showNoItemInCart = (show) => {
        if (show) {
          document.querySelector(`#cart-item-input`).classList.add('d-none');
          document.querySelector(`#no-item-text`).classList.remove('d-none');
        } else {
          document.querySelector(`#cart-item-input`).classList.remove('d-none');
          document.querySelector(`#no-item-text`).classList.add('d-none');
        }
      }
      const removeProductStackJson = (id) => {
        productStackCarts = productStackCarts.filter(e => e.id !== id);
      }
      showLoading(true);

      fetch(`/cart/${productStackCartId}`, {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          "X-CSRF-TOKEN": csrf_token
        },
        method: "DELETE"
      }).then(response => {
        hideModal();
        showLoading(false);

        if (!response.ok) {
          console.log(response);
          response.text().then(text => {
            console.log("failed", text);
          });
          return;
        }
        response.text().then(json => {
          console.log("response", json);
          if (!json.error) {
            removeProductStackJson(productStackCartId);
            deleteProductStackCartItem();
            updateRingkasanBelanja();
            if (cartItemCount() <= 0) {
              showNoItemInCart(true);
            }
            console.log("success 200");
          } else {
            console.log("error 200");
          }
        })
      });
    }

    function onChangeQty(productStackCartId, inputElement) {
      console.log(productStackCartId, inputElement, inputElement.value);

      let csrf_token = document.querySelector("meta[name='csrf-token']").content;
      const showControl = (show) => {
        let element = document.querySelector(`#product-stack-cart-qty-control-${productStackCartId}`);
        if (show) element.classList.remove('d-none');
        else element.classList.add('d-none');
      };
      const updateCheckedProductStackCartQty = () => {
        productStackCarts.find(e => e.id === productStackCartId).kuantitas = parseInt(inputElement.value);
      };
      disableCheckoutBtn(true);
      showControl(false);

      fetch(`/cart/${productStackCartId}`, {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          "X-CSRF-TOKEN": csrf_token
        },
        body: JSON.stringify({
          "kuantitas": inputElement.value,
        }),
        method: "PUT"
      }).then(response => {
        if (!response.ok) {
          console.log(response);
          response.text().then(text => {
            console.log("failed", text);
          });
          return;
        }
        response.text().then(json => {
          console.log("response", json);
          if (!json.error) {
            updateCheckedProductStackCartQty();
            updateRingkasanBelanja();
            disableCheckoutBtn(false);
            showControl(true);
          }
        })
      });

    }
  </script>

  <div class="container mb-4">
    <div class="row">

      {{-- checkout list --}}
      <div class="col-lg-8 col-xl-9 py-4">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-bolder text-primary">Keranjang</h5>
          </div>
          <div class="card-body container-fluid pb-0">

            @if (count($productStackCarts) > 0)
              <div id="cart-item-input" class="row form-check pb-2 mx-0 border-bottom d-none">
                <div class="d-flex justify-content-between">
                  <div>
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Pilih Semua
                    </label>
                  </div>
                  <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal-hapus-terpilih"><p class="mb-0 fw-bold text-primary">Hapus Terpilih</p></a>
                </div>
              </div>
            @endif

            {{-- checkout item --}}
            @foreach($productStackCarts as $productStackCart)
              <div id="product-stack-cart-{{ $productStackCart->id }}" class="row mx-0 border-bottom py-3">
                {{-- checkbox --}}
                <div class="col-auto">
                  <input name="id" value="{{ $productStackCart->id }}" class="form-check-input mt-0 cart-checkbox" type="checkbox" value="" id="flexCheckDefault" {{ $productStackCart->checked ? "checked" : "" }} onchange="onCheckedChanged({{ $productStackCart->id }}, this)">
                </div>
                {{-- image --}}
                <div class="col-auto px-0 rounded-3">
                  <div class="p-0 me-1">
                    <div style="width: 6.5rem; height: 6.5rem;">
                      <a href="/product/{{ $productStackCart->product->slug }}">
                        <div class="w-100 h-100 rounded-3 border border-secondary" style="background-image: url('/{{ $productStackCart->product->photo_1 ?? "img/default.png" }}'); background-size: cover; background-position: center center;"></div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column justify-content-between">
                  <div class="row justify-content-between">
                    <div class="col-auto">
                      <p class="mb-0 text-break">{{ $productStackCart->product->nama }}</p>
                      <p class="px-0 fw-bolder text-break">Rp{{ number_format($productStackCart->product->harga, 0, ',', '.') }}</p>
                    </div>
                    {{-- delete item --}}
                    <div class="col-auto">
                      <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#modal-hapus-barang{{ $productStackCart->id }}"><i class="fas fa-trash" aria-hidden="true"></i></a>
                    </div>
                  </div>
                  {{-- increment decrement --}}
                  <div class="row mx-0 justify-content-end">
                    <div class="col-2 px-0">
                      <div id="product-stack-cart-qty-control-{{ $productStackCart->id }}" class="d-flex flex-row align-items-center px-0 input-group">
                        <span class="input-group-btn">
                          <button type="button" class="quantity-left-minus btn btn-primary btn-number p-0 px-1" data-type="minus">
                            <i class="fas fa-minus text-white" aria-hidden="true"></i>
                          </button>
                        </span>
                        <input type="number" id="quantity" name="kuantitas" class="form-control input-number p-0 text-center" value="{{ $productStackCart->kuantitas }}" min="1" max="{{ $productStackCart->product->stok }}" onchange="onChangeQty({{ $productStackCart->id }}, this)">
                        <span class="input-group-btn">
                          <button type="button" class="quantity-right-plus btn btn-primary btn-number p-0 px-1" data-type="plus">
                            <i class="fas fa-plus text-white" aria-hidden="true"></i>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            {{-- no item in cart --}}
            <div id="no-item-text" class="container-fluid py-4 text-center bg-white {{ count($productStackCarts) <= 0 ? "" : "d-none"}}">
              <p class="text-secondary"><strong>No item found</strong></p>
            </div>

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
              <p id="text-subtotal-barang" class="card-text mb-0 fw-normal">Subtotal (5 barang)</p>
              <p id="text-subtotal-harga" class="card-text text-primary fw-bold fs-4">Rp7.500.000</p>

              {{-- checkout --}}
              <button id="btn-subtotal-barang" type="button" class="btn btn-primary w-100 mb-2 fw-bold" onclick="{{ "location.href = 'checkout';" }}">Checkout (5)</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--------------------------------------->
  <!--------------- LOADING --------------->
  <!--------------------------------------->

  <div id="loading-screen" class="fixed-top w-100 h-100 bg-black bg-opacity-50 d-none" style="z-index: 2000;">
    <div class="d-flex align-items-center justify-content-center h-100">
      <div class="spinner-border text-white" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>

  <!--------------------------------------->
  <!---------------- MODAL ---------------->
  <!--------------------------------------->
  {{-- data-bs-toggle="modal" data-bs-target="#modal-editxxx" --}}

  <!-- modal: hapus terpilih -->
  <div class="modal fade" id="modal-hapus-terpilih" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

  <!-- modal: hapus barang -->
  @foreach($productStackCarts as $productStackCart)
    <div class="modal fade" id="modal-hapus-barang{{ $productStackCart->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title w-100 text-center" id="staticBackdropLabel">Hapus dari Keranjang?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0 text-center">Barang yang kamu pilih akan dihapus dari keranjang.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm p-1 fw-bold w-100" onclick='onDeleteItem({{ $productStackCart->id }})'>Hapus</button>
            <button type="button" class="btn btn-secondary btn-sm p-1 text-white fw-bold w-100" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

@endsection
