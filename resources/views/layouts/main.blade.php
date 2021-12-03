<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <!-- login-modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action>
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label fw-bold">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">Contoh: email@gmail.com</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- content --}}
  @yield('content')

  <!-- footer -->
  <div class="container-fluid px-0">
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
