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


function sendmailAccounts($email, $username, array $arr){

  $mail = new PHPMailer(true);
  $view = new view();
  $mailerData = $view->viewConfigMailer();
  $mailerUsername = $mailerData[0];
  $mailerPassword = $mailerData[1];
  $mailerPlatform = $mailerData[2];
  $mailerPort = $mailerData[3];

  $string;
  $list;
  $arrlength = count($arr);
  for($i = 0; $i < $arrlength; $i++){
    $string = $arr[$i]."<br>";
    $list .= $string;
  }
  $list .= 'etc.';

  $body ="<p>Dear head of $username,</p>
  <p>Greetings of Peace!</p>
  <p>Please tend to the following pending clearances of students:</p>".
  $list
  ."<p><b>This is an auto generated email please do not reply.</b></p>
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
     $mail->Subject = 'Pending Exit Clearances';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

  //ORIGINAL SETTINGS
  // try {
  //   //Server settings
  //   //Server settings
  //    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  //    $mail->isSMTP();
  //    $mail->Host       = 'smtp.gmail.com';     //platform
  //    $mail->SMTPAuth   = true;
  //    $mail->Username   = 'ceumnlecle@gmail.com';   //email
  //    $mail->Password   = 'ejgkweqvskernkxs';                                //password
  //    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  //    $mail->Port       = 587;

  //    //Recipients
  //    $mail->setFrom('ceumnlecle@gmail.com');       //sender
  //    $mail->addAddress($email);

  //    //Content
  //    $mail->isHTML(true);
  //    $mail->Subject = 'Pending Exit Clearances';
  //    $mail->Body    = $body;             //content

  //    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
  //    $mail->send();
  // } catch (Exception $e) {
  //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  // }

}

function sendmailAccountsDean($email, $username, array $arr){

  $mail = new PHPMailer(true);

  $string;
  $list = "";
  $arrlength = count($arr);
  for($i = 0; $i < $arrlength; $i++){
    $string = $arr[$i]."<br>";
    $list .= $string;
  }
  $list .= 'etc.';
  

  $body ="<p>Dear head of $username,</p>
  <p>Greetings of Peace!</p>
  <p>Please tend to the following pending clearances of students:</p>".
  $list
  ."<p><b>This is an auto generated email please do not reply.</b></p>
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
    $mail->Subject = 'Pending Exit Clearances';
    $mail->Body    = $body;             //content

    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>
