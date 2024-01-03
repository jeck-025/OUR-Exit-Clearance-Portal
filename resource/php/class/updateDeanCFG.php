<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class updateDeanCFG extends config{

    public function addUser(){
        if(Input::exists()){
            // if(Token::check(Input::get('Token'))){
            if(!empty($_POST['Token'])){
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
                            'groups'=>Input::get('group'),
                            'colleges'=> Input::get('College'),
                            'email'=> Input::get('email'),
                        ));

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                    <b>Congratulations!</b> You have successfully added a new user account.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

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

    public function setDeans(){
        $dean = $_POST['dean'];
        $id = $_POST['id'];
        $config = new config();
        $con = $config->con();

        foreach($dean as $key => $n){
        $sql = "UPDATE `collegeschool` SET `dean` = '$n' WHERE `id` = '$id[$key]'";
        $data = $con->prepare($sql);
        $data ->execute();
        }
    }

    public function setDeans2(){
        $config = new config();
        $con = $config->con();

        //set all to inactive
        $sql0 = "UPDATE `collegeschool` SET `state` = 'inactive'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();

        //set selected deans to active
        foreach($_POST['id'] as $id){
        $sql1 = "UPDATE `collegeschool` SET `state` = 'active' WHERE `id` = '$id'";
        $data1 = $con->prepare($sql1);
        $data1 ->execute();       
        }
        
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Active Deans Updated.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function addDean(){
        $name = $_POST['a_dean_name'];
        $school = $_POST['a_dean_school'];
        $config = new config();
        $con = $config->con();

        $sql0 = "INSERT INTO `collegeschool` (`college_school`, `state`, `name`) VALUES ('$school', 'inactive', '$name')";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();   

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Name Added.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function delDean(){
        $dean_id = $_POST['d_dean'];
        $config = new config();
        $con = $config->con();

        $sql0 = "DELETE FROM `collegeschool` WHERE `id` = '$dean_id'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Name Deleted.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function delUser(){
        $user_id = $_POST['d_user'];
        $config = new config();
        $con = $config->con();

        $sql0 = "DELETE FROM `tbl_accounts` WHERE `id` = '$user_id'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> User Deleted.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function delCourse(){
        $course_id = $_POST['d_course'];
        $config = new config();
        $con = $config->con();

        $sql0 = "DELETE FROM `courseschool` WHERE `id` = '$course_id'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();

        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Course Deleted.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function setRegistrar(){
        $config = new config();
        $con = $config->con();

        //set all group 2 to null
        $sql0 = "UPDATE `tbl_accounts` SET `pos` = NULL WHERE `groups` = '2'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();

        //set selected deans to active
        $id = $_POST['regselect'];
        $sql1 = "UPDATE `tbl_accounts` SET `pos` = 'reg' WHERE `id` = '$id'";
        $data1 = $con->prepare($sql1);
        $data1 ->execute();
        
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Active Registrar Updated.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    public function editUser(){
        $user_id = $_GET['id'];
        $config = new config();
        $view = new view();
        $con = $config->con();

        if(isset($_POST['updUser'])){
            $uid = $_POST['uid'];
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $userGroup = $_POST['group'];

            $sch1 = $_POST['college0'];

            if(empty($_POST['college1'])){
                $sch2 = 'NULL';
            }else{
                $sch2 = "'".$_POST['college1']."'";
            }

            if(empty($_POST['college2'])){
                $sch3 = 'NULL';
            }else{
                $sch3 = "'".$_POST['college2']."'";
            }
            
            if(isset($_POST['secSwitch'])){
                $pos = "'sec'";
            }else{
                $pos = 'NULL';
            }

            $sql1 = "UPDATE `tbl_accounts` SET `name` = '$name', `email` = '$email', `groups` = '$userGroup', `colleges` = '$sch1', `colleges0` = $sch2, `colleges1` = $sch3, `pos` = $pos WHERE `id` = '$user_id'";
            $data1 = $con->prepare($sql1);
            
            if($data1 ->execute()){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <i class='fa-solid fa-circle-check'></i> Settings Saved.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>    
                    </div>";
            }else{
                echo "Error!";
            }
        }

        if(!empty($_FILES["signature"])){
            $sign = new signature($_FILES['signature'], $_POST['signuser']);
            $sign->insertSignature();
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <i class='fa-solid fa-circle-check'></i> Signature Updated.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>    
                    </div>";
        }

        if(isset($_POST['sigclear'])){
            $sign = new signature($_POST['signature'], $_POST['signuser']);
            $sign->clearSignature();
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <i class='fa-solid fa-circle-check'></i> Signature Removed.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>    
                    </div>";
        }

        //changeP2();

        $sql0 = "SELECT * FROM `tbl_accounts` WHERE `id` = '$user_id'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();
        $result = $data0->fetchAll(PDO::FETCH_ASSOC);
            $username = $result[0]['username'];
            $name = $result[0]['name'];
            $email = $result[0]['email'];
            $groups = $result[0]['groups'];
            $college0 = $result[0]['colleges'];
            $college1 = $result[0]['colleges0'];
            $college2 = $result[0]['colleges1'];
            $pos = $result[0]['pos'];
            $signature = $result[0]['signature'];
            
            if($groups == 2){
                $ssLock = '';
                $ssMainLock = 'required';
                $poslock = 'disabled';
                $poscheck = '';
            }elseif($groups == 3){
                $ssLock = 'disabled';
                $ssMainLock = '';
                $poslock = ''; 
                    if($pos == 'sec'){
                        $poscheck = 'checked';
                    }else{
                        $poscheck = '';
                    }
            }else{
                $ssLock = 'disabled';
                $ssMainLock = '';
                $poslock = 'disabled';
                $poscheck = '';
            }

            if(empty($signature)){
                $signature = "<i>No Signature Yet.</i>";
            }else{
                $signature = "<i>Filename: ".$result[0]['signature']."</i>";
            }
            
        echo "<div class='report-dl-form mt-3'>
                <div class='col col-md-9 shadow'>
                    <div class='col col-md'>
                        <h4 class='text-center mt-4 mb-2'><i class='fa-solid fa-id-card'></i> Edit User</h4>
                            <form method='post'>
                                <table class='table mt-4'>
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-5'>
                                                    <label for = 'username' class=''> Username:</label>
                                                    <input class='form-control'  type = 'text' name='username' id='username' value ='$username' autocomplete='off' required />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-4'>
                                                    <label for = 'fullname' class=''> Name:</label>
                                                    <input class='form-control'  type = 'text' name='fullname' id='fullname' value ='$name' autocomplete='off' required />
                                                </div>
                                                <div class='form-group col-4'>
                                                    <label for = 'email' class=''> Email Address:</label>
                                                    <input class='form-control'  type = 'text' name='email' id='email' value ='$email' autocomplete='off' required />
                                                </div>
                                                <div class='form-group col-4'>
                                                    <label for='group' >Assign to User Group:</label>
                                                        <select id='group' name='group' class='form-select form-control' data-live-search='true' required>";
                                                            $view->groupSP3($groups);
                                                            $view->groupSP2();
                                                            echo "</select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-12'>
                                                    <label for='College' >Assign to School:</label>
                                                    
                                                    <select id='college0' name='college0' class='form-select form-control mt-2' data-live-search='true' $ssMainLock>";
                                                        $view->collegeSP3($college0);
                                                        $view->collegeSP2();
                                                    echo "</select>

                                                    <select id='college1' name='college1' class='form-select form-control mt-2' data-live-search='true' $ssLock>";
                                                        if(!empty($college1)){
                                                            $view->collegeSP4($college1);
                                                            $view->collegeSP2();
                                                            echo "<option data-tokens='NULL' value=''>None</option>";
                                                        }else{
                                                            echo "<option data-tokens='NULL' value=''>None</option>";
                                                            $view->collegeSP2();
                                                        }
                                                    echo "</select>

                                                    <select id='college2' name='college2' class='form-select form-control mt-2' data-live-search='true' $ssLock>";
                                                        if(!empty($college2)){
                                                            $view->collegeSP5($college2);
                                                            $view->collegeSP2();
                                                            echo "<option data-tokens='NULL' value=''>None</option>";
                                                        }else{
                                                            echo "<option data-tokens='NULL' value=''>None</option>";
                                                            $view->collegeSP2();
                                                        }
                                                    echo "</select>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-2'>
                                                    <label for='College' >For Dean's Office Use Only</label>
                                                    <div class='form-check form-switch ml-3'>
                                                        <input class='form-check-input' type='checkbox' id='secSwitch' name='secSwitch' $poslock $poscheck>
                                                        <label class='form-check-label' for='secSwitch'>Set as Office Secretary</label>
                                                    </div>
                                                </div>
                                                <div class='form-group col-2'>
                                                    <button type='submit' name='updUser' id='updUser' class='btn btn-adduser btn-block'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>
                                                    
                                                </div>
                                                <div class='form-group col-2'>
                                                    <a href='deanconfig.php' class='btn btn-danger btn-block'>Back</a>
                                                </div>
                                                <div class='form-group col-6'>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <input type='hidden' name='uid' value='$user_id'>
                                    </form>
                                </div>
                            </div>
                        </div>";
        
        // echo "<div class='report-dl-form mt-3'>
        //         <div class='col col-md-9 mb-5 shadow'>
        //             <div class='col col-md'>
        //                 <h4 class='text-center mt-4 mb-2'><i class='fa-solid fa-file-signature'></i> Change Password</h4>
        //                 <table class='table mt-4'>
        //                     <tr>
        //                         <td>
        //                             <form action='' method='POST'>
                                        
                                            
        //                                             <div class='row justify-content-center'>
        //                                                 <div class='form-group col-3'>
        //                                                     <label for = 'password_current'> Enter Current Password:</label>
        //                                                     <input type='password' class='form-control' name='password_current' id='password' value ='' autocomplete='off' required/>
        //                                                 </div>
        //                                                 <div class='form-group col-3'>
        //                                                     <label for = 'password'> Enter New Password:</label>
        //                                                     <input type='password' class='form-control' name='password' id='password' value ='' autocomplete='off' required/>
        //                                                 </div>
        //                                                 <div class='form-group col-3'>
        //                                                     <label for = 'ConfirmPassword'> Confirm New Password:</label>
        //                                                     <input type='password' class='form-control' name='ConfirmPassword' id='ConfirmPassword' value ='' autocomplete='off' required/>
        //                                                 </div>
        //                                                 <div class='form-group col-3'>
        //                                                     <input type='hidden' name='Token' value='".Token::generate()."' >
        //                                                     <input type='submit' value='Change password' class=' form-control btn btn-adduser btn-block' />
        //                                                 </div>
        //                                             </div>

                                        
        //                             </form>
        //                         </td>
        //                     </tr>
        //                 </table>
        //             </div>
        //         </div>
        //     </div>";

        echo "<div class='report-dl-form mt-3'>
                <div class='col col-md-9 mb-5 shadow'>
                    <div class='col col-md'>
                        <h4 class='text-center mt-4 mb-2'><i class='fa-solid fa-file-signature'></i> Signature</h4>
                        <table class='table mt-4'>
                            <tr>
                                <td>
                                    <form method='POST' enctype='multipart/form-data'>
                                    <div class='row justify-content-center'>
                                        $signature
                                        <input type='hidden' name='signuser' value='$username'>
                                        <label for = 'signature'> Upload Signature File:</label>
                                        <div class='col col-md-8'>
                                            <input type='file' name='signature' class='form-control'>
                                        </div>
                                        <div class='col col-md-2'>
                                            <input type='submit' value='Update Signature' name='sigupdate' class='form-control btn btn-adduser'> </form>
                                        </div>
                                        <div class='col col-md-2'>
                                            <form method='POST'>
                                            <input type='hidden' name='signature' value='$signature'>
                                            <input type='hidden' name='signuser' value='$username'>
                                            <input type='submit' value='Clear Signature' name='sigclear' class='form-control btn btn-danger'>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>";
        // die();
    }

    public function addCourse(){
        $courseName = $_POST['courseName'];
        $courseABBR = $_POST['courseABBR'];
        $courseSchool = $_POST['courseCollege'];
        $courseGroup = $_POST['courseGroup'];

        $config = new config();
        $con = $config->con();

        $sql = "SELECT `departmentABBR` FROM `courseschool` WHERE `department` = '$courseSchool' LIMIT 1";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
            $schoolABBR = $result[0]['departmentABBR'];

        $sql0 = "INSERT INTO `courseschool` (`course`, `courseABBR`, `department`, `departmentABBR`, `type`, `status`) VALUES ('$courseName', '$courseABBR', '$courseSchool', '$schoolABBR', '$courseGroup', 'Active')";
        $data0 = $con->prepare($sql0);
        
        $data0->execute();
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fa-solid fa-circle-check'></i> Course Added.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";

    }

    public function editCourse(){
        $course_id = $_GET['id'];
        $config = new config();
        $view = new view();
        $con = $config->con();

        if(isset($_POST['updCrs'])){
            $cid = $_POST['cid'];
            $crsName = $_POST['courseName'];
            $crsABBR = $_POST['courseABBR'];
            $school = $_POST['school'];
            $crsType = $_POST['type'];
              
            if(isset($_POST['activeSwitch'])){
                $crsStatus = 'Active';
            }else{
                $crsStatus = 'Inactive';
            }

            $sql = "SELECT DISTINCT `departmentABBR` from `courseschool` WHERE `department` = '$school' LIMIT 1";
            $data = $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            $deptABBR = $result[0]['departmentABBR'];

            $sql1 = "UPDATE `courseschool` SET `course` = '$crsName', `courseABBR` = '$crsABBR', `department` = '$school', `departmentABBR` = '$deptABBR', `type` = '$crsType', `status` = '$crsStatus' WHERE `id` = '$cid'";
            $data1 = $con->prepare($sql1);
            
            if($data1 ->execute()){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <i class='fa-solid fa-circle-check'></i> Settings Saved.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>    
                    </div>";
            }else{
                echo "Error!";
            }
        }

        $sql0 = "SELECT * FROM `courseschool` WHERE `id` = '$course_id'";
        $data0 = $con->prepare($sql0);
        $data0 ->execute();
        $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);
            $courseName = $result0[0]['course'];
            $courseABBR = $result0[0]['courseABBR'];
            $department = $result0[0]['department'];
            $courseType = $result0[0]['type'];
            $courseStatus = $result0[0]['status'];

            if($courseStatus == "Active"){
                $check = "checked";
            }else{
                $check = "";
            }

            
        echo "<div class='report-dl-form mt-3'>
                <div class='col col-md-9 shadow'>
                    <div class='col col-md'>
                        <h4 class='text-center mt-4 mb-2'><i class='fa-solid fa-pen-to-square'></i> Edit Course / Degree</h4>
                            <form method='post'>
                                <table class='table mt-4'>
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-8'>
                                                    <label for = 'courseName' class=''> Course / Degree Program Name:</label>
                                                    <input class='form-control'  type = 'text' name='courseName' id='courseName' value ='$courseName' autocomplete='off' required />
                                                </div>
                                                <div class='form-group col-4'>
                                                    <label for = 'courseABBR' class=''> Course / Degree Program Abbreviation:</label>
                                                    <input class='form-control'  type = 'text' name='courseABBR' id='courseABBR' value ='$courseABBR' autocomplete='off' required />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-6'>
                                                    <label for='school' >Assign to School / College:</label>
                                                    <select id='school' name='school' class='form-select form-control'>";
                                                        $view->collegeSP3($department);
                                                        $view->collegeSP2();
                                                    echo "</select>
                                                </div>
                                                <div class='form-group col-3'>
                                                    <label for='type' >Course Type:</label>
                                                    <select id='type' name='type' class='form-select form-control'>";
                                                        $view->courseSP4($course_id);
                                                        $view->courseSP5();
                                                    echo "</select>
                                                </div>
                                                <div class='form-group col-3'>
                                                    <label for='active'>Course Status: </label>
                                                    <div class='form-check form-switch ml-3'>
                                                        <input class='form-check-input' type='checkbox' id='activeSwitch' name='activeSwitch' $check>
                                                        <label class='form-check-label' for='activeSwitch'>Currently set as: <h5 class='crsStat'>$courseStatus</h5></label>
                                                        <label class='form-check-label' for='activeSwitch'>Toggle switch to change status.</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='row justify-content-center'>
                                                <div class='form-group col-4'>
                                                   
                                                </div>
                                                <div class='form-group col-2'>
                                                    <button type='submit' name='updCrs' id='updCrs' class='btn btn-adduser btn-block'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>
                                                    
                                                </div>
                                                <div class='form-group col-2'>
                                                    <a href='deanconfig.php' class='btn btn-danger btn-block'>Back</a>
                                                </div>
                                                <div class='form-group col-4'>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <input type='hidden' name='cid' value='$course_id'>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
}
?>