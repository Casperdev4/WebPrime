<?php

$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['e-mail']);
$telephone = htmlspecialchars($_POST['telephone']);
$domaines = htmlspecialchars($_POST['domaines']);
$site = htmlspecialchars($_POST['site']);
$referencement = htmlspecialchars($_POST['referencement']);
$comment = htmlspecialchars($_POST['comment']);

$message = "Nom: $nom \n";
$message .= "E-mail: $email \n";
$message .= "Telephone: $telephone \n";
$message .= "Secteur d'activite: $domaines \n";
$message .= "Site web souhaite: $site \n";
$message .= "Referencement: $referencement \n";
$message .= "Commentaires: $comment \n"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.fr';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@webprime.fr';
    $mail->Password   = 'Allamalyjass912!'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('contact@webprime.fr', 'WebPrime');
    $mail->addAddress('contact@webprime.fr');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Formulaire de contact';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    // Redirection vers index.html
    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>

