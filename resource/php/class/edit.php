<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailApproved.php';

class edit extends config{
    public $id;
    public $user;
    public $type;

    public function __construct($id = null, $user = null, $type = null){
        $this->id = $id;
        $this->user = $user;
        $this->type = $type;
    }

    public function approveClearanceAccounting(){
        $con = $this->con();
        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'CLEARED', `accountingremarks` = '', `accountingdate` = CURRENT_TIMESTAMP, `acct_asst` = '$this->user' WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `accountingclearance` = 'CLEARED', `accountingremarks` = '', `accountingdate` = CURRENT_TIMESTAMP, `acct_asst` = '$this->user' WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceGuidance(){
        $con = $this->con();
        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `guidanceclearance` = 'CLEARED', `guidanceremarks` = '', `guidancedate` = CURRENT_TIMESTAMP, `guid_asst` = '$this->user' WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `guidanceclearance` = 'CLEARED', `guidanceremarks` = '', `guidancedate` = CURRENT_TIMESTAMP, `guid_asst` = '$this->user' WHERE `id` = '$this->id'";
        }
        
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceDepartment(){
        $con = $this->con();
        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'CLEARED', `departmentremarks` = '', `departmentdate` = CURRENT_TIMESTAMP, `dean_asst` = '$this->user' WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `departmentclearance` = 'CLEARED', `departmentremarks` = '', `departmentdate` = CURRENT_TIMESTAMP, `dean_asst` = '$this->user' WHERE `id` = '$this->id'";
        }
       
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceLibrary(){
        $con = $this->con();
        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'CLEARED', `libraryremarks` = '', `librarydate` = CURRENT_TIMESTAMP, `lib_asst` = '$this->user' WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `libraryclearance` = 'CLEARED', `libraryremarks` = '', `librarydate` = CURRENT_TIMESTAMP, `lib_asst` = '$this->user' WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function approveClearanceRegistrar(){
        $con = $this->con();

        if($this->type == "Graduate"){
            $sql2 = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
            $sql2 = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
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
        sendmailApproved($email, $lname, $fname, $mname, $tn, $this->type);

        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'CLEARED', `registrarremarks` = '', `registrardate` = CURRENT_TIMESTAMP, `registrar_sra` = '$this->user' WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'CLEARED', `registrarremarks` = '', `registrardate` = CURRENT_TIMESTAMP, `registrar_sra` = '$this->user' WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

        public function removeClearanceRegistrar(){
        $con = $this->con();



        // echo "execute sql now";
        // die();

        if($this->type == "Graduate"){
            $sql2 = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
            $sql2 = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
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

        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'REMOVED', `registrarremarks` = '', `registrar_sra` = '$this->user' WHERE `id` = '$this->id'";

        }else{ 
            //not yet working for undergraduates as of July 11, 2023
            // $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'CLEARED', `registrarremarks` = '', `registrardate` = CURRENT_TIMESTAMP, `registrar_sra` = '$this->user' WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>