<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/ee4d206cc2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="resource/css/gradLogin.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>ECLE - Student Checker</title>
    <link rel="icon" type="image/x-icon" href="resource/img/icon.ico" />
  </head>
  <body>

    <header>

        <nav class="navbar navbar-expand-md navbar-dark">
          <img src="resource/img/ceulogo2.png" class="img-fluid logo">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="icons ml-auto">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="https:/www.facebook.com/theCEUofficial/"><i class="fab fa-facebook-f"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/ceuofficial/"><i class="fab fa-instagram"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="https://twitter.com/ceumalolos"><i class="fab fa-twitter"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>


    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7 ml-5 text-white text">
          <div class="content mt-5">
            <p class="line1 anim-typewriter1 font-weight-bold"><span class="ecle">E</span>XIT <span class="ecle">CLE</span>ARANCE</p>
            <p class="line2 anim-typewriter2">CEU<span> EMPOWERS.</span> CEU <span>INSPIRES.</span> </p>
            <!-- <p class="line anim-typewriter3">CEU <span>INSPIRES.</span></p> -->
          </div>
        </div>
        <div class="col-md">
          <div class="row">
            <div class="sample">
              <div class="col-md pt-4 mt-5">
              <div class="login-fields">
                <div class="content">
                  <img class="ecleLogo" src="resource/img/ecle-logo-new.png">
                  <!-- <h1 class="text-center">ECLE
                  </h1> -->
                  <h5 class="text-center"><span class="ecle">E</span>xit <span class="ecle">Cle</span>arance Portal for <br><span class="ceu">CEU Office of the University Registrar</span></h5>
                  <?php gradInfo(); ?>
                  <form action="" method="post">
                    <div class="inputs">
                      <input type="text" class="input" pattern="[0-9]{4}-[0-9]{5}" oninvalid="this.setCustomValidity('Please follow the pattern (XXXX-XXXXX)')" oninput="this.setCustomValidity('')" placeholder="Student Number" name="studentNumber" required>
                      <input type="text" class="input" maxlength ="1" pattern="[a-zA-Z\s]*$" oninvalid="this.setCustomValidity('Please use characters!')" oninput="this.setCustomValidity('')" placeholder="First Letter of Last Name" name="lname" required>
                      <br> <small class="text-muted" style="font-size: .6em;"><b>*Please input the first letter of your Last Name</b></small>
                    </div>
                    <div>
                      <input type="submit" class="button-check btn-info"value="Check"/>
                      
                    </div>
                  </form>
                    <div>
                      <a href="index.php"><button class="btn-primary button-back"/>Back</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </header>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="ft pt-3">
              Centro Escolar University || R.Bolasoc | J.Espiritu | D.Calalang | C.DelaCruz | L.Pradez | D.Prado | J. Anatalio
            </p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
