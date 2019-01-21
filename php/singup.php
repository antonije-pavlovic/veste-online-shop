<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require "konekcija.php";


   header("Content-type: application/json");
   $code = 404;
   $data = null;

   if(isset($_POST['send'])){       
        $name=$_POST['name'];      
        $username=$_POST['username'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $repeatPass=$_POST['repeatPass'];

        $errors=[];

        $regName="/^[A-Z][a-z]{2,12}$/";        
        $regUsername="/^\w{4,20}$/";
        $regEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        $regPass="/^[A-z0-9]{5,20}\W?[A-z0-9]{0,20}$/";      

    
        if(!preg_match($regName, $name))
            array_push($errors,"your name is not valid");

        if(!preg_match($regUsername, $username))
            array_push($errors,"your username is not valid");

         if(!preg_match($regEmail, $email))
            array_push($errors,"your email is not valid");

        if(!preg_match($regPass, $pass))
            array_push($errors,"your password is not valid");
        if($repeatPass != $pass)
            array_push($errors,"your password is not valid");

        if(count($errors)){
            $code=422;
            $data=$errors;
        }else{
            $pass = md5($pass);
            $date=date("Y-m-d H:m:s",time());
            $token = md5(time() . $date);
            $query="insert into korisnik(ime,korisnicko_ime,email,password,aktivan,token,uloga_id)
                    values(:ime, :kor_ime, :email, :password,0,:token,2)";
            $statement = $konekcija->prepare($query);
            $statement->bindParam(":ime",$name);            
            $statement->bindParam(":kor_ime",$username);
            $statement->bindParam(":email",$email);
            $statement->bindparam(":password",$pass);           
            $statement->bindParam(":token",$token);    
                   
            try{
                $code = $statement->execute() ? 201 : 500;                
                $mail = new PHPMailer(true);   
                            
               // echo $mail; //ispisuje u konzoli 200
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
                    $mail->Password = '';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('mr.antonije@gmail.com', 'Antonije Pavlovic');
                     $mail->addAddress($email);     // Add a recipient
                    // $mail->addAddress('ellen@example.com');               // Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
                
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Registration';                   
                    $mail->Body    = 'Click on the following link: <a href="https://veste-onlineshop.000webhostapp.com/php/verification.php?token='.$token.'">LINK </a>  to activate your account';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                    $mail->send();
                
                   // echo 'Message has been sent';
                    $code = 200;
                } catch (Exception $e) {
                    $code = 500;
                }
            }catch(PDOException $e){
                $code = 409;
            }
        }
    }
    http_response_code($code);
    echo json_encode($data);
