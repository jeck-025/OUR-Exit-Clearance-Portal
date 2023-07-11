<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailHold.php';

class restore extends config{
    public $id, $sy, $sem, $type;

    public function __construct($id=null, $sy=null, $sem=null, $type=null){
        $this->id = $id;
        $this->sy = $sy;
        $this->sem = $sem;
        $this->type = $type;
    }

        public function restoreClearanceRegistrar(){
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
        }

        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET
                `semester` = '$this->sem', `sy` = '$this->sy', `dateReq` = CURRENT_TIMESTAMP,
                `libraryclearance` = 'PENDING', `libraryremarks` = NULL, `librarydate` = NULL,
                `departmentclearance` = 'PENDING', `departmentremarks` = NULL, `departmentdate` = NULL,
                `accountingclearance` = 'PENDING', `accountingremarks` = NULL, `accountingdate` = NULL,
                `registrarclearance` = 'PENDING', `registrarremarks` = NULL, `registrardate` = NULL,
                `registrar_sra` = NULL, `acct_asst` = NULL, `lib_asst` = NULL, `dean_asst` = NULL
                WHERE `id` = '$this->id'";
        }else{
            //not yet working for undergraduates as of July 11, 2023
            // $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'ON HOLD', `registrarremarks` = '$this->remarks', `registrardate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'"; 
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
        }

        public function restorewDataClearanceRegistrar(){
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
        }

        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET
                `semester` = '$this->sem', `sy` = '$this->sy', 
                `registrarclearance` = 'PENDING', `registrarremarks` = NULL, `registrardate` = NULL
                 WHERE `id` = '$this->id'";
        }else{
            //not yet working for undergraduates as of July 11, 2023
            // $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'ON HOLD', `registrarremarks` = '$this->remarks', `registrardate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'"; 
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