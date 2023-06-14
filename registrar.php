<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
$chartForm = new chartForm();
isRegistrar($user->data()->groups);
$import = new import();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resource/css/styledash.css" type="text/css">
    <link rel="stylesheet" href="resource/css/form.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <title>Dashboard</title>
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
            <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fas fa-question-circle me-2"></i>Pendings <?php echo '<span class="badge badge-danger">'.$viewtable->viewTotalRegistrar(). '</span>';  ?>
            </a>

            <div class="item">
              <a class="sub-btn" href="registrar.php"><i class="fa-solid fa-house-user"></i>Dashboard</a>
            </div>

            <!-- requests -->
            <div class="item">
              <a class="sub-btn"><i class="fa-solid fa-tag"></i>Requests<i class="fas fa-chevron-right dropdown"></i></a>
                <div class="sub-menu">
                  <a href="regs-req-tr.php" name="Rtransfer" class="sub-item border-bottom" value="Transfer">
                   Transfer <?php echo '<span class="badge badge-danger">'.$viewtable->viewCountPendingRegistrarTR(). '</span>';?> </a> 
                  <a href="regs-req-gd.php" name="Rgraduate" class="sub-item" value="Graduate">
                   Graduate <?php echo '<span class="badge badge-danger">'.$viewtable->viewCountPendingRegistrarGD(). '</span>';?> </a> 
                </div>
            </div>

            <!-- approved -->
            <div class="item">
              <a class="sub-btn"><i class="fa-solid fa-thumbs-up"></i>Cleared<i class="fas fa-chevron-right dropdown"></i></a>
                <div class="sub-menu">
                  <a href="regs-app-tr.php" name="Atransfer" class="sub-item border-bottom" value="Transfer">Transfer</a>
                  <a href="regs-app-gd.php" name="Agraduate" class="sub-item" value="Graduate">Graduate</a>
                </div>
            </div>

            <!-- hold -->
            <div class="item pb-3 border-bottom">
              <a class="sub-btn"><i class="fa-sharp fa-solid fa-pause"></i>On Hold<i class="fas fa-chevron-right dropdown"></i></a>
                <div class="sub-menu">
                  <a href="regs-hld-tr.php" name="Atransfer" class="sub-item border-bottom" value="Transfer">Transfer</a>
                  <a href="regs-hld-gd.php" name="Agraduate" class="sub-item" value="Graduate">Graduate</a>
                </div>
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
              <img class="sch-logo" src='resource/img/<?php deptImage(); ?>'>
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
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php 
                      if($user->data()->username == "REGISTRAR" || $user->data()->username == "RCBOLASOC" || $user->data()->username == "jeck"){
                        echo "<li><a href='adminconfig.php' class='dropdown-item'>Config</a></li>";
                        echo "<li><a href='changepasswordRegistrar.php' class='dropdown-item'>Change Password</a></li>";
                      }
                    ?>
                    <li><a href= "#" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#reportModal'>Reports</a></li>
                          <?php include 'modals.php'; ?>
                    <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <div class="pl-3 pt-3">
            <!-- <a href="reportsDownload.php" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-file-arrow-down me-2"></i>Download Reports</a> -->
            <!-- <div class='float-right'>
                  <img src='resource/img/ecle-logo-new-inv.png' class='ecleLogo'>
                </div> -->
          </div>

          <div class="container-fluid p-5">
            <div class="row">
              <div class="col-md p-5 content">
                  <?php 
                    if($user->data()->username == "REGISTRAR" || $user->data()->username == "RCBOLASOC" || $user->data()->username == "jeck"){
                      echo "<h4>Welcome, ".$user->data()->name.". <i class='fa-solid fa-hand-peace fa-bounce'></i></h4>";
                      echo "<br><hr>";
                      $chartForm->filterForm(); 
                      if(!empty($_GET['semester'])){
                          if(!empty($_GET['sch'])){
                            $viewchart = new chartfilter($_GET["sy"], $_GET["semester"], $_GET["sch"]);
                              if($_GET['sch'] == "SAM"){
                                $display_sch = "School of Accountancy and Management";
                              }elseif($_GET['sch'] == "SELAMS"){
                                $display_sch = "School of Education, Liberal Arts, Music, Social Work";
                              }elseif($_GET['sch'] == "DENT"){
                                $display_sch = "School of Dentistry";
                              }elseif($_GET['sch'] == "GRADSCH"){
                                $display_sch = "Graduate School";
                              }elseif($_GET['sch'] == "MEDICINE"){
                                $display_sch = "School of Medicine";
                              }elseif($_GET['sch'] == "MEDTECH"){
                                $display_sch = "School of Medical Technology";
                              }elseif($_GET['sch'] == "NHM"){
                                $display_sch = "School of Nutrition and Hospitality Management";
                              }elseif($_GET['sch'] == "NURSING"){
                                $display_sch = "School of Nursing";
                              }elseif($_GET['sch'] == "OPTO"){
                                $display_sch = "School of Optometry";
                              }elseif($_GET['sch'] == "PHARM"){
                                $display_sch = "School of Pharmacy";
                              }elseif($_GET['sch'] == "SCITECH"){
                                $display_sch = "School of Science and Technology";
                              }else{
                                $display_sch = "Error";
                              }
                          }else{
                            $viewchart = new chartfilter($_GET["sy"], $_GET["semester"]);
                          }
                          
                          echo "<div class='col-md-6 text-center'></div>";
                          echo "<hr>";
                          echo "<h5 class='col-md pb-3' style='text-align:center; font-weight:bold;'>Summary of Names of Chosen Universities of Transferring-Out Students for "; 

                                if(!empty($_GET['sch'])){
                                  echo "<b class='sy'>SY $_GET[sy]-$_GET[semester] </b><br> from the <b class='sy'> $display_sch </b></h5><br>";
                                }else{
                                  echo "<b class='sy'>SY $_GET[sy]-$_GET[semester]</b></h5><br>";}  

                          echo "<canvas id='chart_schools' style='width:100%;max-width:800px;'></canvas>";
                          
                          echo "<hr>";
                          echo "<h5 class='col-md pb-3' style='text-align:center; font-weight:bold;'>Summary of Number of Students per Reason for ";

                                if(!empty($_GET['sch'])){
                                  echo "<b class='sy'>SY $_GET[sy]-$_GET[semester] </b><br> from the <b class='sy'> $display_sch </b></h5><br>";
                                }else{
                                  echo "<b class='sy'>SY $_GET[sy]-$_GET[semester]</b></h5><br>";}  

                          echo "<canvas id='chart_reasons' style='width:100%;max-width:800px;'></canvas>";
                          
                          echo "<hr>";
                          echo "<h5 class='col-md pb-3' style='text-align:center; font-weight:bold;'>Summary of Number of Students Transferred per School for <b class='sy'> SY $_GET[sy]-$_GET[semester]</b><br></h5>";
                          echo "<canvas id='chart_schoolnames' style='width:100%;max-width:800px; height:325px;'></canvas>";
                          echo "</div>"; ?>

                          <script>
                          const schoolbar = document.getElementById('chart_schools');
                          new Chart(schoolbar, {
                            type: 'horizontalBar',
                            data: {
                              labels: <?php echo'["' . implode('", "', $viewchart->viewTransferredSchoolNames()) . '"]' ?>,
                              datasets: [{
                                //maxBarThickness: 40,
                                label: 'Number of Students Transferred to Other Universities',
                                data: <?php echo '[' . implode(', ', $viewchart->viewTransferredSchoolTotal()) . ']' ?>,
                                backgroundColor: [
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)',
                                  'rgb(41, 41, 110)'
                                ],
                              }]
                            },
                            options: {
                              scales: {
                                  xAxes: [{
                                      ticks: {
                                          beginAtZero: true
                                      }
                                  }]
                              }
                            }
                          });
                          </script>
                          <script>
                            const reasonbar = document.getElementById('chart_reasons');

                            new Chart(reasonbar, {
                              type: 'horizontalBar',
                              data: {
                                labels: <?php echo'["' . implode('", "', $viewchart->viewReasonNames()) . '"]' ?>,
                                datasets: [{
                                  label: 'Number of Students per Reason for Transferring',
                                  data: <?php echo '[' . implode(', ', $viewchart->viewReasonTotal()) . ']' ?>,
                                  backgroundColor: [
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)',
                                    'rgb(147, 149, 152)'
                                  ],
                                }]
                              },
                              options: {
                                scales: {
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                                plugins: {
                                  legend: {
                                    display: false
                                  }
                                }
                              }
                            });
                          </script>

                          <script>
                            const schoolnamebar = document.getElementById('chart_schoolnames');

                            new Chart(schoolnamebar, {
                              type: 'pie',
                              data: {
                                labels: ['SAM', 'DENTISTRY', 'ELAMS', 'GRADUATE SCHOOL', 'MEDICINE', 'MEDTECH', 'NHM', 'NURSING', 'OPTOMETRY', 'PHARMACY', 'SCITECH'],
                                datasets: [{
                                  label: 'Number of Students Transferred-Out per School',
                                  data: <?php echo "['".$viewchart->countSAM()."', 
                                                    '".$viewchart->countDENTISTRY()."', 
                                                    '".$viewchart->countELAMS()."',
                                                    '".$viewchart->countGS()."',
                                                    '".$viewchart->countMEDICINE()."',
                                                    '".$viewchart->countMEDTECH()."',
                                                    '".$viewchart->countNHM()."',
                                                    '".$viewchart->countNURSING()."',
                                                    '".$viewchart->countOPTO()."',
                                                    '".$viewchart->countPHARM()."',
                                                    '".$viewchart->countSCITECH()."' ]" ?>,
                                  backgroundColor: [
                                    'rgb(255,217,0)', // sam
                                    'rgb(114,0,255)',  // dentistry
                                    'rgb(255,0,0)',   // elams
                                    'rgb(0,50,165)',  //gradsch
                                    'rgb(255,151,239)', // medicine
                                    'rgb(0,255,60)',  // medtech
                                    'rgb(0,126,255)',  // NHM
                                    'rgb(255,191,99)', // nursing
                                    'rgb(172,54,54)', // opto
                                    'rgb(15,125,0)',  // pharmacy
                                    'rgb(255,132,0)', // scitech
                                  ],
                                }]
                              },
                            });
                          </script>
              <?php }}else{
                      echo "<h3>Welcome, ".$user->data()->name.". <i class='fa-solid fa-hand-peace fa-bounce'></i></h3>";
                      echo "<h6>Ready to sign some clearance? Kindly refer to the sidebar on the left of your screen. <i class='fa-solid fa-arrow-left fa-beat-fade'></i></h6>";
                          } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </header>
      <script type="text/javascript">
        var el = document.getElementById("wrapper")
        var toggleButton = document.getElementById("menu-toggle")

        toggleButton.onclick = function(){
          el.classList.toggle("toggled")
        }
      </script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
  </body>
</html>
