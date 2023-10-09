<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
isLogin();
$searchtable = new searchAllTable();
$viewtable = new viewtable();
$user = new user();
isViewer($user->data()->groups);
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <title>ECLE - Search All</title>
    <link rel="icon" type="image/x-icon" href="resource/img/icon.ico" />
  </head>
  <body>
    <header>
      <div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
          <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase">
            <img src="resource/img/logo.jpg" class="img-fluid logo">
          </div>
          <div class="list-group list-group-flush my-3 p-2 text-center">
            <h5><i class="fa-solid fa-hand-peace"></i> <?php echo "Hi, ".$user->data()->name; ?></h5>
          </div>
          <div class="sch-img text-center">
              <img class="sch-logo-reg" src='resource/img/<?php deptImage(); ?>'>
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
                <li class="nav-item dropdown ">
                  <a href="#" class="nav-link dropdown-toggle second-text fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> <?php echo $user->data()->username ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- <li><a href= "#" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#reportModal'>Reports</a></li> -->
                    <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- <div class="pl-3 pt-3">
               div here
          </div> -->

          <div class="container-fluid main p-5">
            <div class="col-md p-3 content">

              <div class="row justify-content-md-center next p-3">
                <div class="col-md-3 pt-3 content">
                  <h4 class="text-center p-3"><i class="fa-solid fa-magnifying-glass fa-beat-fade fa-lg"></i> Clearance Search</h4>
                </div>
                <div class="col-md-9 pt-3">
                  <form method="get">
                    <div class="row form-group">
                      <div class="col col-md-9">
                        <label for="searchName">Enter Name of Student or Course</label>
                        <input type="text" class="form-control" name="searchName" id="searchName" value="<?php if(!empty($_GET['searchName'])){echo $_GET['searchName'];}?>" autocomplete="off" required>
                      </div>
                      <div class="col col-md-3">
                        <label for="submitSearch" class="form-label">&nbsp</label>
                        <button type="submit" id="submitSearch" class="btn btn-primary btn-block">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="row justify-content-md-center next">
                <div class="col-md p-5">
                    <?php 
                      if(!empty($_GET['searchName'])){
                        $searchtable->searchTable($_GET['searchName']);
                      }
                    ?>
                      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                      <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
                      <script type="text/javascript">
                        $(document).ready( function () {
                          $('#scholartable').DataTable({
                            "ordering": false,
                            "searching": false
                          });
                        });
                      </script>
                      <script type="text/javascript">
                        $(document).ready( function () {
                          $('#scholartable2').DataTable({
                            "ordering": false,
                            "searching": false
                          });
                        });
                      </script>

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
