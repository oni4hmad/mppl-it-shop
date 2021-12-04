<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name." | ".$email ?></title>

    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- customized bootstrap css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/662e3d0d32.js" crossorigin="anonymous"></script>
</head>
<body>

  {{-- js: copy kode pembayaran --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/copy-kode-pembayaran.js"></script>

  <div class="container">
    <h3>Tooltip Methods</h3>
    <div>
      <p>Click on the buttons to manually control the tooltip above:</p>
      <button type="button" class="btn btn-primary">Show</button>
      <button type="button" class="btn btn-warning">Hide</button>
      <button type="button" class="btn btn-success">Toggle</button>
      <button type="button" class="btn btn-danger">Destroy</button>
    </div>
  </div>


  <button id="copy-kode-pembayaran" type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="manual" title="Tooltip on top">
    Tooltip on top
  </button>

  <script>
  $(document).ready(function(){
    $(".btn-primary").click(function(){
      $("[data-toggle='tooltip']").tooltip('show');
    });
    $(".btn-warning").click(function(){
      $("[data-toggle='tooltip']").tooltip('hide');
    });
    $(".btn-success").click(function(){
      $("[data-toggle='tooltip']").tooltip('toggle');
    });
    $(".btn-danger").click(function(){
     $("[data-toggle='tooltip']").tooltip('destroy');
    });
  });
  </script>

  <!-- bootstrap 5 css -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
