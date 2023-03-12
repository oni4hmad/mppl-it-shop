  {{-- user navbar --}}
  <nav id="navbar_top" class="border-1 border-bottom bg-white">
    <div class="container d-flex justify-content-between bg-white p-3">
      <div>
        <a class="navbar-brand ps-3" href="/">
          <img src="/assets/itshop-logo.svg" alt="logo itshop" width="100px">
        </a>
      </div>
      <div class="col-6">
        <form action="/search">
          <div class="input-group rounded">
            <input type="search" name="search" class="form-control rounded-end rounded-pill" placeholder="Cari produk elektronikmu" aria-label="Search" aria-describedby="search-addon" value="{{ request()->search }}" />
            <button type="submit" class="btn btn-secondary rounded-start rounded-pill px-3">
              <i class="fas fa-search text-white"></i>
            </button>
          </div>
        </form>
      </div>
      <div>
        <ul class="nav">
          <li class="nav-item border-end border-2">
            <a class="nav-link text-secondary" href="/cart">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            {{-- foto & nama akun --}}
            <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="me-2" style="width: 1.5rem; height: 1.5rem;">
                <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('/{{ Auth::user()->profile_picture ?? 'assets/admin-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
              </div>
              <span class="fw-bold text-primary">{{ Auth::user()->nama }}</span>
            </a>
            {{-- drop down menu --}}
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/order-history-product">Riwayat Order</a></li>
              <li><a class="dropdown-item" href="/account-settings">Pengaturan Akun</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="/logout" onclick="">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
