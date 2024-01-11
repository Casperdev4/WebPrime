<?php

$nom = $_POST['nom'];
$email = $_POST['e-mail'];
$telephone = $_POST['telephone'];
$services = $_POST['services'];

$message = "Nom: $nom \n";
$message .= "E-mail: $email \n";
$message .= "Téléphone: $telephone \n";
$message .= "Prestations: $services \n";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                      // Send using SMTP
    $mail->Host       = 'smtp.ionos.fr';                  // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'contact@webprime.fr';            // SMTP username (votre adresse email complète)
    $mail->Password   = 'Allamalyjass912!';               // SMTP password (votre mot de passe)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   // Enable TLS encryption
    $mail->Port       = 465;                              // TCP port to connect to (port alternatif)

    // Recipients
    $mail->setFrom('contact@webprime.fr', 'Assainissement 75');
    $mail->addAddress('contact.aquaserv@gmail.com');  // Remplacez par l'adresse email du destinataire

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
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

