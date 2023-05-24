<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailHold.php';

class hold extends config{
    public $id, $remarks;

    public function __construct($id=null, $remarks=null){
        $this->id = $id;
        $this->remarks = $remarks;
    }

    public function holdClearanceAccounting($gettype){
        $con = $this->con();

        if($gettype == "Graduate"){
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
        $office = "Accounting";
        
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'ON HOLD', `accountingremarks` = '$this->remarks', `accountingdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `accountingclearance` = 'ON HOLD', `accountingremarks` = '$this->remarks', `accountingdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceAccounting($gettype){
        $con = $this->con();

         if($gettype == "Graduate"){
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

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `accountingclearance` = 'PENDING', `accountingremarks` = NULL, `accountingdate` = NULL WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `accountingclearance` = 'PENDING', `accountingremarks` = NULL, `accountingdate` = NULL WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceGuidance($gettype){
        $con = $this->con();

        if($gettype == "Graduate"){
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
        $office = "Guidance";
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `guidanceclearance` = 'ON HOLD', `guidanceremarks` = '$this->remarks', `guidancedate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `guidanceclearance` = 'ON HOLD', `guidanceremarks` = '$this->remarks', `guidancedate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }
        
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceGuidance($gettype){
        $con = $this->con();

        if($gettype == "Graduate"){
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

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `guidanceclearance` = 'PENDING', `guidanceremarks` = NULL, `guidancedate` = NULL WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `guidanceclearance` = 'PENDING', `guidanceremarks` = NULL, `guidancedate` = NULL WHERE `id` = '$this->id'";
        }

        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceDepartment($gettype){
        $con = $this->con();
        if($gettype == "Graduate"){
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
            $office = $row['school'];
        }

        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'ON HOLD', `departmentremarks` = '$this->remarks', `departmentdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `departmentclearance` = 'ON HOLD', `departmentremarks` = '$this->remarks', `departmentdate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true; 
        }else{
            return false;
        }
    }

    public function resetHoldClearanceDepartment($gettype){
        $con = $this->con();
        if($gettype == "Graduate"){
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

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `departmentclearance` = 'PENDING', `departmentremarks` = NULL, `departmentdate` = NULL WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `departmentclearance` = 'PENDING', `departmentremarks` = NULL, `departmentdate` = NULL WHERE `id` = '$this->id'";
        }
        
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function holdClearanceLibrary($gettype){
        $con = $this->con();

        if($gettype == "Graduate"){
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
        $office = "Library";
        sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'ON HOLD', `libraryremarks` = '$this->remarks', `librarydate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `libraryclearance` = 'ON HOLD', `libraryremarks` = '$this->remarks', `librarydate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceLibrary($gettype){
        $con = $this->con();

        if($gettype == "Graduate"){
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

        if($gettype == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `libraryclearance` = 'PENDING', `libraryremarks` = NULL, `librarydate` = NULL WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `libraryclearance` = 'PENDING', `libraryremarks` = NULL, `librarydate` = NULL WHERE `id` = '$this->id'";
        }
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