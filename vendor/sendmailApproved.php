<?php
/*if(isset($open) && $open){
  ob_start();
  //do what it is supposed to do
}
else {
  header("HTTP/1.1 403 Forbidden");
  exit;
}*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';


function sendmailApproved($email, $lname, $fname, $mname, $tn, $type){

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body ="
            <p>Dear $fname $mname $lname,</p>

            <p>Good Day!</p>

            <p>Your Exit Clearance has been processed by all concerned departments.</p><br>

            <p>You may now download your signed Exit Clearance form by clicking this <a href=https://ceumnlregistrar.com/ecle/formDownload.php?referenceID=$tn&type=$type> LINK </a>.</p>
            
            <p>You may also download your signed Library Clearance form by clicking this <a href=https://ceumnlregistrar.com/ecle/formDownloadL.php?referenceID=$tn&type=$type> LINK </a>.</p><br>
            
            <p><b>This is an auto-generated email. Please do not reply here.</b></p>
            
            <p>Thank you and stay safe.</p>";
  try {
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = $mailerPlatform;     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = $mailerUsername;   //email
     $mail->Password   = $mailerPassword;                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = $mailerPort;

     //Recipients
     $mail->setFrom($mailerUsername);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = 'Exit Clearance Approved';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}


