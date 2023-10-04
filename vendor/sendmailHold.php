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

  $body ="
          <p>Dear $fname $mname $lname,</p>

          <p>Good Day!</p>

          <p>Your request Exit Clearance is currently on-hold.</p><br>
          
          <p>Please see the message / remarks from the $office below:</p>
          
          <p><b><i>$remarks.</i></b></p><br>
          
          <p>Please resolve the issue / concern immediately for your clearance to proceed.</p><br>

          <p>For more information, you may call the Office of the University Registrar at (00632)8735-68-77 or (00632)8735-68-61 local 245 / 274</p><br>
          
          <p><b>This is an auto generated email please do not reply.</b></p><br>
          
          <p>Thank you.</p>";
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


