<?php

require_once __DIR__ . '/../vendor/phpmailer/PHPMailer.php';
require_once __DIR__ . '/../vendor/phpmailer/SMTP.php';
require_once __DIR__ . '/../vendor/phpmailer/Exception.php';
require_once __DIR__ . '/PersistentManager.php';

use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    public static function inviaConfermaEmail($email, $token) {
        // rileva il dominio vero della richiesta (localhost in sviluppo, il dominio
        // pubblico una volta online) invece di scriverlo fisso: altrimenti un'email
        // generata dal sito online conterrebbe comunque un link a "localhost".
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $link = "http://$host/MechanicOne/utente/confermaEmail/" . $token;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'stefanoarcieri04@gmail.com';
            $mail->Password   = 'lqbd nvwa mnvq xfge'; // la App Password, non quella vera
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('stefanoarcieri04@gmail.com', 'MechanicOne');
            $mail->addAddress($email);
            $mail->Subject = 'Conferma la tua email - MechanicOne';
            $mail->Body    = 'Clicca qui per confermare: ' . $link;

            $mail->send();
        } catch (Exception $e) {
            PersistentManager::getInstance() -> delete('EUtente', 'email', $email); // rimuove l'utente appena creato se l'invio dell'email fallisce
            error_log("Invio email fallito: " . $mail->ErrorInfo);
            throw new \Exception("Impossibile inviare l'email di conferma.");
        }
    }
}
?>
