  {{-- guest navbar --}}
  <nav id="navbar_top" class="border-1 border-bottom bg-white">
    <div class="container d-flex justify-content-between bg-white p-3">
      <div>
        <a class="navbar-brand ps-3" href="/">
          <img src="/assets/itshop-logo.svg" alt="logo itshop" width="100px">
        </a>
      </div>
      <div class="col-6">
        <div class="input-group rounded">
          <input type="search" class="form-control rounded-end rounded-pill" placeholder="Cari produk elektronikmu" aria-label="Search" aria-describedby="search-addon" />
          <button type="button" class="btn btn-secondary rounded-start rounded-pill px-3">
            <i class="fas fa-search text-white"></i>
          </button>
        </div>
      </div>
      <div>
        <ul class="nav">
          <li class="nav-item border-end border-2">
            <a class="nav-link text-secondary" href="#">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" data-bs-toggle="modal" data-bs-target="#login-modal" role="button">Login</a>
          </li>
          <li class="nav-item bg-primary rounded-pill">
            <a class="btn btn-primary nav-link fw-bold text-white rounded-pill" href="#register" role="button">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
