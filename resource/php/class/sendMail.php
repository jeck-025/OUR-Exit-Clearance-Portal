<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailAccounts.php';

class sendMail extends config{

    public $student;

    public function sendLibrary(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `ecle_forms` WHERE `libraryclearance` = 'PENDING'";
        $data = $con->prepare($sql);
        $data->execute();
        $arr = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
        }

        $sql2 = "SELECT * FROM `tbl_accounts` WHERE `groups` = 6";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        foreach($result2 as $row2){
            $email = $row2['email'];
            $username = $row2['username'];
        }
        sendmailAccounts($email, $username, $arr);
    }

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

    public function sendAccounting(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `ecle_forms` WHERE `accountingclearance` = 'PENDING'";
        $data = $con->prepare($sql);
        $data->execute();
        $arr = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $arr[] = $row['lname'].", ".$row['fname']." ".$row['mname'];
        }

        $sql2 = "SELECT * FROM `tbl_accounts` WHERE `groups` = 4";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
        foreach($result2 as $row2){
            $email = $row2['email'];
            $username = $row2['username'];
        }
        sendmailAccounts($email, $username, $arr);
    }
}

?>