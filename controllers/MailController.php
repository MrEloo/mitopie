<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailController extends AbstractController
{


    public function sendMail()
    {

        $tokenManager = new CSRFTokenManager();



        //Validation du token avant toute chose pour empêcher les faille CSRF
        if ($tokenManager->validateCSRFToken($_POST['csrf_token'])) {


            if (!empty($_POST['nom']) && !empty($_POST['objet']) && !empty($_POST['email']) && !empty($_POST['message'])) {

                $nom = htmlspecialchars($_POST['nom']);
                $email = htmlspecialchars($_POST['email']);
                $objet = htmlspecialchars($_POST['objet'], ENT_QUOTES);
                $message = htmlspecialchars($_POST['message'], ENT_QUOTES);


                $mail = new PHPMailer(true);

                // $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'eloan.coindin@3wa.io'; // Your Mailtrap username
                $mail->Password = 'injsetitgngohvyb'; // Your Mailtrap password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Sender and recipient settings
                $mail->setFrom($email, $nom);

                $emailReceiver = 'eloan.coindin@outlook.fr';
                $nomDestinataire = 'eloan';

                $mail->addAddress($emailReceiver, $nomDestinataire);

                // Sending plain text email
                $mail->isHTML(false); // Set email format to plain text
                $mail->Subject = $objet;
                $mail->Body = $message;

                // Send the email
                if (!$mail->send()) {
                    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                    $rate = 'Une erreure est survenue, veuillez réessayer plus tard';
                    $this->render('contact.html.twig', ['rate' => $rate]);
                } else {
                    $reussi = 'Votre message a bien été envoyé';
                    $this->render('pages/contact.html.twig', ['reussi' => $reussi]);
                }
            }
        }
    }
}
