<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isRegistrar($user->data()->groups);
$import = new import();
$view = new view();
$update = new updateDeanCFG();
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
                    <li><a href="adminconfig.php" class="dropdown-item">Config</a></li>
                    <li><a href="changepasswordRegistrar.php" class="dropdown-item">Setting</a></li>
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

              <div class="accordion" id="accordionExample">
                <?php 
                  if(isset($_POST['updatedeanCFG'])){ 
                    $update->setDeans2(); 
                  }

                  if(isset($_POST['updatedeanCFGAdd'])){
                    $update->addDean(); 
                  }

                  if(isset($_POST['courseNewSubmit'])){
                    $update->addCourse(); 
                  }

                  if(isset($_POST['updatedeanCFGDel'])){
                    $update->delDean(); 
                  }

                  if(isset($_POST['updatedeanCFGRegUpd'])){
                    $update->setRegistrar(); 
                  }

                  if(isset($_POST['userDel'])){
                    $update->delUser(); 
                  }

                  if(isset($_POST['userEdit'])){
                    $id = $_POST['d_user'];
                    $url = 'edituser.php?id='.$id;
                    echo '<script> window.location ="'.$url.'"</script>';
                  }

                  if(isset($_POST['courseEdit'])){
                    $id = $_POST['d_course'];
                    $url = 'editcourse.php?id='.$id;
                    echo '<script> window.location ="'.$url.'"</script>';
                  }
                  
                  if(!empty($_POST['mailer-username']) && !empty($_POST['mailer-password'])){
                    $updateMailer = new updateMailer($_POST['mailer-username'], $_POST['mailer-password'], $_POST['mailer-port'], $_POST['mailer-platform']);
                    $updateMailer->updateMailerConfig();

                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong><i class='fa-solid fa-circle-check'></i> Mailer Config Updated</strong><br>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                  }
                ?>

                <h4 class="text-center m-3">Dept. Heads Configuration</h4><hr>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingZero">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                      Set Active Registrar
                    </button>
                  </h2>
                  <div id="collapseZero" class="accordion-collapse collapse" aria-labelledby="headingZero" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="import-grad-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                          <h4>Set Active Registrar</h4><hr>
                          <div class='input-group col-md-12'>
                            <div class="col col-md text-center">
                              <form method='post'>
                                  
                                    <?php $view->loadReg2(); ?>

                                <button type='submit' name='updatedeanCFGRegUpd' id='updatedeanCFGRegUpd' class='btn btn-adduser'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Set Active Deans
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="import-grad-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                            <h4>Set Active Deans</h4><hr>
                            <div class='input-group col-md-12'>
                              <div class="col col-md text-center">
                                <form method='post'>
                                  <table id='scholartable' class='table table-hover table-striped table-borderless table-sm table-dean'>
                                    <tr>
                                      <th width='50%'><h5>College / School</h5></th>
                                      <th width='50%'><h5>Active Dean</h5></th>
                                    </tr> 
                                    <?php $view->loadDeans2(); ?>
                                  </table>
                                  <button type='submit' name='updatedeanCFG' id='updatedeanCFG' class='btn btn-adduser'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>
                                </form>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Add / Remove Dean
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="semester-config-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 shadow">
                          <div class="col col-md">
                            
                            <div class='input-group col-md-12'>
                              <div class="col col-md">
                                <form method='post'>
                                  <div class="row">
                                    <h4 class="text-center">Add Dean</h4><hr>
                                    <div class="col col-md-10">
                                      <label for="a_dean_name" class="form-label">Name</label>
                                      <input type="text" name="a_dean_name" class="form-control" placeholder="Name" autocomplete="off">
                                    </div>
                                  </div>

                                  <div class="row mt-3">
                                    <div class="col col-md-10">
                                      <label for="a_dean_school" class="form-label">Assign to:</label>
                                      <select name="a_dean_school" class="form-select form-control" data-live-search="true">
                                        <?php $view->collegeSP2();?>
                                      </select>
                                    </div>
                                  
                                    <div class="col-md-2 text-center">
                                      <label for="s_submit" class="form-label">&nbsp;</label>
                                      <button type="submit" id="updatedeanCFGAdd" name="updatedeanCFGAdd" class="btn btn-adduser btn-block"><i class="fa-solid fa-floppy-disk"></i> Save </button>
                                    </div>
                                  </div>
                                </form>

                                <form method="post">
                                  <div class="row mt-5 mb-3">
                                    <h4 class="text-center">Remove Dean</h4><hr>
                                    <div class="col col-md-10">
                                      <label for="d_dean" class="form-label">Name</label>
                                      <?php $view->loadDeans3(); ?>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <label for="s_submit" class="form-label">&nbsp;</label>
                                      <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#deanDelModal"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="deanDelModal" tabindex="-1" aria-labelledby="deanDelModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="#deanDelModalLabel">Confirm</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Delete Name? <br>
                                          This cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" id="updatedeanCFGDel" name="updatedeanCFGDel" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion" id="accordionExample2">
              <h4 class="text-center m-4">User Configuration</h4><hr>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Add User Account
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                    <div class="accordion-body">
                      <div class="report-dl-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                          <div class="col col-md text-center">
                            <?php vald(); ?>
                               <h4>Add User</h4><hr>
                                  <form action="" method="post">
                                    <table class="table ">
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="form-group col-4">
                                                    <label for = "username" class=""> Username:</label>
                                                    <input class="form-control"  type = "text" name="username" id="username" value ="<?php echo input::get('username');?>" autocomplete="off" required />
                                                    </div>
                                                    <div class="form-group col-4">
                                                    <label for = "password"> Password:</label>
                                                    <input type="password" class="form-control" name="password" id="password" value ="<?php echo input::get('password');?>" autocomplete="off"required/>
                                                    </div>
                                                    <div class="form-group col-4">
                                                    <label for = "ConfirmPassword"> Confirm Password:</label>
                                                    <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" value ="<?php echo input::get('ConfirmPassword');?>" autocomplete="off"required/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="form-group col-6">
                                                    <label for = "fullName" class=""> Full Name</label>
                                                    <input class="form-control"  type = "text" name="fullName" id="fullName" value ="<?php echo input::get('fullName');?>"/required>
                                                    </div>
                                                    <div class="form-group col-6">
                                                    <label for = "email" class=""> Email Address</label>
                                                    <input class="form-control"  type = "text" name="email" id="email" value ="<?php echo input::get('email');?>"/required>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
   
                                                    <div class="form-group col-6">
                                                      <label for="College" >Assign to School:</label>
                                                          <select id="College" name="College[]" class="form-select form-control" data-live-search="true" required>
                                                            <?php $view->collegeSP2();?>
                                                          </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                      <label for="College" >Assign to User Group:</label>
                                                          <select id="Group" name="group" class="form-select form-control" data-live-search="true" required>
                                                            <?php $view->groupSP2();?>
                                                          </select>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="form-group col-7">
                                                        <label  >&nbsp;</label>
                                                    <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                                    <input type="submit" value="Add New Account" class=" form-control btn btn-adduser" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Edit / Remove User Account
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                    <div class="accordion-body">
                      <div class="report-dl-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 shadow">
                          <div class="col col-md">
                            <div class='input-group col-md-12'>
                              <div class="col col-md">
                                <form method="post">
                                  <div class="row mb-3">
                                    <h4 class="text-center">Edit / Remove User</h4><hr>
                                    <div class="col col-md-8">
                                      <label for="d_user" class="form-label">Name</label>
                                      <?php $view->loadUserAcct(); ?>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <label for="userEdit" class="form-label">&nbsp</label>
                                        <button type="submit" class="btn btn-editButtons btn-block" name="userEdit" id="userEdit"><i class="fa-solid fa-user-pen"></i> Edit</button>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <label for="userEdit" class="form-label">&nbsp</label>
                                        <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#userDelModal"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="userDelModal" tabindex="-1" aria-labelledby="userDelModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="#userDelModalLabel">Confirm</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Delete User? <br>
                                          This cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" id="userDel" name="userDel" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- NEW SET -->
              <div class="accordion" id="accordionExample3">
              <h4 class="text-center m-4">Course Management</h4><hr>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Add Course
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample3">
                    <div class="accordion-body">
                      <div class="report-dl-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 text-center shadow">
                          <div class="col col-md text-center">
                            
                               <h4>Add Course</h4><hr>
                                  <form action="" method="post">
                                    <table class="table ">
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="form-group col-8">
                                                      <label for = "courseName" class=""> Course</label>
                                                      <input class="form-control"  type = "text" name="courseName" id="courseName" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group col-4">
                                                      <label for = "courseABBR" class=""> Course Abbreviaton</label>
                                                      <input class="form-control"  type = "text" name="courseABBR" id="courseABBR" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
   
                                                    <div class="form-group col-8">
                                                      <label for="courseCollege" >Assign to School:</label>
                                                          <select id="courseCollege" name="courseCollege" class="form-select form-control" data-live-search="true" required>
                                                            <?php $view->collegeSP2();?>
                                                          </select>
                                                    </div>
                                                    <div class="form-group col-4">
                                                      <label for="courseGroup" >Assign to Course Group:</label>
                                                          <select id="courseGroup" name="courseGroup" class="form-select form-control" data-live-search="true" required>
                                                            <option value="Non-Science">Non-Science</option>
                                                            <option value="Science">Science</option>
                                                          </select>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="form-group col-7">
                                                        <label  >&nbsp;</label>
                                                    <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                                    <input type="submit" value="Add New Course" class=" form-control btn btn-adduser" name="courseNewSubmit" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Edit / Remove Course
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample3">
                    <div class="accordion-body">
                      <div class="report-dl-form">
                        <div class="col col-md-9 pt-3 pb-3 mb-3 shadow">
                          <div class="col col-md">
                            <div class='input-group col-md-12'>
                              <div class="col col-md">
                                <form method="post">
                                  <div class="row mb-3">
                                    <h4 class="text-center">Edit / Remove Course</h4><hr>
                                    <div class="col col-md-8">
                                      <label for="d_course" class="form-label">Course Name</label>
                                      <div class='form-group mb-0'>
                                        <select name='d_course' class='form-control form-select form-select-sm'>
                                        <?php $view->courseSP3(); ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <label for="courseEdit" class="form-label">&nbsp</label>
                                        <button type="submit" class="btn btn-editButtons btn-block" name="courseEdit" id="courseEdit"><i class="fa-solid fa-user-pen"></i> Edit</button>
                                    </div>
                                    <div class="col-md-2 text-center">
                                      <label for="courseDelete" class="form-label">&nbsp</label>
                                        <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#courseDelModal"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="courseDelModal" tabindex="-1" aria-labelledby="courseDelModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="#courseDelModalLabel">Confirm</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Delete Course? <br>
                                          This cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" id="courseDel" name="courseDel" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              

                
              <h4 class="text-center m-4">Mailer Configuration</h4><hr>
              <div class="accordion" id="accordionExample4">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      Mailer Credentials
                    </button>
                  </h2>
                  <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample4">
                    <div class="accordion-body">
                      <div class="report-dl-form">
                        <div class="col col-md-12 pt-3 pb-4 mb-3 text-center shadow">
                          <div class="col col-md text-center">
                            <div class="mailer-config-form">
                              <div class="col col-md-9 pt-3 pb-3 text-center shadow">
                                <form method="post">
                                  <div class="row">
                                    <div class="col">
                                      <h4>Mailer Settings</h4><hr>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <?php
                                      $mailerData = $view->viewConfigMailer();
                                      $mailerUsername = $mailerData[0];
                                      $mailerPassword = $mailerData[1];
                                      $mailerPlatform = $mailerData[2];
                                      $mailerPort = $mailerData[3];
                                    ?>
                                    <div class="col col-md-3">
                                      <label for="mailer-username" class="form-label">Username / Email Address</label>
                                      <input type="text" id="mailer-username" name="mailer-username" class="form-control" autocomplete="off" value="<?php echo "$mailerUsername"; ?>" required>
                                    </div>
                                    <div class="col col-md-3">
                                      <label for="mailer-password" class="form-label">App Password</label>
                                      <input type="password" id="mailer-password" name="mailer-password" class="form-control" autocomplete="off" value="<?php echo "$mailerPassword"; ?>" required>
                                    </div>
                                    <div class="col col-md-3">
                                      <label for="mailer-platform" class="form-label">Platform</label>
                                      <input type="text" name="mailer-platform" id="mailer-platform" class="form-control" autocomplete="off" value="<?php echo "$mailerPlatform"; ?>" required>
                                    </div>
                                    <div class="col col-md-1">
                                      <label for="mailer-port" class="form-label">Port</label>
                                      <input type="text" name="mailer-port" id="mailer-port" class="form-control" autocomplete="off" value="<?php echo "$mailerPort"; ?>" required>
                                    </div>
                                    <div class="col col-md-2">
                                      <label for="mailer_info_update" class="form-label">&nbsp;</label>
                                      <button type="submit" id="mailer_info_update" class="btn btn-dark btn-block" onClick="btnSaveMailer()"><i class="fa-solid fa-floppy-disk"></i> Save </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      var el = document.getElementById("wrapper")
      var toggleButton = document.getElementById("menu-toggle")

      toggleButton.onclick = function(){
        el.classList.toggle("toggled")    
      }

      function btnSaveMailer(){
        mailer_info_update.innerHTML = '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Saving...';
      }

    </script>
  </body>
</html>
