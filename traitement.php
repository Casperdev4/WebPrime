<?php

header('Content-Type: text/html; charset=UTF-8');

function contains_links_or_scripts($text) {
    $pattern = "/https?:\/\/[^\s]+|<a\s+href\s*=\s*['\"]?[^\s>]+['\"]?|<script[\s\S]*?<\/script>/i";
    return preg_match($pattern, $text);
}

$nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['e-mail'], ENT_QUOTES, 'UTF-8');
$domaines = htmlspecialchars($_POST['domaines'], ENT_QUOTES, 'UTF-8');
$site = htmlspecialchars($_POST['site'], ENT_QUOTES, 'UTF-8');
$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

if (contains_links_or_scripts($comment)) {
    echo "Les liens ou les scripts ne sont pas autorisés.";
    exit();
}

$message = "Nom : $nom \n";
$message .= "E-mail : $email \n";
$message .= "Secteur : $domaines \n";
$message .= "Site web : $site \n";
$message .= "Commentaires : $comment \n"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.fr';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@webprime.fr';
    $mail->Password   = 'Allamalyjass912!'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('contact@webprime.fr', 'WEBPRIME');
    $mail->addAddress('webprime91@hotmail.com');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->Subject = 'Formulaire';
    $mail->Body    = nl2br($message);
    $mail->AltBody = $message;
    $mail->send();
    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>

