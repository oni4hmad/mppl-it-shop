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
          @guest
          @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link fw-bold" data-bs-toggle="modal" data-bs-target="#login-modal" role="button">Login</a>
            </li>
          @endif
          @if (Route::has('register'))
            <li class="nav-item bg-primary rounded-pill">
              <a class="btn btn-primary nav-link fw-bold text-white rounded-pill" href="{{ route('register') }}" role="button">Register</a>
            </li>
          @endif
          @else
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
              <li><a class="dropdown-item" href="#">Riwayat Order</a></li>
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
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- login-modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email Address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>

            <div class="modal-footer justify-content-center pb-0">
              <button type="submit" class="btn btn-primary w-100 fw-bold">
                  {{ __('Login') }}
              </button>

              @if (Route::has('password.request'))
                  <a class="btn btn-link p-0 m-0" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif
            </div>
        </form>
      </div>
      </div>
    </div>
  </div>