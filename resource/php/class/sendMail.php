<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailAccounts.php';

class sendMail extends config{

    public $student;

    // public function sendLibrary(){
    //     $config = new config;
    //     $con = $config->con();
    //     $sql = "SELECT * FROM `ecle_forms` WHERE `libraryclearance` = 'PENDING'";
    //     $data = $con->prepare($sql);
    //     $data->execute();
    //     $arr = array();
    //     $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result as $row){
    //         $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
    //     }

    //     $sql2 = "SELECT * FROM `tbl_accounts` WHERE `groups` = 6";
    //     $data2 = $con->prepare($sql2);
    //     $data2->execute();
    //     $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result2 as $row2){
    //         $email = $row2['email'];
    //         $username = $row2['username'];
    //     }
    //     sendmailAccounts($email, $username, $arr);
    // }

    // public function sendGuidance(){
    //     $config = new config;
    //     $con = $config->con();
    //     $sql = "SELECT * FROM `ecle_forms` WHERE `guidanceclearance` = 'PENDING'";
    //     $data = $con->prepare($sql);
    //     $data->execute();
    //     $arr = array();
    //     $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result as $row){
    //         $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
    //     }

    //     $sql2 = "SELECT * FROM `tbl_accounts` WHERE `groups` = 5";
    //     $data2 = $con->prepare($sql2);
    //     $data2->execute();
    //     $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result2 as $row2){
    //         $email = $row2['email'];
    //         $username = $row2['username'];
    //     }
    //     sendmailAccounts($email, $username, $arr);
    // }

    public function sendDean(){
        $config = new config;

        $con = $config->con();
        $sql2 = "SELECT `username` FROM `tbl_accounts` WHERE `groups` = 3";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $usernames = array();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        foreach($result2 as $username){
            $usernames[] = $username;
        }

        $con = $config->con();
        $sql3 = "SELECT `email` FROM `tbl_accounts` WHERE `groups` = 3";
        $data3 = $con->prepare($sql3);
        $data3->execute();
        $emails = array();
        $result3 = $data3->fetchAll(PDO::FETCH_ASSOC);
        foreach($result3 as $email){
            $emails[] = $email;
        }

        $con = $config->con();
        $sql4 = "SELECT `colleges` FROM `tbl_accounts` WHERE `groups` = 3";
        $data4 = $con->prepare($sql4);
        $data4->execute();
        $colleges = array();
        $result4 = $data4->fetchAll(PDO::FETCH_ASSOC);
        foreach($result4 as $college){
            $colleges[] = $college;
        }
        
        $collegeItem = "";
        $emailItem = "";
        $usernameItem = "";
        $arrlength = count($colleges);
        for($i = 0; $i < $arrlength; $i++){
            $college = $colleges[$i];
            $collegeItem = implode(" ",$college);
            
            $email = $emails[$i];
            $emailItem = implode(" ",$email);
            
            $username = $usernames[$i];
            $usernameItem = implode(" ",$college);
            
            $con = $config->con();
            $sql = "SELECT * FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `school` = '$collegeItem' AND `expiry` = 'NO'";
            
            $data = $con->prepare($sql);
            $data->execute();
            
            $arr = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)){
                continue;
            }
            else {
                foreach($result as $row){
                    $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
                }
                sendmailAccountsDean($emailItem, $usernameItem, $arr);
            }
            
          }
    }

    // public function sendAccounting(){
    //     $config = new config;
    //     $con = $config->con();
    //     $sql = "SELECT * FROM `ecle_forms` WHERE `accountingclearance` = 'PENDING'";
    //     $data = $con->prepare($sql);
    //     $data->execute();
    //     $arr = array();
    //     $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result as $row){
    //         $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
    //     }

    //     $sql2 = "SELECT * FROM `tbl_accounts` WHERE `groups` = 4";
    //     $data2 = $con->prepare($sql2);
    //     $data2->execute();
    //     $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result2 as $row2){
    //         $email = $row2['email'];
    //         $username = $row2['username'];
    //     }
    //     sendmailAccounts($email, $username, $arr);
    // }


    public function sendLibrary(){
        $config = new config;
        $con = $config->con();

        //undergraduate
        // PENDING
        $sql = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `guidanceclearance` = 'CLEARED' AND `libraryclearance` = 'PENDING'";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        $countLibraryUG = $result[0]['count'];

        //ONHOLD
        $sql2 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `guidanceclearance` = 'CLEARED' AND `libraryclearance` = 'ON HOLD'";
        $data2 = $con->prepare($sql);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        $countLibraryUGH = $result2[0]['count'];
        
        //graduate
        //PENDING
        $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `libraryclearance` = 'PENDING'";
        $data1 = $con->prepare($sql1);
        $data1->execute();
        $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        $countLibraryGD = $result1[0]['count'];

        //HOLD
        $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `libraryclearance` = 'ON HOLD'";
        $data1 = $con->prepare($sql1);
        $data1->execute();
        $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        $countLibraryGDH = $result1[0]['count'];

        mailerLibrary($countLibraryGD, $countLibraryUG, $countLibraryGDH, $countLibraryUGH);
    }

    public function sendAccounting(){
        $config = new config;
        $con = $config->con();

        //undergraduate
        // PENDING
        $sql = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `libraryclearance` = 'CLEARED' AND `accountingclearance` = 'PENDING'";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        $countAcctgUG = $result[0]['count'];

        //ONHOLD
        $sql2 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `libraryclearance` = 'CLEARED' AND `accountingclearance` = 'ON HOLD'";
        $data2 = $con->prepare($sql);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        $countAcctgUGH = $result2[0]['count'];
        
        //graduate
        //PENDING
        $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `accountingclearance` = 'PENDING'";
        $data1 = $con->prepare($sql1);
        $data1->execute();
        $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        $countAcctgGD = $result1[0]['count'];

        //HOLD
        $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `accountingclearance` = 'ON HOLD'";
        $data1 = $con->prepare($sql1);
        $data1->execute();
        $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        $countAcctgGDH = $result1[0]['count'];

        mailerAccounting($countAcctgGD, $countAcctgUG, $countAcctgGDH, $countAcctgUGH);
    }
    
    public function sendGuidance(){
        $config = new config;
        $con = $config->con();

        //undergraduate
        // PENDING
        $sql = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'CLEARED' AND `guidanceclearance` = 'PENDING'";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        $countGuidUG = $result[0]['count'];

        //ONHOLD
        $sql2 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'CLEARED' AND `guidanceclearance` = 'ON HOLD'";
        $data2 = $con->prepare($sql);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        $countGuidUGH = $result2[0]['count'];
        
        //graduate
        //PENDING
        // $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `guidanceclearance` = 'PENDING'";
        // $data1 = $con->prepare($sql1);
        // $data1->execute();
        // $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        // $countAcctgGD = $result1[0]['count'];

        //HOLD
        // $sql1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `guidanceclearance` = 'ON HOLD'";
        // $data1 = $con->prepare($sql1);
        // $data1->execute();
        // $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        // $countAcctgGDH = $result1[0]['count'];

        mailerGuidance($countGuidUG, $countGuidUGH);
    }

    public function sendRegistrar(){
        $config = new config;
        $con = $config->con();

        //undergraduate
        // PENDING
        $sql = "SELECT `school`, count(*) as `count` FROM `ecle_forms_ug` WHERE `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' GROUP BY `school`";
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result)){
            foreach ($result as $data){
                $ugPendingSch[] = $data['school'];
                $ugPendingCT[] = $data['count'];
            }
        }else{
            $ugPendingSch[] = 0;
            $ugPendingCT[] = 0;
        }

        //ONHOLD
        $sql2 = "SELECT `school`, count(*) as `count` FROM `ecle_forms_ug` WHERE `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'ON HOLD' GROUP BY `school`";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        
        if(!empty($result2)){
            foreach ($result2 as $data2){
                $ugHoldSch[] = $data2['school'];
                $ugHoldCT[] = $data2['count'];
            }
        }else{
            $ugHoldSch = 0;
            $ugHoldCT = 0;
        }
        
        //graduate
        //PENDING
        $sql1 = "SELECT `school`, count(*) as `count` FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' GROUP BY `school`";
        $data1 = $con->prepare($sql1);
        $data1->execute();
        $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
        
        if(!empty($result1)){
            foreach ($result1 as $data1){
                $gdPendingSch[] = $data1['school'];
                $gdPendingCT[] = $data1['count'];
            }
        }else{
            $gdPendingSch[] = 0;
            $gdPendingCT[] = 0;
        }


        //HOLD
        $sql3 = "SELECT `school`, count(*) as `count` FROM `ecle_forms` WHERE `registrarclearance` = 'ON HOLD' GROUP BY `school`";
        $data3 = $con->prepare($sql3);
        $data3->execute();
        $result3 = $data3->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result3)){
            foreach ($result3 as $data3){
                $gdHoldSch[] = $data3['school'];
                $gdHoldCT[] = $data3['count'];
            }
        }else{
            $gdHoldSch[] = 0;
            $gdHoldCT[] = 0;
        }

        mailerRegistrar($ugPendingSch, $ugPendingCT, $gdPendingSch, $gdPendingCT, $ugHoldSch, $ugHoldCT, $gdHoldSch, $gdHoldCT);
    }
}

?>