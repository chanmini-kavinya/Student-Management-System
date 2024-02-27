<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

  $subject = $_POST['subject'];
  $message = $_POST['message'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartstartenglishclub0@gmail.com'; 
    $mail->Password = 'smart123!@#';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('smartstartenglishclub0@gmail.com'); 
    $mail->addAddress($email); 
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "<h3>$message</h3>";

    $mail->send();
    echo "<script type='text/javascript'>alert('Message Sent!');</script>";
  } catch (Exception $e){
    $alert = '<div >
                <span>'.$e->getMessage().'</span>
              </div>';
  }
//echo $alert;
?>
      