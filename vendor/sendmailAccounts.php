<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';


// function sendmailAccounts($email, $username, array $arr){

//   $mail = new PHPMailer(true);
//   $view = new view();
//   $mailerData = $view->viewConfigMailer();
//   $mailerUsername = $mailerData[0];
//   $mailerPassword = $mailerData[1];
//   $mailerPlatform = $mailerData[2];
//   $mailerPort = $mailerData[3];

//   $string;
//   $list;
//   $arrlength = count($arr);
//   for($i = 0; $i < $arrlength; $i++){
//     $string = $arr[$i]."<br>";
//     $list .= $string;
//   }
//   $list .= 'etc.';

//   $body ="<p>Dear head of $username,</p>
//   <p>Greetings of Peace!</p>
//   <p>Please tend to the following pending clearances of students:</p>".
//   $list
//   ."<p><b>This is an auto generated email please do not reply.</b></p>
//   <p>Thank you and stay safe.</p>";

//   echo $email;

//   echo $body;

//   die();


//   try {
//     //Server settings
//      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//      $mail->isSMTP();
//      $mail->Host       = $mailerPlatform;     //platform
//      $mail->SMTPAuth   = true;
//      $mail->Username   = $mailerUsername;   //email
//      $mail->Password   = $mailerPassword;                                //password
//      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//      $mail->Port       = $mailerPort;

//      //Recipients
//      $mail->setFrom($mailerUsername);       //sender
//      $mail->addAddress($email);

//      //Content
//      $mail->isHTML(true);
//      $mail->Subject = 'Pending Exit Clearances';
//      $mail->Body    = $body;             //content

//      $mail->SMTPDebug  = SMTP::DEBUG_OFF;
//      $mail->send();
//   } catch (Exception $e) {
//       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }
// }

// function sendmailAccountsDean($email, $username, array $arr){

//   $mail = new PHPMailer(true);
//   $view = new view();
//   $mailerData = $view->viewConfigMailer();
//   $mailerUsername = $mailerData[0];
//   $mailerPassword = $mailerData[1];
//   $mailerPlatform = $mailerData[2];
//   $mailerPort = $mailerData[3];

//   $string;
//   $list = "";
//   $arrlength = count($arr);
//   for($i = 0; $i < $arrlength; $i++){
//     $string = $arr[$i]."<br>";
//     $list .= $string;
//   }
//   $list .= 'etc.';
  

//   $body ="<p>Dear head of $username,</p>
//   <p>Greetings of Peace!</p>
//   <p>Please tend to the following pending clearances of students:</p>".
//   $list
//   ."<p><b>This is an auto generated email please do not reply.</b></p>
//   <p>Thank you and stay safe.</p>";

//   try {
//     //Server settings
//      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//      $mail->isSMTP();
//      $mail->Host       = $mailerPlatform;     //platform
//      $mail->SMTPAuth   = true;
//      $mail->Username   = $mailerUsername;   //email
//      $mail->Password   = $mailerPassword;                                //password
//      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//      $mail->Port       = $mailerPort;

//      //Recipients
//      $mail->setFrom($mailerUsername);       //sender
//      $mail->addAddress($email);

//      //Content
//      $mail->isHTML(true);
//      $mail->Subject = 'Pending Exit Clearances';
//      $mail->Body    = $body;             //content

//      $mail->SMTPDebug  = SMTP::DEBUG_OFF;
//      $mail->send();
//   } catch (Exception $e) {
//       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }
// }

//-----------------------------------------------------------------------------------------------
function registrarEmail(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = 2";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function accountingEmail(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = 4";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function guidanceEmail(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = 5";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function libraryEmail(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = 6";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deansEmail(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function mailerRegistrar($ugPendingSch, $ugPendingCT, $gdPendingSch, $gdPendingCT, $ugHoldSch, $ugHoldCT, $gdHoldSch, $gdHoldCT){

  $emails = registrarEmail();

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  if($ugPendingCT > 0){
    $regsPendingArrayUG = array();
    for($i = 0; $i < count($ugPendingSch); $i++){
      $regsPendingArrayUG[$i] = "<tr><td>".$ugPendingSch[$i]." - <b>".$ugPendingCT[$i]."</b></td></tr>";}
    $regsPendingUG = implode('<br>', $regsPendingArrayUG);
  }else{
    $regsPendingUG = "<b>NONE</b>";
  }

  if($ugHoldCT > 0){
    $regsHoldArrayUG = array();
    for($i = 0; $i < count($ugHoldSch); $i++){
      $regsHoldArrayUG[$i] = "<tr><td>".$ugHoldSch[$i]." - <b>".$ugHoldCT[$i]."</b></td></tr>";}
    $regsHoldUG = implode('<br>', $regsHoldArrayUG);
  }else{
    $regsHoldUG = "<b>NONE</b>";
  }

  if($gdPendingCT > 0){
    $regsPendingArrayGD = array();
    for($i = 0; $i < count($gdPendingSch); $i++){
      $regsPendingArrayGD[$i] = "<tr><td>".$gdPendingSch[$i]." - <b>".$gdPendingCT[$i]."</b></td></tr>";}
    $regsPendingGD = implode('<br>', $regsPendingArrayGD);
  }else{
    $regsPendingGD = "<b>NONE</b>";
  }

  if($gdHoldCT > 0){
    $regsHoldArrayGD = array();
    for($i = 0; $i < count($gdHoldSch); $i++){
      $regsHoldArrayGD[$i] = "<tr><td>".$gdHoldSch[$i]." - <b>".$gdHoldCT[$i]."</b></td></tr>";}
    $regsHoldGD = implode('<br>', $regsHoldArrayGD);
  }else{
    $regsHoldGD = "<b>NONE</b>";
  }

  
  $body = "<p>Good Day!</p>
            <p>Please see below the Exit Clearance Daily Report for the Office of the University Registrar</p>
  
          <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
            <tr><td>&nbsp;</td></tr>
            
            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>Pending Exit Clearance - Graduates</h3> </th></tr>
            $regsPendingGD
            
            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>Pending Exit Clearance - Undergraduates</h3> </th></tr>
            $regsPendingUG

            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>On-Hold Clearance - Graduates</h3> </th></tr>
            $regsHoldGD

            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>On-Hold Clearance - Undergraduates</h3> </th></tr>
            $regsHoldUG

            <tr><td>&nbsp;</td></tr>
          </table>";

          echo $body;
      echo $recipient_email;

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = $mailerPlatform;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailerUsername;
    $mail->Password   = $mailerPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $mailerPort;

    //Sender
    $mail->setFrom($mailerUsername);
    // $mail->addAddress('jganatalio@ceu.edu.ph');
    // $mail->addAddress('rcbolasoc@ceu.edu.ph');

    // Recipients
    // for($i = 0; $i < count($emails); $i++){
    //   $mail->addAddress($emails[$i]['email']);
    // }

    $mail->isHTML(true);
    $mail->Subject = 'Exit Clearance Daily Report - Office of the University Registrar';
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerAccounting($countAcctgGD, $countAcctgUG, $countAcctgGDH, $countAcctgUGH){

  $emails = accountingEmail();

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body =
        "Accounting Graduate Pending: $countAcctgGD <br>
         Accounting Undergraduate Pending: $countAcctgUG <br>
         Accounting Graduate Hold: $countAcctgGDH <br>
         Accounting Undergraduate Hold: $countAcctgUGH <br>";

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = $mailerPlatform;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailerUsername;
    $mail->Password   = $mailerPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $mailerPort;

    //Sender
    $mail->setFrom($mailerUsername);

    // Recipients
    for($i = 0; $i < count($emails); $i++){
      $mail->addAddress($emails[$i]['email']);
      echo $emails[$i]['email'];
    }

    $mail->isHTML(true);
    $mail->Subject = 'Exit Clearance Daily Report - Accounting Department';
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerGuidance($countGuidUG, $countGuidUGH){

  $emails = guidanceEmail();

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body =
        "Guidance Undergraduate Pending: $countGuidUG <br>
         Guidance Undergraduate Hold: $countGuidUGH <br>";

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = $mailerPlatform;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailerUsername;
    $mail->Password   = $mailerPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $mailerPort;

    //Sender
    $mail->setFrom($mailerUsername);

    // Recipients
    for($i = 0; $i < count($emails); $i++){
      $mail->addAddress($emails[$i]['email']);
    }

    $mail->isHTML(true);
    $mail->Subject = 'Exit Clearance Daily Report - Guidance and Counseling Department';
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerLibrary($countLibraryGD, $countLibraryUG, $countLibraryGDH, $countLibraryUGH){

  $emails = libraryEmail();

  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the Library Department ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countLibraryGD</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countLibraryUG</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countLibraryGDH</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countLibraryUGH</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p>Thank you.</p>";

      echo $body;


  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = $mailerPlatform;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailerUsername;
    $mail->Password   = $mailerPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $mailerPort;

    //Sender
    $mail->setFrom($mailerUsername);

    // Recipients
    for($i = 0; $i < count($emails); $i++){
      $mail->addAddress($emails[$i]['email']);
    }

    $mail->isHTML(true);
    $mail->Subject = 'Exit Clearance Daily Report - Library Department';
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerDeans($countUGPending0, $countUGHold0, $countGDPending0, $countGDHold0, $abbr0,
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
                    ){
  
  //$emails = registrarEmail();

  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  //$emails = deansEmail();
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  //for($i = 0; $i < 1; $i++){ //test
  for($i = 0; $i < count($emails); $i++){
      $emails = deansEmail();
      if($emails[$i]['colleges'] == "School of Accountancy and Management"){
        $undergradPending = $countUGPending0;
        $undergradHold = $countUGHold0;
        $graduatePending = $countGDPending0;
        $graduateHold = $countGDHold0;
        $school = $abbr0;
      }elseif($emails[$i]['colleges'] == "School of Dentistry"){
        $undergradPending = $countUGPending1;
        $undergradHold = $countUGHold1;
        $graduatePending = $countGDPending1;
        $graduateHold = $countGDHold1;
        $school = $abbr1;
      }elseif($emails[$i]['colleges'] == "School of Education, Liberal Arts, Music and Social Work"){
        $undergradPending = $countUGPending2;
        $undergradHold = $countUGHold2;
        $graduatePending = $countGDPending2;
        $graduateHold = $countGDHold2;
        $school = $abbr2;
      }elseif($emails[$i]['colleges'] == "Graduate School"){
        $undergradPending = $countUGPending3;
        $undergradHold = $countUGHold3;
        $graduatePending = $countGDPending3;
        $graduateHold = $countGDHold3;
        $school = $abbr3;
      }elseif($emails[$i]['colleges'] == "School of Medical Technology"){
        $undergradPending = $countUGPending4;
        $undergradHold = $countUGHold4;
        $graduatePending = $countGDPending4;
        $graduateHold = $countGDHold4;
        $school = $abbr4;
      }elseif($emails[$i]['colleges'] == "School of Medicine"){
        $undergradPending = $countUGPending5;
        $undergradHold = $countUGHold5;
        $graduatePending = $countGDPending5;
        $graduateHold = $countGDHold5;
        $school = $abbr5;
      }elseif($emails[$i]['colleges'] == "School of Nursing"){
        $undergradPending = $countUGPending6;
        $undergradHold = $countUGHold6;
        $graduatePending = $countGDPending6;
        $graduateHold = $countGDHold6;
        $school = $abbr6;
      }elseif($emails[$i]['colleges'] == "School of Nutrition and Hospitality Management"){
        $undergradPending = $countUGPending7;
        $undergradHold = $countUGHold7;
        $graduatePending = $countGDPending7;
        $graduateHold = $countGDHold7;
        $school = $abbr7;
      }elseif($emails[$i]['colleges'] == "School of Optometry"){
        $undergradPending = $countUGPending8;
        $undergradHold = $countUGHold8;
        $graduatePending = $countGDPending8;
        $graduateHold = $countGDHold8;
        $school = $abbr8;
      }elseif($emails[$i]['colleges'] == "School of Pharmacy"){
        $undergradPending = $countUGPending9;
        $undergradHold = $countUGHold9;
        $graduatePending = $countGDPending9;
        $graduateHold = $countGDHold9;
        $school = $abbr9;
      }elseif($emails[$i]['colleges'] == "School of Science and Technology"){
        $undergradPending = $countUGPending10;
        $undergradHold = $countUGHold10;
        $graduatePending = $countGDPending10;
        $graduateHold = $countGDHold10;
        $school = $abbr10;
      }else{
        $undergradPending = "";
        $undergradHold = "";
        $graduatePending = "";
        $graduateHold = "";
        $school = "";
      }

      $schoolName = $emails[$i]['colleges']; // Complete School / College Name
      $user = $emails[$i]['name'];           // Name of Recipient / Secretary
      $recipient_email = $emails[$i]['email']; // Secretary's Email

      $subject = "Exit Clearance Daily Report - $schoolName - $today";
      $body = "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $schoolName ($today)</p>
      
                <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$graduatePending</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$undergradPending</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$graduateHold</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$undergradHold</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p>Thank you.</p>";
                

      // echo $body;
      // echo $recipient_email;
      // echo $emails;



      try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = $mailerPlatform;
        $mail->SMTPAuth   = true;
        $mail->Username   = $mailerUsername;
        $mail->Password   = $mailerPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $mailerPort;

        //Sender
        $mail->setFrom($mailerUsername);

        //Recipient
        //$mail->addAddress($recipient_email);
        //$mail->addAddress('jganatalio@ceu.edu.ph');
        //$mail->addAddress('rcbolasoc@ceu.edu.ph');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->SMTPDebug  = SMTP::DEBUG_OFF;
        //$mail->send();
        
      }catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

}


?>