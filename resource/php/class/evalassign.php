<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class evalassign extends config{

    public function evaluatorAssignment2UG(){
        $user = new user();
        $username = $user->data()->username;
        
        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function evaluatorAssignment2UGPD(){
        $user = new user();
        $username = $user->data()->username;

        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `guidanceclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC;";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `guidanceclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC;";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `guidanceclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC;";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `guidanceclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` ='$college' ORDER BY `dateReq` ASC;";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms_ug` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `guidanceclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC;";
        }
        return $query;
    }

    public function evaluatorAssignment2GD(){
        $user = new user();
        $username = $user->data()->username;

        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function evaluatorAssignment2GDPD(){
        $user = new user();
        $username = $user->data()->username;

        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC;";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC;";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC;";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` ='$college' ORDER BY `dateReq` ASC;";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms` WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR `departmentclearance` NOT LIKE 'CLEARED' OR `accountingclearance` NOT LIKE 'CLEARED') AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC;";
        }
        return $query;
    }

    public function tableRegistrarClearedGD(){
        $user = new user();
        $username = $user->data()->username;

         if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function tableRegistrarClearedUG(){
        $user = new user();
        $username = $user->data()->username;

         if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function tableRegistrarHoldGD(){
        $user = new user();
        $username = $user->data()->username;

         if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function tableRegistrarHoldUG(){
        $user = new user();
        $username = $user->data()->username;

         if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                    // 3 college
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                    // 2 college
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                    // 1 college
                }else{
                    // error
                }
        }else{
            $query = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
        }
        return $query;
    }

    public function countTotalRegistrarGD(){
        $user = new user();
        $username = $user->data()->username;

        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                }else{
                    //error
                }
        }else{
            $query = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO'";
        }

        $con = $this->con();
        $data= $con->prepare($query);
        $data->execute();
        $count = $data->fetchColumn();

        return $count;
    }

    public function countTotalRegistrarUG(){
        $user = new user();
        $username = $user->data()->username;

        if($user->data()->groups == '2'){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_accounts` WHERE `username` = '$username'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
                $college = $result[0]['colleges'];
                $college0 = $result[0]['colleges0'];
                $college1 = $result[0]['colleges1'];

                if(!empty($college1) && !empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0', '$college1') ORDER BY `dateReq` ASC";
                }elseif(empty($college1) && !empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college0') ORDER BY `dateReq` ASC";
                }elseif(!empty($college1) && empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` IN ('$college', '$college1') ORDER BY `dateReq` ASC";
                }elseif(empty($college1) && empty($college0)){
                    $query = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `school` = '$college' ORDER BY `dateReq` ASC";
                }else{
                    //error
                }
        }else{
            $query = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO'";
        }

        $con = $this->con();
        $data= $con->prepare($query);
        $data->execute();
        $count = $data->fetchColumn();

        return $count;
    }

    public function countTotalRegistrar(){
        $count = new evalassign();

        $con = $this->con();
        $GD = $count->countTotalRegistrarGD();
        $UG = $count->countTotalRegistrarUG();

        $count = $GD + $UG;

        return $count;
    }
}
