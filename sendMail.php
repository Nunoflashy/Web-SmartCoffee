<?php
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/Exception.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'PHPMailer/PHPMailer/src/OAuth.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    function sendMail($mail, $subject, $msg) {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Username = 'nunoduquenunes@gmail.com';
        $mailer->Password = '';
        $mailer->Port = 587;
        $mailer->isHTML(true);
        $mailer->setFrom('nunoduquenunes@gmail.com', 'Smart Coffee');
        $mailer->addAddress($mail);
        $mailer->Subject = $subject;
        $mailer->Body    = nl2br($msg);

        if(!$mailer->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
            echo 'Erro: ' . $mailer->ErrorInfo;
        }
    }
?>