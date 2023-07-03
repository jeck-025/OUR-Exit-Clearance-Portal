<?php
function CheckSuccess($status){
    if($status =='Success'){
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully submitted your request!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}

function Success(){
    echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <b>Congratulations!</b> You have successfully registered a new Student Records Assistant!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
function loginError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid username/Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
function curpassError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Current Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

function pError($error){
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <b>Error!</b> '.$error.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

function vald(){
     if(Input::exists()){
      if(Token::check(Input::get('Token'))){
         if(!empty($_POST['College'])){
             $_POST['College'] = implode(',',Input::get('College'));
         }else{
            $_POST['College'] ="";
         }
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'username'=>array(
                'required'=>'true',
                'min'=>4,
                'max'=>20,
                'unique'=>'tbl_accounts'
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            ),
            'fullName'=>array(
                'required'=>'true',
                'min'=>2,
                'max'=>50,
            ),
            'email'=>array(
                'required'=>'true'
            ),
            'College'=>array(
                'required'=>'true')
        ));

            if($validate->passed()){
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $user->create(array(
                        'username'=>Input::get('username'),
                        'password'=>Hash::make(Input::get('password'),$salt),
                        'salt'=>$salt,
                        'name'=> Input::get('fullName'),
                        'joined'=>date('Y-m-d H:i:s'),
                        'groups'=>1,
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email'),
                    ));

                    // $user->createC(array(
                    //     'checker'=> Input::get('fullName'),

                    // ));
                    // $user->createV(array(
                    //     'verifier'=> Input::get('fullName'),
                    // ));

                    // $user->createR(array(
                    //     'releasedby'=> Input::get('fullName'),

                    // ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }

                Success();
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
            }
        }
            }else{
                return false;
            }
        }

        function logd(){
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST,array(
                        'username' => array('required'=>true),
                        'password'=> array('required'=>true)
                    ));
                    if($validation->passed()){
                        $user = new user();
                        $remember = (Input::get('remember') ==='on') ? true :false;
                        $login = $user->login(Input::get('username'),Input::get('password'),$remember);
                        if($login){
                            if($user->data()->groups == 1){                     // admin
                                 Redirect::to('registrar.php');
                                echo $user->data()->groups;
                            }else if($user->data()->groups == 2){               // registrar
                                 Redirect::to('registrar.php');
                                echo $user->data()->groups;
                            }else if($user->data()->groups == 3){               // dean's offices
                                Redirect::to('dean.php');
                               echo $user->data()->groups;
                            }else if($user->data()->groups == 4){               // accounting
                            Redirect::to('accounting.php');
                           echo $user->data()->groups;
                            }else if($user->data()->groups == 5){               // guidance
                            Redirect::to('guidance.php');
                           echo $user->data()->groups;
                            }else if($user->data()->groups == 6){               // library
                                Redirect::to('library.php');
                               echo $user->data()->groups;
                            }
                            else{
                                Redirect::to('index.php');
                               echo $user->data()->groups;
                            }
                        }else{
                            loginError();
                        }
                    }else{
                        foreach($validation->errors() as $error){
                            echo $error.'<br />';
                        }
                    }
                }
            }
        }

        function isLogin(){
            $user = new user();
            if(!$user->isLoggedIn()){
                Redirect::to('adminlogin.php');
            }
        }

function profilePic(){
    $view = new view();
    if($view->getdpSRA()!=="" || $view->getdpSRA()!==NULL){
        echo "<img class='rounded-circle profpic img-thumbnail ml-3' alt='100x100' src='data:".$view->getMmSRA().";base64,".base64_encode($view->getdpSRA())."'/>";
    }else{
        echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='resource/img/user.jpg'/>";
    }
}

function updateProfile(){
    if(Input::exists()){
        if(!empty($_POST['College'])){
            $_POST['College'] = implode(',',Input::get('College'));
        }else{
           $_POST['College'] ="";
        }

        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'username'=>array(
                'required'=>'true',
                'min'=>4,
                'max'=>20,
                'unique'=>'tbl_accounts'
            ),
            'fullName'=>array(
                'required'=>'true',
                'min'=>2,
                'max'=>50,
            ),
            'email'=>array(
                'required'=>'true',
                'min'=>5,
                'max'=>50,
            ),
            'College'=>array(
                'required'=>'true'
            )));

            if($validate->passed()){
                $user = new user();

                try {
                    $user->update(array(
                        'username'=>Input::get('username'),
                        'name'=> Input::get('fullName'),
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email')
                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                Redirect::to('template.php');
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
        }

    }
}

function changeP(){
    if(Input::exists()){
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'password_current'=>array(
                'required'=>'true',
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            )));

            if($validate->passed()){
                $user = new user();
                if(Hash::make(Input::get('password_current'),$user->data()->salt) !== $user->data()->password){
                    curpassError();
                }else{
                    $user = new user();
                    $salt = Hash::salt(32);
                    try {
                        $user->update(array(
                            'password'=>Hash::make(Input::get('password'),$salt),
                            'salt'=>$salt
                        ));
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                    if($user->data()->groups == 2){
                        Redirect::to('registrar.php');
                        echo $user->data()->groups;
                    }else if($user->data()->groups == 3){
                        Redirect::to('dean.php');
                        echo $user->data()->groups;
                    }else if($user->data()->groups == 4){
                        Redirect::to('accounting.php');
                        echo $user->data()->groups;
                    }else if($user->data()->groups == 5){
                        Redirect::to('guidance.php');
                        echo $user->data()->groups;
                    }else if($user->data()->groups == 6){
                        Redirect::to('library.php');
                        echo $user->data()->groups;
                    }
                }
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
            }
        }
    }
}


function approveAccounting(){
    if(!empty($_GET['edit'])){
        $edit = new edit($_GET['edit'], $_GET['user'], $_GET['type']);
        if($edit->approveClearanceAccounting()){
        } else{
            echo "Error in approving";
        }
    }
}

function approveGuidance(){
    if(!empty($_GET['edit'])){
        $edit = new edit($_GET['edit'], $_GET['user'], $_GET['type']);
        if($edit->approveClearanceGuidance()){
        } else{
            echo "Error in approving";
        }
    }
}

function approveDepartment(){
    if(!empty($_GET['edit'])){
        $edit = new edit($_GET['edit'], $_GET['user'], $_GET['type']);
        if($edit->approveClearanceDepartment()){
        } else{
            echo "Error in approving";
        }
    }
}

function approveLibrary(){
    if(!empty($_GET['edit'])){
        $edit = new edit($_GET['edit'], $_GET['user'], $_GET['type']);
        if($edit->approveClearanceLibrary()){
        } else{
            echo "Error in approving";
        }
    }
}

function approveRegistrar(){
    if(!empty($_GET['edit'])){
        $edit = new edit($_GET['edit'], $_GET['user'],$_GET['type']);
        if($edit->approveClearanceRegistrar()){
        } else{
            echo "Error in approving";
        }
    }
}

function holdRegistrar(){
    if(isset($_POST['reset'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'],$_POST['type']);
        $hold->resetHoldClearanceRegistrar();
    }
    elseif(!empty($_POST['hold']) && !empty($_POST['remarks'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'],$_POST['type']);
        $hold->holdClearanceRegistrar();
    }
}

function holdAccounting(){
    if(isset($_POST['reset'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->resetHoldClearanceAccounting();
    }
    elseif(!empty($_POST['hold']) && !empty($_POST['remarks'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->holdClearanceAccounting();
    }
}

function holdGuidance(){
    if(isset($_POST['reset'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->resetHoldClearanceGuidance();
    }
    elseif(!empty($_POST['hold']) && !empty($_POST['remarks'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->holdClearanceGuidance();
    }
}

function holdDepartment(){
    if(isset($_POST['reset'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->resetHoldClearanceDepartment();
    }
    elseif(!empty($_POST['hold']) && !empty($_POST['remarks'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->holdClearanceDepartment();
    }
}

function holdLibrary(){
    if(isset($_POST['reset'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->resetHoldClearanceLibrary();
    }
    elseif(!empty($_POST['hold']) && !empty($_POST['remarks'])){
        $hold = new hold($_POST['hold'],$_POST['remarks'], $_POST['type']);
        $hold->holdClearanceLibrary();
    }
}

function isAdmin($user){
    if($user === "1"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function isRegistrar($user){
    if($user === "2" || $user === "1"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function isDean($user){
    if($user === "3"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function isAccounting($user){
    if($user === "4"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function isGuidance($user){
    if($user === "5"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function isLibrary($user){
    if($user === "6"){

    }
    else{
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}

function viewAccounting(){
    if(!empty($_GET['id'])){
        $info = new info($_GET['id'], $_GET['type']);
        if($info->infoAccounting()){
        }
    }
}

function viewGuidance(){
    if(!empty($_GET['id'])){
        $info = new info($_GET['id'], $_GET['type']);
        if($info->infoGuidance()){
        }
    }
}

function viewLibrary(){
    if(!empty($_GET['id'])){
        $info = new info($_GET['id'], $_GET['type']);
        if($info->infoLibrary()){
        }
    }
}

function viewRegistrar(){
    if(!empty($_GET['id'])){
        $info = new info($_GET['id'], $_GET['type']);
        if($info->infoRegistrar()){
        }
    }
}
function viewDean(){
    if(!empty($_GET['id'])){
        $info = new info($_GET['id'], $_GET['type']);
        if($info->infoDean()){
        }
    }
}

function gradInfo(){
    if (Input::exists()) {
        if(!empty($_POST['studentNumber']) && !empty($_POST['lname'])){
            if(strlen(trim($_POST['lname'])) != 0){
                Redirect::to("viewGraduate.php?studentNumber=$_POST[studentNumber]&lname=$_POST[lname]");
            }
            else{
                echo "<br>";
                echo "<b><i>**Please enter an appropriate input";
            }
        }
        else{
            echo "<br>";
            echo "<b><i>**Please enter an appropriate input";
        }
    }
}

function sendmailLibrary(){
    $send = new sendMail();
    $send->sendLibrary();
}

function sendmailDean(){
    $send = new sendMail();
    $send->sendDean();
}
function sendmailAccounting(){
    $send = new sendMail();
    $send->sendAccounting();
}

function sendmailGuidance(){
    $send = new sendMail();
    $send->sendGuidance();
}

function sendmailRegistrar(){
    $send = new sendMail();
    $send->sendRegistrar();
}

function expireLibrary(){
    if(!empty($_GET['expire'])){
        $expire = new expire($_GET['expire']);
        if($expire->expiredLibrary()){
        } else{
            echo "Error in expiring";
        }
    }
}

function expireDean(){
    if(!empty($_GET['expire'])){
        $expire = new expire($_GET['expire']);
        if($expire->expiredDean()){
        } else{
            echo "Error in expiring";
        }
    }
}

function expireAccounting(){
    if(!empty($_GET['expire'])){
        $expire = new expire($_GET['expire']);
        if($expire->expiredAccounting()){
        } else{
            echo "Error in expiring";
        }
    }
}

function expireGuidance(){
    if(!empty($_GET['expire'])){
        $expire = new expire($_GET['expire']);
        if($expire->expiredGuidance()){
        } else{
            echo "Error in expiring";
        }
    }
}

function expireRegistrar(){
    if(!empty($_GET['expire'])){
        $expire = new expire($_GET['expire']);
        if($expire->expiredRegistrar()){
        } else{
            echo "Error in expiring";
        }
    }
}

function deptImage(){
    $user = new user();
    $username = $user->data()->username;

    if($username == "SAM"){
        echo "img-am.png";
    }elseif($username == "DENT"){
        echo "img-dmd.png";
    }elseif($username == "SELAMS"){
        echo "img-elams.png";
    }elseif($username == "GRADSCH"){
        echo "img-gs.png";
    }elseif($username == "MEDICINE"){
        echo "img-med.png";
    }elseif($username == "MEDTECH"){
        echo "img-mt.png";
    }elseif($username == "NURSING"){
        echo "img-nu.png";
    }elseif($username == "NHM"){
        echo "img-nhm.png";
    }elseif($username == "OPTO"){
        echo "img-od.png";
    }elseif($username == "PHARM"){
        echo "img-pharm.png";
    }elseif($username == "SCITECH"){
        echo "img-sc.png";
    }elseif($username == "GUIDANCE"){
        echo "img-gcd.png";
    }elseif($username == "LIBRARY"){
        echo "img-lib.png";
    }else{
        echo "img-ceu.png";
    }

}

function schoolYear(){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT DISTINCT `sy` FROM `ecle_forms`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->sy . '." value="' . $row->sy . '">' . $row->sy . '</option>';
    }
  }

function schoolSelect()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT DISTINCT `departmentABBR`, `department` FROM `courseschool` ORDER BY `department` ASC";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->departmentABBR . '." value="' . $row->departmentABBR . '">' . $row->department . '</option>';
    }
  }

  function evaluatorAssignment(){
    $user = new user();
    if($user->data()->username == "EFLORENTINO"){
        $query = " AND `schoolABBR` = 'PHARMACY'";
    }elseif($user->data()->username == "CSEETIONG"){
        $query = " AND (`schoolABBR` = 'NHM' OR `schoolABBR` = 'MEDICINE' OR `schoolABBR` = 'SCITECH') ";
    }elseif($user->data()->username == "MJACOSALEM"){
        $query = " AND `schoolABBR` = 'MEDTECH'";
    }elseif($user->data()->username == "JCRUZ"){
        $query = " AND (`schoolABBR` = 'SELAMS' OR `schoolABBR` = 'OPTO') ";
    }elseif($user->data()->username == "MAPOSTOL"){
        $query = " AND `schoolABBR` = 'DENTISTRY'";
    }elseif($user->data()->username == "MFLORES"){
         $query = " AND (`schoolABBR` = 'SAM' OR `schoolABBR` = 'NURSING') ";
    }elseif($user->data()->username == "ERIVERA"){
        $query = " AND (`schoolABBR` = 'GRADSCH' OR `schoolABBR` = 'SCITECH') ";
    }elseif($user->data()->username == "JBOCO"){
        $query = " AND (`schoolABBR` = 'SAM') ";
    }else{
        $query = "";
        //for REGISTRAR and non-evaluator admin only
    }
    return $query;
  }

  function evaluatorName(){
    $user = new user();
    $evaluator_name = $user->data()->username;
    return $evaluator_name;
  }

  function acct_asstName(){
    $user = new user();
    $acct_asst_name = $user->data()->username;
    return $acct_asst_name;
  }

  function dean_asstName(){
    $user = new user();
    $dean_asst_name = $user->data()->username;
    return $dean_asst_name;
  }

  function libr_asstName(){
    $user = new user();
    $libr_asst_name = $user->data()->username;
    return $libr_asst_name;
  }

  function guid_asstName(){
    $user = new user();
    $guid_asst_name = $user->data()->username;
    return $guid_asst_name;
  }

//   function evaluatorName(){
//     $user = new user();
//     $config = new config;
//     $username = $user->data()->username;
//     $con = $config->con();
//     $sql = "SELECT `name` from `tbl_accounts` WHERE `username` = '$username'";
//     $data = $con->prepare($sql);
//     $data->execute();
//     $result = $data->fetchAll(PDO::FETCH_ASSOC);
//     $name = $result[0]['name'];
//     return $name;
//   }

//  function countSCITECH(){
//         $config = new config;
//         $con = $config->con();
//         $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'SCITECH'";
//         $data = $con-> prepare($sql);
//         $data ->execute();
//         $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
//         return $rows[0]['count'];
//     }

// function countSAM(){
//         $config = new config;
//         $con = $config->con();
//         $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'SAM'";
//         $data = $con-> prepare($sql);
//         $data ->execute();
//         $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
//         return $rows[0]['count'];
//     }

 ?>
