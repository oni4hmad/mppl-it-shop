
      <div id="sidebar" class="col-auto ps-4 py-4 border-end border-1" style="width: 200px;">
        <div class="sticky-top" id="sticky-fix">
          {{-- sidebar: profile --}}
          <div class="row border-bottom pb-4 mb-4">
            <div class="col px-0 pe-1" style="max-width: 50px; max-height: 50px;">
              <div style="width: 50px; height: 50px;">
                <div class="w-100 h-100 bg-image rounded-circle border" style="background-image: url('/{{ Auth::user()->profile_picture->path ?? 'assets/user-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
              </div>
            </div>
            <div class="col">
              <p class="m-0 p-0 fw-bold text-break">{{ auth()->user()->nama }}</p>
              <p class="m-0 p-0 text-primary text-break">Pelanggan</p>
            </div>
          </div>
          {{-- sidebar: menu --}}
          <a href="/order-history-product" class="text-decoration-none">
            <p class="fw-bold text-break {{ Request::segment(1)=='order-history-product' ? "text-dark text-decoration-underline" : "text-secondary" }}">Produk Elektronik</p>
          </a>
          <a href="/order-history-service" class="text-decoration-none">
            <p class="fw-bold text-break {{ Request::segment(1)=='order-history-service' ? "text-dark text-decoration-underline" : "text-secondary" }}">Servis Komputer</p>
          </a>
        </div>
      </div>
