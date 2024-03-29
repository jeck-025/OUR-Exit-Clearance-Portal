<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isRegistrar($user->data()->groups);
$import = new import();
$view = new view();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resource/css/adminConfigStyle.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <title>ECLE - Config</title>
    <link rel="icon" type="image/x-icon" href="resource/img/icon.ico" />
  </head>
  <body>
    <header>
      <div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
          <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase">
            <img src="resource/img/logo.jpg" class="img-fluid logo">
          </div>
          <div class="list-group list-group-flush my-3">
            <div class="item">
              <a href="registrar.php"><i class="fa-solid fa-gauge-high"></i>Dashboard</a>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                $('.sub-btn').click(function(){
                  $(this).next('.sub-menu').slideToggle();
                  $(this).find('.dropdown').toggleClass('rotate');
                });
              });
            </script>
          </div>
          <div class="sch-img text-center">
            <img class="sch-logo" src="resource/img/gear.png">
          </div>
        </div>
        <div id="page-content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom">
            <div class="d-flex align-items-center">
              <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupporteContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle second-text fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> <?php echo $user->data()->username ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- <li><a href="sendmails.php" class="dropdown-item">Send Mails</a></li> -->
                    <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <div class="container-fluid main p-3">
            <div class="row justify-content-md-center next ">
              <div class="col-md-10 pt-3 content">

                <div class="import-grad-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <h4>Advanced Configuration</h4><hr>
                      <div class="row d-flex justify-content-center">
                        <div class="col col-md-3" id="importFrm">
                          <a class="btn btn-dark" href="addusers" target="_blank"><i class="fa-solid fa-users"></i> Add / Remove User</a>
                        </div>
                        <div class="col col-md-3" id="importFrm">
                          <a class="btn btn-dark" href="override" target="_blank"><i class="fa-solid fa-file-pen"></i> Data Override</a>
                        </div>
                        <div class="col col-md-3" id="importFrm">
                          <a class="btn btn-dark" href="deanconfig" target="_blank"><i class="fa-solid fa-screwdriver-wrench"></i> Other Advanced Config</a>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="import-grad-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <h4>Import Names of Graduate Students</h4><hr>
                      <div class="col col-md text-center" id="importFrm">
                        <?php $import->insertGraduate(); ?>
                          <form action="" method="post" enctype="multipart/form-data"><br>
                            <small class="note">CSV File Only</small><br>
                            <input type="file" name="file" accept=".csv">
                            <button type="submit" class="btn btn-dark btn-sm" name="importSubmit" id="i_submit" onClick="btnImport()"><i class="fa-solid fa-file-import"></i> Import</button>
                            <a href="ecle.csv" download="ecle template" class="btn btn-primary btn-sm" id="tp_download" onClick="btnTemplate()"><i class="fa-solid fa-file-arrow-down"></i> Download Template</a>
                            <a href="courses.xlsx" download="courses template" class="btn btn-primary btn-sm" id="cs_download" onClick="btnCourses()"><i class="fa-solid fa-circle-info"></i> Instructions</a>
                          </form>
                      </div>
                  </div>
                </div>
                <div class="semester-config-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <form method="post">
                      <?php
                        if(!empty($_POST['semester']) || !empty($_POST['sy'])){
                          $update = new update($_POST['semester'], $_POST['sy']);
                          $update->updateSemester();
                          $update->updateSchoolyear(); ?>

                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-check"></i> Semester Config Updated.</strong> You may now import new set of lists.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      <?php }?>
                      <h4>Change Year and Semester</h4><?php $view->viewConfigSem();?><hr>
                      <div class="row">
                        <div class="col col-md-5">
                          <label for="semester" class="form-label">Semester</label>
                          <select name="semester" id="semester" class="form-select form-control" data-live-search="true">
                            <?php $view->semesterChoose();?>
                          </select>
                        </div>
                        <div class="col col-md-5">
                          <label for="sy" class="form-label">School Year</label>
                          <input type="text" name="sy" id="sy" class="form-control" placeholder="xxxx-xxxx" pattern="[0-9]{4}-[0-9]{4}" oninvalid="this.setCustomValidity('Please follow the pattern (XXXX-XXXX)')" oninput="this.setCustomValidity('')" autocomplete="off">
                        </div>
                        <div class="col-md-2 text-center">
                          <label for="s_submit" class="form-label">&nbsp;</label>
                          <button type="submit" id="s_submit" class="btn btn-dark btn-block" onClick="btnSave()"><i class="fa-solid fa-floppy-disk"></i> Save </button>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="report-dl-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <div class="row">
                      <div class="col col-md-8">
                        <form method="get" action="reportsDownload.php">
                        <h4>Generate Reports</h4><hr>
                          <div class="row">
                            <div class="col col-md-3">
                              <label for="r_semester" class="form-label">Semester</label>
                                <select name="r_semester" id="semester" class="form-select form-control" data-live-search="true">
                                  <?php $view->semesterChoose();?>
                                </select>
                            </div>
                            <div class="col col-md-3">
                              <label for="r_sy" class="form-label">School Year</label>
                                <input type="text" name="r_sy" id="r_sy" class="form-control" placeholder="xxxx-xxxx" pattern="[0-9]{4}-[0-9]{4}" oninvalid="this.setCustomValidity('Please follow the pattern (XXXX-XXXX)')" oninput="this.setCustomValidity('')" autocomplete="off">
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="g_submit" class="form-label"><u>Graduates</u></label>
                              <button type="submit" id="g_submit" name="g_submit" class="btn btn-dark btn-block" onClick="btnDownloadG()"><i class="fa-solid fa-download"></i> Download </button>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="u_submit" class="form-label"><u>Transfers</u></label>
                              <button type="submit" id="u_submit" name="u_submit" class="btn btn-dark btn-block" onClick="btnDownloadU()"><i class="fa-solid fa-download"></i> Download </button>
                            </div>
                          </div> 
                        </form>
                      </div>
                      <div class="col col-md-4">
                        <h4>Send Mails</h4><hr>
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <p class="sendMails">Send Follow-up emails for pending clearances.</p>
                          </div>
                        </div>
                        <div class="row sendmailsDiv">
                          <div class="col-md-8 pt-0 text-center">
                            <a href="sendmails.php" id="sendmails" class="btn btn-dark btn-block" onClick="btnSendMails()"> <i class="fas fa-envelope"></i> Send to All</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      var el = document.getElementById("wrapper")
      var toggleButton = document.getElementById("menu-toggle")

      toggleButton.onclick = function(){
        el.classList.toggle("toggled")    
      }

      function btnImport(){
        i_submit.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Processing...';
      }

      function btnTemplate(){
        tp_download.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Loading...';
        setTimeout(() => {tp_download.innerHTML = '<i class="fa-solid fa-file-arrow-down"></i> Download Template';}, 1500);
      }

      function btnCourses(){
        cs_download.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Loading...';
        setTimeout(() => {cs_download.innerHTML = '<i class="fa-solid fa-circle-info"></i> Instructions';}, 1500);
      }

      function btnSave(){
        s_submit.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Saving...';
      }
      
      function btnDownloadG(){
        g_submit.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Loading...';
        setTimeout(() => {g_submit.innerHTML = '<i class="fa-solid fa-download"></i> Graduates';}, 1500);
      }

      function btnDownloadU(){
        u_submit.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Loading...';
        setTimeout(() => {u_submit.innerHTML = '<i class="fa-solid fa-download"></i> Transfers';}, 1500);
      }

      function btnSendMails(){
        sendmails.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Sending...';
      }

      function btnSaveMailer(){
        mailer_info_update.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Saving...';
      }

    </script>
  </body>
</html>
