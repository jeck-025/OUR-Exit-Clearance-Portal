<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class updateDeanCFG extends config{

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
}
?>