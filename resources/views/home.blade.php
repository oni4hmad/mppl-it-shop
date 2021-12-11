<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Home</title>

  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- customized bootstrap css -->
  <link rel="stylesheet" href="css/style.css">

  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/662e3d0d32.js" crossorigin="anonymous"></script>

  <!-- navbar fix -->
  <script src="js/navbar-fix.js"></script>
</head>

<body>
  <!-- navbar -->
  <nav id="navbar_top" class="border-1 border-bottom">
    <div class="container d-flex justify-content-between bg-white p-3">
      <div>
        <a class="navbar-brand ps-3" href="#">
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
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
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
        {{-- <form method="POST" action="{{ route('login') }}" >
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label fw-bold">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <div id="emailHelp" class="form-text">Contoh: email@gmail.com</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
              {{ __('Login') }}
          </button>
            @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
              </a>
            @endif
          </div>
        </form> --}}
      </div>
    </div>
  </div>

  <!-- carousel promo -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <a href="#promo"><img src="img/promo/promo1.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
            <div class="carousel-item">
              <a href="#promo"><img src="img/promo/promo2.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
            <div class="carousel-item">
              <a href="#promo"><img src="img/promo/promo3.jpg" class="d-block w-100" alt="banner promo"></a>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- banner: jual produk / servis komputer -->
  <div class="container">
    <div class="row mt-1">
      <div class="position-relative col-8 p-2">
        <div class="position-absolute bottom-0 start-0 ps-3">
          <div class="container pb-3">
            <div class="row">
              <h2 class="text-white fw-bold">Cari Komponen</h2>
              <h2 class="text-white fw-bold">PC Impianmu</h2>
            </div>
          </div>
          <div class="container pb-5">
            <div class="row">
              <div class="col-12">
                <a class="btn btn-primary w-50 fw-bold btn-lg rounded-pill" href="search" role="button">Cari Produk</a>
              </div>
            </div>
          </div>
        </div>
        <img src="img/banner/home_bg-produk-elektronik.png" class="img-fluid rounded-3" alt="banner produk elektronik">
      </div>
      <div class="position-relative col-4 p-2">
        <div class="position-absolute bottom-0 start-0 ps-3">
          <div class="container pb-3">
            <div class="row">
              <h2 class="text-white fw-bold">Pesan Teknisi</h2>
              <h2 class="text-white fw-bold">Servis Terbaik</h2>
            </div>
          </div>
          <div class="container pb-5">
            <div class="row">
              <div class="col-12">
                <a class="btn btn-primary w-70 fw-bold btn-lg rounded-pill" href="/service-order" role="button">Pesan Jasa Servis</a>
              </div>
            </div>
          </div>
        </div>
        <img src="img/banner/home_bg-servis-komputer.png" class="img-fluid rounded-3" alt="banner produk elektronik">
      </div>
    </div>
  </div>

  <!-- category -->
  <!-- category: title -->
  <div class="container mt-3">
    <div class="d-flex flex-row">
      <h1 class="fw-bold text-primary">Category&nbsp;</h1>
      <div class="container">
        <div class="row">
          <div class="col-12 border-2 border-bottom" style="height: 30px;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- category: grid -->
  <div class="container">
    <div class="d-flex justify-content-between mt-2" style="height: 180px;">
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/proci.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Processor</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/gpu.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Graphics Card</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/ram.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Memory</h2>
          </a>
        </div>
      </div>
      <div class="w-100 me-3 position-relative bg-image rounded-3" style="background-image: url('img/category/storage.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 ms-3 pb-1">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Storage</h2>
          </a>
        </div>
      </div>
      <div class="w-100 position-relative bg-image rounded-3" style="background-image: url('img/category/monitor.png'); background-size: cover;">
        <div class="position-absolute w-100 h-100 rounded-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 1.0), rgba(255, 255, 255, 0));"></div>
        <div class="position-absolute start-0 bottom-0 mb-0 pb-1 ms-3">
          <a href="#kategori">
            <h2 class="text-white fw-bold">Monitor</h2>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <div class="container-fluid mt-5 px-0">
    <div class="bg-dark py-5">
      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="d-block w-100 me-5">
            <h4 class="border-start border-primary border-5 ps-2 pb-2 text-white">Follow Us</h4>
            <p class="ps-3 text-white">Infomrasi seputar produk baru, restock, review, promo, dan lain-lain.</p>
            <div class="ps-3 d-flex justify-content-start">
              <div class="d-block me-3">
                <a href="#sosmed" class="text-white">
                  <i class="fab fa-facebook fa-2x"></i>
                </a>
              </div>
              <div class="d-block me-3">
                <a href="#sosmed" class="text-white">
                  <i class="fab fa-youtube fa-2x"></i>
                </a>
              </div>
              <div class="d-block">
                <a href="#sosmed" class="text-white">
                  <i class="fab fa-instagram fa-2x"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="d-block w-100 me-5">
            <h4 class="border-start border-primary border-5 ps-2 pb-2 text-white">Customer Service</h4>
            <ul class="ms-1 text-white">
              <li>08113004000</li>
              <li>081234363000</li>
            </ul>
          </div>
          <div class="d-block w-100 me-5">
            <h4 class="border-start border-primary border-5 ps-2 pb-2 text-white">Location</h4>
            <div class="ps-3 text-white">
              <p>ITC Surabaya Mega Grosir<br>ITech City Lantai 2 Blok L8 No 9<br>Jl. Gembong No.20-30<br><b>SURABAYA</b></p>
              <p>Ruko Center Point<br>Jl. Puncak Borobudur No.B29<br><b>MALANG</b></p>
            </div>
          </div>
          <div class="d-block w-100">
            <h4 class="border-start border-primary border-5 ps-2 pb-2 text-white">Jam Operasional</h4>
            <div class="ps-3 text-white">
              <p><b>BUKA</b><br>Senin – Sabtu<br>10:00 – 17:00 WIB<br></p>
              <p><b>TUTUP</b><br>Minggu / Libur Nasional</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- bootstrap 5 css -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
