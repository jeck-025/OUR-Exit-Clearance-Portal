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
      $regsPendingArrayUG[$i] = "<tr><td>".$ugPendingSch[$i]." - ".$ugPendingCT[$i]."</td></tr>";}
    $regsPendingUG = implode('<br>', $regsPendingArrayUG);
  }else{
    $regsPendingUG = "None";
  }

  if($ugHoldCT > 0){
    $regsHoldArrayUG = array();
    for($i = 0; $i < count($ugHoldSch); $i++){
      $regsHoldArrayUG[$i] = "<tr><td>".$ugHoldSch[$i]." - ".$ugHoldCT[$i]."</td></tr>";}
    $regsHoldUG = implode('<br>', $regsHoldArrayUG);
  }else{
    $regsHoldUG = "None";
  }

  if($gdPendingCT > 0){
    $regsPendingArrayGD = array();
    for($i = 0; $i < count($gdPendingSch); $i++){
      $regsPendingArrayGD[$i] = "<tr><td>".$gdPendingSch[$i]." - ".$gdPendingCT[$i]."</td></tr>";}
    $regsPendingGD = implode('<br>', $regsPendingArrayGD);
  }else{
    $regsPendingGD = "None";
  }

  if($gdHoldCT > 0){
    $regsHoldArrayGD = array();
    for($i = 0; $i < count($gdHoldSch); $i++){
      $regsHoldArrayGD[$i] = "<tr><td>".$gdHoldSch[$i]." - ".$gdHoldCT[$i]."</td></tr>";}
    $regsHoldGD = implode('<br>', $regsHoldArrayGD);
  }else{
    $regsHoldGD = "None";
  }

  
  $body = "<table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=70%;'>
            <tr><th> <b><u> Exit Clearance Daily Report for the Office of the University Registrar </u></b> </th></tr>
            <tr><td>&nbsp;</td></tr>
            
            <tr><th style='border: 1px solid #ddd;'> Pending Exit Clearance - Graduates </th></tr>"
            .$regsPendingGD.
            
            "<tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #ddd;'> Pending Exit Clearance - Undergraduates </th></tr>"
            .$regsPendingUG.

            "<tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #ddd;'> On-Hold Clearance - Graduates </th></tr>"
            .$regsHoldGD.

            "<tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #ddd;'> On-Hold Clearance - Undergraduates </th></tr>"
            .$regsHoldUG.

            "<tr><td>&nbsp;</td></tr>
          </table>";

  //echo $body;





  // echo $gp;

  // $body = 
  //       '<p>Pending Graduates:</p>

  //       for($i = 0; $i < count($gp); $i++){
  //         echo $gp[$i]." ".$gpct[$i];
  //       }
        
        
        
        
        
  //       ';

  

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
    $mail->addAddress('jganatalio@ceu.edu.ph');

    // Recipients
    // for($i = 0; $i < count($emails); $i++){
    //   $mail->addAddress($emails[$i]['email']);
    // }

    $mail->isHTML(true);
    $mail->Subject = 'Exit Clearance Daily Report - Office of the University Registrar';
    $mail->Body = $body;
    // $mail->Body = $body;
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
    //$mail->send();
    
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
    //$mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerLibrary($countLibraryGD, $countLibraryUG, $countLibraryGDH, $countLibraryUGH){

  $emails = libraryEmail();

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body =
        "Library Graduate Pending: $countLibraryGD <br>
         Library Undergraduate Pending: $countLibraryUG <br>
         Library Graduate Hold: $countLibraryGDH <br>
         Library Undergraduate Hold: $countLibraryUGH <br>";

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

?>
