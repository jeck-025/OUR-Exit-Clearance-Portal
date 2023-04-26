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


function sendmailApproved($email, $lname, $fname, $mname, $tn){

  $mail = new PHPMailer(true);

  $body ="<p>Dear $lname, $fname $mname,</p>
  <p>Greetings of Peace!</p>
  <p>Your Exit Clearance has been Approved by the University Registrar.</p>
  <p>You may now download your copy of the Exit Clearance Form</p>
  <p>by visiting the ECLE status checker or click this <a href=https://ceumnlregistrar.com/ecle/formDownload.php?referenceID=$tn> LINK </a></p>
  <p><b>This is an auto-generated email. Please do not reply.</b></p>
  <p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'ceumnlecle@gmail.com';   //email
     $mail->Password   = 'ejgkweqvskernkxs';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom('ceumnlecle@gmail.com');       //sender
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


