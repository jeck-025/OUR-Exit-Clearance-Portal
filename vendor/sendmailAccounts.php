<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';

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

function deanEmailSAM(){
  $college = "School of Accountancy and Management";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailDENT(){
  $college = "School of Dentistry";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailELAMS(){
  $college = "School of Education, Liberal Arts, Music and Social Work";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailGRADSCH(){
  $college = "Graduate School";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailMEDTECH(){
  $college = "School of Medical Technology";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailMEDICINE(){
  $college = "School of Medicine";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailNURSING(){
  $college = "School of Nursing";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailNHM(){
  $college = "School of Nutrition and Hospitality Management";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailOPTO(){
  $college = "School of Optometry";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailPHARM(){
  $college = "School of Pharmacy";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function deanEmailSCITECH(){
  $college = "School of Science and Technology";
  $config = new config;
  $con = $config->con();
  $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3' AND `pos` = 'sec' AND `colleges` = '$college'";
  $data = $con-> prepare($sql);
  $data ->execute();
  $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function mailerRegistrar($ugPendingSch, $ugPendingCT, $gdPendingSch, $gdPendingCT, $ugHoldSch, $ugHoldCT, $gdHoldSch, $gdHoldCT){

  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");
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
            <p>Please see below the Exit Clearance Daily Report for the Office of the University Registrar ($today)</p>
  
          <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
            <tr><td>&nbsp;</td></tr>
            
            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>Pending Exit Clearance - Graduates</h3> </th></tr>
            <tr><td>$regsPendingGD</td></tr>
            
            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>Pending Exit Clearance - Undergraduates</h3> </th></tr>
            <tr><td>$regsPendingUG</td></tr>

            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>On-Hold Clearance - Graduates</h3> </th></tr>
            <tr><td>$regsHoldGD</td></tr>

            <tr><td>&nbsp;</td></tr>

            <tr><th style='border: 1px solid #201460; background-color:#201460; color:#fff;'> <h3>On-Hold Clearance - Undergraduates</h3> </th></tr>
            <tr><td>$regsHoldUG</td></tr>

            <tr><td>&nbsp;</td></tr>
            <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
          </table>";

          //echo $body;

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
    for($i = 0; $i < count($emails); $i++){
      $mail->addAddress($emails[$i]['email']);
      //echo $emails[$i]['email'];
    }

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
                <p>Please see below the Exit Clearance Daily Report for the Accounting Department ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countAcctgGD</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countAcctgUG</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countAcctgGDH</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countAcctgUGH</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;

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
      //echo $emails[$i]['email'];
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
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
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

function mailerSAM($countUGPending0, $countUGHold0, $countGDPending0, $countGDHold0, $abbr0){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailSAM();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending0</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending0</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold0</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold0</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerDENT($countUGPending1, $countUGHold1, $countGDPending1, $countGDHold1, $abbr1){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailDENT();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending1</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending1</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold1</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold1</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
        // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerELAMS($countUGPending2, $countUGHold2, $countGDPending2, $countGDHold2, $abbr2){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailELAMS();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending2</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending2</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold2</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold2</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerGRADSCH($countUGPending3, $countUGHold3, $countGDPending3, $countGDHold3, $abbr3){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailGRADSCH();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending3</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending3</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold3</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold3</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;

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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerMEDTECH($countUGPending4, $countUGHold4, $countGDPending4, $countGDHold4, $abbr4){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailMEDTECH();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending4</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending4</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold4</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold4</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerMEDICINE($countUGPending5, $countUGHold5, $countGDPending5, $countGDHold5, $abbr5){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailMEDICINE();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending5</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending5</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold5</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold5</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerNURSING($countUGPending6, $countUGHold6, $countGDPending6, $countGDHold6, $abbr6){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailNURSING();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending6</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending6</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold6</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold6</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerNHM($countUGPending7, $countUGHold7, $countGDPending7, $countGDHold7, $abbr7){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailNHM();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending7</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending7</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold7</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold7</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //$emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerOPTO($countUGPending8, $countUGHold8, $countGDPending8, $countGDHold8, $abbr8){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailOPTO();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending8</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending8</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold8</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold8</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerPHARM($countUGPending9, $countUGHold9, $countGDPending9, $countGDHold9, $abbr9){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailPHARM();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending9</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending9</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold9</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold9</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function mailerSCITECH($countUGPending10, $countUGHold10, $countGDPending10, $countGDHold10, $abbr10){
  date_default_timezone_set('asia/manila');
  $today = date("F j, Y");

  $emails = deanEmailSCITECH();
  $school = $emails[0]['colleges'];
  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $subject = "Exit Clearance Daily Report - $school";
  $body =
        "<p>Good Day!</p>
                <p>Please see below the Exit Clearance Daily Report for the $school ($today)</p>

                  <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDPending10</h3> </td>
                  </tr>
                  
                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGPending10</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countGDHold10</h3> </td>
                  </tr>

                  <tr>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
                    <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$countUGHold10</h3> </td>
                  </tr>

                </table>
                
                <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
                <p><small><i>NOTE: This is an auto-generated email message by the system. Daily Reports are generated every 3pm, Monday-Saturday</i></small></p>
                <p>Thank you.</p>";

      //echo $body;


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
      //echo $emails[$i]['email'];
    }
    // $mail->addAddress('jganatalio@ceu.edu.ph');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
    
  }catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}





// unused functions below here--------------------------------------------------------------------------

// function deansEmail(){
//   $config = new config;
//   $con = $config->con();
//   $sql = "SELECT distinct(`name`), email, colleges from `tbl_accounts` WHERE `groups` = '3'";
//   $data = $con-> prepare($sql);
//   $data ->execute();
//   $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
//   return $rows;
// }

// function mailerDeans($countUGPending0, $countUGHold0, $countGDPending0, $countGDHold0, $abbr0,
//                       $countUGPending1, $countUGHold1, $countGDPending1, $countGDHold1, $abbr1,
//                       $countUGPending2, $countUGHold2, $countGDPending2, $countGDHold2, $abbr2,
//                       $countUGPending3, $countUGHold3, $countGDPending3, $countGDHold3, $abbr3,
//                       $countUGPending4, $countUGHold4, $countGDPending4, $countGDHold4, $abbr4,
//                       $countUGPending5, $countUGHold5, $countGDPending5, $countGDHold5, $abbr5,
//                       $countUGPending6, $countUGHold6, $countGDPending6, $countGDHold6, $abbr6,
//                       $countUGPending7, $countUGHold7, $countGDPending7, $countGDHold7, $abbr7,
//                       $countUGPending8, $countUGHold8, $countGDPending8, $countGDHold8, $abbr8,
//                       $countUGPending9, $countUGHold9, $countGDPending9, $countGDHold9, $abbr9,
//                       $countUGPending10, $countUGHold10, $countGDPending10, $countGDHold10, $abbr10
//                     ){
  
//   //$emails = registrarEmail();

//   date_default_timezone_set('asia/manila');
//   $today = date("F j, Y");

//   //$emails = deansEmail();
//   $mail = new PHPMailer(true);
//   $view = new view();
//   $mailerData = $view->viewConfigMailer();
//   $mailerUsername = $mailerData[0];
//   $mailerPassword = $mailerData[1];
//   $mailerPlatform = $mailerData[2];
//   $mailerPort = $mailerData[3];

//   //for($i = 0; $i < 1; $i++){ //test
//   for($i = 0; $i < count($emails); $i++){
//       $emails = deansEmail();
//       if($emails[$i]['colleges'] == "School of Accountancy and Management"){
//         $undergradPending = $countUGPending0;
//         $undergradHold = $countUGHold0;
//         $graduatePending = $countGDPending0;
//         $graduateHold = $countGDHold0;
//         $school = $abbr0;
//       }elseif($emails[$i]['colleges'] == "School of Dentistry"){
//         $undergradPending = $countUGPending1;
//         $undergradHold = $countUGHold1;
//         $graduatePending = $countGDPending1;
//         $graduateHold = $countGDHold1;
//         $school = $abbr1;
//       }elseif($emails[$i]['colleges'] == "School of Education, Liberal Arts, Music and Social Work"){
//         $undergradPending = $countUGPending2;
//         $undergradHold = $countUGHold2;
//         $graduatePending = $countGDPending2;
//         $graduateHold = $countGDHold2;
//         $school = $abbr2;
//       }elseif($emails[$i]['colleges'] == "Graduate School"){
//         $undergradPending = $countUGPending3;
//         $undergradHold = $countUGHold3;
//         $graduatePending = $countGDPending3;
//         $graduateHold = $countGDHold3;
//         $school = $abbr3;
//       }elseif($emails[$i]['colleges'] == "School of Medical Technology"){
//         $undergradPending = $countUGPending4;
//         $undergradHold = $countUGHold4;
//         $graduatePending = $countGDPending4;
//         $graduateHold = $countGDHold4;
//         $school = $abbr4;
//       }elseif($emails[$i]['colleges'] == "School of Medicine"){
//         $undergradPending = $countUGPending5;
//         $undergradHold = $countUGHold5;
//         $graduatePending = $countGDPending5;
//         $graduateHold = $countGDHold5;
//         $school = $abbr5;
//       }elseif($emails[$i]['colleges'] == "School of Nursing"){
//         $undergradPending = $countUGPending6;
//         $undergradHold = $countUGHold6;
//         $graduatePending = $countGDPending6;
//         $graduateHold = $countGDHold6;
//         $school = $abbr6;
//       }elseif($emails[$i]['colleges'] == "School of Nutrition and Hospitality Management"){
//         $undergradPending = $countUGPending7;
//         $undergradHold = $countUGHold7;
//         $graduatePending = $countGDPending7;
//         $graduateHold = $countGDHold7;
//         $school = $abbr7;
//       }elseif($emails[$i]['colleges'] == "School of Optometry"){
//         $undergradPending = $countUGPending8;
//         $undergradHold = $countUGHold8;
//         $graduatePending = $countGDPending8;
//         $graduateHold = $countGDHold8;
//         $school = $abbr8;
//       }elseif($emails[$i]['colleges'] == "School of Pharmacy"){
//         $undergradPending = $countUGPending9;
//         $undergradHold = $countUGHold9;
//         $graduatePending = $countGDPending9;
//         $graduateHold = $countGDHold9;
//         $school = $abbr9;
//       }elseif($emails[$i]['colleges'] == "School of Science and Technology"){
//         $undergradPending = $countUGPending10;
//         $undergradHold = $countUGHold10;
//         $graduatePending = $countGDPending10;
//         $graduateHold = $countGDHold10;
//         $school = $abbr10;
//       }else{
//         $undergradPending = "";
//         $undergradHold = "";
//         $graduatePending = "";
//         $graduateHold = "";
//         $school = "";
//       }

//       $schoolName = $emails[$i]['colleges']; // Complete School / College Name
//       $user = $emails[$i]['name'];           // Name of Recipient / Secretary
//       $recipient_email = $emails[$i]['email']; // Secretary's Email

//       $subject = "Exit Clearance Daily Report - $schoolName - $today";
//       $body = "<p>Good Day!</p>
//                 <p>Please see below the Exit Clearance Daily Report for the $schoolName ($today)</p>
      
//                 <table style='font-family:arial, sans-serif; border: 1px solid #ddd; border-collapse: collapse; width=100%;'>
//                   <tr>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Graduates</h3> </td>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$graduatePending</h3> </td>
//                   </tr>
                  
//                   <tr>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>Pending Undergraduates</h3> </td>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$undergradPending</h3> </td>
//                   </tr>

//                   <tr>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Graduates</h3> </td>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$graduateHold</h3> </td>
//                   </tr>

//                   <tr>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center; padding-left:10px; padding-right:10px;'> <h3>On-Hold Undergraduates</h3> </td>
//                     <td style='border: 1px solid #ddd; width:50%; text-align:center; vertical-align:center;'> <h3>$undergradHold</h3> </td>
//                   </tr>

//                 </table>
                
//                 <p>You may log-in to your ECLE Account <a href=ceumnlregistrar.com/ecle/adminlogin>HERE</a> to view these pending clearances.</p>
//                 <p>Thank you.</p>";
                

//       // echo $body;
//       // echo $recipient_email;
//       // echo $emails;



//       try {
//         //Server settings
//         $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//         $mail->isSMTP();
//         $mail->Host       = $mailerPlatform;
//         $mail->SMTPAuth   = true;
//         $mail->Username   = $mailerUsername;
//         $mail->Password   = $mailerPassword;
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port       = $mailerPort;

//         //Sender
//         $mail->setFrom($mailerUsername);

//         //Recipient
//         //$mail->addAddress($recipient_email);
//         //$mail->addAddress('jganatalio@ceu.edu.ph');
//         //$mail->addAddress('rcbolasoc@ceu.edu.ph');

//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body = $body;
//         $mail->SMTPDebug  = SMTP::DEBUG_OFF;
//         //$mail->send();
        
//       }catch(Exception $e){
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//       }
//     }

// }

?>