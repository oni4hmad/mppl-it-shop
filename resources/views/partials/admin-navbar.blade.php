  {{-- user navbar --}}
  <nav id="navbar_top" class="border-1 border-bottom bg-white">
    <div class="container d-flex justify-content-between bg-white p-3">
      <div>
        <a class="navbar-brand ps-3 d-flex flex-row align-items-center" href="/">
          <img src="/assets/itshop-logo.svg" alt="logo itshop" width="100px">
          <div class="ms-2 mt-2 text-secondary fs-6">Admin</div>
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
          <li class="nav-item dropdown border-end border-2">
            <div class="d-flex">
              <a class="nav-link text-secondary" href="/cart">
                <i class="fas fa-shopping-cart"></i>
              </a>
              <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
              </a>
              <ul class="dropdown-menu py-0" aria-labelledby="navbarDropdown0" style="min-width: 300px;">
                <div class="container-fluid">

                  {{-- notification items --}}
                  {{-- notif-1 --}}
                  <a href="#" class="text-decoration-none text-black">
                    <div class="row py-2">
                      <div class="col-auto">
                        <i class="fas fa-cog text-secondary"></i>
                      </div>
                      <div class="col ps-0">
                        <p class="mb-0 text-break"><b>Oni Ahmad</b> memesan <b>jasa servis</b></p>
                        <p class="mb-0 text-secondary text-break">3 jam yang lalu</p>
                      </div>
                    </div>
                  </a>
                  <li><hr class="dropdown-divider my-0"></li>

                  {{-- notif-2 --}}
                  <a href="#" class="text-decoration-none text-black">
                    <div class="row py-2">
                      <div class="col-auto">
                        <i class="fas fa-server text-secondary"></i>
                      </div>
                      <div class="col ps-0">
                        <p class="mb-0 text-break"><b>Oni Ahmad</b> memesan <b>4 barang elektronik</b></p>
                        <p class="mb-0 text-secondary text-break">3 Juli 2021 09:00</p>
                      </div>
                    </div>
                  </a>
                  <li><hr class="dropdown-divider my-0"></li>

                </div>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown">
            {{-- foto & nama akun --}}
            <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="me-2" style="width: 1.5rem; height: 1.5rem;">
                <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('/{{ Auth::user()->profile_picture->path ?? 'assets/admin-icon.svg' }}'); background-size: cover; background-position: center center;"></div>
              </div>
              <span class="fw-bold text-primary">{{ Auth::user()->nama }}</span>
            </a>
            {{-- drop down menu --}}
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard">Halaman Admin</a></li>
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
