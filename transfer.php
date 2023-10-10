<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
$view = new view();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://kit.fontawesome.com/03ca298d2d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="resource/css/transfer.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->

    <!-- <script>
    function onSubmit(token) {
      document.getElementById("demo-form").submit();
    }
    </script> -->

    <title>ECLE Transfer Form</title>
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

      <div class="container mt-5 responsive">
        <div class="row">
          <div class="content px-4 m-auto justify-content-center responsive">
            <div class="col-md pt-3 text-center">
              <!-- <img class="ecleLogo" src="resource/img/ecle-logo-new.png"> -->
              <h2 class="head-text"><img class="ecleLogo" src="resource/img/ecle-logo-new.png">Exit Clearance Form for Undergraduates</h2>
              
              <hr class="divider">
            </div>

          <?php
          if(!empty($_POST)){         

              $recaptcha_secret_key = '6LcZHmwoAAAAADZh4bK3HzmFGzLXvTvRs3XiQOsz';
              $recaptcha_response = $_POST['g-recaptcha-response'];

              $url = 'https://www.google.com/recaptcha/api/siteverify';
              $data = array(
                  'secret' => $recaptcha_secret_key,
                  'response' => $recaptcha_response
              );

              $options = array(
                  'http' => array (
                      'method' => 'POST',
                      'header' => 'Content-type: application/x-www-form-urlencoded',
                      'content' => http_build_query($data)
                  )
              );

              $context = stream_context_create($options);
              $verify = file_get_contents($url, false, $context);
              $captcha_success = json_decode($verify);

              if ($captcha_success->success) {


              } else {

                  // reCAPTCHA validation failed, handle it accordingly
                  // For example, you can display an error message and prevent form submission.
                  echo "reCAPTCHA validation failed.";
                  exit;
              }

              
                                $insert= new insert($_POST['fname'], $_POST['lname'], $_POST['mname'], $_POST['studID'], 
                                $_POST['email'], $_POST['contact'], $_POST['course'], $_POST['bday'], 
                                $_POST['year'], $_POST['sem'], $_POST['university'], $_POST['reason'], 
                                $_FILES['validID'],$_FILES['validID']['tmp_name'],
                                $_FILES['file_letter'],$_FILES['file_letter']['tmp_name'],
                                $_FILES['validID']['size'],
                                $_FILES['file_letter']['size']);
              
          }
          ?>

          <form method="POST" enctype="multipart/form-data">
            <div class="row mt-3 g-3">
              <!---Firstname--->
              <div class="col-md-4">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" pattern="[a-zA-Z\s]*$" oninvalid="this.setCustomValidity('Please use characters!')" oninput="this.setCustomValidity('')" id="firstName" required>
              </div>

              <!---Middlename--->
              <div class="col-md-4">
                <label for="middleName" class="form-label">Middle Name</label>
                <input type="text" name="mname" class="form-control" pattern="[a-zA-Z\s]*$" oninvalid="this.setCustomValidity('Please use characters!')" oninput="this.setCustomValidity('')" id="middleName">
              </div>

              <!---Lastname--->
              <div class="col-md-4">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" pattern="[a-zA-Z\s]*$" oninvalid="this.setCustomValidity('Please use characters!')" oninput="this.setCustomValidity('')" id="lastName" required>
              </div>
            </div>
            <div class="row mt-3 g-3">
              <!---Student Number--->
              <div class="col-md-4">
                <label for="studentNumber" class="form-label">Student Number <br><small class="studN">(Use <b>0000-00000</b> if you cannot remember your Student Number)</small></label>
                <!-- <input type="text" name="studID" class="form-control" pattern="[A-Za-z0-9]{4}-[A-Za-z0-9]{5}" oninvalid="this.setCustomValidity('Please follow the pattern (XXXX-XXXXX)')" oninput="this.setCustomValidity('')" id="studentNumber" required> -->
                <input type="text" name="studID" class="form-control" pattern="[0-9]{4}-[0-9]{5}" oninvalid="this.setCustomValidity('Please follow the pattern (xxxx-xxxxx)')" oninput="this.setCustomValidity('')" id="studentNumber" placeholder="xxxx-xxxxx" required>
              </div>

              <!---Email--->
              <div class="col-md-4">
                <label for="email" class="mt-4 form-label">Email</label>
                <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Please follow the pattern sample@gmail.com')" oninput="this.setCustomValidity('')" id="email" required>
              </div>

              <!---Contact Number--->
              <div class="col-md-4">
                <label for="contactNumber" class="form-label">Contact Number <br><small class="studN">12-Digit Mobile Number</small></label>
                <input type="text" name="contact" class="form-control" pattern="09[0-9]{9}" oninvalid="this.setCustomValidity('Please follow the pattern 0XXXXXXXXXX')" oninput="this.setCustomValidity('')" id="contactNumber" required>
              </div>
            </div>
            <div class="row mt-3 g-3">
              
              <!---Course/Degree--->
              <div class="col-md-8">
                <label form="course" class="form-label">Course/Degree</label>
                <select id="course" name="course" class="form-select form-control selectpicker" data-live-search="true" required>
                <?php $view->courseSP2();?>
                </select>
              </div>

              <div class="col-md-4">
                <label for="bday" class="form-label">Birthday</label>
                <input type="date" name="bday" class="form-control" id="bday" required>
              </div>
            </div>
            <div class="row mt-3 g-3">
              <!---Year Level--->
              <div class="col-md-3">
                <label for="yearLevel" class="form-label">School Year Last Enrolled</label>
                <input type="text" name="year" class="form-control" pattern="[0-9]{4}-[0-9]{4}" oninvalid="this.setCustomValidity('Please follow the pattern xxxx-xxxx')" oninput="this.setCustomValidity('')" id="yearLevel" placeholder="xxxx-xxxx" required>
               </div>
              <div class="col-md-2">
                <label for="sem" class="form-label">Semester</label>
                <select id="sem" name="sem" class="form-select form-control" data-live-search="true" required>
                <?php $view->semesterChoose();?>
                </select>
              </div>

              <!---Transfer School--->
              <div class="col-md-4">
                <label for="university" class="form-label">Transferring School</label>
                <select id="university" name="university" class="form-select form-control selectpicker" data-live-search="true" required>
                <?php $view->university();?>
                </select>
              </div>

              <!---Reason--->
              <div class="col-md-3">
                <label for="reason" class="form-label">Reason</label>
                <select id="reason" name="reason" class="form-select form-control" data-live-search="true" required>
                <?php $view->reason();?>
                </select>
              </div>
            </div>

            <hr class="divider">

            <div class="row g-3">
              <div class="col-md-6 mb-3 text-center">
                <div class="row">
                  <div class="col-12 text-center wBorder">
                    <p class="fupload_head"><i class="fas fa-folder-open"></i> Required Documents</p>
                    <p class="fupload_head_cap">Please attach the following documents in PDF Format</p>
                  </div>
                  <div class="col-md-6 fupload wBorder">
                    <label for="validID" class="form-label"><b>Valid ID of Parent or Guardian</b></label><br>
                    <input id="validID" class="form-control-file " accept=".pdf" type="file" name="validID" required>
                  </div>
                  <div class="col-md-6 fupload wBorder">
                    <label for="file_letter" class="form-label"><b>Letter of Intent for Exit</b></label><br>
                    <input id="file_letter" class="form-control-file " accept=".pdf" type="file" name="file_letter" required>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6 text-center">
                <div class="col-12 text-center">
                <!-- <p class="fupload_head"><i class="fas fa-user-check"></i> Captcha</p>
                <p class="fupload_captcha">Please complete the captcha below before submitting.</p> -->
                <!-- <div class="form-group col-md-5 justify-content-center"> -->
                  <!-- <p><img src="captcha.php" width="120" height="30" alt="CAPTCHA"></p>
                  <p><input type="text" size="6" maxlength="5" name="captcha" value="">
                  <small>Copy the digits from the image into this box</small></p> -->
                  <!-- </div> -->
                  <div class="g-recaptcha" data-sitekey="6LcZHmwoAAAAAMud5aRHZVyMKm80GzSqMM6fFoXz"></div>
              </div>
            </div>

            <hr class="divider">
              <div class="col-md pb-5 pt-3 text-center">
                <div>
                  <button type="submit" class="btn btn-sm button-submit btn-info"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
                <div>
                  <!-- <button onclick="location.href='index.php'" class="btn btn-sm btn-outline-light mt-2 button-back">Back</button> -->
                  <button onclick="history.back()" class="btn btn-sm btn-outline-light mt-2 button-back"> <i class="fas fa-long-arrow-alt-left"></i> Back</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="vendor/js/bootstrap-select.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script> -->
    


</body>
</html>
