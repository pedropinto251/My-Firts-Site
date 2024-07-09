<?php    
    require_once('PHPMailer/PHPMailer.php');
    require_once('PHPMailer/SMTP.php');
    require_once('PHPMailer/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendEmail($emailRecipient, $subject, $body){
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'afavoritadoporto@gmail.com';
            $mail->Password = 'Grupo_06';
            $mail->CharSet = 'UTF-8';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('afavoritadoporto@gmail.com', 'A Favorita do Porto');
            $mail->addAddress($emailRecipient);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
?>