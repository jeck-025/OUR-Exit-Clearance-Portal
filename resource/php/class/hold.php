<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailHold.php';

class hold extends config{
    public $id, $remarks;

    public function __construct($id=null, $remarks=null){
        $this->id = $id;
        $this->remarks = $remarks;
    }

    public function holdClearanceAccounting(){
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
        }
        $office = "Accounting";
        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'ON HOLD', `accountingremarks` = '$this->remarks', `accountingdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceAccounting(){
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
        }

        $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'PENDING', `accountingremarks` = NULL, `accountingdate` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceDepartment(){
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
            $office = $row['school'];
        }
        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'ON HOLD', `departmentremarks` = '$this->remarks', `departmentdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true; 
        }else{
            return false;
        }
    }

    public function resetHoldClearanceDepartment(){
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
        }

        $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'PENDING', `departmentremarks` = NULL, `departmentdate` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceLibrary(){
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
        }
        $office = "Library";
        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'ON HOLD', `libraryremarks` = '$this->remarks', `librarydate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceLibrary(){
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
        }

        $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'PENDING', `libraryremarks` = NULL, `librarydate` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceRegistrar(){
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
        }
        $office = "Registrar";
        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'ON HOLD', `registrarremarks` = '$this->remarks', `registrardate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }

    }
    public function resetHoldClearanceRegistrar(){
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
        }

        $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'PENDING', `registrarremarks` = NULL, `registrardate` = NULL WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>