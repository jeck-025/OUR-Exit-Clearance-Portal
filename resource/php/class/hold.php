<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailHold.php';

class hold extends config{
    public $id, $remarks, $type;

    public function __construct($id=null, $remarks=null, $type=null){
        $this->id = $id;
        $this->remarks = $remarks;
        $this->type = $type;
    }

    public function holdClearanceAccounting(){
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
        $office = "Accounting";
        
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($this->type == "Graduate"){
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

    public function resetHoldClearanceAccounting(){
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

    public function holdClearanceGuidance(){
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
        $office = "Guidance";
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($this->type == "Graduate"){
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

    public function resetHoldClearanceGuidance(){
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

    public function holdClearanceDepartment(){
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
            $office = $row['school'];
        }

        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($this->type == "Graduate"){
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

    public function resetHoldClearanceDepartment(){
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

    public function holdClearanceLibrary(){
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
        $office = "Library";
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($this->type == "Graduate"){
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

    public function resetHoldClearanceLibrary(){
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
        $office = "Registrar";
        //sendOnHoldMail($email, $this->remarks, $lname, $fname, $mname, $office);

        if($this->type == "Graduate"){
            $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'ON HOLD', `registrarremarks` = '$this->remarks', `registrardate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'ON HOLD', `registrarremarks` = '$this->remarks', `registrardate` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'"; 
        }
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetHoldClearanceRegistrar(){
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
            $sql = "UPDATE `ecle_forms` SET `registrarclearance` = 'PENDING', `registrarremarks` = NULL, `registrardate` = NULL WHERE `id` = '$this->id'";
        }else{
            $sql = "UPDATE `ecle_forms_ug` SET `registrarclearance` = 'PENDING', `registrarremarks` = NULL, `registrardate` = NULL WHERE `id` = '$this->id'";
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