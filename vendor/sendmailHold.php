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


function sendOnHoldMail($email, $remarks, $lname, $fname, $mname, $office){

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body ="<p>Dear $lname, $fname $mname,</p>
  <p>Greetings of Peace!</p>
  <p>Your request for an Exit Clearance is currently on-hold.</p>
  <p>Please see the message from the $office below:</p>
  <p><b><i>$remarks.</i></b></p>
  <p>Please resolve the issue / concern immediately for your clearance to proceed.</p>
  <p><b>This is an auto generated email please do not reply.</b></p>
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
     $mail->Subject = 'Exit Clearance On Hold';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}


