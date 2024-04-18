<?php

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;

class Mail
{
    private $mailClass;

    public function __construct(private string $email, private string $sujet, private string $message)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'eloan.coinidn@gmail.com';                 // SMTP username
        $mail->Password = 'injsetitgngohvyb';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('eloan.coinidn@gmail.com', 'mitopie');
        $mail->addAddress($email, '');     // Add a recipient

        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $sujet;
        $mail->msgHTML($message, __DIR__);
        $this->mailClass = $mail;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function sendMail()
    {
       $reponse = $this->mailClass->send();
       return $reponse;
    }
}
