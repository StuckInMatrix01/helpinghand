<?php 

//echo !extension_loaded('openssl')?"Not Available":"Available";

use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        $mail->SMTPEDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'helping.hand.organization0@gmail.com';
        $mail->Password = "Thepeople'sorganization";
        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
        $mail->Port = '587';

        $mail->setFrom('helping.hand.organization0@gmail.com');
        $mail->addAddress('helping.hand.organization0@gmail.com'); // where i want to receive emails.

        $mail->isHTML(true);
        $mail->Subject  = 'Message Received (Contact Page)';
        $mail->Body = "<h3>Name : $name <br>Email: $email <br> Message: $message</h3>";

        $mail->send();
        $alert = '<div class="alert-success">
                    <span>Message Sent! Thank you for contacting us. </span>
                </div>';
    }catch(Exception $e){
        $alert = '<div class="alert-error">
                    <span>'.$e->getMessage().'</span>
                </div>';
    }

}


?>