  {{-- user navbar --}}
  <nav id="navbar_top" class="border-1 border-bottom bg-white">
    <div class="container d-flex justify-content-between bg-white p-3">
      <div>
        <a class="navbar-brand ps-3 d-flex flex-row align-items-center" href="/">
          <img src="/assets/itshop-logo.svg" alt="logo itshop" width="100px">
          <div class="ms-2 mt-2 text-secondary fs-6">Teknisi</div>
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
          <li class="nav-item dropdown border-end border-2">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
            </a>
            <ul class="dropdown-menu py-0" aria-labelledby="navbarDropdown0" style="min-width: 350px;">
              <div class="container-fluid">

                {{-- notification items --}}
                {{-- notif-1 --}}
                <a href="#" class="text-decoration-none text-black">
                  <div class="row py-2">
                    <div class="col-auto">
                      <i class="fas fa-cog text-secondary"></i>
                    </div>
                    <div class="col ps-0">
                      <p class="mb-0 text-break"><b>Admin 001</b> meminta kesediaan anda melakukan <b>servis  (ID: 9003 / Fiodhy Ardito /  Laptop suka tiba-tiba mati sendiri padahal baterai masih penuh dan kadang bisa di cas kadang tidak bisa)</b></p>
                      <p class="mb-0 text-secondary text-break">3 jam yang lalu</p>
                    </div>
                  </div>
                </a>
                <li><hr class="dropdown-divider my-0"></li>

                {{-- notif-2 --}}
                <a href="#" class="text-decoration-none text-black">
                  <div class="row py-2">
                    <div class="col-auto">
                      <i class="fas fa-cog text-secondary"></i>
                    </div>
                    <div class="col ps-0">
                      <p class="mb-0 text-break"><b>Admin 001</b> meminta kesediaan anda melakukan <b>servis  (ID: 9002 / Oni Ahmad /  komputer tidak bisa menyala)</b></p>
                      <p class="mb-0 text-secondary text-break">3 Juli 2021 09:00</p>
                    </div>
                  </div>
                </a>
                <li><hr class="dropdown-divider my-0"></li>

              </div>
            </ul>
          </li>
          <li class="nav-item dropdown">
            {{-- foto & nama akun --}}
            <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="me-2" style="width: 1.5rem; height: 1.5rem;">
                <div class="w-100 h-100 rounded-circle border border-secondary" style="background-image: url('{{ asset('profile_pic') }}/{{ Auth::user()->profile_pic }}'); background-size: cover; background-position: center center;"></div>
              </div>
              <span class="fw-bold text-primary">{{ Auth::user()->name }}</span>
            </a>
            {{-- drop down menu --}}
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/confirm-service-availability">Halaman Teknisi</a></li>
              <li><a class="dropdown-item" href="/account-settings">Pengaturan Akun</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
