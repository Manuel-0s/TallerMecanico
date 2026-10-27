<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../config/config.php';

class Mail {

    function enviar(array $destinatarios, string $asunto, string $contenido, $adjunto = null): bool {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_EMAIL;
        $mail->Password = SMTP_PASSWORD;

        foreach ($destinatarios as $destinatario) {
            $mail->addAddress($destinatario);
        }

        $mail->setFrom(SMTP_EMAIL, 'Taller Mecánico');
        $mail->Subject = $asunto;
        $mail->msgHTML($contenido);

        return $mail->send();
    }
}
?>