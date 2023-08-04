<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailAccounts.php';

class sendMail extends config{

    //public $student;

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

    // public function sendDean2(){
    //     $config = new config;

    //     $con = $config->con();
    //     $sql2 = "SELECT `username` FROM `tbl_accounts` WHERE `groups` = 3";
    //     $data2 = $con->prepare($sql2);
    //     $data2->execute();
    //     $usernames = array();
    //     $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result2 as $username){
    //         $usernames[] = $username;
    //     }

    //     $con = $config->con();
    //     $sql3 = "SELECT `email` FROM `tbl_accounts` WHERE `groups` = 3";
    //     $data3 = $con->prepare($sql3);
    //     $data3->execute();
    //     $emails = array();
    //     $result3 = $data3->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result3 as $email){
    //         $emails[] = $email;
    //     }

    //     $con = $config->con();
    //     $sql4 = "SELECT `colleges` FROM `tbl_accounts` WHERE `groups` = 3";
    //     $data4 = $con->prepare($sql4);
    //     $data4->execute();
    //     $colleges = array();
    //     $result4 = $data4->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($result4 as $college){
    //         $colleges[] = $college;
    //     }
        
    //     $collegeItem = "";
    //     $emailItem = "";
    //     $usernameItem = "";
    //     $arrlength = count($colleges);
    //     for($i = 0; $i < $arrlength; $i++){
    //         $college = $colleges[$i];
    //         $collegeItem = implode(" ",$college);
            
    //         $email = $emails[$i];
    //         $emailItem = implode(" ",$email);
            
    //         $username = $usernames[$i];
    //         $usernameItem = implode(" ",$college);
            
    //         $con = $config->con();
    //         $sql = "SELECT * FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `school` = '$collegeItem' AND `expiry` = 'NO'";
            
    //         $data = $con->prepare($sql);
    //         $data->execute();
            
    //         $arr = array();
    //         $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //         if (empty($result)){
    //             continue;
    //         }
    //         else {
    //             foreach($result as $row){
    //                 $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
    //             }
    //             sendmailAccountsDean($emailItem, $usernameItem, $arr);
    //         }
    //       }
    // }

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
        $sql1 = "SELECT `school`, count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' GROUP BY `school`";
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
            $gdHoldSch = 0;
            $gdHoldCT = 0;
        }

        mailerRegistrar($ugPendingSch, $ugPendingCT, $gdPendingSch, $gdPendingCT, $ugHoldSch, $ugHoldCT, $gdHoldSch, $gdHoldCT);
    }

    public function sendDean(){
        $config = new config;
        $con = $config->con();

        // MANUAL CONFIGURATION FOR EACH SCHOOL / COLLEGE

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Accountancy and Management
            $abbr0 = "SAM";

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending0 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr0'";
            $dataUGPending0 = $con->prepare($sqlUGPending0);
            $dataUGPending0->execute();
            $resultUGPending0 = $dataUGPending0->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending0 = $resultUGPending0[0]['count'];

            //ONHOLD
            $sqlUGHold0 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr0'";
            $dataUGHold0 = $con->prepare($sqlUGHold0);
            $dataUGHold0->execute();
            $resultUGHold0 = $dataUGHold0->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold0 = $resultUGHold0[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending0 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr0'";
            $dataGDPending0 = $con->prepare($sqlGDPending0);
            $dataGDPending0->execute();
            $resultGDPending0 = $dataGDPending0->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending0 = $resultGDPending0[0]['count'];

            //HOLD
            $sqlGDHold0 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr0'";
            $dataGDHold0 = $con->prepare($sqlGDHold0);
            $dataGDHold0->execute();
            $resultGDHold0 = $dataGDHold0->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold0 = $resultGDHold0[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Dentistry
            $abbr1 = 'DENT';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending1 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr1'";
            $dataUGPending1 = $con->prepare($sqlUGPending1);
            $dataUGPending1->execute();
            $resultUGPending1 = $dataUGPending1->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending1 = $resultUGPending1[0]['count'];

            //ONHOLD
            $sqlUGHold1 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr1'";
            $dataUGHold1 = $con->prepare($sqlUGHold1);
            $dataUGHold1->execute();
            $resultUGHold1 = $dataUGHold1->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold1 = $resultUGHold1[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr1'";
            $dataGDPending1 = $con->prepare($sqlGDPending1);
            $dataGDPending1->execute();
            $resultGDPending1 = $dataGDPending1->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending1 = $resultGDPending1[0]['count'];

            //HOLD
            $sqlGDHold1 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr1'";
            $dataGDHold1 = $con->prepare($sqlGDHold1);
            $dataGDHold1->execute();
            $resultGDHold1 = $dataGDHold1->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold1 = $resultGDHold1[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Education, Liberal Arts, Music, Social Work
            $abbr2 = 'SELAMS';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending2 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr2'";
            $dataUGPending2 = $con->prepare($sqlUGPending2);
            $dataUGPending2->execute();
            $resultUGPending2 = $dataUGPending2->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending2 = $resultUGPending2[0]['count'];

            //ONHOLD
            $sqlUGHold2 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr2'";
            $dataUGHold2 = $con->prepare($sqlUGHold2);
            $dataUGHold2->execute();
            $resultUGHold2 = $dataUGHold2->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold2 = $resultUGHold2[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending2 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr2'";
            $dataGDPending2 = $con->prepare($sqlGDPending2);
            $dataGDPending2->execute();
            $resultGDPending2 = $dataGDPending2->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending2 = $resultGDPending2[0]['count'];

            //HOLD
            $sqlGDHold2 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr2'";
            $dataGDHold2 = $con->prepare($sqlGDHold2);
            $dataGDHold2->execute();
            $resultGDHold2 = $dataGDHold2->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold2 = $resultGDHold2[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // Graduate School
            $abbr3 = 'GRADSCH';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending3 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr3'";
            $dataUGPending3 = $con->prepare($sqlUGPending3);
            $dataUGPending3->execute();
            $resultUGPending3 = $dataUGPending3->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending3 = $resultUGPending3[0]['count'];

            //ONHOLD
            $sqlUGHold3 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr3'";
            $dataUGHold3 = $con->prepare($sqlUGHold3);
            $dataUGHold3->execute();
            $resultUGHold3 = $dataUGHold3->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold3 = $resultUGHold3[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending3 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr3'";
            $dataGDPending3 = $con->prepare($sqlGDPending3);
            $dataGDPending3->execute();
            $resultGDPending3 = $dataGDPending3->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending3 = $resultGDPending3[0]['count'];

            //HOLD
            $sqlGDHold3 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr3'";
            $dataGDHold3 = $con->prepare($sqlGDHold3);
            $dataGDHold3->execute();
            $resultGDHold3 = $dataGDHold3->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold3 = $resultGDHold3[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Medical Technology
            $abbr4 = 'MEDTECH';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending4 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr4'";
            $dataUGPending4 = $con->prepare($sqlUGPending4);
            $dataUGPending4->execute();
            $resultUGPending4 = $dataUGPending4->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending4 = $resultUGPending4[0]['count'];

            //ONHOLD
            $sqlUGHold4 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr4'";
            $dataUGHold4 = $con->prepare($sqlUGHold4);
            $dataUGHold4->execute();
            $resultUGHold4 = $dataUGHold4->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold4 = $resultUGHold4[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending4 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr4'";
            $dataGDPending4 = $con->prepare($sqlGDPending4);
            $dataGDPending4->execute();
            $resultGDPending4 = $dataGDPending4->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending4 = $resultGDPending4[0]['count'];

            //HOLD
            $sqlGDHold4 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr4'";
            $dataGDHold4 = $con->prepare($sqlGDHold4);
            $dataGDHold4->execute();
            $resultGDHold4 = $dataGDHold4->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold4 = $resultGDHold4[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Medicine
            $abbr5 = 'MEDICINE';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending5 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr5'";
            $dataUGPending5 = $con->prepare($sqlUGPending5);
            $dataUGPending5->execute();
            $resultUGPending5 = $dataUGPending5->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending5 = $resultUGPending5[0]['count'];

            //ONHOLD
            $sqlUGHold5 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr5'";
            $dataUGHold5 = $con->prepare($sqlUGHold5);
            $dataUGHold5->execute();
            $resultUGHold5 = $dataUGHold5->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold5 = $resultUGHold5[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending5 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr5'";
            $dataGDPending5 = $con->prepare($sqlGDPending5);
            $dataGDPending5->execute();
            $resultGDPending5 = $dataGDPending5->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending5 = $resultGDPending5[0]['count'];

            //HOLD
            $sqlGDHold5 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr5'";
            $dataGDHold5 = $con->prepare($sqlGDHold5);
            $dataGDHold5->execute();
            $resultGDHold5 = $dataGDHold5->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold5 = $resultGDHold5[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Nursing
            $abbr6 = 'NURSING';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending6 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr6'";
            $dataUGPending6 = $con->prepare($sqlUGPending6);
            $dataUGPending6->execute();
            $resultUGPending6 = $dataUGPending6->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending6 = $resultUGPending6[0]['count'];

            //ONHOLD
            $sqlUGHold6 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr6'";
            $dataUGHold6 = $con->prepare($sqlUGHold6);
            $dataUGHold6->execute();
            $resultUGHold6 = $dataUGHold6->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold6 = $resultUGHold6[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending6 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr6'";
            $dataGDPending6 = $con->prepare($sqlGDPending6);
            $dataGDPending6->execute();
            $resultGDPending6 = $dataGDPending6->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending6 = $resultGDPending6[0]['count'];

            //HOLD
            $sqlGDHold6 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr6'";
            $dataGDHold6 = $con->prepare($sqlGDHold6);
            $dataGDHold6->execute();
            $resultGDHold6 = $dataGDHold6->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold6 = $resultGDHold6[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Nutrition and Hospitality Management
            $abbr7 = 'NHM';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending7 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr7'";
            $dataUGPending7 = $con->prepare($sqlUGPending7);
            $dataUGPending7->execute();
            $resultUGPending7 = $dataUGPending7->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending7 = $resultUGPending7[0]['count'];

            //ONHOLD
            $sqlUGHold7 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr7'";
            $dataUGHold7 = $con->prepare($sqlUGHold7);
            $dataUGHold7->execute();
            $resultUGHold7 = $dataUGHold7->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold7 = $resultUGHold7[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending7 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr7'";
            $dataGDPending7 = $con->prepare($sqlGDPending7);
            $dataGDPending7->execute();
            $resultGDPending7 = $dataGDPending7->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending7 = $resultGDPending7[0]['count'];

            //HOLD
            $sqlGDHold7 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr7'";
            $dataGDHold7 = $con->prepare($sqlGDHold7);
            $dataGDHold7->execute();
            $resultGDHold7 = $dataGDHold7->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold7 = $resultGDHold7[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Optometry
            $abbr8 = 'OPTO';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending8 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr8'";
            $dataUGPending8 = $con->prepare($sqlUGPending8);
            $dataUGPending8->execute();
            $resultUGPending8 = $dataUGPending8->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending8 = $resultUGPending8[0]['count'];

            //ONHOLD
            $sqlUGHold8 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr8'";
            $dataUGHold8 = $con->prepare($sqlUGHold8);
            $dataUGHold8->execute();
            $resultUGHold8 = $dataUGHold8->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold8 = $resultUGHold8[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending8 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr8'";
            $dataGDPending8 = $con->prepare($sqlGDPending8);
            $dataGDPending8->execute();
            $resultGDPending8 = $dataGDPending8->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending8 = $resultGDPending8[0]['count'];

            //HOLD
            $sqlGDHold8 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr8'";
            $dataGDHold8 = $con->prepare($sqlGDHold8);
            $dataGDHold8->execute();
            $resultGDHold8 = $dataGDHold8->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold8 = $resultGDHold8[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Pharmacy
            $abbr9 = 'PHARM';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending9 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr9'";
            $dataUGPending9 = $con->prepare($sqlUGPending9);
            $dataUGPending9->execute();
            $resultUGPending9 = $dataUGPending9->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending9 = $resultUGPending9[0]['count'];

            //ONHOLD
            $sqlUGHold9 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr9'";
            $dataUGHold9 = $con->prepare($sqlUGHold9);
            $dataUGHold9->execute();
            $resultUGHold9 = $dataUGHold9->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold9 = $resultUGHold9[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending9 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr9'";
            $dataGDPending9 = $con->prepare($sqlGDPending9);
            $dataGDPending9->execute();
            $resultGDPending9 = $dataGDPending9->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending9 = $resultGDPending9[0]['count'];

            //HOLD
            $sqlGDHold9 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr9'";
            $dataGDHold9 = $con->prepare($sqlGDHold9);
            $dataGDHold9->execute();
            $resultGDHold9 = $dataGDHold9->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold9 = $resultGDHold9[0]['count'];

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // School of Science and Technology
            $abbr10 = 'SCITECH';

            // UNDERGRADUATE
            // PENDING
            $sqlUGPending10 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr10'";
            $dataUGPending10 = $con->prepare($sqlUGPending10);
            $dataUGPending10->execute();
            $resultUGPending10 = $dataUGPending10->fetchAll(PDO::FETCH_ASSOC);
            $countUGPending10 = $resultUGPending10[0]['count'];

            //ONHOLD
            $sqlUGHold10 = "SELECT count(*) as `count` FROM `ecle_forms_ug` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr10'";
            $dataUGHold10 = $con->prepare($sqlUGHold10);
            $dataUGHold10->execute();
            $resultUGHold10 = $dataUGHold10->fetchAll(PDO::FETCH_ASSOC);
            $countUGHold10 = $resultUGHold10[0]['count'];

            // GRADUATE
            //PENDING
            $sqlGDPending10 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$abbr10'";
            $dataGDPending10 = $con->prepare($sqlGDPending10);
            $dataGDPending10->execute();
            $resultGDPending10 = $dataGDPending10->fetchAll(PDO::FETCH_ASSOC);
            $countGDPending10 = $resultGDPending10[0]['count'];

            //HOLD
            $sqlGDHold10 = "SELECT count(*) as `count` FROM `ecle_forms` WHERE `departmentclearance` = 'ON HOLD' AND `schoolABBR` = '$abbr10'";
            $dataGDHold10 = $con->prepare($sqlGDHold10);
            $dataGDHold10->execute();
            $resultGDHold10 = $dataGDHold10->fetchAll(PDO::FETCH_ASSOC);
            $countGDHold10 = $resultGDHold10[0]['count'];
        

        mailerDeans(
            $countUGPending0, $countUGHold0, $countGDPending0, $countGDHold0, $abbr0,
            $countUGPending1, $countUGHold1, $countGDPending1, $countGDHold1, $abbr1,
            $countUGPending2, $countUGHold2, $countGDPending2, $countGDHold2, $abbr2,
            $countUGPending3, $countUGHold3, $countGDPending3, $countGDHold3, $abbr3,
            $countUGPending4, $countUGHold4, $countGDPending4, $countGDHold4, $abbr4,
            $countUGPending5, $countUGHold5, $countGDPending5, $countGDHold5, $abbr5,
            $countUGPending6, $countUGHold6, $countGDPending6, $countGDHold6, $abbr6,
            $countUGPending7, $countUGHold7, $countGDPending7, $countGDHold7, $abbr7,
            $countUGPending8, $countUGHold8, $countGDPending8, $countGDHold8, $abbr8,
            $countUGPending9, $countUGHold9, $countGDPending9, $countGDHold9, $abbr9,
            $countUGPending10, $countUGHold10, $countGDPending10, $countGDHold10, $abbr10

        );
    }
}

?>