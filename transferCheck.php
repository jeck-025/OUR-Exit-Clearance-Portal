<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
$view = new view;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/ee4d206cc2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="resource/css/transferCheck.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>ECLE Status Checker</title>
    <link rel="icon" type="image/x-icon" href="resource/img/icon.ico" />
  </head>
  <body>
      <header>
          <nav class="navbar navbar-expand-md navbar-dark">
            <img src="resource/img/ceulogo2.png" class="img-fluid logo">
          </nav>

      <div class="container py-5 text-white">
        <div class="content text-center">
          <div class="row">
            <div class="col-md mt-5 pt">
              <a href="transferCheck.php"><img class="ecleLogo" src="resource/img/ecle-logo-new.png"></a>
              <h2 class="head-text">Undergraduate Status Checker</h2>
              <hr class="divider">
              <!-- <h1 class="head-text text-center">Ecle Status Checker</h1> -->
            </div>
          <div class="input pb-5 m-auto">
            <?php
              if(!empty($_POST)){
                  require 'transferResult.php';
              }else{
                  require 'checkForm.php';
              }
              ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col col-md-4 buttonsdiv">
          <?php 
            if(!empty($_POST)){
              echo '<a href="transferCheck.php" class="btn btn-sm btn-outline-light text-center ">Check Another Status</a>';
            }else{
              // do not show button
            }
          ?>
          <a href="index.php" class="btn btn-sm btn-outline-light text-center ">Back to ECLE Home</a>
        </div>
      </div>
  </header>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

</body>
</html>
