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


function sendReferenceMail($lname, $fname, $mname, $transnumber, $email){

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $body ="<p>Dear $lname, $fname $mname,</p>

            <p>Good Day!</p>

            <p>You have successfully applied for an Exit Clearance.</p>

            <p>Please take note of your Exit Clearance Reference Number <b>$transnumber</b>.</p>

            <p>You may check the status of your clearance using our Exit Clearance status checker by clicking this <a href=https://ceumnlregistrar.com/ecle/transferCheck>LINK</a>.</p>

            <p>Kindly check your email regularly for updates regarding your clearance.</p>

            <p><b>This is an auto generated email please do not reply.</b></p>

            <p>Thank you and stay safe.</p>";
  try {
    //Server settings
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
     $mail->Subject = 'Exit Clearance Reference Number';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}


