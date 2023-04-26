<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailApproved.php';

class expire extends config{
    public $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function expiredAccounting(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `expiry` = 'YES', `studentID` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function expiredLibrary(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `expiry` = 'YES', `studentID` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function expiredDean(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `expiry` = 'YES', `studentID` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function expiredRegistrar(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `expiry` = 'YES', `studentID` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

}

?>