
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
          <a href="/dashboard" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break {{ Request::segment(1)=='dashboard' ? "text-decoration-underline" : "text-secondary" }}">
            <i class="fas fa-home me-2"></i>Home</p>
          </a>
          <a href="manage-product" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break {{ Request::segment(1)=='manage-product' ? "text-decoration-underline" : "text-secondary" }}">
            <i class="fas fa-microchip me-2"></i>Produk</p>
          </a>
          <a href="manage-technician" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break {{ Request::segment(1)=='manage-technician' ? "text-decoration-underline" : "text-secondary" }}">
            <i class="fas fa-user-cog me-2"></i>Teknisi</p>
          </a>
          <p class="my-3 p-2 py-3 border-top border-bottom fw-bold text-break text-secondary">Orderan</p>
          <a href="manage-product-order" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break {{ Request::segment(1)=='manage-product-order' ? "text-decoration-underline" : "text-secondary" }}">
            <i class="fas fa-server me-2"></i>Produk Elektronik</p>
          </a>
          <a href="manage-service-order" class="text-decoration-none"><p id="side-nav" class="mb-0 p-2 fw-bold text-break {{ Request::segment(1)=='manage-service-order' ? "text-decoration-underline" : "text-secondary" }}">
            <i class="fas fa-cog me-2"></i>Jasa Servis</p>
          </a>
        </div>
      </div>