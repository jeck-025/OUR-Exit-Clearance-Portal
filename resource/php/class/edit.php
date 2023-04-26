<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailApproved.php';

class edit extends config{
    public $id;
    public $user;

    public function __construct($id = null, $user = null){
        $this->id = $id;
        $this->user = $user;
    }

    public function approveClearanceAccounting(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'CLEARED', `accountingremarks` = '', `accountingdate` = CURRENT_TIMESTAMP, `acct_asst` = '$this->user' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceDepartment(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'CLEARED', `departmentremarks` = '', `departmentdate` = CURRENT_TIMESTAMP, `dean_asst` = '$this->user' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceLibrary(){
        $con = $this->con();
        $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'CLEARED', `libraryremarks` = '', `librarydate` = CURRENT_TIMESTAMP, `lib_asst` = '$this->user' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceRegistrar(){
        $con = $this->con();

        $sql2 = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $result = $data2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $email = $row['email'];
            $lname = $row['lname'];
            $fname = $row['fname'];
            $mname = $row['mname'];
            $tn = $row['referenceID'];
        }
        sendmailApproved($email, $lname, $fname, $mname, $tn);

        $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'CLEARED', `registrarremarks` = '', `registrardate` = CURRENT_TIMESTAMP, `registrar_sra` = '$this->user' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>