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
  @if (auth()->check() && Auth::user()->is_admin == 3)
    @include('partials.user-navbar')
  @elseif (auth()->check() && Auth::user()->is_admin == 1)
    @include('partials.admin-navbar')
  @elseif (auth()->check() && Auth::user()->is_admin == 2)
    @include('partials.technician-navbar')
  @else
    @include('partials.guest-navbar')
  @endif

  {{-- content --}}
  @yield('content')

  <!-- footer -->
  <div class="container-fluid px-0">
    <div class="bg-dark py-5">
      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="d-block w-100 me-5">
            <h4 class="border-start border-primary border-5 ps-2 pb-2 text-white">Follow Us</h4>
            <p class="ps-3 text-white">Dapatkan infomrasi terbaru seputar produk, restock, review, promo, dan lain-lain.</p>
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
