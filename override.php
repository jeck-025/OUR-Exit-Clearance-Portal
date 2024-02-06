<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isRegistrar($user->data()->groups);
$import = new import();
$view = new view();
$update = new updateDeanCFG();
$ovrd = new ovrData();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap for navbar and navbar link dropdown  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <!-- bootstrap for other elements  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="resource/css/adminConfigStyle.css" rel="stylesheet"  type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ECLE - Override Data</title>
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
                    <!-- <li><a href="adminconfig.php" class="dropdown-item">Config</a></li>
                    <li><a href="changepasswordRegistrar.php" class="dropdown-item">Setting</a></li> -->
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
                  <div class="col col-md-11 pt-3 pb-3 mb-3 bg-white text-center shadow">
                    <h4>Override Data</h4><hr>
                        <form action="" method="GET">
                          <div class="row py-2">
                            <div class="col-md-10">
                              <select class="form-control selectpicker" data-live-search="true" name="gid">
                                <?php 
                                    if(isset($_GET['gid'])){
                                        echo "<option>".$_GET['gid']."</option>";
                                    }else{
                                        echo "<option>GRADUATE - Select Student ID</option>";
                                    }
                                    $view->studIDGrad(); ?>
                              </select>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                              <button type="submit" class="btn btn-block btn-adduser" name="searchGrad"><i class="fa-solid fa-folder-open"></i> Open</button>
                            </div>
                          </div>
                        </form>
                        <form action="" method="GET">
                          <div class="row">
                            <div class="col-md-10">
                              <select class="form-control selectpicker" data-live-search="true" name="uid">
                                <?php 
                                    if(isset($_GET['uid'])){
                                        echo "<option>".$_GET['uid']."</option>";
                                    }else{
                                        echo "<option>UNDERGRADUATE - Select Student ID</option>";
                                    }
                                    $view->studIDUndergrad(); ?>
                              </select>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center">
                              <button type="submit" class="btn btn-block btn-adduser" name="searchUnder"><i class="fa-solid fa-folder-open"></i> Open</button>
                            </div>
                          </div>
                        </form>
                  </div>
                </div>

                <?php
                  if(isset($_GET['searchGrad'])){
                    echo "<div class='import-grad-form'>";
                    echo "<div class='col col-md-11 py-3 mb-3 bg-white shadow'>";
                      $id = $_GET['gid'];
                      $ovrd->viewRaw($id, 'grad');
                    echo "</div></div>";
                  }elseif(isset($_GET['searchUnder'])){
                    echo "<div class='import-grad-form'>";
                    echo "<div class='col col-md-11 py-3 mb-3 bg-white shadow'>";
                      $id = $_GET['uid'];
                      $ovrd->viewRaw($id, 'under');
                    echo "</div></div>";
                  }else{
                    // display nothing
                  }
                ?>

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
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

  </body>
</html>

                <!-- <div class="semester-config-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <form method="post">
                      <?php
                        //if(!empty($_POST['semester']) || !empty($_POST['sy'])){
                        //  $update = new update($_POST['semester'], $_POST['sy']);
                        //  $update->updateSemester();
                        //  $update->updateSchoolyear(); ?>

                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-check"></i> Semester Config Updated.</strong> You may now import new set of lists.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      <?php //}?>
                      <h4>Change Year and Semester</h4><?php //$view->viewConfigSem();?><hr>
                      <div class="row">
                        <div class="col col-md-5">
                          <label for="semester" class="form-label">Semester</label>
                          <select name="semester" id="semester" class="form-select form-control" data-live-search="true">
                            <?php //$view->semesterChoose();?>
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
                </div> -->
                <!-- <div class="report-dl-form">
                  <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                    <div class="row">
                      <div class="col col-md-8">
                        <form method="get" action="reportsDownload.php">
                        <h4>Generate Reports</h4><hr>
                          <div class="row">
                            <div class="col col-md-3">
                              <label for="r_semester" class="form-label">Semester</label>
                                <select name="r_semester" id="semester" class="form-select form-control" data-live-search="true">
                                  <?php //$view->semesterChoose();?>
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
                </div> -->
                <!-- <div class="mailer-config-form">
                  <div class="col col-md-9 pt-3 pb-3 text-center shadow">
                    <form method="post">
                    <?php
                        //if(!empty($_POST['mailer-username']) && !empty($_POST['mailer-password'])){
                        //  $updateMailer = new updateMailer($_POST['mailer-username'], $_POST['mailer-password'], $_POST['mailer-port'], $_POST['mailer-platform']);
                        //  $updateMailer->updateMailerConfig(); ?>

                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-check"></i> Mailer Config Updated</strong><br>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      <?php //}?>
                    <div class="row">
                      <div class="col">
                        <h4>Mailer Settings</h4><hr>
                      </div>
                    </div>
                    <div class="row">
                      <?php
                        //$mailerData = $view->viewConfigMailer();
                        //$mailerUsername = $mailerData[0];
                        //$mailerPassword = $mailerData[1];
                        //$mailerPlatform = $mailerData[2];
                        //$mailerPort = $mailerData[3];
                      ?>
                      <div class="col col-md-3">
                        <label for="mailer-username" class="form-label">Username</label>
                        <input type="text" id="mailer-username" name="mailer-username" class="form-control" autocomplete="off" value="<?php //echo "$mailerUsername"; ?>" required>
                      </div>
                      <div class="col col-md-3">
                        <label for="mailer-password" class="form-label">Password</label>
                        <input type="password" id="mailer-password" name="mailer-password" class="form-control" autocomplete="off" value="<?php //echo "$mailerPassword"; ?>" required>
                      </div>
                      <div class="col col-md-3">
                        <label for="mailer-platform" class="form-label">Platform</label>
                        <input type="text" name="mailer-platform" id="mailer-platform" class="form-control" autocomplete="off" value="<?php //echo "$mailerPlatform"; ?>" required>
                      </div>
                      <div class="col col-md-1">
                        <label for="mailer-port" class="form-label">Port</label>
                        <input type="text" name="mailer-port" id="mailer-port" class="form-control" autocomplete="off" value="<?php //echo "$mailerPort"; ?>" required>
                      </div>
                      <div class="col col-md-2">
                        <label for="mailer_info_update" class="form-label">&nbsp;</label>
                        <button type="submit" id="mailer_info_update" class="btn btn-dark btn-block" onClick="btnSaveMailer()"><i class="fa-solid fa-floppy-disk"></i> Save </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div> -->