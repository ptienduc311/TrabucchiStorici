<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);

function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $option = [])
{
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $config_email['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config_email['smtp_user'];
        $mail->Password = $config_email['smtp_pass'];
        $mail->SMTPSecure = $config_email['stmp_secure'];
        $mail->Port = $config_email['smtp_port'];
        $mail->CharSet = "UTF-8";
        
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
        // $mail->addCC($config_email['smtp_user']);
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
        // echo "Errore nell'invio della prenotazione. Errore dettagliato: {$mail->ErrorInfo}";
    }
}
