<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require "konekcija.php";

if(isset($_POST['mail'])){
    $subject=$_POST['subject'];
    $text=$_POST['text'];
    $code=404;
    $mail = new PHPMailer(true);
   // $nameOfUSer=$_SESSION['user']->ime;    
     try {
        
         //Server settings
         // $mail->SMTPDebug = 0;
          $mail->SMTPOptions = array(
         'ssl' => array(
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
         )
     );                                       // Enable verbose debug output
         $mail->isSMTP();                                      // Set mailer to use SMTP
         $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
         $mail->SMTPAuth = true;                               // Enable SMTP authentication
         $mail->Username = 'mr.antonije@gmail.com';                 // SMTP username
         $mail->Password = 'klarasuman';                           // SMTP password
         $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
         $mail->Port = 587;                                    // TCP port to connect to
     
         //Recipients
         $mail->setFrom('mr.antonije@gmail.com', 'Veste');
          $mail->addAddress('antonijepavlovic1@gmail.com');     // Add a recipient
         // $mail->addAddress('ellen@example.com');               // Name is optional
         // $mail->addReplyTo('info@example.com', 'Information');
         // $mail->addCC('cc@example.com');
         // $mail->addBCC('bcc@example.com');
     
         //Attachments
         // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
         //Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject =$subject;
         //odradi verifikaciju pre nego sto kliknem na link u mail-u
         $mail->Body= $text ;
         // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
         $mail->send();
     
        // echo 'Message has been sent';
         $code = 200;
     } catch (Exception $e) {
        // $code = 500;
        $code=$e->getMessage();
     }
echo $code;
}