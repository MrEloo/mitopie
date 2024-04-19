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

                $nom = htmlspecialchars_decode($_POST['nom']);
                $email = htmlspecialchars_decode($_POST['email']);
                $objet = htmlspecialchars_decode($_POST['objet'], ENT_QUOTES | ENT_HTML5);
                $message = htmlspecialchars_decode($_POST['message'], ENT_QUOTES | ENT_HTML5);


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
                    $_SESSION['rate'] =  $rate;
                    $this->redirect('index.php?route=contact');
                } else {
                    $reussi = 'Votre message a bien été envoyé';
                    $_SESSION['reussi'] = $reussi;
                    $this->redirect('index.php?route=contact');
                }
            }
        }
    }

    public function sendMailToUsers(): void
    {
        if ($this->checkAdmin()) {
            $um = new UserManager();
            $users = $um->getAllUser();

            if (!empty($_POST['objet']) && !empty($_POST['message'])) {

                $objet = utf8_decode($_POST['objet'], ENT_QUOTES | ENT_HTML5);
                $message = utf8_decode($_POST['message'], ENT_QUOTES | ENT_HTML5);


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
                $email = 'eloan.coindin@outlook.fr';
                $nom = 'Coindin Eloan';
                $mail->setFrom($email, $nom);


                foreach ($users as $key => $user) {
                    if ($user->getNewsletter() === 1) {
                        $emailReceiver = $user->getEmail();
                        $nomDestinataire = $user->getNom();

                        $mail->addBCC($emailReceiver, $nomDestinataire);
                    }
                }

                $mail->CharSet = "UTF-8";

                $mail->Encoding = 'base64';


                // Sending plain text email
                $mail->isHTML(false); // Set email format to plain text
                $mail->Subject = $objet;
                $mail->Body = $message;

                // Send the email
                if (!$mail->send()) {
                    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                    $rate = 'Une erreure est survenue, veuillez réessayer plus tard';
                    $_SESSION['rate'] =  $rate;
                    $this->redirect('index.php?route=newsletter');
                } else {
                    $reussi = 'Votre message a bien été envoyé';
                    $_SESSION['reussi'] = $reussi;
                    $this->redirect('index.php?route=newsletter');
                }
            }
        } else {
            $this->redirect('index.php');
        }
    }
}
