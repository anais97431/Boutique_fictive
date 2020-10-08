<?php
require "fonction.php";

captcha();
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$login = $_POST["login"];
$message = $_POST["message"];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$mail = new PHPmailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
$mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
$mail->SMTPAuth = true; // Activer authentication SMTP
$mail->Username = 'anais.elgueta21@gmail.com'; // Votre adresse email d'envoi
$mail->Password = 'Azerty974+'; // Le mot de passe de cette adresse email
$mail->SMTPSecure = 'ssl'; // Accepter SSL
$mail->Port = 465;

$mail->setFrom('anais.elgueta21@gmail.com', 'Anais Elgueta'); // Personnaliser l'envoyeur
$mail->addAddress('anais.elgueta21@gmail.com', 'Anais Elgueta'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = 'Here is the subject';
$mail->Body = "Mail du contact : <br>" . $login . "<br>Message adressé : <br>" . $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


if (!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    
} else {
    echo 'Le message a bien été envoyé !';
}